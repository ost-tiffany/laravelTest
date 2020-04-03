@extends('layouts.app')

@section('title')
    <title>アップロード確認</title>
@endsection

@section('content')
    {{-- upload --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('商品追加') }}</div>
        
                    <div class="card-body">
                    <form  method="POST" action="{{route('productaddconfirm')}}">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">商品名</label>
                                <input type="hidden" name="product_name" value="{{$newproducts['product_name']}}">
                                <input type="text" class="form-control" value="{{$newproducts['product_name']}}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="product_type">商品類</label>
                                <input type="hidden" name="product_type" value="{{$newproducts['product_type']}}">
                            
                                <select class="form-control" value="" disabled>
                                    <option value="">選択肢て下さい</option>
                                    @foreach ($types as $type)
                                        <option name="product_type" value="{{$type['type_id']}}" {{$newproducts['product_type'] == $type['type_id'] ? "selected" : ""}}>{{$type['type_name']}}</option>
                                    @endforeach   
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_stocks">商品在庫</label>
                                <input id="product_stocks" name="product_stocks"  type="hidden"  class="form-control @error('product_stocks') is-invalid @enderror" value="{{$newproducts['stocks']}}" > 
                                <input id="product_stocks" name="product_stocks"  type="number"  class="form-control @error('product_stocks') is-invalid @enderror" value="{{$newproducts['stocks']}}" disabled>               
                            </div>
                    
                            <div class="form-group">
                                <div style="width:400px;">
                                    <label>登録画像 :</label>
                                    <input type="hidden" id="product_image_path" name="product_image_path" class="form-control" value={{$newproducts['product_image']}}>
                                    <input type="hidden" id="product_image_name" name="product_image_name" class="form-control" value={{$newproducts['product_image_name']}}>
                                    <img class="img-responsive img-rounded img-thumbnail" src="{{$newproducts['product_image']}}">
                                </div>
                            </div>
                    
                            <button type="submit" class="btn btn-secondary btn-sm">追加</button>
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