@extends("layout.admin")
@section("title")
    <title>Thêm menu</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Cập nhật menu",'origin'=>'Menu', 'action'=>'Add', 'route'=>'menus.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('menus.edit', ['id'=>$menu->id])}}" method="post" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên menu</label>
                            <input value="{{$menu->name}}" type="text" name="name" placeholder="Nhập tên menu"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Chọn danh mục cha</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Đây là danh mục cha</option>
                                {!! $html !!}
                            </select>
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
