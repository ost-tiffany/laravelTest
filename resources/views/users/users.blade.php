@extends('layouts.app')
@section('title')
<title>ユーザー　ページ</title>
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

    @if (Session::get('alert-none'))
        <div class="row justify-content-center text-justify">
            <div class="alert alert-warning">
                {{Session::get('alert-none')}}
            </div>
        </div>
    </div>
    @endif

    <div class="col-8 offset-md-3" style="width:900px">
        <table class="cell-border stripe hover" name="usertable" id="usertable">
            <thead>
                <tr>
                    <th scope="col">ユーザID</th>
                    <th scope="col">ユーザ名</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userlist as $user)
                    <tr>
                        <td>{{ $user["user_id"] }}</td>
                        <td>{{ $user["user_name"] }}</td>
                        <td>{{ $user["email"] }}</td>
                        <td>
                            @if(Auth::user()->user_role == 1)
                                @if(Auth::user()->user_id == $user["user_id"])
                                    <a class="btn btn-success" id="edituser" name="edituser" href="{{ route('useredit',['user_id'=>$user["user_id"]]) }}">編集</a> 
                                @endif
                            @else
                            {{-- button auth user --}}
                                <a class="btn btn-success" id="edituser" name="edituser" href="{{ route('useredit',['user_id'=>$user["user_id"]]) }}">編集</a> 
                                
                                @if (Auth::user()->user_id != $user["user_id"])
                                    &nbsp; 
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" onclick="showDeleteModal({{$user['user_id']}});">
                                        削除
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">削除確認</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    再度削除のをご確認お願いいたします。
                                                </div>
                                                <form class="modal-footer" method="post" action="{{route('deleteuser') }}">
                                                    @csrf
                                                    <input type="hidden" name="user_id"  id="modal_user_id" value="">
                                                    <button type="submit" class="btn btn-primary">削除</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
    <script>
        function showDeleteModal($user_id) {
            $('#modal_user_id').val($user_id);
            $('#exampleModal').modal('show');
        }
    </script>
@endsection
