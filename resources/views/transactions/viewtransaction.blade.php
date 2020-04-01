@extends('layouts.app')

@section('title')
    <title> 取引精細</title>
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
    {{-- isi --}}
    <div class="col-8 offset-md-3">
        @foreach ($transactions as $transaction)
        <table class="table borderless" name="transactiondetail" id="transactiondetail">
                <tr>
                    <th scope="col">注文日</th>
                    <td>{{date("d F Y", strtotime($transaction["transaction_date"]))}}</td>
                </tr>
                <tr>
                    <th scope="col">取引ID</th>
                    <td>{{$transaction_id}}</td>
                </tr>
                <tr>
                    <th scope="col">ステータス</th>
                    <td>
                        @switch($transaction["status"])
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
                </tr>
                <tr>
                    <th scope="col">住所</th>
                    <td>{{$transaction["address"]}}</td>
                </tr>
                <tr>
                    <th scope="col">メモ</th>
                    <td>{{$transaction["memo"]}}</td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align:right;">
                        {{-- href="{{ route('') }}" --}}
                    <a class="btn btn-success btn-sm" id="edittransaction" name="edittransaction" @if($transaction["status"] != 2) href="{{route('editorder', [$transaction_id])}}"@endif>編集</a> 
                        &nbsp;
                        <button class="btn btn-danger btn-sm" id="canceltransaction" name="canceltransaction" onclick="showCancelModal({{$transaction_id}});"  @if($transaction["status"] == 2) disabled @endif>取り消す</button>

                        {{-- modal sakujou --}}
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal2LongTitle">取り消す確認</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="text-align: left; font-weight:lighter">再度取り消しのをご確認お願いいたします。</div>
                                    <form class="modal-footer" method="post" action="{{route('deleteorder') }}">
                                        @csrf
                                        <input type="hidden" name="transaction_id"  id="modal_transaction_id_cancel" value="">
                                        <input type="hidden" name="action"  id="action" value="1">
                                        <button type="submit" class="btn btn-primary">取り消す</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        &nbsp;
                        <button class="btn btn-dark btn-sm" id="deletetransaction" name="deletetransaction" onclick="showDeleteModal({{$transaction_id}});">削除</button>  

                        {{-- modal sakujou --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">削除確認</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="text-align: left; font-weight:lighter">再度削除のをご確認お願いいたします。</div>
                                    <form class="modal-footer" method="post" action="{{route('deleteorder') }}">
                                        @csrf
                                        <input type="hidden" name="transaction_id"  id="modal_transaction_id" value="">
                                        <button type="submit" class="btn btn-primary">削除</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </th> 
                </tr>
        </table>
        @endforeach
    </div>

    {{-- item --}}
    <table class="cell-border stripe hover" name="transactiontable" id="transactiontable">
        <thead>
            <tr>
                <th scope="col">商品ID</th>
                <th scope="col">商品</th>
                <th scope="col">数量</th>
                <th scope="col">画像</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailtransactions as $item)
            <tr>
                <td>{{$item["product_id"]}}</td>
                <td>{{$item["product_name"]}}</td>
                <td>{{$item["quantity"]}}</td>
                <td><img class="img-responsive img-rounded img-thumbnail" style="width: 150px;" src="/upload/{{ $item["product_id"] }}/{{ $item["product_image"] }}" alt=""></td>
            </tr> 
            @endforeach
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
    <script>
        function showDeleteModal(transaction_id) {
            $('#modal_transaction_id').val(transaction_id);
            $('#exampleModal').modal('show');
        }

        function showCancelModal($transaction_id) {
            $('#modal_transaction_id_cancel').val($transaction_id);
            $('#exampleModal2').modal('show');
        }
    </script>
@endsection