@extends('layouts.app')

@section('title')
    <title>商品</title>

    <style>
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-top: 30px;
        }
    </style>
@endsection

@section('content')

    <div class="content title">
        <div class="links" style="width: 900px; margin:auto;">  
            <a>></a> 
            @foreach ($types as $type)
            <a href="{{ route('productlist',['type_id'=>$type['type_id']])}}"> {{$type["type_name"]}} </a> 
            &nbsp;
            @endforeach
        </div>
    </div>

    <div>
        @if (Session::get('alert'))
            <div class="row justify-content-center text-justify">
                <div class="alert alert-warning">
                    {{ Session::get('alert') }}
                </div>
            </div>
        @endif
    </div>

    <div>
        @if (Session::get('alert-success'))
            <div class="row justify-content-center text-justify">
                <div class="alert alert-success">
                    {{ Session::get('alert-success') }}
                </div>
            </div>
        @endif
    </div>

    <hr style="width: 1000px; margin-top: 60px">
    {{-- latest 5 --}}
    <div>	
        <div class="content title m-b-md">
            <h5> <strong> 最新商品 </strong> </h5>
        </div>
		
        <div class="container" style="width:1000px;" name="latest" id="latest">	
			<div  class="row justify-content-md-center" >
                @foreach ($productslist as $product)
				<div class="col-md-auto" style="margin-bottom:30px;　text-align:center;">
                    <a href="/upload/{{ $product["product_id"] }}/{{ $product["product_image"] }}">
                    <img src="/upload/{{ $product["product_id"] }}/{{ $product["product_image"] }}" style="width:150px; height:150px; object-fit: cover;" class="img-fluid rounded-circle">
                    </a>
                    <p>{{$product['type_name']}}</p>   
                    <p>{{$product['product_name']}}<br>
                    by: <strong>{{$product['created_by_user_name']}}</strong><br></p>								
                </div>		
                @endforeach	
			</div>
		</div>
      
    </div>

@endsection