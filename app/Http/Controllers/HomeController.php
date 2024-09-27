<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::Where('usertype','user')->get()->count();

        $product = Product::all()->count();

        $order = Order::all()->count();

        $delivered = Order::Where('status','Delivered')->get()->count();

        return view('admin.index',compact('user','product','order','delivered'));
    }

    public function home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userId = $user->id;
    
            $count = Cart::Where('user_id', $userId)->count();
        }
        else
        {
            $count = '';
        }

        return view('home.index',compact('product','count'));
    }

    public function shop()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userId = $user->id;
    
            $count = Cart::Where('user_id', $userId)->count();
        }
        else
        {
            $count = '';
        }

        return view('home.shop',compact('product','count'));
    }

    public function login_home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userId = $user->id;
    
            $count = Cart::Where('user_id', $userId)->count();
        }
        else
        {
            $count = '';
        }


        return view('home.index',compact('product','count')); 
    }

    public function product_details($id)
    {
        // Fetch the main product
        $data = Product::find($id);

        // Fetch related products from the same category
        $relatedProducts = Product::where('category', $data->category)
                                ->where('id', '!=', $data->id) // Exclude the current product
                                ->limit(5) // Limit to 5 related products
                                ->get();

        // Check if the user is authenticated
        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;

            // Count the items in the cart for the authenticated user
            $count = Cart::where('user_id', $userId)->count();
        } else {
            // No cart count if not logged in
            $count = '';
        }

        // Return the product details view with the main product, cart count, and related products
        return view('home.product_details', compact('data', 'count', 'relatedProducts'));
    }


    public function add_cart($id)
    {
        $product_id = $id;

        $user = Auth::user();

        $user_id = $user->id; 

        $data = new Cart;

        $data->user_id = $user_id;

        $data->product_id = $product_id;

        $data->save();

         // Flash success message with toastr
         session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Added to the Cart Successfully.',
            'title' => 'Success!',
        ]);

        return redirect()->back();
    }

    public function mycart()
    {
        if(Auth::id())
        {
            $user = Auth::user();

            $userId = $user->id;
    
            $count = Cart::Where('user_id', $userId)->count();

            $cart = Cart::Where('user_id', $userId)->get();
        }

        return view('home.mycart',compact('count','cart'));
    }

    public function delete_cart($id)
    {
        $data = Cart::find($id);

        $data->delete();

         // Flash success message with toastr
         session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Removed from the Cart Successfully.',
            'title' => 'Success!',
        ]);

        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $name = $request->receiver_name;

        $address = $request->receiver_address;

        $mobileNo = $request->receiver_mobile;

        $userId = Auth::user()->id;

        $cart = Cart::Where('user_id', $userId)->get();

        foreach($cart as $carts)
        {
            $order = new Order;

            $order->name = $name;

            $order->rec_address = $address;

            $order->mobile_no = $mobileNo;

            $order->user_id = $userId;

            $order->product_id = $carts->product_id;

            $order->save();

        }

        $cartRemove = Cart::Where('user_id', $userId)->get();

        foreach($cartRemove as $remove)
        {
            $data = Cart::find($remove->id);

            $data->delete();
        }

        // Flash success message with toastr
        session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Ordered Successfully.',
            'title' => 'Success!',
        ]);

        return redirect()->back();

    }

    public function myorders()
    {
        $user = Auth::user()->id;

        $count = Cart::Where('user_id', $user)->get()->count();

        $order = Order::Where('user_id', $user)->get();

        return view('home.order',compact('count','order'));
    }

    // stripe online payment method

    public function stripe($value)
    {
        return view('home.stripe',compact('value'));
    }

    public function stripePost(Request $request,$value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from Complete." 

        ]);

        $name = Auth::user()->name;

        $address = Auth::user()->address;

        $mobileNo = Auth::user()->mobile_no;

        $userId = Auth::user()->id;

        $cart = Cart::Where('user_id', $userId)->get();

        foreach($cart as $carts)
        {
            $order = new Order;

            $order->name = $name;

            $order->rec_address = $address;

            $order->mobile_no = $mobileNo;

            $order->user_id = $userId;

            $order->product_id = $carts->product_id;

            $order->payment_status = "Paid";

            $order->save();

        }

        $cartRemove = Cart::Where('user_id', $userId)->get();

        foreach($cartRemove as $remove)
        {
            $data = Cart::find($remove->id);

            $data->delete();
        }

        // Flash success message with toastr
        session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Ordered Successfully.',
            'title' => 'Success!',
        ]);

        return redirect('mycart');

    }

   
}
