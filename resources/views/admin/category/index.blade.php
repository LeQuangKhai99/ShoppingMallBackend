@extends("layout.admin")
@section("title")
    <title>Trang chủ</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partial.content-header', ['name'=>"Danh sách loại sản phẩm", 'origin'=>'Category', 'action'=>'Index', 'route'=>'categories.index'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('categories.create')}}" class="btn btn-success float-right" style="margin-bottom: 20px">Thêm loại sản phẩm</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{$category['id']}}</th>
                                <td>{{$category['name']}}</td>
                                <td>

                                    <a href="{{route('categories.edit', ['id'=>$category->id])}}" class="btn btn-primary">Cập nhật</a>

                                    <a href="{{route('categories.delete', ['id'=>$category->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$categories->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
