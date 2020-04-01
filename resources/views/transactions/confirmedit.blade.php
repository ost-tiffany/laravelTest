@extends('layouts.app')

@section('title')
    <title> 取引編集</title>

<!--JS !-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('bootstrap/js/select2.min.js')}}"></script>

<!--css !-->
<link href="{{asset('bootstrap/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('取引編集確認') }}</div>
           
            <form method="post" action='{{route('editorderconfirm', [$transaction_id])}}' id="formconfirmedit"> 
                    @csrf 
                    <div style="margin:30px;">
                            <input id="transaction_id" type="hidden" class="form-control" name="transaction_id" value="{{$transaction_id}}">

                            <div class="form-group row">
                                <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('注文日') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="text" class="form-control" name="date" value="{{date("d F Y", strtotime($orders["date"]))}}"  disabled>
                                    <input id="date" type="hidden" class="form-control" name="date" value="{{$orders["date"]}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('住所') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{$orders["address"]}}"  disabled>
                                    <input id="address" type="hidden" class="form-control" name="address" value="{{$orders["address"]}}" >

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="memo" class="col-md-2 col-form-label text-md-right">{{ __('メモ') }}</label>

                                <div class="col-md-6">
                                    <input id="memo" type="memo" class="form-control" name="memo" value="{{$orders["memo"]}}" disabled >
                                    <input id="memo" type="hidden" class="form-control" name="memo" value="{{$orders["memo"]}}" >
                                </div>
                            </div>

                        {{-- order item --}}
                        <hr style="width: 200px; margin-bottom: 10px">

                        @for ($i = 0; $i < count($orders["item"]); $i++)
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-1">
                                    <label for="item">アイテム</label>
                                    <select class="js-example-basic-single form-control" id="item{{$i}}"  autocomplete="off" disabled>
                                        <option value='{{$orders["item"][$i]}}' {{$orders["item"][$i] == $orders["item"][$i] ? "selected" : ""}}>{{$orders["item"][$i]}} - {{$orders["product_name"][$i]}}</option>
                                    </select>
                                    <input id="item{{$i}}" type="hidden" class="form-control" name="item[]" value="{{$orders["item"][$i]}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="quantity">数量</label>
                                    <input type="number" class="form-control" id="quantity"  min="0" value='{{$orders["quantity"][$i]}}' disabled>
                                    <input type="hidden" class="form-control" id="quantity" name="quantity[]" min="0" value='{{$orders["quantity"][$i]}}'>
                                </div>
                                <div>
                                    <a href="/upload/{{ $orders["item"][$i] }}/{{ $orders["product_image"][$i] }}"> 
                                        <img class="img-responsive img-rounded img-thumbnail" style="width: 150px;" src="/upload/{{ $orders["item"][$i] }}/{{ $orders["product_image"][$i] }}" alt="">
                                    </a>
                                </div>

                            </div>
                        @endfor

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" style="top:20px;">
                                <input type="submit" class="btn btn-primary btn-sm" name="submit" value="注文">
                                &nbsp;
                                <a href="{{url()->previous()}}" class="btn btn-danger btn-sm">{{ __('キャンセル') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection