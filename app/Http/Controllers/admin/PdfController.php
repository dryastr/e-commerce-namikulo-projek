<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function downloadInvoice($id)
    {
        $order = Order::with(['user', 'payment', 'items.product'])->find($id);
        $pdf = FacadePdf::loadView('admin.orders.invoice', compact('order'));
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}
