<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\PersonalData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use Carbon\Carbon; // Alias Carbon\Carbon untuk kejelasan

class HomeController extends Controller
{
    // --- Public Views ---

    public function index()
    {
        return view('home');
    }

    public function rooms()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    public function amenities()
    {
        return view('amenities');
    }

    public function contact()
    {
        return view('contact');
    }

    public function food()
    {
        return view('food');
    }

    public function booking()
    {
        $rooms = Room::all();
        return view('booking', compact('rooms'));
    }

    // --- Reservasi & Booking ---

    public function store(Request $request)
    {
        // 1. Validasi Data Formulir
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
            'room_type' => 'required|exists:rooms,id',
            // Passport bersifat opsional
            'id_card' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'passport' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120', 
            // Input checkbox dari form akan berupa 'on' atau null, bukan boolean
            'breakfast' => 'nullable', 
            'spa' => 'nullable',
            'airport_transfer' => 'nullable',
            'terms' => 'required|accepted',
        ]);

        // 2. Perhitungan Biaya
        $room = Room::findOrFail($request->room_type);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);

        $totalAmount = $room->price_per_night * $nights;
        $additionalServices = [];

        // Hitung layanan tambahan
        if ($request->has('breakfast')) {
            $totalAmount += 75000 * $request->guests * $nights;
            $additionalServices['breakfast'] = 75000 * $request->guests * $nights;
        }
        if ($request->has('spa')) {
            $totalAmount += 250000;
            $additionalServices['spa'] = 250000;
        }
        if ($request->has('airport_transfer')) {
            $totalAmount += 150000;
            $additionalServices['airport_transfer'] = 150000;
        }

        // 3. Buat Reservasi
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_type,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            // Simpan data guest sebagai JSON/array di special_requests
            'special_requests' => [
                'guest_name' => $request->name,
                'guest_email' => $request->email,
                'guest_phone' => $request->phone,
            ],
            // Simpan layanan tambahan
            'additional_services' => $additionalServices,
        ]);

        // 4. Unggah dan Simpan Data Personal
        $filesToSave = [];
        if ($request->hasFile('id_card')) {
            $filesToSave[] = $this->storeFile($request->file('id_card'), 'id_card', $reservation->id);
        }
        if ($request->hasFile('passport')) {
            $filesToSave[] = $this->storeFile($request->file('passport'), 'passport', $reservation->id);
        }

        // Simpan semua PersonalData
        foreach ($filesToSave as $file) {
            PersonalData::create($file);
        }

        // 5. Perbaikan: Redirect ke Halaman Riwayat Reservasi dengan Notifikasi
        return redirect()->route('reservations') // Ganti 'reservations' dengan nama route riwayat Anda
                         ->with('success', 'Reservasi Anda berhasil dibuat! Silakan cek riwayat untuk detail pembayaran.');
    }

    /**
     * Helper function to store file and return data array for PersonalData model.
     */
    private function storeFile($file, $type, $reservationId)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . $reservationId . '_' . $type . '.' . $extension;
        
        // PENTING: Gunakan 'private' disk untuk dokumen sensitif
        $path = $file->storeAs('personal_data', $filename, 'private'); 

        return [
            'reservation_id' => $reservationId,
            'file_path' => $path,
            'file_type' => $type,
            'original_name' => $originalName,
        ];
    }



    // --- Riwayat Reservasi ---

    public function reservations()
    {
        $reservations = Auth::user()->reservations()->with('room')->latest()->get();
        return view('reservations', compact('reservations'));
    }

    public function showReservation(Reservation $reservation)
    {
        // Route Model Binding memastikan $reservation adalah instance dari Reservation
        
        // Ensure the reservation belongs to the authenticated user
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if reservation should be marked as completed (past check-out date)
        // Gunakan helper Carbon/now() untuk perbandingan yang lebih aman
        if (in_array($reservation->status, ['confirmed', 'checked_in']) && $reservation->check_out < Carbon::now()) {
            $reservation->update(['status' => 'completed']);
        }

        return view('reservation-detail', compact('reservation'));
    }

    public function checkIn(Request $request, Reservation $reservation)
    {
        // Route Model Binding ensures $reservation is an instance
        
        // Ensure the reservation belongs to the authenticated user
        if ($reservation->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if the reservation is confirmed
        if ($reservation->status !== 'confirmed') {
            return response()->json(['error' => 'Only confirmed reservations can be checked in'], 400);
        }

        // Update the status to checked_in
        $reservation->update(['status' => 'checked_in']);

        return response()->json(['success' => 'Check-in successful', 'status' => 'checked_in']);
    }
}