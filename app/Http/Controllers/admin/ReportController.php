<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogProduct;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $orderItems = OrderItem::all();
        $payments = Payment::all();

        $bestSellingProduct = $this->getBestSellingProduct($orderItems);
        $totalRevenue = $this->getTotalRevenue($orders);
        $mostPopularPaymentMethod = $this->getMostPopularPaymentMethod($payments);
        $totalProductsSold = $this->getTotalProductsSold($orderItems);
        $transactionList = $this->getTransactionList($orders, $orderItems, $payments);

        return view('admin.report.index', compact('bestSellingProduct', 'totalRevenue', 'mostPopularPaymentMethod', 'totalProductsSold', 'transactionList'));
    }

    private function getBestSellingProduct($orderItems)
    {
        $productSales = array();
        foreach ($orderItems as $orderItem) {
            if (isset($productSales[$orderItem->product_id])) {
                $productSales[$orderItem->product_id] += $orderItem->quantity;
            } else {
                $productSales[$orderItem->product_id] = $orderItem->quantity;
            }
        }
        arsort($productSales);
        $bestSellingProduct = array_slice($productSales, 0, 1);
        return $bestSellingProduct;
    }

    private function getTotalRevenue($orders)
    {
        $totalRevenue = 0;
        foreach ($orders as $order) {
            $totalRevenue += $order->total_amount;
        }
        return $totalRevenue;
    }

    private function getMostPopularPaymentMethod($payments)
    {
        $paymentMethods = array();
        foreach ($payments as $payment) {
            if (isset($paymentMethods[$payment->payment_method])) {
                $paymentMethods[$payment->payment_method]++;
            } else {
                $paymentMethods[$payment->payment_method] = 1;
            }
        }
        arsort($paymentMethods);
        $mostPopularPaymentMethod = array_slice($paymentMethods, 0, 1);
        return $mostPopularPaymentMethod;
    }

    private function getTotalProductsSold($orderItems)
    {
        $totalProductsSold = 0;
        foreach ($orderItems as $orderItem) {
            $totalProductsSold += $orderItem->quantity;
        }
        return $totalProductsSold;
    }

    private function getTransactionList($orders, $orderItems, $payments)
    {
        $transactionList = array();
        foreach ($orders as $order) {
            $transactionList[] = array(
                'id' => $order->id,
                'date' => $order->created_at,
                'total_amount' => $order->total_amount,
                'payment_method' => $order->payment->payment_method,
                'items' => array(),
            );
            foreach ($orderItems as $orderItem) {
                if ($orderItem->order_id == $order->id) {
                    $transactionList[count($transactionList) - 1]['items'][] = array(
                        'product_id' => $orderItem->product_id,
                        'quantity' => $orderItem->quantity,
                        'price' => $orderItem->price,
                    );
                }
            }
        }
        return $transactionList;
    }
}
