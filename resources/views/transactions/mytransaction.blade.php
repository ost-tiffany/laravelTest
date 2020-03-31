@extends('layouts.app')

@section('title')
    <title> 履歴履歴</title>
@endsection

@section('content')

@if (Session::get('alert'))
<div name="alertsuccess" id="alertsuccess" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ Session::get('type')}} </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>{{ Session::get('alert') }}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
    </div>
    </div>
</div>


<script>
$('#alertsuccess').modal('show');
</script>
@endif

<div class="col-8 offset-md-3" style="width:900px">
    <table class="cell-border stripe hover" name="transactiontable" id="transactiontable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">取引ID</th>
                <th scope="col">注文日</th>
                <th scope="col">ステータス</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{$i = 1}}
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$transaction["transaction_id"]}}</td>
                    <td>{{date("d F Y", strtotime($transaction["transaction_date"]))}}</td>
                    <td>@switch($transaction["status"])
                            @case(1)
                                {{"準備中"}}
                                @break
                            @case(2)
                                {{"取り消した"}}
                                @break
                            @case(3)
                                {{"済み"}}
                                @break
                        @endswitch
                    </td>
                    <td><a class="btn btn-success" id="viewtransaction" name="viewtransaction" href="{{ route('transactiondetailview',['transaction_id'=>$transaction["transaction_id"]]) }}">表示</a></td>
                </tr>
            @endforeach
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