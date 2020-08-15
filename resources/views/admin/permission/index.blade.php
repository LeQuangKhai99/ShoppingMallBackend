@extends("layout.admin")
@section("title")
    <title>Danh sách permission</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách permission", 'origin'=>'Permission', 'action'=>'Index', 'route'=>'permissions.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('permissions.create')}}" class="btn btn-success float-right" style="margin-bottom: 20px">Thêm permission</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên permission</th>
                                <th scope="col">Tên hiển thị</th>
                                <th scope="col">Key code</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{$permission->id}}</th>
                                    <th scope="row">{{$permission->name}}</th>
                                    <th scope="row">{{$permission->display_name}}</th>
                                    <th scope="row">{{$permission->key_code}}</th>
                                    <td>
                                        <a href="{{route('permissions.edit', ['id'=>$permission->id])}}" class="btn btn-primary">Cập nhật</a>
                                        <a data-url="{{route('permissions.delete', ['id'=>$permission->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger act-del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$permissions->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('js')
    <script src="/js/act_del.js"></script>
@endsection
