@extends('layouts.app')

@section('title')
    <title> 履歴履歴</title>
@endsection

@section('content')

<div class="col-8 offset-md-3" style="width:900px">
    <table class="cell-border stripe hover" name="transactiontable" id="transactiontable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">取引ID</th>
                <th scope="col">ステータス</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{-- @php $i = 1; @endphp
            @foreach ($productslist as $transaction) --}}
            {{$transaction["transaction_id"] = 1}}
                <tr>
                    {{-- <td>{{$i++}}</td> --}}
                    <td>d</td>
                    <td>d</td>
                    <td>d</td>
                    <td><a class="btn btn-success" id="viewtransaction" name="viewtransaction" href="{{ route('transactiondetailview',['transaction_id'=>$transaction["transaction_id"]]) }}">表示</a></td>
                </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>

<script>
    $(document).ready( function () {
        //hide modal here

        $('#transactiontable').DataTable(
            { 
            "language" : {
                "sEmptyTable": "レコードがありません",
                "sInfo": " _START_ 件　～ _END_ 件 _TOTAL_ 件中",
                "sInfoEmpty": "0　件　～ 0 件 0 件中",
                "sInfoFiltered": "",
                "sInfoPostFix": "",
                "sLengthMenu": "表示 _MENU_ 件",
                "sLoadingRecords": "ローディング...",
                "sProcessing": "処理中...",
                "sSearch": "検索:",
                "sSearchPlaceholder": "",
                "sThousands": ",",
                "sUrl": "",
                "sZeroRecords": "対応するレコードがありません",
                "paginate": {
                    "first":      "初",
                    "last":       "後",
                    "next":       "次",
                    "previous":   "前"
                }
                }
            });
    });
</script>


@endsection