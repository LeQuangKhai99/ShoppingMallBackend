@extends("layout.admin")
@section("title")
    <title>Danh sách sản phẩm</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách sản phẩm", 'origin'=>'Product', 'action'=>'Index', 'route'=>'products.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('products.create')}}" class="btn btn-success float-right" style="margin-bottom: 20px">Thêm sản phẩm</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td>
                                        <img style="width: 100px; height: 100px;" src="{{$product->feature_image_path}}" alt="">
                                    </td>

                                    <td>{{optional($product->users)->name}}</td>
                                    <td>{{optional($product->Category)->name}}</td>

                                    <td>
                                        <a href="{{route('products.edit', ['id'=>$product->id])}}" class="btn btn-primary">Cập nhật</a>
                                        <a href data-url="{{route('products.delete', ['id'=>$product->id])}}" type="button" class="btn btn-danger act-del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$products->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $('.act-del').on('click', function (e){
            e.preventDefault();
            var url = $(this).data('url');
            var btn = $(this);
            Swal.fire({
                title: 'Bạn có chắc muốn xóa?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'GET',
                        url: url,
                        success: function (data){
                            if (data.code == 200){
                                btn.parent().parent().remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted',
                                    'success'
                                )
                            }

                        },
                        error: function (){

                        }
                    })
                }
            })
        })
    </script>
@endsection
