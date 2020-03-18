@extends('layouts.app')
@section('title')
<title>User page</title>
@endsection

@section('content')


<table class="table table-bordered col-8 offset-md-2">
    <thead>
        </tr>
            <th colspan='5'>
                USER LIST
            </th>
        </tr>
        <tr>
            <th scope="col">ユーザID</th>
            <th scope="col">ユーザ名</th>
            <th scope="col">メールアドレス</th>
            <th class="table-borderless" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userlist as $user)
            <tr>
                <th>{{ $user["user_id"] }}</th>
                <td>{{ $user["user_name"] }}</td>
                <td>{{ $user["email"] }}</td>
            <td><a class="btn btn-success" id="edituser" name="edituser" href="{{ route('useredit',['user_id'=>$user["user_id"]]) }}">Edit</a> &nbsp; <button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
        @endforeach
    </tbody>
  </table>


@endsection

