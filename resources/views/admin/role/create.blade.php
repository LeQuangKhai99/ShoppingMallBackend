@extends("layout.admin")
@section("title")
    <title>Thêm Role</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Thêm Role",'origin'=>'Role', 'action'=>'Add', 'route'=>'roles.index'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('roles.create')}}" method="post" enctype="multipart/form-data" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên role</label>
                            <input value="{{old('names')}}" type="text" name="names" placeholder="Nhập tên role"  class="form-control check-all">
                            @error('names')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="display_name" placeholder="Nhập mô tả role"  class="form-control">{{old('display_name')}}</textarea>
                            @error('display_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label><input class="check-all" type="checkbox"></label>
                        check all
                        @foreach($parentPermission as $permission)
                        <div class="card col-md-12">
                            <div class="card-body" style="background-color: #18c3e2">
                                <h5 class="card-title">
                                    <label><input class="checkbox_parent" type="checkbox" value="{{$permission->id}}"></label>
                                    {{$permission->name}}

                                </h5>
                            </div>
                            <hr>

                            <div class="row">
                                @foreach($permission->PermissionChildren()->get() as $child)
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <label><input class="checkbox_children" name="permission_id[]" type="checkbox" value="{{$child->id}}"></label>
                                        {{$child->name}}
                                    </h5>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        @endforeach
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
    <script>
        $('.checkbox_parent').on('click', function (){
            $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'));
        })

        $('.check-all').on('click', function (){
            $('.checkbox_parent').prop('checked', $(this).prop('checked'));
            $('.checkbox_children').prop('checked', $(this).prop('checked'));
        })
    </script>
@endsection
