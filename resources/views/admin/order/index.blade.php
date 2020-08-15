@extends("layout.admin")
@section("title")
    <title>Danh sách đơn hàng</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách đơn hàng", 'origin'=>'Order', 'action'=>'Index', 'route'=>'orders.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->customer->name}}</td>
                                    <td>
                                        @if($order->status == 0)
                                            <a data-url="{{route('orders.edit', ['id'=>$order->id])}}" type="button" class="btn btn-danger act-edit">Chưa giao</a>
                                        @else
                                            <a data-url="{{route('orders.edit', ['id'=>$order->id])}}" type="button" class="btn btn-success act-edit">Đã giao</a>
                                        @endif
                                    </td>
                                    <td>{{$order->note}}</td>
                                    <td>
                                        <a href="{{route('orders.detail', ['id'=>$order->id])}}" class="btn btn-primary ">Xem chi tiết</a>
                                        <a href data-url="{{route('orders.delete', ['id'=>$order->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger act-del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$orders->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('js')
    <script src="/js/act_del.js"></script>
    <script src="/js/act_edit.js"></script>
@endsection
