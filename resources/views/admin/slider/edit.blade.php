@extends("layout.admin")
@section("title")
    <title>Cập nhật slider</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Cập nhật slider",'origin'=>'Slider', 'action'=>'Edit', 'route'=>'sliders.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('sliders.edit', ['id'=>$slider->id])}}" method="post" enctype="multipart/form-data" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên slider</label>
                            <input value="{{$slider->name}}" type="text" name="names" placeholder="Nhập tên slider"  class="form-control">
                            @error('names')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" placeholder="Nhập mô tả"  class="form-control">{{$slider->description}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img style="width: 150px; height: 150px; display: block; margin: 10px" src="{{$slider->image_path}}" alt="">
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
