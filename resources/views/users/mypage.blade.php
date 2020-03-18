@extends('layouts.app')
@section('title')
<title>My Page</title>
@endsection

@section('content')


<table class="table table-bordered col-7 offset-md-3" style="width:900px;">
        <tr>
            <th scope="col">ユーザー　番号</th>
            <th>{{ Auth::user()->user_id }}</th>
        </tr>
        <tr>
            <th scope="col">ユーザID</th>
            <td>{{ Auth::user()->user_name }}</td>
        </tr>
        <tr>
            <th scope="col">ユーザ名</th>
            <td>{{ Auth::user()->realname }}</td>
        </tr>
            <th scope="col">メールアドレス</th>
            <td>{{ Auth::user()->email }}</td>
        </tr>
        </tr>
            <th scope="col">生年月日</th>
            <td>{{ Auth::user()->birthday }}</td>
        </tr>
        </tr>
            <th scope="col">性別</th>
            <td>{{ Auth::user()->gender == 1 ? "男" : "女" }}</td>
        </tr>
  </table>

  {{-- <div class="offset-md-6">
    <button type="button" class="btn btn-success">Edit</button> &nbsp; <button type="button" class="btn btn-danger">Delete</button>
  </div> --}}


@endsection
