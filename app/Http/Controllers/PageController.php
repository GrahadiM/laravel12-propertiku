<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Mail\StoreContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEmailRequest;

class PageController extends Controller
{
    public function home() : View
    {
        $categories = Category::with('properties')->get();
        $posts = Post::get();
        // dd($categories, $posts);

        return view('home', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    public function detail(Property $property) : View
    {
        return view('detail', [
            'property' => $property
        ]);
    }

    public function property(Request $request)
    {
        $categories = Category::all();

        // Mulai query properti
        $query = Property::with(['galleries', 'category']);

        // Jika ada filter kategori yang dipilih
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('title', $request->category);
            });
        }

        $properties = $query->get();

        return view('property', [
            'properties' => $properties,
            'categories' => $categories
        ]);
    }

    public function posts()
    {
        $posts = Post::get();

        return view('posts', [
            'posts' => $posts
        ]);
    }

    public function detailPost(Post $post){
        return view('posts-detail',[
            'post' => $post
        ]);
    }

    public function contact()
    {
        // return view('contact');
        return view('contact-whatsapp');
    }

    // Contact-Us via WhatsApp
    public function getWhatsapp(Request $request){
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $url = 'https://api.whatsapp.com/send?phone=+6281360503971&text=Nama%20:%20'.$name.'%0AEmail%20:%20'.$email.'%0APesan%20:%20'.$message;

        return redirect($url);
    }

    // Contact-Us via Email
    public function getEmail(StoreEmailRequest $request){
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('grahadim178@gmail.com')->send(new StoreContactMail($detail));
        return back()->with('message', 'Terimakasih atas feedbacknya! kami akan membacanya sesegera mungkin');
    }

    public function order(Property $property, Request $request)
    {
        // Generate unique order ID untuk Properti
        $orderId = 'PRP-' . date('Ymd') . '-' . rand(1000, 9999);

        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $property->price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone ?? '08xxxxxxxxxx',
            ],
            'item_details' => [
                [
                    'id' => $property->id,
                    'price' => $property->price,
                    'quantity' => 1,
                    'name' => $property->name,
                    'category' => $property->category->title ?? 'Property Unit',
                ]
            ],
            'callbacks' => [
                'finish' => route('payment.finish'),
                'error' => route('payment.error'),
                'pending' => route('payment.pending'),
            ],
            'enabled_payments' => ['credit_card', 'gopay', 'shopeepay', 'bca_va', 'bni_va', 'bri_va', 'indomaret', 'alfamart'],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'property_id' => $property->id, // Sesuaikan foreign key di tabel transaksi
                'order_id' => $orderId,
                'transaction_id' => $orderId,
                'amount' => $property->price,
                'status' => 'pending',
                'snap_token' => $snapToken,
            ]);

            return view('order', [
                'snap_token' => $snapToken,
                'property' => $property,
                'transaction' => $transaction
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function paymentFinish(Request $request): RedirectResponse
    {
        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;

        \Log::info('Payment Finish Callback', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
            'all_params' => $request->all()
        ]);

        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            // Update transaction status based on callback parameters
            $status = $this->mapTransactionStatus($transactionStatus);
            $transaction->update([
                'status' => $status,
                'payment_type' => $request->payment_type ?? null,
                'payment_data' => $request->all()
            ]);

            if ($status === 'success') {
                return redirect()->route('payment.success')->with([
                    'success' => 'Pembayaran berhasil!',
                    'order_id' => $orderId
                ]);
            } elseif ($status === 'pending') {
                return redirect()->route('payment.pending-page')->with([
                    'info' => 'Menunggu konfirmasi pembayaran...',
                    'order_id' => $orderId
                ]);
            }
        }

        return redirect()->route('payment.pending-page')->with('info', 'Menunggu konfirmasi pembayaran...');
    }

    public function paymentError(Request $request): RedirectResponse
    {
        $orderId = $request->order_id;

        \Log::error('Payment Error Callback', [
            'order_id' => $orderId,
            'all_params' => $request->all()
        ]);

        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            $transaction->update([
                'status' => 'failed',
                'payment_data' => $request->all()
            ]);
        }

        return redirect()->route('payment.failed')->with('error', 'Pembayaran gagal! Silakan coba lagi.');
    }

    public function paymentPending(Request $request): RedirectResponse
    {
        $orderId = $request->order_id;

        \Log::info('Payment Pending Callback', [
            'order_id' => $orderId,
            'all_params' => $request->all()
        ]);

        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            $transaction->update([
                'status' => 'pending',
                'payment_data' => $request->all()
            ]);
        }

        return redirect()->route('payment.pending-page')->with('info', 'Menunggu pembayaran...');
    }

    public function paymentSuccess(): View
    {
        return view('payment.success');
    }

    public function paymentFailed(): View
    {
        return view('payment.failed');
    }

    public function paymentPendingPage(): View
    {
        return view('payment.pending');
    }

    private function mapTransactionStatus($midtransStatus)
    {
        $statusMap = [
            'capture' => 'success',
            'settlement' => 'success',
            'pending' => 'pending',
            'deny' => 'failed',
            'cancel' => 'failed',
            'expire' => 'failed',
            'failure' => 'failed'
        ];

        return $statusMap[$midtransStatus] ?? 'pending';
    }

    private function checkTransactionStatus($orderId)
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);
            return $this->mapTransactionStatus($status->transaction_status);
        } catch (\Exception $e) {
            \Log::error('Error checking transaction status: ' . $e->getMessage());
            return 'pending';
        }
    }

    // Webhook for Midtrans notification (server-to-server)
    public function paymentNotification(Request $request)
    {
        $notification = $request->all();

        \Log::info('Payment Notification Webhook', $notification);

        $transaction = Transaction::where('order_id', $notification['order_id'])->first();

        if ($transaction) {
            $status = $this->mapTransactionStatus($notification['transaction_status']);

            $transaction->update([
                'status' => $status,
                'payment_type' => $notification['payment_type'] ?? null,
                'payment_data' => $notification
            ]);

            \Log::info('Transaction updated via webhook', [
                'order_id' => $notification['order_id'],
                'status' => $status
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
