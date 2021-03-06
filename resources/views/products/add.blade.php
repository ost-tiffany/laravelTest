@extends('layouts.app')

@section('title')
    <title>商品追加</title>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('商品追加') }}</div>
                    <div class="card-body">
                    <form  action="{{route('productaddpost')}}" method="POST" enctype="multipart/form-data">
                    {{-- <form id="form" action="/products/add/confirm" method="POST" enctype="multipart/form-data"> --}}
                            @csrf
                            <div class="form-group">
                                <label for="product_name">商品名</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{old('product_name')}}">

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                            <div class="form-group">
                                <label for="product_type">商品類</label>
                                <select id="product_type" name="product_type"  class="form-control @error('product_type') is-invalid @enderror" >
                                    <option name="product_type" value="">選択肢て下さい</option>
                                    @foreach ($types as $type)
                                        <option name="product_type" value="{{$type['type_id']}}">{{$type['type_name']}}</option>
                                    @endforeach   
                                </select>
                                @error('product_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                  
                            </div>

                            <div class="form-group">
                                <label for="product_stocks">商品在庫</label>
                                <input id="product_stocks" name="product_stocks"  type="number" class="form-control @error('product_stocks') is-invalid @enderror" >
                                @error('product_stocks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                  
                            </div>
                            
                            <div class="form-group">
                                <div>
                                    <input type="file" id="product_image" name="product_image"  class="form-control @error('product_image') is-invalid @enderror">

                                @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                    
                            <input type="submit" class="btn btn-secondary btn-sm" name="submit" value="追加">
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection