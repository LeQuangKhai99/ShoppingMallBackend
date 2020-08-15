@extends("layout.admin")
@section("title")
    <title>Trang chủ</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách menu", 'origin'=>'Menu', 'action'=>'Index', 'route'=>'menus.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('menus.create')}}" class="btn btn-success float-right" style="margin-bottom: 20px">Thêm menu</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menu</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($menus as $menu)
                                <tr>
                                    <th scope="row">{{$menu->id}}</th>
                                    <td>{{$menu->name}}</td>
                                    <td>
                                        <a href="{{route('menus.edit', ['id'=>$menu->id])}}" class="btn btn-primary">Cập nhật</a>
                                        <a href="{{route('menus.delete', ['id'=>$menu->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$menus->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
