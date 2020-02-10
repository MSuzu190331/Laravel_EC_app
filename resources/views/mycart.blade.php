@extends('layouts.app') 

@section('content') 
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">
            {{ Auth::user()->name }}さんのカートの中身</h1>

            <div class="">
                <p class="text-center">{{ $message ?? '' }}</p><br>
                <div class="my_cart">

                    @foreach($mycarts as $mycart)
                        <div class="mycart_box">
                            {{ $mycart->stock->name }}<br>
                            {{ number_format($mycart->stock->fee )}}円<br>
                                <img src="/image/{{ $mycart->stock->imgpath }}" alt="" class="incart" >
                                <br>

                                <form action="/cartdelete" method="post">
                                  @csrf
                                  <input type="hidden" name="stock_id" value="{{ $mycart->stock->id }}">
                                  <input type="submit" value="カートから削除する">
                                </form>
                        </div>
                    @endforeach

                </div>

                <a href="/">商品一覧へ</a>
            </div>
        </div>
    </div>
</div>
@endsection