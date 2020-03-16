@extends('layouts.app')
@section('title')
<title>User page</title>
@endsection

@section('content')
<table>
    <thead>
        <tr>
            <td>User Id</td>
            <td>User Name</td>   
            <td>Email</td>   
            <td>Gender</td>
        </tr>       
    </thead>
    <tbody>
        @foreach ($userlist as $user)
            <tr>
                <td>{{ $user["user_id"] }}</td>
                <td>{{ $user["user_name"] }}</td>   
                <td>{{ $user["email"] }}</td>   
                <td>{{ $user["gender"] == 1 ? "male" : "female" }}</td>       
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

