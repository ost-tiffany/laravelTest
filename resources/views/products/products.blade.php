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


@if (Session::get('type'))
    <div class="table col-8 offset-md-3" style="width:900px" id="table">
    @php var_dump($productslist) @endphp
    
    <div class="col-8 offset-md-3" style="width:900px">
        <table class="cell-border stripe hover display">
            <thead>
                </tr>
                    <th colspan='5'>{{Session::get('type')}}</th>
                </tr>
                <tr>
                    <th scope="col">製品ID</th>
                    <th scope="col">製品名</th>
                    <th scope="col">職人</th>
                    <th scope="col">製品画像</th>
                </tr>
            </thead>
            <tbody>
            {{-- @foreach ($productslist as $product)
                <tr>
                    <td>{{ $product["product_id"] }}</td>
                    <td>{{ $product["product_name"] }}</td>
                    <td>{{ $product["created_by_user_name"] }}</td>
                    <td>{{ $poduct["product_image"] }}</td>
                    <td><button type="button" class="btn btn-success">Edit</button> &nbsp; <button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
            @endforeach --}}
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready( function () {
            //$('#table').table('show');
            
            $('table.display').DataTable(
                { 
                "language" : {
                    "sEmptyTable": "レコードがありません",
                    "sInfo": " _START_ 件　～ _END_ 件 _TOTAL_ 件中",
                    "sInfoEmpty": "0　件　～ 0 件 0 件中",
                    "sInfoFiltered": "",
                    "sInfoPostFix": "",
                    "sLengthMenu": "表示 _MENU_ 件",
                    "sLoadingRecords": "ローディング...",
                    "sProcessing": "処理中...",
                    "sSearch": "検索:",
                    "sSearchPlaceholder": "",
                    "sThousands": ",",
                    "sUrl": "",
                    "sZeroRecords": "対応するレコードがありません",
                    "paginate": {
                        "first":      "初",
                        "last":       "後",
                        "next":       "次",
                        "previous":   "前"
                    }
                    }
                });
        });
    </script>

    @else

        <div>
            @if (Session::get('alert-success'))
                <div class="row justify-content-center text-justify">
                    <div class="alert alert-success">
                        {{ Session::get('alert-success') }}
                    </div>
                </div>
            @endif
        <div>


    {{-- upload --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('商品追加') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('addproduct') }}"　enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name">商品名</label>
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" id="product_name" name="product_name">

                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <label for="product_type">商品類</label>
                                        <select id="product_type" name="product_type" value="{{ old('product_type') }}" class="form-control @error('product_type') is-invalid @enderror" >
                                            <option name="product_type" value="">選択肢て下さい</option>
                                            <option name="product_type" value="1">木</option>
                                            <option name="product_type" value="2">他</option>
                                        </select>

                                    @error('product_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <div style="width:400px;">
                                        <input type="file" id="product_image" name="product_image" value="{{ old('product_image') }}" class="form-control @error('product_image') is-invalid @enderror">
                                        
                                        @error('product_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <input type="submit" class="btn btn-secondary btn-sm" id="submitupload" name="submitupload" value="追加">
                            </form>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


{{-- update table --}}

@endsection