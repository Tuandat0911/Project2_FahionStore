<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Notifications\OrderShipped;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $product;
    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function index() {
//        $sliders = Slider::orderBy('id', 'desc')->take(3)->get();
        $sliders = Slider::all();
        $settings = Setting::all();
        $categories = Category::where('parent_id', 0)->get();
        $productsMen = Product::whereIn('category_id', Category::where('parent_id', 14)->pluck('id'))->get();
        $productsWomen = Product::whereIn('category_id', Category::where('parent_id', 15)->pluck('id'))->get();
        $carts = session()->get('cart');
        return view('home.home', compact('sliders', 'categories', 'productsMen', 'productsWomen', 'carts', 'settings'));
    }

    public function productDetail(Request $request) {
        $settings = Setting::all();
        $sliders = Slider::all();
        $productDetail = $this->product->find($request->id);
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::all();
        $sizes = ProductDetails::where('product_id', $request->id)->get();
        return view('home.product_detail', compact('sliders', 'categories', 'productDetail', 'products', 'sizes', 'settings'));
    }

    public function showCart() {
        $settings = Setting::all();
        $categories = Category::where('parent_id', 0)->get();
        $carts = session()->get('cart');
        return view('home.cart', compact('categories', 'carts', 'settings'));
    }

    public function addToCartFromDetail(Request $request) {
//        session()->flush('cart'); // remove tat ca session
        $cart = session()->get('cart');
        $product_detail = ProductDetails::where('id', $request->product_detail_id)->first();
        $id = $product_detail->id;
        $product = Product::find($product_detail->product_id);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $request->quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'feature_image' => $product->feature_image,
                'size' => $product_detail->size_id,
            ];
        }
        session()->put('cart', $cart);
//        echo"<pre>";
//        print_r(session()->get('cart'));
        return redirect()->route('showCart');
    }

    public function deleteCart(Request $request) {
        if($request->id) {
            $cart = session()->get('cart');
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return redirect()->route('showCart');
        }
    }

    public function updateCart(Request $request)
    {
        $key = $request->input('key');
        $quantity = $request->input('quantity');

        // Cập nhật số lượng trong session
        $carts = session()->get('cart');
        if(isset($carts[$key])) {
            $carts[$key]['quantity'] = $quantity;
            session()->put('cart', $carts);
        }
        return response()->json(['success' => true]);
    }


    public function checkout() {
        $settings = Setting::all();
        $categories = Category::where('parent_id', 0)->get();
        $carts = session()->get('cart');
        return view('home.checkout', compact('categories', 'carts', 'settings'));
    }

    public function order(Request $request) {
        $orders = new Order();
        $carts = session()->get('cart');
        $total = 10;
        foreach($carts as $cart) {
            $total += $cart['price'] * $cart['quantity'];
        }
        $order = $orders->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $total,
            'status' => 'PENDING',
            'user_id' => Auth::user()->id
        ]);

        foreach($carts as $key => $item) {
            $order->orderDetail()->create([
                'product_id' => $key,
                'quantity' => $item['quantity'],
                'price' => $item['quantity'] * $item['price']
            ]);
        }

        session()->forget('cart');

//        echo"<pre>";
//        print_r(session()->get('cart'));
        return redirect()->route('orderStatus');
    }

    public function orderStatus() {
        $settings = Setting::all();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $cancel = session()->get('cancel');
        $categories = Category::where('parent_id', 0)->get();
        return view('home.order_status', compact('orders', 'categories', 'cancel', 'settings'));
    }

    public function cancel(string $id) {
        $cancel = session()->get('cancel');
        if(!isset($cancel[$id])) {
            $cancel[$id] = [
                'note' => 'Customer cancels order'
            ];
        }
        session()->put('cancel', $cancel);

        return redirect()->route('orderStatus');
    }

    public function shop() {
        $settings = Setting::all();
        $products = DB::table('product_details')
            ->select('product_id')
            ->groupBy('product_id')
            ->havingRaw('SUM(quantity) = 0')
            ->pluck('product_id') // Lấy danh sách các giá trị product_id
            ->toArray(); // Chuyển đổi thành mảng

        $categories = Category::where('parent_id', 0)->get();
        $data = Product::whereNotIn('id', $products)->paginate(9);
//        echo"<pre>";
//        print_r(session()->get('notification'));
        return view('home.shop', compact('categories', 'data', 'settings'));
    }

    public function contact() {
        $settings = Setting::all();
        $categories = Category::where('parent_id', 0)->get();
        return view('home.contact', compact('categories', 'settings'));
    }

    public function searchByName(Request $request) {
        $name = trim($request->name);
        $data = Product::where('name', 'like', '%' . $name . '%')->paginate(9);
        $categories = Category::where('parent_id', 0)->get();
        $settings = Setting::all();
        return view('home.shop', compact('categories', 'data', 'settings'));
    }

    public function searchCategory(string $slug) {
        $category_id = Category::where('slug', $slug)->first()->id;
        $data = Product::where('category_id', $category_id)->paginate(9);
        $categories = Category::where('parent_id', 0)->get();
        $settings = Setting::all();
        return view('home.shop', compact('categories', 'data', 'settings'));
    }
}
