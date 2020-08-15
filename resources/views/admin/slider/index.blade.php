@extends("layout.admin")
@section("title")
    <title>Danh sách slide</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách slide", 'origin'=>'Slide', 'action'=>'Index', 'route'=>'sliders.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('sliders.create')}}" class="btn btn-success float-right" style="margin-bottom: 20px">Thêm slide</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slide</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{$slider->id}}</th>
                                    <td>{{$slider->name}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td><img style="width: 150px; height: 150px" src="{{$slider->image_path}}" alt=""></td>
                                    <td>
                                        <a href="{{route('sliders.edit', ['id'=>$slider->id])}}" class="btn btn-primary">Cập nhật</a>
                                        <a href data-url="{{route('sliders.delete', ['id'=>$slider->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger act-del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$sliders->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('js')
    <script src="/js/act_del.js"></script>
@endsection
