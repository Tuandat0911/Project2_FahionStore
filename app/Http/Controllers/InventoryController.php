<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\InventoryTransactionDetail;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    private $inventoryTransaction;
    private $productDetails;

    public function __construct(InventoryTransaction $inventoryTransaction, ProductDetails $productDetails) {
        $this->inventoryTransaction = $inventoryTransaction;
        $this->productDetails = $productDetails;
    }

    public function index() {
        $inventories = $this->inventoryTransaction->orderBy('id', 'desc')->paginate(5);
        return view('admin.inventory.index', compact('inventories'));
    }

    public function create() {
        $data = Product::all();
        return view('admin.inventory.add', compact('data'));
    }

    public function search (Request $request) {
        $name = trim($request->name);
        $data = Product::where('name', 'like', '%' . $name . '%')->get();
        return view('admin.inventory.add', compact('data'));
    }


    public function store(Request $request) {
        $transaction = $this->inventoryTransaction->create([
            'transaction_date' => now(),
            'user_id' => Auth::user()->id,
            'transaction_type' => $request->transaction_type
        ]);

        if($request->transaction_type == 'Import') {
            foreach($request->product_detail_id as $index => $item) {
                if(!empty($request->quantity[$index])) {
                    $transaction->transactionDetail()->create([
                        'product_detail_id' => $item,
                        'quantity' =>  $request->quantity[$index]
                    ]);
                    $quantity = $this->productDetails->find($item)->quantity;
                    $this->productDetails->find($item)->update([
                        'quantity' => $request->quantity[$index] + $quantity
                    ]);
                }
            }
            return redirect()->route('inventory.index')->with('success', 'Import successfully');
        }
        else {
            foreach($request->product_detail_id as $index => $item) {
                if(!empty($request->quantity[$index])) {
                    $transaction->transactionDetail()->create([
                        'product_detail_id' => $item,
                        'quantity' =>  $request->quantity[$index]
                    ]);
                    $quantity = $this->productDetails->find($item)->quantity;
                    $this->productDetails->find($item)->update([
                        'quantity' => $quantity - $request->quantity[$index]
                    ]);
                }
            }
            return redirect()->route('inventory.index')->with('success', 'Export successfully');
        }
    }

    public function detail(string $id) {
        $status = $this->inventoryTransaction->find($id)->transaction_type;
        $data = InventoryTransactionDetail::where('inventory_transaction_id', $id)->get();
        return view('admin.inventory.detail', compact('data', 'status'));
    }
}
