@extends('layouts.app')
@section('title')
<title>Confirmation</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Updated Data') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('confirmeditpost',['user_id'=>$user_id])}}">
                        {{-- @method('patch') --}}
                        @csrf
                        @foreach ($usernewdata as $item)
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Id') }}</label>

                                <div class="col-md-6">
                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $item["user_id"]}}" autocomplete="user_id" autofocus>
                                    <input id="user_id" type="text" class="form-control" name="user_id" value="{{ $item["user_id"]}}" autocomplete="user_id" autofocus disabled>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User name') }}</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="hidden" class="form-control" name="user_name" value="{{ $item["user_name"]}}" autocomplete="user_name" autofocus >
                                    <input id="user_name" type="text" class="form-control" name="user_name" value="{{ $item["user_name"]}}" autocomplete="user_name" autofocus disabled >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="realname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="realname" type="hidden" class="form-control" name="realname" value="{{ $item["realname"]}}" autocomplete="realname" autofocus>
                                    <input id="realname" type="text" class="form-control" name="realname" value="{{ $item["realname"]}}" autocomplete="realname" autofocus disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="hidden" class="form-control" name="email" value="{{ $item["email"]}}" autocomplete="email">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $item["email"]}}" autocomplete="email" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="hidden" class="form-control" value="{{ $item["password"]}}" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                                <div class="col-md-6">
                                    <input id="birthday" type="hidden" class="form-control" name="birthday" value="{{ $item["birthday"]}}" autocomplete="birthday">
                                    <input id="birthday" type="date" class="form-control" name="birthday" value="{{ $item["birthday"]}}" autocomplete="birthday" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="form-check" value="">
                                    <input class="form-check-inline" type="hidden" name="gender" id="gender" value="1" {{ $item["gender"] == 1 ? "checked" : ""}}>
                                    <input class="form-check-inline" type="radio" name="gender" id="gender" value="1" {{ $item["gender"] == 1 ? "checked" : ""}} disabled>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-inline" type="hidden" name="gender" id="gender" value="2" {{ $item["gender"] == 2 ? "checked" : ""}}>
                                    <input class="form-check-inline" type="radio" name="gender" id="gender" value="2" {{ $item["gender"] == 2 ? "checked" : ""}} disabled>
                                </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
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