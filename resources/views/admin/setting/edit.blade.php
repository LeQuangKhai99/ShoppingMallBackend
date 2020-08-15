@extends("layout.admin")
@section("title")
    <title>Cập nhật setting</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Cập nhật setting",'origin'=>'Setting', 'action'=>'Edit', 'route'=>'settings.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('settings.edit', ['id'=>$setting->id])}}" method="post" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Config key</label>
                            <input value="{{$setting->config_key}}" type="text" name="key" placeholder="Nhập config key"  class="form-control">
                        </div>
                        @error('key')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if(request()->type === 'textarea')
                            <div class="form-group">
                                <label>Config value</label>
                                <textarea rows="5" name="value" placeholder="Nhập config value"  class="form-control">{{$setting->config_value}}</textarea>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Config value</label>
                                <input value="{{$setting->config_value}}" type="text" name="value" placeholder="Nhập config value"  class="form-control">
                            </div>
                        @endif
                        @error('value')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
