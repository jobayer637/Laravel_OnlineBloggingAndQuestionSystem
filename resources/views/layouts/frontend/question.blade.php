<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>


    <!-- Bootstrap Core Css -->
    <link href="{{asset('assests/backend/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{asset('assests/backend/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('assests/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
    @stack('css')

</head>

<body class="theme-blue">


       <div class="row clearfix">
            <form name="myForm" class="was-validated" action="{{route('addquestion')}}" method="POST" onSubmit="return formSubmit()" enctype="myltipart/form-data">
           @csrf
               <div class="row">
                   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
                       <div class="card">
                           <div class="header">
                               <h2>
                                   ASK YOUR QUESTION
                                   <small>QUESTION/create</small>
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
                                           <input type="text" name="qtitle" id="category" class="form-control">
                                           <label class="form-label">Ask your Question</label>
                                       </div>
                                   </div>

                                   <div class="form-group form-float">
                                       <input type="file" name="image">
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
                                       <select name="category" class="form-control show-tick" data-live-search="true" multiple>
                                           <option value="0">Select a category</option>
                                           <option value="Java">Java</option>
                                           <option value="Python">Python</option>
                                           <option value="C/C++">C/C++</option>
                                           <option value="PHP">PHP</option>
                                           <option value="HTML/CSS">HTML/CSS</option>
                                           <option value="Wordpress">Wordpress</option>
                                           <option value="Design">Design</option>
                                           <option value="General">General</option>
                                       </select>
                                   </div>

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
                               Question description
                           </h2>
                       </div>
                       <div class="body">
                           <textarea id="tinymce" name="qbody">

                           </textarea>
                       </div>
                   </div>
               </div>
           </div>
           </form>
       </div>
       <!-- Vertical Layout | With Floating Label -->


<!-- Jquery Core Js -->
<script src="{{asset('assests/backend/plugins/jquery/jquery.min.js')}}"></script>
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


@stack('js')
</body>
</html>
