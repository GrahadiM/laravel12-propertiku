<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();
        $recentOrders = Transaction::where('user_id', $user->id)
            ->with('travelPackage')
            ->latest()
            ->take(5)
            ->get();

        return view('profile.show', [
            'user' => $user,
            'recentOrders' => $recentOrders
        ]);
    }

    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui!');
    }

    public function orders(): View
    {
        $user = Auth::user();
        $orders = Transaction::where('user_id', $user->id)
            ->with('travelPackage')
            ->latest()
            ->paginate(10);

        return view('profile.orders', [
            'orders' => $orders
        ]);
    }

    public function cancelOrder(Transaction $order): RedirectResponse
    {
        // Pastikan order milik user yang sedang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Hanya bisa cancel order dengan status pending
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya order dengan status pending yang dapat dibatalkan.');
        }

        $order->update(['status' => 'cancel']);

        return redirect()->route('profile.orders')->with('success', 'Order berhasil dibatalkan.');
    }

    public function checkPaymentStatus($orderId): JsonResponse
    {
        $order = Transaction::where('order_id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        try {
            // Cek status ke Midtrans
            $status = \Midtrans\Transaction::status($orderId);

            // Update status di database
            $order->update(['status' => $status->transaction_status]);

            return response()->json([
                'status' => $status->transaction_status,
                'message' => 'Status berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $order->status,
                'message' => 'Gagal memeriksa status: ' . $e->getMessage()
            ], 500);
        }
    }
}
