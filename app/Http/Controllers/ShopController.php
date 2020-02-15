<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function index() 
    {
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));  
    }

    public function myCart(Cart $cart) 
    {
        $data = $cart->showCart();
        return view('mycart',$data);
    }

    public function addMyCart(Request $request, Cart $cart) 
    {
        $stock_id = $request->stock_id;
        $message = $cart->addCart($stock_id);
        $data = $cart->showCart();
        return view('mycart',$data)->with('message',$message);
    }

    public function deleteMyCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->daleteCart($stock_id);
        $data = $cart->showCart();
        return view('mycart',$data)->with('message',$message);
    }

    public function checkout(Cart $cart)
    {
        return view('checkout');
    }
}
