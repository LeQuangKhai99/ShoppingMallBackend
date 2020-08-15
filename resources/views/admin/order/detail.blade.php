@extends("layout.admin")
@section("title")
    <title>Chi tiết đơn hàng</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Chi tiết đơn hàng", 'origin'=>'Order', 'action'=>'Index', 'route'=>'orders.index'])
    <!-- /.content-header -->
        <div style="width: 60%; margin: auto">
                <div class="form-group">
                    <label>Tên khách hàng</label>
                    <input value="{{$order->customer->name}}" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <input value="{{$order->status == 0 ? 'Chưa giao' : 'Đã giao'}}" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea rows="5" class="form-control">{{$order->note}}</textarea>
                </div>
                <div class="form-group">
                    <label>Ngày đặt hàng</label>
                    <input value="{{$order->created_at}}" type="text" class="form-control">
                </div>
            @php
                $total = 0;
            @endphp
            @foreach($order->orderItems as $key => $item)
                <h4>Sản phẩm thứ: {{$key+1}}</h4>
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input value="{{$item->product->name}}" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Hình ảnh sản phẩm</label>
                    <img class="form-control" style="width: 150px; height: 150px" src="{{$item->product->feature_image_path}}" alt="">
                </div>
            @php
            $total += $item->product->price * $item->quantity;
            @endphp
                <div class="form-group">
                    <label>Giá</label>
                    <input value="{{number_format($item->product->price)}} VND" type="text" class="form-control">
                </div>
            <div class="form-group">
                <label>Số lượng</label>
                <input value="{{$item->quantity}}" type="text" class="form-control">
            </div>
            @endforeach
            <h2>Tổng tiền: {{ number_format($total) }}</h2>
        </div>
    </div>

@endsection
@section('js')
    <script src="/js/act_del.js"></script>
@endsection
