@extends("layout.admin")
@section("title")
    <title>Danh sách role</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách role", 'origin'=>'Role', 'action'=>'Index', 'route'=>'roles.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('roles.create')}}" class="btn btn-success float-right" style="margin-bottom: 20px">Thêm role</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên role</th>
                                <th scope="col">Tên hiển thị</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{$role->id}}</th>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->display_name}}</td>
                                    <td>
                                        <a href="{{route('roles.edit', ['id'=>$role->id])}}" class="btn btn-primary">Cập nhật</a>
                                        <a href data-url="{{route('roles.delete', ['id'=>$role->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger act-del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$roles->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('js')
    <script src="/js/act_del.js"></script>
@endsection
