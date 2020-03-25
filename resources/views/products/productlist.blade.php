@extends('layouts.app')

@section('title')
    <title>商品リスト</title>

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
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')

<div class="content title m-b-md">
    <div class="links">  
        <a>></a> 
        <a href="{{ route('woodlist')}}">木造</a> 
        &nbsp;
        <a href="{{ route('otherlist') }}">雑貨</a>
    </div>
</div> 
    {{-- @php var_dump($productslist) @endphp --}}
    
        <div>
            @if (Session::get('alert'))
                <div class="row justify-content-center text-justify">
                    <div class="alert alert-success">
                        {{ Session::get('alert') }}
                    </div>
                </div>
            @endif
        <div>
  
{{-- update table --}}

@endsection