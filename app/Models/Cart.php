<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = [
      'stock_id', 'user_id'
    ];

    // アソシエーションの記載。CartモデルはStockモデルにbelongs_to
    public function stock()
    {
      return $this->belongsTo('\App\Models\Stock');
    }

    // 自分のカートを見る時の処理(getでの遷移時)
    public function showCart()
    {
      $user_id = Auth::id();
      return $this->where('user_id',$user_id)->get();
    }

    // カートに商品を加える時の処理
    public function addCart($stock_id)
    {
      $user_id = Auth::id();
      $cart_add_info=Cart::firstOrCreate(['stock_id' => $stock_id, 'user_id' => $user_id]);

      if ($cart_add_info->wasRecentlyCreated) {
          $message = 'カートに追加しました';
      } else {
          $message = 'カートに登録済みです';
      }
      return $message;
    }

    // カートから商品を削除する時の処理
    public function daleteCart($stock_id)
    {
      $user_id = Auth::id();
      if (Cart::where('user_id', $user_id)->where('stock_id', $stock_id)->delete()) {
        $message = '商品をカートから削除しました';
        return $message;
      } else {
        $message = 'エラー';
      }
    }

}


