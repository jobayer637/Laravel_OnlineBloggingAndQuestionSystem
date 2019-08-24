@extends('layouts.backend.app')

@section('title', 'question')

@push('css')

    <link href="{{asset('assests/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush

@section('content')

   <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
             <form name="BlogForm" action="{{route('admin.blog.store')}}" onsubmit="return ValidateMyForm()" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    ASK YOUR QUESTION
                                    <small>Blog/create</small>
                                </h2>

                            </div>
                            <div class="body">
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
                                        <div class="form-line">
                                            <input type="text" name="title" id="title" class="form-control" required>
                                            <label class="form-label">Blog Title</label>
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <input type="file" name="image">
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="image_title" id="image_title" class="form-control">
                                            <label class="form-label">Image Title optional</label>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-12">
                        <div class="card">
                            <div class="body">
                                <div class="clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                        <p>
                                            <b>Select Categories</b>
                                        </p>
                                        <select name="category" class="form-control show-tick" data-live-search="true">
                                            <option >Select a category</option>
                                            @foreach($category as $c=>$cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="body">
                                <div class="clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                                        <a href="{{route('admin.question.index')}}" class="btn btn-warning m-t-15 waves-effect">BACK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Blog description
                            </h2>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="body">

                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>

@endsection


@push('js')
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

    <script type="text/javascript">

      function ValidateMyForm(){
        var cat =  document.forms["BlogForm"]["category"];
        var bdy =  document.forms["BlogForm"]["body"];
        if (cat.selectedIndex < 1)
         {
             alert("Please select a category");
             cat.focus();
             return false;
         }
        if (bdy.value=="")
         {
             alert("Please write something in body");
             cat.focus();
             return false;
         }
      }
    </script>
@endpush
