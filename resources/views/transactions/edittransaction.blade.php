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
                <div class="card-header">{{ __('取引編集') }}</div>
           
            <form method="post" action='{{route('editorderpost', [$transaction_id])}}'> 
                    @csrf 
                    <div style="margin:30px;">
                    @foreach ($transaction as $trans)
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('注文日') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control" name="date" value="{{date("d F Y", strtotime($trans['date']))}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('住所') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$trans['address']}}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="memo" class="col-md-2 col-form-label text-md-right">{{ __('メモ') }}</label>

                            <div class="col-md-6">
                                <textarea id="memo" type="memo"　rows='3' class="form-control @error('memo') is-invalid @enderror" name="memo" value="{{$trans['memo']}}" > </textarea>
                            </div>
                        </div>
                    @endforeach

                        {{-- order item --}}
                        <hr style="width: 200px; margin-bottom: 10px">

                        <div class="form-row col-md-12">
                             <button type="button" name="adding" id="adding" onclick="add();" class="btn btn-info btn-sm btn-block" style="margin:30px;">新例</button>
                        </div>

                        <div>
                            <input type="hidden" value="3" id="count">
                            <div id="transactiondetail" name="transactiondetail" >
                            @for ($i = 1; $i <=3; $i++)  
                                <div class="wrapper{{$i}} row" >
                                    <div class="col-md-6 offset-md-1">
                                        <label for="item">アイテム</label>
                                            <select class="js-example-basic-single form-control" id="item{{$i}}" name="item[]">
                                                @foreach ($productname as $product)
                                                    <option value='{{$product["product_id"]}}'>{{$product["product_id"]}} - {{$product["product_name"]}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quantity">数量</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" min="0">

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
                            @endfor
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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
  		for (let index = 1; index <= 3; index++) {
			$('#item'+index).select2();	  
		}
	});


    function add(){
		var index = document.getElementById("count").value;
		var flag =  index + 1;

        var product = '<div class="form-group col-md-6 offset-md-1"><label for="item">Item</label><select class="js-example-basic-single form-control" id="item'+flag+'" name="item[]">@foreach($productname as $product)<option value="{{ $product["product_id"] }}">{{$product["product_id"] .' - '. $product["product_name"] }}</option>@endforeach</select></div>';
		
        // var product = '<div class="col-md-6 offset-md-1"><label for="item">アイテム</label><select class="js-example-basic-single form-control" id="item'+flag+'" name="item[]">'@foreach($productname as $product)'<option value='{{$product["product_id"]}}'>{{$product["product_id"]}} - {{$product["product_name"]}}</option>'@endforeach'</select></div>';

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