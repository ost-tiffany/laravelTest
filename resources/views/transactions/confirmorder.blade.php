@extends('layouts.app')

@section('title')
    <title> 取引確認フォーム</title>

@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('取引確認フォーム') }}</div>
                    <form method="post" action='{{route('ordersureconfirm')}}'> 
                        @csrf 
                        <div style="margin:30px;">
                            <div class="form-group row">
                                <label for="date" class="col-md-2 col-form-label text-md-right">注文日</label>

                                <div class="col-md-6">
                                    <input id="date" type="text" class="form-control" name="date" value="{{$order['date']}}" disabled>
                                    <input id="date" type="hidden" name="date" value="{{$order['date']}}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-2 col-form-label text-md-right">住所</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{$order['address']}}" disabled>
                                    <input id="address" type="hidden" class="form-control" name="address" value="{{$order['address']}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="memo" class="col-md-2 col-form-label text-md-right">メモ</label>

                                <div class="col-md-6">
                                    <input id="memo" type="text"　rows='3' class="form-control" name="memo" value="{{$order['memo']}}" disabled >
                                    <input id="memo" type="hidden" name="memo" value="{{$order['memo']}}" >
                                </div>
                            </div>

                            {{-- order item --}}
                            <hr style="width: 200px; margin-bottom: 10px;">

                            @for ($i = 0; $i < count($order["item"]); $i++)  
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-1">
                                        <label for="item">アイテム</label>
                                        <select class="js-example-basic-single form-control" id="item[]" name="item[]" disabled>
                                        <option value='{{$order["item"][$i]}}'> {{$order["item"][$i]}} - {{$order["product_name"][$i]}}</option>
                                        </select>
                                         <input id="item[]" name="item[]" type="hidden" value="{{$order["item"][$i]}}">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="quantity">数量</label>
                                        <input type="text" class="form-control" id="quantity[]" name="quantity[]" value="{{$order["quantity"][$i]}}" disabled>
                                        <input type="hidden" class="form-control" id="quantity[]" name="quantity[]" value="{{$order["quantity"][$i]}}">
                                    </div>

                                    <div>
                                        <a href="/upload/{{ $order["item"][$i] }}/{{ $order["product_image"][$i] }}"> 
                                            <img class="img-responsive img-rounded img-thumbnail" style="width: 150px;" src="/upload/{{ $order["item"][$i] }}/{{ $order["product_image"][$i] }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            @endfor
                            
                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-primary btn-sm" name="submit" value="注文">
                                    &nbsp;
                                    <a href="{{url()->previous()}}" class="btn btn-danger btn-sm">{{ __('キャンセル') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection