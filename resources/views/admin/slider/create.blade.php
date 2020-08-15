@extends("layout.admin")
@section("title")
    <title>Thêm slider</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Thêm slider",'origin'=>'Slider', 'action'=>'Add', 'route'=>'sliders.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('sliders.create')}}" method="post" enctype="multipart/form-data" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên slider</label>
                            <input value="{{old('names')}}" type="text" name="names" placeholder="Nhập tên slider"  class="form-control">
                            @error('names')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" placeholder="Nhập mô tả"  class="form-control">{{old('description')}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="image" placeholder="Nhập tên slider"  class="form-control-file">
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
