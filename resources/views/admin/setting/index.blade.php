@extends("layout.admin")
@section("title")
    <title>Danh sách cài đặt</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header', ['name'=>"Danh sách cài đặt", 'origin'=>'Setting', 'action'=>'Index', 'route'=>'settings.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="btn-group float-right" style="margin-bottom: 20px;">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thêm setting
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('settings.create').'?type=text'}}">Text</a>
                                <a class="dropdown-item" href="{{route('settings.create').'?type=textarea'}}">Text Area</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($settings as $setting)
                                <tr>
                                    <th scope="row">{{$setting->id}}</th>
                                    <th scope="row">{{$setting->config_key}}</th>
                                    <th scope="row">{{$setting->config_value}}</th>
                                    <td>
                                        <a href="{{route('settings.edit', ['id'=>$setting->id]).'?type='.$setting->type}}" class="btn btn-primary">Cập nhật</a>
                                        <a data-url="{{route('settings.delete', ['id'=>$setting->id])}}" onclick="return confirm('Bạn có chắc muốn xóa?')" type="button" class="btn btn-danger act-del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                {{$settings->links()}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('js')
    <script src="/js/act_del.js"></script>
@endsection
