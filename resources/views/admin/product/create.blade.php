@extends("layout.admin")
@section("title")
    <title>Thêm sản phẩm</title>
@endsection
@section('css')
    <link href="{{asset('/vendors/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include("partial.content-header", ['name'=>"Thêm sản phẩm",'origin'=>'Product', 'action'=>'Add', 'route'=>'products.index'])
    <!-- /.content-header -->
                <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('products.create')}}" enctype="multipart/form-data" method="post" style="width: 50%; margin: auto">
                        @csrf
                        <div class="form-group">
                            <label>Tên menu</label>
                            <input type="text" value="{{old('name')}}" name="name" placeholder="Nhập tên sản phẩm"  class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input value="{{old('price')}}" type="number" name="price" placeholder="Nhập giá sản phẩm"  class="form-control">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file" name="image"  class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Ảnh chi tiết</label>
                            <input type="file" multiple name="images[]"  class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="my-editor" type="text" name="content1" placeholder="Nhập tên nội dung"  class="form-control">{{old('content1')}}</textarea>
                            @error('content1')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm</label>
                            <select value="{{old('cate')}}" name="cate" class="form-control">
                                {!! $html !!}
                            </select>
                            @error('cate ')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Chọn tag cho sản phẩm</label>
                            <select name="tags[]" class="form-control tags_select" multiple="multiple">

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

@section('js')
    <script src="{{asset('/vendors/select2/select2.min.js')}}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        $(".tags_select").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    </script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "#my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection
