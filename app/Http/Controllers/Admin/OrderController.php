<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['orderItems']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('order_id', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('customer_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('customer_email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')
                       ->paginate(15);

        // Statistics
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function show(Order $order)
    {
        $order->load(['orderItems']);
        
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,processing,completed,cancelled,failed',
                'notes' => 'nullable|string|max:500'
            ]);

            $order->update([
                'status' => $validated['status'],
                'admin_notes' => $validated['notes'] ?? $order->admin_notes,
                'updated_at' => now()
            ]);

            return back()->with('success', 'Status order berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Order $order)
    {
        try {
            DB::transaction(function () use ($order) {
                // Delete order items first
                $order->orderItems()->delete();
                // Delete order
                $order->delete();
            });

            return redirect()->route('admin.orders.index')
                           ->with('success', 'Order berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // API endpoint untuk dashboard statistics
    public function getStats()
    {
        $today = now()->startOfDay();
        $thisMonth = now()->startOfMonth();

        return response()->json([
            'today_orders' => Order::whereDate('created_at', $today)->count(),
            'today_revenue' => Order::whereDate('created_at', $today)
                                   ->where('status', 'completed')
                                   ->sum('total_amount'),
            'month_orders' => Order::where('created_at', '>=', $thisMonth)->count(),
            'month_revenue' => Order::where('created_at', '>=', $thisMonth)
                                   ->where('status', 'completed')
                                   ->sum('total_amount'),
        ]);
    }
}