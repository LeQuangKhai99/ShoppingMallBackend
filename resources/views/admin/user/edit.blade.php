@extends("layout.admin")
@section("title")
    <title>Cập nhật user</title>
@endsection
@section('css')
    <link href="{{asset('/vendors/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Cập nhật user",'origin'=>'User', 'action'=>'Edit', 'route'=>'users.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('users.edit', ['id'=>$user->id])}}" method="post" enctype="multipart/form-data" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên user</label>
                            <input value="{{$user->name}}" type="text" name="names" placeholder="Nhập tên user"  class="form-control">
                            @error('names')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" placeholder="Nhập email"  class="form-control" value="{{$user->email}}"/>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input name="pass" type="password" placeholder="Nhập mật khẩu"  class="form-control"/>
                            @error('pass')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Chọn quyền</label>
                            <select name="roles[]" class="form-control tag-select" multiple>
                                @foreach($roles as $role)
                                    <option
                                        {{$userRole->contains('id', $role->id) ? 'selected' : '' }}
                                        value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
@section('js')
    <script src="{{asset('/vendors/select2/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.tag-select').select2();
        });
    </script>
@endsection
