@extends("layout.admin")
@section("title")
    <title>Thêm loại sản phẩm</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include("partial.content-header", ['name'=>"Thêm loại sản phẩm",'origin'=>'Category', 'action'=>'Add', 'route'=>'categories.index'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('categories.create')}}" method="post" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên loại sản phẩm</label>
                            <input type="text" name="name" placeholder="Nhập tên loại sản phẩm"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Chọn danh mục cha</label>
                            <select name="cate" class="form-control">
                                <option value="0">Đây là danh mục cha</option>
                                {!!$html!!}
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
