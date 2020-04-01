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
{{-- {{dd(count($detiltransaction))}} --}}
{{-- {{var_dump($productname)}}
<br>
{{dd($transaction)}}
<br>
@foreach ($transaction as $trans)
{{$trans["memo"]}}
@endforeach --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('取引編集') }}</div>
           
            <form method="post" action='{{route('editorderpost', [$transaction_id])}}'> 
                    @csrf 
                    <div style="margin:30px;">
                        @foreach ($transaction as $trans)
                            <input id="transaction_id" type="hidden" class="form-control" name="transaction_id" value="{{$transaction_id}}">

                            <div class="form-group row">
                                <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('注文日') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{date("d F Y", strtotime($trans["transaction_date"]))}}">
                                
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('住所') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$trans["address"]}}" >

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="memo" class="col-md-2 col-form-label text-md-right">{{ __('メモ') }}</label>

                                <div class="col-md-6">
                                    <input id="memo" type="memo" class="form-control @error('memo') is-invalid @enderror" name="memo" value="{{$trans["memo"]}}" >

                                    @error('memo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        @endforeach

                        {{-- order item --}}
                        <hr style="width: 200px; margin-bottom: 10px">

                        <div class="form-row col-md-12">
                             <button type="button" name="adding" id="adding" onclick="add();" class="btn btn-info btn-sm btn-block" style="margin:30px;">新例</button>
                        </div>                       

                        <div>
                            <input type="hidden" value="{{count($detiltransaction)}}" id="count">
                            <div id="transactiondetail" name="transactiondetail" >
                                @php $detilno = 0; @endphp
                                @for ($i = 1; $i <=count($detiltransaction); $i++)  
                                <div class="wrapper{{$i}} row" >
                                    <div class="col-md-6 offset-md-1">
                                        <label for="item">アイテム</label>
                                            <select class="js-example-basic-single form-control" id="item{{$i}}" name="item[]" autocomplete="off">
                                                @foreach ($productname as $product)
                                                    <option value='{{$product["product_id"]}}' {{$detiltransaction[$detilno]["product_id"] == $product["product_id"] ? "selected" : ""}}>{{$product["product_id"]}} - {{$product["product_name"]}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quantity">数量</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" min="0" autocomplete="off" value='{{$detiltransaction[$detilno]["quantity"]}}'>

                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" name="deleterow" id="deleterow{{$i}}"  onclick="delete_row({{$i}});" class="btn btn-danger" style="margin-top:30px">削除</button>
                                    </div>
                                </div>
                                @php $detilno++; @endphp
                                @endfor
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" style="top:20px;">
                                <input type="submit" class="btn btn-primary btn-sm" name="submit" value="注文">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var nomor = document.getElementById("count").value;
  		for (let index = 1; index <= nomor; index++) {
			$('#item'+index).select2();	  
        }
        
        $("#date").datepicker({
			dateFormat: "yy-mm-dd",
		});
	});

    function add(){
		var flag =  parseInt($('#count').val())+1;

        var product = '<div class="form-group col-md-6 offset-md-1"><label for="item">Item</label><select class="js-example-basic-single form-control" id="item'+flag+'" name="item[]">@foreach($productname as $product)<option value="{{ $product["product_id"] }}">{{$product["product_id"] .' - '. $product["product_name"] }}</option>@endforeach</select></div>';
		

		var qty = '<div class="col-md-3"><div class="<label for="quantity">数量</label><input type="number" class="form-control" id="quantity" name="quantity[]" min="0"></div></div>';
		 
		$("#transactiondetail").append('<div class="wrapper'+flag+' row" >' + product + qty + '<div class="col-md-1"><button type="button" name="deleterow" id="deleterow'+flag+'"  onclick="delete_row('+flag+');" class="btn btn-danger" style="margin-top:30px;">削除</button></div></div></div>');

		$('#item'+flag).select2();
		document.getElementById("count").value++;
	}

    function delete_row(index){
		var flag = document.getElementById("count").value;
		//hapus 
		$(".wrapper"+index).remove();
		if(flag == 1) {
			document.getElementById("count").value = 0;

		} else {
			document.getElementById("count").value--;
		}
	}

                                    
</script>
@endsection