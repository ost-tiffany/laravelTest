@extends('layouts.app')
@section('title')
<title>User page</title>
@endsection

@section('content')


<table class="table table-bordered col-8 offset-md-2">
    <thead>
        <tr>
            <th scope="col">ユーザID</th>
            <th scope="col">ユーザ名</th>
            <th scope="col">メールアドレス</th>
            <th scope="col">性別</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userlist as $user)
            <tr>
                <th>{{ $user["user_id"] }}</th>
                <td>{{ $user["user_name"] }}</td>
                <td>{{ $user["email"] }}</td>
                <td>{{ $user["gender"] == 1 ? "男" : "女" }}</td>
                <td><button type="button" class="btn btn-success">Edit</button> &nbsp; <button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
        @endforeach
    </tbody>
  </table>


@endsection

