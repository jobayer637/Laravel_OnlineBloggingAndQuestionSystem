@extends('layouts.backend.app')

@section('title', 'Tags')

@push('css')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('assests/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assests/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush

@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <h2>
               <a class="btn btn-primary" href="{{route('admin.blog.create')}}">CREATE NEW BLOG</a>
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            SHOW ALL CATEGORIES
                        </h2>
                        <div id="showUpdateMsg"></div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">

                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>S/L</th>
                                    <th>Blog id</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                      <th>S/L</th>
                                      <th>Blog id</th>
                                      <th>Title</th>
                                      <th>Category</th>
                                      <th>Image</th>
                                      <th>Action</th>
                                  </tr>
                                </tfoot>
                                <tbody>
                                  @foreach($blog as $sl=>$blog)
                                  <tr id="delete_{{$blog->id}}">
                                      <th>{{$sl+1}}</th>
                                      <th>{{$blog->id}}</th>
                                      <th class="showTitle_{{$blog->id}}">{{$blog->title}}</th>
                                      <th class="showCategory_{{$blog->id}}">{{$blog->category->name}}</th>
                                      <th><img src="http://127.0.0.1:8000/storage/blog/{{$blog->image}}" alt="" height="40px" width="50px"> </th>
                                      <th>
                                        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter_{{$blog->id}}"><i class="fa fa-edit"></i></a>
                                          @csrf
                                          @method('DELETE')
                                        <a data-id="{{$blog->id}}" data-route="{{route('admin.blog.destroy',$blog->id)}}" class="blogDeleteClass btn btn-sm btn-danger" ><i class="fa fa-trash-o"></i></a>
                                      </th>
                                  </tr>

                                  <!-- start blog edit Modal -->
                                  <div class="modal model-xl fade w-100" id="exampleModalCenter_{{$blog->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalCenterTitle">Edit blog</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <form name="BlogForm"  onsubmit="return ValidateMyForm()" method="post" enctype="multipart/form-data">
                                                      @csrf
                                                      @method('PUT')
                                                      @if($errors->any())
                                                          @foreach($errors->all() as $error)
                                                              <div class="alert alert-warning alert-dismissible" role="alert">
                                                                  <strong>Opps Sorry!</strong> {{$error}}
                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                              </div>
                                                          @endforeach
                                                      @endif

                                                      <div class="form-group form-float">
                                                          <h5>Blog title *</h5>
                                                          <div class="form-line">
                                                              <input type="text" name="blogTitle" id="title" class="title_{{$blog->id}} form-control" value="{{$blog->title}}" required>
                                                          </div>
                                                      </div>

                                                      <div class="form-group form-float">
                                                          <h5>Select image(optional)</h5>
                                                          <input type="file" name="image">
                                                      </div>

                                                      <div class="form-group form-float">
                                                          <h5>Image title(optional)</h5>
                                                          <div class="form-line">
                                                              <input type="text" name="image_title" id="image_title" class="form-control" value="{{$blog->image_title}}">
                                                          </div>
                                                      </div>

                                                      <div class="form-group form-float mt-1">
                                                          <h5>Select Category *</h5>
                                                          <div class="form-line">
                                                              <select name="categoryId" class="category_{{$blog->id}} selectVal form-control show-tick" data-live-search="true" data-route="{{route('admin.blog.update',$blog->id)}}">
                                                                  @foreach($category as $cat)
                                                                      <option {{$blog->category->name==$cat->name?'selected':''}} value="{{$cat->id}}">{{$cat->name}}</option>
                                                                  @endforeach
                                                              </select>
                                                          </div>
                                                      </div>

                                                      <div class="mt-0 pt-0" >
                                                          <h5>Blog description *</h5>
                                                          <textarea class="body_{{$blog->id}}" id="tinymce" name="body">
                                                              {{$blog->body}}
                                                          </textarea>
                                                      </div>

                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button id="{{$sl}}" data-route="{{route('admin.blog.update',$blog->id)}}" data-id="{{$blog->id}}"  type="button" class="submitButton btn btn-primary">Save changes</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- end blog edit Modal -->
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assests/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <script src="{{asset('assests/backend/js/pages/tables/jquery-datatable.js')}}"></script>

    <script src="{{asset('assests/backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('assests/backend/plugins/tinymce')}}';
        });
    </script>

{{--    start blog delete section--}}
    <script>
        $(".blogDeleteClass").on('click', function () {
            if(!confirm('Are you sure?')) return false;
            var blogId = $(this).data('id');
            var token = $('input[name=_token]').val();
            var route = $(this).data('route');
            $.ajax({
                type:'DELETE',
                url:route,
                data:{
                    _token:token,
                },
                success:function (data) {
                    $("#delete_"+data).remove();
                }
            });
        });
    </script>
    {{--    end blog delete section--}}

{{--   start update blog section--}}
    <script>
        var catId=0;
        $(".selectVal").on('change', function () {
            catId = $(this).val();
        });

        $(".submitButton").on('click', function () {
            var id = $(this).data('id');
            var route = $(this).data('route');
            var token = $('input[name=_token]').val();
            var blogTitle = $(".title_"+id).val();
            var timyMceValue = tinymce.get();
            var cno = $(this).attr('id');
            var body = timyMceValue[cno].getContent();

            $.ajax({
                type:'PUT',
                url:route,
                data:{
                    _token:token,
                    catId:catId,
                    blogTitle:blogTitle,
                    blogBody:body,
                },
                success:function (data) {
                    $("#exampleModalCenter_"+id).modal('hide');
                    $(".showTitle_"+id).text(data.title);
                    $("#showUpdateMsg").append("<h4 class=\"text-white\"  style=\"text-align: center;background: indianred; width: 250px;margin: auto;padding: 10px 0px 10px 0px;\">" +
                        "Data successfully updated" +
                        "</h4>");
                }
            });
        })
    </script>
{{--   end update blog section--}}
@endpush
