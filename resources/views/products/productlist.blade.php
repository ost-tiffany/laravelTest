@extends('layouts.app')

@section('title')
    <title>商品リスト</title>

    <style>
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
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

    <div class="content title m-b-md">
        <div class="links">  
            <a>></a> 
            <a href="{{ route('woodlist')}}">木造</a> 
            &nbsp;
            <a href="{{ route('otherlist') }}">雑貨</a>
        </div>
    </div> 

    <div class="col-8 offset-md-3" style="width:900px">
        <table class="cell-border stripe hover" name="usertable" id="usertable">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">商品ID</th>
                    <th scope="col">商品名</th>
                    <th scope="col">登録画像</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($productslist as $product)
                    <tr>
                        <td>{{$i++}}</td>
                        <td> {{ $product["product_id"] }}</td>
                        <td>{{ $product["product_name"] }}</td>
                        <td> <a href="/upload/{{ $product["product_id"] }}/{{ $product["product_image"] }}"> 
                                <img class="img-responsive img-rounded img-thumbnail" style="width: 150px;" src="/upload/{{ $product["product_id"] }}/{{ $product["product_image"] }}" alt="">
                            </a></td>
                        <td><a class="btn btn-success" id="editimage" name="editimage" href="{{ route('productedit',['product_id'=>$product["product_id"]]) }}">編集</a> 
                            &nbsp; 
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" onclick="showDeleteModal({{$product['product_id']}});">
                                削除
                            </button>
                                
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">削除確認</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">再度削除のをご確認お願いいたします。</div>
                                        <form class="modal-footer" method="post" action="{{route('productdelete') }}">
                                            @csrf
                                            <input type="hidden" name="product_id"  id="modal_product_id" value="">
                                            <button type="submit" class="btn btn-primary">削除</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
        function showDeleteModal($product_id) {
            $('#modal_product_id').val($product_id);
            $('#exampleModal').modal('show');
        }
    </script>

@endsection