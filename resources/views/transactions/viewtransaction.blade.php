@extends('layouts.app')

@section('title')
    <title> 取引精細</title>
@endsection

@section('content')

<div class="col-8 offset-md-3" style="width:900px">
    {{-- isi --}}
    <div class="col-8 offset-md-3">
        <table class="table borderless" name="transactiondetail" id="transactiondetail">
                <tr>
                    <th scope="col">取引ID</th>
                    <td>d</td>
                </tr>
                <tr>
                    <th scope="col">ステータス</th>
                    <td>d</td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align:right;">
                        {{-- href="{{ route('') }}" --}}
                        <a class="btn btn-success btn-sm" id="edittransaction" name="edittransaction" >編集</a> 
                        &nbsp;
                        <a class="btn btn-danger btn-sm" id="canceltransaction" name="canceltransaction">取り消す</a>
                        &nbsp;
                        <a class="btn btn-dark btn-sm" id="deletetransaction" name="deletetransaction">削除</a>  
                        </th> 
                </tr>
        </table>
    </div>

    {{-- item --}}
    <table class="cell-border stripe hover" name="transactiontable" id="transactiontable">
        <thead>
            <tr>
                <th scope="col">商品ID</th>
                <th scope="col">商品</th>
                <th scope="col">数量</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>d</td>
                <td>d</td>
                <td>d</td>
            </tr>
        </tbody>
    </table>
</div>

    <script>
        $(document).ready( function () {
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