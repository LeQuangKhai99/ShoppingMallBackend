@extends("layout.admin")
@section("title")
    <title>Trang chủ</title>
@endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include("partial.content-header", ['name'=>"Trang chủ", 'origin'=>'Home', 'action'=>'', 'route'=>'home'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <h1>Trang chủ</h1>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
