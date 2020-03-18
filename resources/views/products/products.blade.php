@extends('layouts.app')
@section('title')
<title>Products page</title>
@endsection

@section('content')


<table class="table table-bordered col-8 offset-md-2">
    <thead>
        </tr>
            <th colspan='5'>
               WOOD
            </th>
        </tr>
        <tr>
            <th scope="col">製品ID</th>
            <th scope="col">製品名</th>
            <th scope="col">職人</th>
            <th scope="col">製品画像</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productlist as $product)
            <tr>
                <td>{{ $product["product_id"] }}</td>
                <td>{{ $product["product_name"] }}</td>
                <td>{{ $product["created_by_user_name"] }}</td>
                <td>{{ $poduct["product_image"] }}</td>
                <td><button type="button" class="btn btn-success">Edit</button> &nbsp; <button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="table table-bordered col-8 offset-md-2">
        <thead>
            </tr>
                <th colspan='5'>
                WOOD
                </th>
            </tr>
            <tr>
                <th scope="col">書類</th>
                <th scope="col">製品ID</th>
                <th scope="col">製品名</th>
                <th scope="col">職人</th>
                <th scope="col">製品画像</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($productlist as $product)
            <tr>
                <th>{{ $product["product_type"] }}</th>
                <td>{{ $product["product_id"] }}</td>
                <td>{{ $product["product_name"] }}</td>
                <td>{{ $product["created_by_user_name"] }}</td>
                <td>{{ $poduct["product_image"] }}</td>
                <td><button type="button" class="btn btn-success">Edit</button> &nbsp; <button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
          @endforeach
        </tbody>
    </table>


@endsection