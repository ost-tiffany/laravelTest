@extends('layouts.app')

@section('title')
    <title>商品編集</title>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品編集') }}</div>
                <div class="card-body">
                    <form action="{{ route('producteditpost',['product_id'=>$product_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($productsdata as $productdata)
                            
                            <div class="form-group">
                                <label for="product_name">商品ID</label>
                                <input type="text" class="form-control" id="product_id" name="product_id" value="{{$product_id}}" disabled>
                                <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{$product_id}}">
                            </div>

                            <div class="form-group">
                                <label for="product_name">商品名</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{$productdata['product_name']}}">
                            
                                @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                    
                            <div class="form-group">
                                <label for="product_type">商品類</label>
                                <select id="product_type" name="product_type"  class="form-control @error('product_type') is-invalid @enderror" value="">
                                    <option name="product_type" value="">選択して下さい</option>
                                    @foreach ($types as $type)
                                        <option name="product_type" value="{{$type['type_id']}}" {{$productdata['product_type'] == $type['type_id'] ? "selected" : ""}}>{{$type['type_name']}}</option>
                                    @endforeach 
                                </select>

                                

                                @error('product_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                    
                            <div class="form-group">
                                <div>
                                    <input type="hidden" id="product_image_old" name="product_image_old"  class="form-control" value="{{$productdata['product_image']}}">
                                    <input type="file" id="product_image" name="product_image"  class="form-control @error('product_image') is-invalid @enderror">
                                    @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div>
                                        <img  class="img-responsive img-rounded img-thumbnail" style="width: 250px;" src="/upload/{{ $productdata["product_id"] }}/{{ $productdata["product_image"] }}" alt="">
                                    </div>
                                </div>
                            </div>
                    
                            <input type="submit" class="btn btn-secondary btn-sm" name="submit" value="編集">

                        @endforeach
                    </form>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection