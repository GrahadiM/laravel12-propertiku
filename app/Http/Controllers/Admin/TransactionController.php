<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index(): View
    {
        return view('admin.transactions.index');
    }

    public function datatables(): JsonResponse
    {
        $transactions = Transaction::with(['user', 'travelPackage'])
            ->select('transactions.*')
            ->latest();

        return DataTables::of($transactions)
            ->addIndexColumn()
            ->addColumn('action', function ($transaction) {
                return '
                    <div class="btn-group" role="group">
                        <button type="button"
                                class="btn btn-info btn-sm view-details"
                                data-toggle="modal"
                                data-target="#transactionModal"
                                data-transaction-id="' . $transaction->id . '">
                            <i class="fa fa-eye"></i>
                        </button>
                        <!-- <form class="d-inline"
                              action="' . route('admin.transactions.update-status', $transaction) . '"
                              method="POST">
                            ' . csrf_field() . '
                            ' . method_field('PUT') . '
                            <input type="hidden" name="status" value="success">
                            <button type="submit"
                                    class="btn btn-success btn-sm"
                                    title="Mark as Success"
                                    onclick="return confirm(\'Apakah Anda yakin ingin mengubah status menjadi success?\')">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                        <form class="d-inline"
                              action="' . route('admin.transactions.update-status', $transaction) . '"
                              method="POST">
                            ' . csrf_field() . '
                            ' . method_field('PUT') . '
                            <input type="hidden" name="status" value="failed">
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Mark as Failed"
                                    onclick="return confirm(\'Apakah Anda yakin ingin mengubah status menjadi failed?\')">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                        <form class="d-inline delete-form"
                              action="' . route('admin.transactions.destroy', $transaction) . '"
                              method="POST">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit"
                                    class="btn btn-dark btn-sm"
                                    title="Delete"
                                    onclick="return confirm(\'Apakah Anda yakin ingin menghapus transaksi ini?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form> -->
                    </div>
                ';
            })
            ->editColumn('user.name', function ($transaction) {
                return $transaction->user ? $transaction->user->name : 'N/A';
            })
            ->editColumn('travelPackage.name', function ($transaction) {
                return $transaction->travelPackage ? $transaction->travelPackage->name : 'N/A';
            })
            ->editColumn('amount', function ($transaction) {
                return 'Rp ' . number_format($transaction->amount, 0, ',', '.');
            })
            ->editColumn('status', function ($transaction) {
                $statusColors = [
                    'success' => 'success',
                    'pending' => 'warning',
                    'failed' => 'danger',
                    'cancel' => 'secondary',
                    'expire' => 'dark'
                ];

                $color = $statusColors[$transaction->status] ?? 'secondary';
                return '<span class="badge badge-' . $color . '">' . ucfirst($transaction->status) . '</span>';
            })
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($transaction) {
                return $transaction->updated_at->format('d/m/Y H:i');
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function show(Transaction $transaction): JsonResponse
    {
        try {
            $transaction->load(['user', 'travelPackage']);

            return response()->json([
                'success' => true,
                'transaction' => $transaction,
                'travel_package' => $transaction->travelPackage,
                'user' => $transaction->user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }
    }

    public function updateStatus(Transaction $transaction): JsonResponse
    {
        try {
            $status = request('status');

            $validStatuses = ['success', 'pending', 'failed', 'cancel', 'expire'];

            if (!in_array($status, $validStatuses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid'
                ], 400);
            }

            $transaction->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Status transaksi berhasil diubah menjadi ' . $status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Transaction $transaction): JsonResponse
    {
        try {
            $transaction->delete();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function statistics(): JsonResponse
    {
        try {
            $totalTransactions = Transaction::count();
            $successTransactions = Transaction::where('status', 'success')->count();
            $pendingTransactions = Transaction::where('status', 'pending')->count();
            $failedTransactions = Transaction::where('status', 'failed')->count();
            $totalRevenue = Transaction::where('status', 'success')->sum('amount');
            $avgTransaction = $successTransactions > 0 ? $totalRevenue / $successTransactions : 0;

            return response()->json([
                'success' => true,
                'total_transactions' => $totalTransactions,
                'success_transactions' => $successTransactions,
                'pending_transactions' => $pendingTransactions,
                'failed_transactions' => $failedTransactions,
                'total_revenue' => $totalRevenue,
                'avg_transaction' => $avgTransaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export(): JsonResponse
    {
        // Untuk sementara return response JSON
        // Nanti bisa diimplementasi export ke Excel/PDF
        return response()->json([
            'success' => true,
            'message' => 'Fitur export akan segera tersedia'
        ]);
    }
}
