@extends('layouts.app')
@section('title')
<title>確認表面</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('確認表面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('confirmeditpost',['user_id'=>$user_id])}}">
                        {{-- @method('patch') --}}
                        @csrf
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザー　番号') }}</label>

                                <div class="col-md-6">
                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $user_id}}" autocomplete="user_id">
                                    <input id="user_id" type="text" class="form-control" name="user_id" value="{{ $user_id}}" autocomplete="user_id" autofocus disabled>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザID') }}</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="hidden" class="form-control" name="user_name" value="{{ $usernewdata["user_name"]}}" >
                                    <input id="user_name" type="text" class="form-control" name="user_name" value="{{ $usernewdata["user_name"]}}" autocomplete="user_name" autofocus disabled >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="realname" class="col-md-4 col-form-label text-md-right">{{ __('ユーザ名') }}</label>

                                <div class="col-md-6">
                                    <input id="realname" type="hidden" class="form-control" name="realname" value="{{ $usernewdata["realname"]}}" >
                                    <input id="realname" type="text" class="form-control" name="realname" value="{{ $usernewdata["realname"]}}" autocomplete="realname" autofocus disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="hidden" class="form-control" name="email" value="{{ $usernewdata["email"]}}" >
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $usernewdata["email"]}}" autocomplete="email" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="hidden" class="form-control" value="{{ $usernewdata["password"]}}" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('生年月日') }}</label>

                                <div class="col-md-6">
                                    <input id="birthday" type="hidden" class="form-control" name="birthday" value="{{ $usernewdata["birthday"]}}">
                                    <input id="birthday" type="date" class="form-control" name="birthday" value="{{ $usernewdata["birthday"]}}" autocomplete="birthday" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('性別') }}</label>

                                <div class="form-check" value="">
                                    <input class="form-check-inline" type="hidden" name="gender" id="gender" value="1" {{ $usernewdata["gender"] == 1 ? "checked" : ""}}>
                                    <input class="form-check-inline" type="radio" name="gender" id="gender" value="1" {{ $usernewdata["gender"] == 1 ? "checked" : ""}} disabled>
                                    <label class="form-check-label" for="male"> 男 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-inline" type="hidden" name="gender" id="gender" value="2" {{ $usernewdata["gender"] == 2 ? "checked" : ""}}>
                                    <input class="form-check-inline" type="radio" name="gender" id="gender" value="2" {{ $usernewdata["gender"] == 2 ? "checked" : ""}} disabled>
                                    <label class="form-check-label" for="male"> 女 </label>
                                </div>
                            </div>

                            {{-- @php echo $usernewdata["password"] @endphp --}}
  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                                &nbsp;
                                <a href="{{url()->previous()}}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection