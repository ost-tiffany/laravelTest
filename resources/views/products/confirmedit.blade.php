@extends('layouts.app')

@section('title')
    <title>商品編集確認</title>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品編集確認') }}</div>
                <div class="card-body">
                    <form action="{{ route('producteditconfirm',['product_id'=>$product_id]) }}" method="POST">
                        @csrf                      
                            <div class="form-group">
                                <label for="product_name">商品ID</label>
                                <input type="text" class="form-control" id="product_id" name="product_id" value="{{$product_id}}" disabled>
                                <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{$product_id}}">
                            </div>

                            <div class="form-group">
                                <label for="product_name">商品名</label>
                                <input type="hidden" class="form-control " id="product_name" name="product_name" value="{{$productdata['product_name']}}">
                                <input type="text" class="form-control " id="product_name" name="product_name" value="{{$productdata['product_name']}}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <input type="hidden" name="product_type" id="product_type" value="{{$productdata['product_type']}}">
                                <label for="product_type">商品類</label>
                                <select id="product_type" name="product_type"  class="form-control" value="" disabled>
                                    <option name="product_type" value="">選択してください</option>
                                    @foreach ($types as $type)
                                        <option name="product_type" value="{{$type['type_id']}}" {{$productdata['product_type'] == $type['type_id'] ? "selected" : ""}}>{{$type['type_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_stocks">商品在庫</label>
                                <input type="hidden" id="product_stocks" name="product_stocks" value="{{$productdata['stocks']}}" >
                                <input type="number" id="product_stocks" name="product_stocks"  class="form-control" value="{{$productdata['stocks']}}" disabled>                  
                            </div>
                    
                            <div class="form-group">
                                <div style="width:400px;">
                                    <label>登録画像 :</label>
                                    <input type="hidden" id="product_image_name_old" name="product_image_name_old"  class="form-control" value="{{$productdata['product_image_name_old']}}">
                                    <input type="hidden" id="product_image_name" name="product_image_name"  class="form-control" value="{{$productdata['product_image_name']}}">
                                    <input type="hidden" id="product_image" name="product_image"  class="form-control" value="{{$productdata['product_image']}}">
                                    <img  class="img-responsive img-rounded img-thumbnail" style="width: 250px;" src="{{$productdata['product_image']}}" alt="">
                                </div>
                            </div>
                    
                            <input type="submit" class="btn btn-secondary btn-sm" name="submit" value="編集">
                            &nbsp;
                                <a href="{{url()->previous()}}" class="btn btn-danger btn-sm">{{ __('キャンセル') }}</a>
                    </form>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection