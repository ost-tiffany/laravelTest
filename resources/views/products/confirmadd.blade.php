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
                    <form action="{{route('productaddconfirm')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">商品名</label>
                                <input  name="product_name" type="hidden" value="{{$newproducts['product_name']}}">
                                <input type="text" class="form-control" value="{{$newproducts['product_name']}}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="product_type">商品類</label>
                                <input type="hidden" name="product_type" value="{{$newproducts['product_type']}}">
                            
                                <select class="form-control" value="{{$newproducts['product_type']}}" disabled>
                                    <option value="">選択肢て下さい</option>
                                    <option value="1" {{$newproducts['product_type'] == 1 ? "selected" : "" }}>木</option>
                                    <option value="2" {{$newproducts['product_type'] == 2 ? "selected" : "" }}>他</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <div style="width:400px;">
                                    <input type="hidden" id="product_image" name="product_image" class="form-control" value={{$newproducts['product_image']}}>
                                    <img class="img-responsive img-rounded" src="{{$newproducts['product_image']}}">
                                </div>
                            </div>
                    
                            <button type="submit" class="btn btn-secondary btn-sm">追加</button>
                            &nbsp;
                            <a href="{{url()->previous()}}" class="btn btn-danger">{{ __('キャンセル') }}</a>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection