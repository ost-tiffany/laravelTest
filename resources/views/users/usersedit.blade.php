{{-- 
<form action="{{route('douseredit',['user_id'=>$user_id])}}" method="post">
    @csrf
    <table>
    @foreach ($userdata as $item)
        <tr>
            <td><input type="text" name="user_name" id="" value="{{ $item["user_name"]}}"></td>
            <td> {{$item["realname"]}} </td>
            <td> {{$item["birthday"]}} </td>
            <td> {{$item["gender"]}} </td>
            <td> {{$item["email"]}} </td>
        </tr>
    @endforeach
    <tr>
        <td><input type="submit" value="Submit"></td>
    </tr>
</table>
</form> --}}

{{-- {{ var_dump($userdata)}} --}}

@extends('layouts.app')
@section('title')
<title>編集</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit users') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('douseredit',['user_id'=>$user_id])}}">
                        {{-- @method('patch') --}}
                        @csrf
                        @foreach ($userdata as $item)
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザー　番号') }}</label>

                                <div class="col-md-6">
                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $item["user_id"]}}" autocomplete="user_id" autofocus>
                                    <input id="user_id" type="text" class="form-control" name="user_id" value="{{ $item["user_id"]}}" autocomplete="user_id" autofocus disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザID') }}</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="hidden" class="form-control" name="user_name" value="{{ $item["user_name"]}}"  autofocus>
                                    <input id="user_name" type="text" class="form-control" name="" value="{{ $item["user_name"]}}" autofocus disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="realname" class="col-md-4 col-form-label text-md-right">{{ __('ユーザ名') }}</label>

                                <div class="col-md-6">
                                    <input id="realnameold" type="hidden" class="form-control @error('realname') is-invalid @enderror" name="realnameold" value="{{ $item["realname"]}}" autocomplete="realname" autofocus>
                                    <input id="realname" type="text" class="form-control @error('realname') is-invalid @enderror" name="realname" value="{{ $item["realname"]}}" autocomplete="realname" autofocus>

                                    @error('realname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="hidden" class="form-control" name="email" value="{{ $item["email"]}}" autocomplete="email">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $item["email"]}}" autocomplete="email" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="passwordold" type="hidden" value="{{ $item["password"]}}" class="form-control" name="passwordold" autocomplete="new-password">
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('生年月日') }}</label>

                                <div class="col-md-6">
                                    <input id="birthday" type="hidden" class="form-control" name="birthday" value="{{ $item["birthday"]}}" autocomplete="birthday" >
                                    <input id="birthday" type="date" class="form-control" name="birthday" value="{{ $item["birthday"]}}" autocomplete="birthday" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('性別') }}</label>

                                <div class="form-check" value="{{ $item["gender"]}}">
                                    <input class="form-check-inline" type="hidden" name="gender" id="gender" value="1" {{ $item["gender"] == 1 ? "checked" : ""}}>
                                    <input class="form-check-inline" type="radio" name="gender" id="gender" value="1" {{ $item["gender"] == 1 ? "checked" : ""}}  disabled>
                                    <label class="form-check-label" for="male"> Male </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-inline" type="hidden" name="gender" id="gender" value="2" {{ $item["gender"] == 2 ? "checked" : ""}}>
                                    <input class="form-check-inline" type="radio" name="gender" id="gender" value="2" {{ $item["gender"] == 2 ? "checked" : ""}} disabled>
                                    <label class="form-check-label" for="female"> Female </label>

                                </div>
                            </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                                &nbsp;
                                <button type="reset" class="btn btn-danger">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
