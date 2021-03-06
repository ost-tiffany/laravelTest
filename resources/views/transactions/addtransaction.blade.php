@extends('layouts.app')

@section('title')
    <title> 取引フォーム</title>

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
                <div class="card-header">{{ __('取引フォーム') }}</div>
            <form method="post" action='{{route('makeorderpost')}}'> 
                    @csrf 
                    <div style="margin:30px;">
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('注文日') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date')}}">

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
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}" >

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
                                <textarea id="memo" type="memo"　rows='3' class="form-control @error('memo') is-invalid @enderror" name="memo" value="{{old('memo')}}" > </textarea>
                                
                                @error('memo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- order item --}}
                        <hr style="width: 200px; margin-bottom: 10px">

                        <div class="form-row col-md-12">
                                <button type="button" name="adding" id="adding" onclick="add();" class="btn btn-info btn-sm btn-block" style="margin:30px;">新例</button>
                        </div>

                        <div>
                            <input type="hidden" value="" id="count">
                            @php $index = 1; @endphp  
                            <div id="transactiondetail" name="transactiondetail" >
                                @for ($i = 0; $i <3; $i++)       
                                <script>
                                    document.getElementById("count").value++;
                                </script>
                                
                                <div class="wrapper{{$index}} row" >
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
                                        <input type="number" class="form-control @error('quantity.'.$i) is-invalid @enderror" required id="quantity" name="quantity[]" min="0" value="">
                                        
                                        @error('quantity.'.$i)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" name="deleterow" id="deleterow{{$i}}"  onclick="delete_row({{$index}});" class="btn btn-danger" style="margin-top:30px">削除</button>
                                    </div>
                                </div>
                                @php $index++; @endphp  
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
  		for (let index = 0; index < 3; index++) {
			$('#item'+index).select2();	  
		}
		 
		$("#date").datepicker({
			dateFormat: "yy-mm-dd",
		});
	});


    function add(){
		//var index = document.getElementById("count").value;
        var flag =  parseInt($('#count').val())+1;
        flag = flag + Math.floor(Math.random() * 10000);

        var product = '<div class="form-group col-md-6 offset-md-1"><label for="item">アイテム</label><select class="js-example-basic-single form-control" id="item'+flag+'" name="item[]">@foreach($productname as $product)<option value="{{ $product["product_id"] }}">{{$product["product_id"] .' - '. $product["product_name"] }}</option>@endforeach</select></div>';
		
        // var product = '<div class="col-md-6 offset-md-1"><label for="item">アイテム</label><select class="js-example-basic-single form-control" id="item'+flag+'" name="item[]">'@foreach($productname as $product)'<option value='{{$product["product_id"]}}'>{{$product["product_id"]}} - {{$product["product_name"]}}</option>'@endforeach'</select></div>';

		var qty = '<div class="col-md-3"><div class="<label for="quantity">数量</label><input type="number" class="form-control @error('quantity.'.$i) is-invalid @enderror" id="quantity" name="quantity[]" required min="0">@error('quantity.'.$i)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div>';
		 
		$("#transactiondetail").append('<div class="wrapper'+flag+' row" >' + product + qty + '<div class="col-md-1"><button type="button" name="deleterow" id="deleterow'+flag+'"  onclick="delete_row('+flag+');" class="btn btn-danger" style="margin-top:30px;">削除</button></div></div></div>');

		$('#item'+flag).select2();
        document.getElementById("count").value++;
	}

    function delete_row(index){
		var flag = document.getElementById("count").value;
		//hapus 
            if(flag <= 0) {
			    document.getElementById("count").value = 0;
            }
            else {
                $(".wrapper"+index).remove();
                document.getElementById("count").value -= 1;

		}
	}

                                    
</script>
@endsection