<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Stripe;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status', 'Delivered')->get()->count();
        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    // Before Login Home Page
    public function home()
    {

        $product = Product::all();

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }



        return view('home.index', compact('product', 'count'));
    }

    // After Login Home Page

    public function login_home()
    {
        $product = Product::all();

        // Counting the total cart number to shopping bag


        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        // Counting the total cart number to shopping bag End


        return view('home.index', compact('product', 'count'));
    }

    // Product Details Page

    public function product_details($id)
    {

        $data = Product::find($id);

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.product_details', compact('data', 'count'));
    }

    // Add to Cart Button

    public function add_cart($id)
    {

        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Added to Cart Successfully');


        return redirect()->back();
    }

    // Showing Add to Cart Page

    public function mycart()
    {

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $cart = Cart::where('user_id', $user_id)->get();
        }

        return view('home.mycart', compact('count', 'cart'));
    }

    // Cart delete Function

    public function delete_cart($id)
    {

        $cart = Cart::find($id);
        $cart->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Deleted Successfully');

        return redirect()->back();
    }

    // Confirm Order Function

    public function confirm_order(Request $request)
    {

        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts) {

            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;

            $order->save();
        }

        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {

            $data = Cart::find($remove->id);

            $data->delete();
        }

        toastr()->timeOut(10000)->closeButton()->addSuccess('Order Placed Successfully');


        return redirect()->back();
    }

    // My Order Function

    public function myorders()
    {
        $user = Auth::user()->id;
        $count = Cart::where('user_id', $user)->get()->count();

        $order = Order::where('user_id', $user)->get();
        return view('home.order', compact('count', 'order'));
    }

    // Payment scripe Function

    public function stripe($value)
    {
        return view('home.stripe', compact('value'));
    }

    // Payment scripe Function

    public function stripePost(Request $request, $value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $value * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from complete."
        ]);

        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts) {

            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->payment_status = "paid";
            $order->product_id = $carts->product_id;

            $order->save();
        }

        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {

            $data = Cart::find($remove->id);

            $data->delete();
        }

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Ordered Successfully');


        return redirect('/mycart');
    }

    // Shop Section
    public function shop()
    {

        $product = Product::all();

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }



        return view('home./shop', compact('product', 'count'));
    }

    // Why Us Section
    public function why()
    {


        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }



        return view('home./why', compact('count'));
    }

    // Service Section
    public function service()
    {


        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }



        return view('home./service', compact('count'));
    }

    // Contact Section
    public function contact()
    {


        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }



        return view('home./contact', compact('count'));
    }
}
