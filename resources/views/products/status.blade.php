@extends('layouts.app')

@section('title')
    <title>商品類ハンドル</title>
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

    <div class="offset-3" style="padding:50px;">   
        <button class="btn btn-danger btn-sm" id="new_name"" name="new_name"" onclick="showaddTypeModal();" >商品類追加</button>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal2LongTitle">商品類追加</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modal-footer" method="post" action="{{route('addtype') }}">
                        @csrf
                        <label>商品類名</label>
                        <input type="text" name="new_name"  id="modal_new_name_edit" value="">
                        <button type="submit" class="btn btn-primary">商品類追加</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-8 offset-md-3" style="width:900px">
        <table class="cell-border stripe hover" name="usertable" id="usertable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">商品類番号</th>
                    <th scope="col">商品名</th>

                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($type as $typ)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td> {{$typ["type_id"]}}</td>
                        <td> {{$typ["type_name"]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function showaddTypeModal($new_name) {
            $('#modal_transaction_id_edit').val($new_name);
            $('#exampleModal2').modal('show');
        }
    </script>
    <script>
        $(document).ready( function () {
            //hide modal here

            $('#usertable').DataTable(
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