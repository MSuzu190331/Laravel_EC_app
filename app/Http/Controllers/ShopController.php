<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index() 
    {
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));  
    }

    public function myCart(Cart $cart) 
    {
        $mycarts = $cart->showCart();
        return view('mycart', compact('mycarts'));
    }

    public function addMyCart(Request $request, Cart $cart) 
    {
        $stock_id = $request->stock_id;
        $message = $cart->addCart($stock_id);
        $mycarts = $cart->showCart();
        return view('mycart',compact('mycarts', 'message'));
    }

    public function deleteMyCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->daleteCart($stock_id);
        $mycarts = $cart->showCart();
        return view('mycart',compact('mycarts', 'message'));
    }
}
