<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    private $order, $productDetail;
    public function __construct(Order $order, ProductDetails $productDetail) {
        $this->order = $order;
        $this->productDetail = $productDetail;
    }

    public function index() {
        $orders = $this->order->paginate(3);
        $cancel = session()->get('cancel');
        return view('admin.order.index', compact('orders', 'cancel'));
    }

    public function updateOrderStatus(string $id) {
        $order = $this->order->find($id);
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        if($order->status == "PENDING") {
            $this->order->find($id)->update(['status' => "SHIPPING"]);
        }
        elseif($order->status == "SHIPPING") {
            $this->order->find($id)->update(['status' => "RECEIVED"]);
            foreach($orderDetails as $orderDetail) {
                $this->productDetail->find($orderDetail->product_id)->update(['quantity' => $orderDetail->product->quantity - $orderDetail->quantity]);
            }
        }
        return redirect()->route('order.index')->with('success', 'Update Success');
    }

    public function cancelOrder(string $id) {
        $cancel = session()->get('cancel');
        $notis = session()->get('notification');
        if(array_key_exists($id, $cancel)) {
            $this->order->find($id)->update ([
                'status' => 'CANCELED',
                'note' => 'Order canceled by customer'
            ]);
            unset($cancel[$id]);
            session()->put('cancel', $cancel);
        } else {
            $this->order->find($id)->update ([
                'status' => 'CANCELED',
                'note' => 'Order canceled by shop'
            ]);
        }
        return redirect()->route('order.index')->with('success', 'Update Success');
    }
}
