<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\TravelPackage;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $travelPackages = TravelPackage::with('galleries')->count();
        $posts = Post::count();

        // Transaction Statistics
        $totalTransactions = Transaction::count();
        $pendingTransactions = Transaction::where('status', 'pending')->count();
        $successTransactions = Transaction::where('status', 'success')->count();
        $failedTransactions = Transaction::where('status', 'failed')->count();
        $totalRevenue = Transaction::where('status', 'success')->sum('amount');

        // Chart Data - Monthly Transactions (Last 6 months)
        $monthlyTransactions = $this->getMonthlyTransactions();

        // Chart Data - Transaction Status Distribution
        $statusDistribution = $this->getStatusDistribution();

        // Chart Data - Top Travel Packages
        $topPackages = $this->getTopPackages();

        // Recent Transactions
        $recentTransactions = Transaction::with(['user', 'travelPackage'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', [
            'travelPackages' => $travelPackages,
            'posts' => $posts,
            'totalTransactions' => $totalTransactions,
            'pendingTransactions' => $pendingTransactions,
            'successTransactions' => $successTransactions,
            'failedTransactions' => $failedTransactions,
            'totalRevenue' => $totalRevenue,
            'monthlyTransactions' => $monthlyTransactions,
            'statusDistribution' => $statusDistribution,
            'topPackages' => $topPackages,
            'recentTransactions' => $recentTransactions
        ]);
    }

    private function getMonthlyTransactions()
    {
        $transactions = Transaction::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(CASE WHEN status = "success" THEN amount ELSE 0 END) as revenue')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        $labels = [];
        $data = [];
        $revenue = [];

        foreach ($transactions as $transaction) {
            $monthName = date('M Y', mktime(0, 0, 0, $transaction->month, 1, $transaction->year));
            $labels[] = $monthName;
            $data[] = $transaction->count;
            $revenue[] = $transaction->revenue;
        }

        // Reverse to show chronological order
        $labels = array_reverse($labels);
        $data = array_reverse($data);
        $revenue = array_reverse($revenue);

        return [
            'labels' => $labels,
            'data' => $data,
            'revenue' => $revenue
        ];
    }

    private function getStatusDistribution()
    {
        $statuses = Transaction::select(
            'status',
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('status')
        ->get();

        $labels = [];
        $data = [];
        $colors = [
            'success' => '#28a745',
            'pending' => '#ffc107',
            'failed' => '#dc3545',
            'cancel' => '#6c757d',
            'expire' => '#6c757d'
        ];

        foreach ($statuses as $status) {
            $labels[] = ucfirst($status->status);
            $data[] = $status->count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'colors' => $colors
        ];
    }

    private function getTopPackages()
    {
        $topPackages = Transaction::select(
            'travel_packages.name',
            DB::raw('COUNT(transactions.id) as transaction_count'),
            DB::raw('SUM(CASE WHEN transactions.status = "success" THEN transactions.amount ELSE 0 END) as total_revenue')
        )
        ->join('travel_packages', 'transactions.travel_package_id', '=', 'travel_packages.id')
        ->groupBy('travel_packages.id', 'travel_packages.name')
        ->orderBy('transaction_count', 'desc')
        ->take(5)
        ->get();

        return $topPackages;
    }
}
