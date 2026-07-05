<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Tampilkan form checkout
    public function create(Car $car)
    {
        return view('orders.create', compact('car'));
    }

    // Simpan order & kirim notifikasi ke penjual
    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
            'note'    => 'nullable|string',
        ]);

        $validated['car_id']    = $car->id;
        $validated['buyer_id']  = Auth::id();
        $validated['status']    = 'pending';

        $order = Order::create($validated);

        // Kirim notifikasi ke penjual
        $car->user->notify(new NewOrderNotification($order));

        return redirect()->route('orders.success')->with('success', 'Pesanan berhasil dikirim!');
    }

    // Halaman sukses setelah checkout
    public function success()
    {
        return view('orders.success');
    }

    // Halaman notifikasi penjual
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('orders.notifications', compact('notifications'));
    }

    // Konfirmasi order (tandai terjual)
    public function confirm(Order $order)
    {
        if ($order->car->user_id !== Auth::id()) {
            abort(403);
        }

        $order->update(['status' => 'confirmed']);
        $order->car->update(['status' => 'sold']);

        Auth::user()->notifications()->where('data->order_id', $order->id)->update(['read_at' => now()]);

        return back()->with('success', 'Pesanan dikonfirmasi, mobil ditandai Terjual!');
    }

    // Tolak order
    public function reject(Order $order)
    {
        if ($order->car->user_id !== Auth::id()) {
            abort(403);
        }

        $order->update(['status' => 'rejected']);

        Auth::user()->notifications()->where('data->order_id', $order->id)->update(['read_at' => now()]);

        return back()->with('success', 'Pesanan ditolak.');
    }

    public function myOrders()
{
    $orders = Order::where('buyer_id', Auth::id())
                   ->with('car')
                   ->latest()
                   ->paginate(10);
    return view('orders.my-orders', compact('orders'));
}
}