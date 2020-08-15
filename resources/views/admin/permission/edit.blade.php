@extends("layout.admin")
@section("title")
    <title>Cập nhật permission</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Cập nhật permission",'origin'=>'Permission', 'action'=>'Edit', 'route'=>'permissions.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('permissions.edit', ['id'=>$permission->id])}}" method="post" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Chọn module cha</label>
                            <select name="module_parent" class="form-control">
                                <option value="0">Đây là module cha</option>
                                {!! $html !!}
                            </select>
                        </div>
                        @error('key')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Tên permission</label>
                            <input type="text" value="{{$permission->name}}" name="name" placeholder="Nhập tên permission"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị</label>
                            <input type="text" value="{{$permission->display_name}}" name="display_name" placeholder="Nhập tên hiển thị"  class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
