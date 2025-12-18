<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Message;
use App\Models\FoodOrder;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_rooms' => Room::count(),
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'confirmed_reservations' => Reservation::where('status', 'confirmed')->count(),
            'active_reservations' => Reservation::whereIn('status', ['confirmed', 'checked_in'])->count(),
            'total_messages' => Message::count(),
            'unread_messages' => Message::where('read', false)->count(),
            'total_food_orders' => FoodOrder::count(),
            'pending_food_orders' => FoodOrder::where('status', 'pending')->count(),
        ];

        // Calculate revenue statistics
        $today = now()->toDateString();
        $thisWeek = now()->startOfWeek()->toDateString();
        $thisMonth = now()->startOfMonth()->toDateString();

        // Daily revenue from reservations
        $dailyReservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
            ->whereDate('reservations.created_at', $today)
            ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

        // Daily revenue from food orders
        $dailyFoodRevenue = FoodOrder::whereIn('status', ['confirmed', 'delivered'])
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        // Weekly revenue from reservations
        $weeklyReservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
            ->where('reservations.created_at', '>=', $thisWeek)
            ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

        // Weekly revenue from food orders
        $weeklyFoodRevenue = FoodOrder::whereIn('status', ['confirmed', 'delivered'])
            ->where('created_at', '>=', $thisWeek)
            ->sum('total_amount');

        // Monthly revenue from reservations
        $monthlyReservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
            ->where('reservations.created_at', '>=', $thisMonth)
            ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

        // Monthly revenue from food orders
        $monthlyFoodRevenue = FoodOrder::whereIn('status', ['confirmed', 'delivered'])
            ->where('created_at', '>=', $thisMonth)
            ->sum('total_amount');

        $revenueStats = [
            'daily_total' => $dailyReservationRevenue + $dailyFoodRevenue,
            'daily_reservations' => $dailyReservationRevenue,
            'daily_food' => $dailyFoodRevenue,
            'weekly_total' => $weeklyReservationRevenue + $weeklyFoodRevenue,
            'weekly_reservations' => $weeklyReservationRevenue,
            'weekly_food' => $weeklyFoodRevenue,
            'monthly_total' => $monthlyReservationRevenue + $monthlyFoodRevenue,
            'monthly_reservations' => $monthlyReservationRevenue,
            'monthly_food' => $monthlyFoodRevenue,
        ];

        return view('admin.dashboard', compact('stats', 'revenueStats'));
    }

    // User Management
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin,owner',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:user,admin,owner',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin,owner',
        ]);

        $user->update(['role' => $request->role]);

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User role updated successfully.',
                'user' => [
                    'id' => $user->id,
                    'role' => $user->role,
                    'permissions' => $this->getRolePermissions($user->role)
                ]
            ]);
        }

        // Fallback for non-AJAX requests
        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    private function getRolePermissions($role)
    {
        switch ($role) {
            case 'owner':
                return '✓ Akses Penuh';
            case 'admin':
                return '✓ Kelola Admin, Kamar, Pesanan';
            default:
                return '✓ Reservasi Kamar, Lihat Profil';
        }
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    // Room Management
    public function rooms()
    {
        $rooms = Room::paginate(15);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function createRoom()
    {
        return view('admin.rooms.create');
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'facilities' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'description' => $request->description,
            'facilities' => $request->facilities,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.rooms')->with('success', 'Room created successfully.');
    }

    public function editRoom(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function updateRoom(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'facilities' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $room->image;
        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        $room->update([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'description' => $request->description,
            'facilities' => $request->facilities,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.rooms')->with('success', 'Room updated successfully.');
    }

    public function deleteRoom(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }
        $room->delete();
        return redirect()->route('admin.rooms')->with('success', 'Room deleted successfully.');
    }

    // Message Management
    public function messages()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function showMessage(Message $message)
    {
        $message->update(['read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function deleteMessage(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages')->with('success', 'Message deleted successfully.');
    }

    public function markMessageRead(Message $message)
    {
        $message->update(['read' => true]);
        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function markAllMessagesRead()
    {
        Message::where('read', false)->update(['read' => true]);
        return redirect()->back()->with('success', 'All messages marked as read.');
    }

    // Food Order Management
    public function foodOrders()
    {
        $foodOrders = FoodOrder::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.food-orders.index', compact('foodOrders'));
    }

    public function showFoodOrder(FoodOrder $foodOrder)
    {
        $foodOrder->load('user');
        return view('admin.food-orders.show', compact('foodOrder'));
    }

    public function editFoodOrder(FoodOrder $foodOrder)
    {
        return view('admin.food-orders.edit', compact('foodOrder'));
    }

    public function updateFoodOrder(Request $request, FoodOrder $foodOrder)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
            'delivery_time' => 'nullable|date',
            'special_instructions' => 'nullable|string|max:1000',
        ]);

        $foodOrder->update([
            'status' => $request->status,
            'delivery_time' => $request->delivery_time,
            'special_instructions' => $request->special_instructions,
        ]);

        return redirect()->route('admin.food-orders.index')->with('success', 'Food order updated successfully.');
    }

    public function updateFoodOrderStatus(Request $request, FoodOrder $foodOrder)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
        ]);

        $foodOrder->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Food order status updated successfully.');
    }

    public function deleteFoodOrder(FoodOrder $foodOrder)
    {
        $foodOrder->delete();
        return redirect()->route('admin.food-orders.index')->with('success', 'Food order deleted successfully.');
    }



    // Reservation Management
    public function reservations()
    {
        $reservations = Reservation::with(['user', 'room'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function showReservation(Reservation $reservation)
    {
        $reservation->load(['user', 'room']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateReservationStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
        ]);

        $reservation->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Reservation status updated successfully.');
    }

    // Revenue Management
    public function revenue()
    {
        // Calculate revenue from reservations
        $reservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
            ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

        // Calculate revenue from food orders
        $foodOrderRevenue = FoodOrder::whereIn('status', ['confirmed', 'delivered'])
            ->sum('total_amount');

        // Get monthly revenue data for the last 12 months
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');

            $monthlyReservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->whereYear('reservations.created_at', $date->year)
                ->whereMonth('reservations.created_at', $date->month)
                ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
                ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

            $monthlyFoodRevenue = FoodOrder::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereIn('status', ['confirmed', 'delivered'])
                ->sum('total_amount');

            $monthlyRevenue[$monthName] = $monthlyReservationRevenue + $monthlyFoodRevenue;
        }

        $totalRevenue = $reservationRevenue + $foodOrderRevenue;

        return view('admin.revenue', compact(
            'totalRevenue',
            'reservationRevenue',
            'foodOrderRevenue',
            'monthlyRevenue'
        ));
    }

    // Room Revenue Management
    public function roomRevenue()
    {
        // Calculate revenue from room reservations
        $reservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
            ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

        // Get monthly revenue data for room reservations for the last 12 months
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');

            $monthlyReservationRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->whereYear('reservations.created_at', $date->year)
                ->whereMonth('reservations.created_at', $date->month)
                ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
                ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

            $monthlyRevenue[$monthName] = $monthlyReservationRevenue;
        }

        return view('admin.room-revenue', compact('reservationRevenue', 'monthlyRevenue'));
    }

    // Food Revenue Management
    public function foodRevenue()
    {
        // Calculate revenue from food orders
        $foodOrderRevenue = FoodOrder::whereIn('status', ['confirmed', 'delivered'])
            ->sum('total_amount');

        // Get monthly revenue data for food orders for the last 12 months
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');

            $monthlyFoodRevenue = FoodOrder::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereIn('status', ['confirmed', 'delivered'])
                ->sum('total_amount');

            $monthlyRevenue[$monthName] = $monthlyFoodRevenue;
        }

        return view('admin.food-revenue', compact('foodOrderRevenue', 'monthlyRevenue'));
    }

    // Export Revenue Data
    public function exportRevenue()
    {
        $filename = 'revenue_report_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSV Headers
            fputcsv($file, [
                'Month',
                'Room Revenue',
                'Food Revenue',
                'Total Revenue'
            ], ';'); // Use semicolon as delimiter for better Excel compatibility

            // Get data for the last 12 months
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthName = $date->format('M Y');

                // Room revenue for the month
                $roomRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
                    ->whereYear('reservations.created_at', $date->year)
                    ->whereMonth('reservations.created_at', $date->month)
                    ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
                    ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

                // Food revenue for the month
                $foodRevenue = FoodOrder::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->where('status', 'delivered')
                    ->sum('total_amount');

                $totalRevenue = $roomRevenue + $foodRevenue;

                fputcsv($file, [
                    $monthName,
                    'IDR ' . number_format($roomRevenue, 0, ',', '.'), // Format as IDR with Indonesian number format
                    'IDR ' . number_format($foodRevenue, 0, ',', '.'),
                    'IDR ' . number_format($totalRevenue, 0, ',', '.')
                ], ';'); // Use semicolon as delimiter
            }

            // Add summary row
            fputcsv($file, ['', '', '', '', ''], ';'); // Empty row for separation

            // Total revenue summary
            $totalRoomRevenue = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->whereIn('reservations.status', ['confirmed', 'checked_in', 'checked_out'])
                ->sum(\DB::raw('CAST((julianday(reservations.check_out) - julianday(reservations.check_in)) AS INTEGER) * rooms.price_per_night'));

            $totalFoodRevenue = FoodOrder::whereIn('status', ['confirmed', 'delivered'])->sum('total_amount');
            $grandTotal = $totalRoomRevenue + $totalFoodRevenue;

            fputcsv($file, [
                'TOTAL',
                'IDR ' . number_format($totalRoomRevenue, 0, ',', '.'),
                'IDR ' . number_format($totalFoodRevenue, 0, ',', '.'),
                'IDR ' . number_format($grandTotal, 0, ',', '.')
            ], ';'); // Use semicolon as delimiter

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
