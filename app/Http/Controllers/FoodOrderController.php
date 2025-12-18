<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodOrder;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FoodOrderController extends Controller
{
    public function create(Request $request)
    {
        // Get the item from the request (passed via query parameter)
        $item = $request->query('item');
        $price = $request->query('price');

        // Get user's current reservation for room number
        $currentReservation = Auth::user()->reservations()
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->where('check_in', '<=', now())
            ->where('check_out', '>=', now())
            ->first();

        $roomNumber = $currentReservation ? $currentReservation->room->room_number : null;

        return view('food-order', compact('item', 'price', 'roomNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'room_number' => 'nullable|string|max:10',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'special_instructions' => 'nullable|string|max:1000',
        ]);

        $totalAmount = $request->quantity * $request->price;

        $items = [
            [
                'name' => $request->item_name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'subtotal' => $totalAmount,
            ]
        ];

        $foodOrder = FoodOrder::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'room_number' => $request->room_number,
            'items' => $items,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'special_instructions' => $request->special_instructions,
            'delivery_time' => now()->addMinutes(30), // Estimated delivery in 30 minutes
        ]);

        Log::info('Food order created', [
            'order_id' => $foodOrder->id,
            'user_id' => Auth::id(),
            'room_number' => $request->room_number,
            'items' => $items,
        ]);

        return redirect()->route('food')->with('success', 'Pesanan telah dibuat, Mohon menunggu');
    }

    public function index()
    {
        $orders = Auth::user()->foodOrders()->latest()->paginate(10);
        return view('food-orders', compact('orders'));
    }

    public function show(FoodOrder $foodOrder)
    {
        if ($foodOrder->user_id !== Auth::id()) {
            abort(403);
        }

        return view('food-order-detail', compact('foodOrder'));
    }
}
