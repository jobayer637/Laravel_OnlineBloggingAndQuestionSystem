@extends('layouts.frontend.dash')

@section("welcome")
<h3 class="mb-4">
  <a class="text-light" style="font-weight: 900;">Add Question</a>
</h3>
 <h5> <span><a class="text-white" href="{{route('home')}}">Home</a></span> / <span class="text-dark">Add Question</span></h5>
 <br>
@endsection
@section('content')
<div class="bg-white shadow-sm">
  <div class="card-header bg-white">
    <h3 class="text-muted">Add your question</h3>
  </div>
  <div class="card-body">
    <form name="myForm" class="was-validated" action="{{route('addquestion')}}" method="POST" onSubmit="return formSubmit()" enctype="myltipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="question-title" class="col-lg-2 col-md-3 col-sm-12 col-12 col-form-label">Question *</label>
        <div class="form-group col-lg-10 col-md-9 col-sm-12 col-12">
          <input class="form-control" type="text" name="qtitle" placeholder="Eenter appropriate question">
          <small class="text-muted">Please choose an appropriate title for the question to answer it even easier .</small>
        </div>
      </div>

      <div class="form-group row">
        <label for="question-title" class="col-lg-2 col-md-3 col-sm-12 col-12 col-form-label">Category *</label>
        <div class="form-group col-lg-10 col-md-9 col-sm-12 col-12">
          <select name="category" class="form-control show-tick" data-live-search="true">
              <option value="0">Select a category</option>
              @foreach($types as $types)
                  <option value="{{$types->id}}">{{$types->name}}</option>
              @endforeach
          </select>
          <small>Please choose the appropriate section so easily search for your question .</small>
        </div>
      </div>

      <div class="form-group row">
        <label for="question-title" class="col-lg-2 col-md-3 col-sm-12 col-12 col-form-label">Image (optional)</label>
        <div class="col-lg-10 col-md-9 col-sm-12 col-12">
          <input type="file" name="image" class="" id="validatedCustomFile">
        </div>
      </div>

      <div class="form-group row">
        <label for="question-title" class="col-lg-2 col-md-3 col-sm-12 col-12 col-form-label">Question Description</label>
        <div class="form-group col-lg-10 col-md-9 col-sm-12 col-12">
          <textarea class="form-control" id="tinymce" name="qbody"></textarea>
          <small class="text-muted">Please choose an appropriate title for the question to answer it even easier .</small>
        </div>
      </div>

      <input class="btn btn-primary w-100" type="submit" value="Submit" name="button">

    </form>
  </div>
</div>
@endsection

@push('jscript')
<script src="{{asset('assests/backend/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assests/backend/plugins/tinymce/tinymce.js')}}"></script>
<script>
    $(function () {
        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 200,
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
  function formSubmit(){
    var ttl = document.myForm.qtitle;
    var cat = document.myForm.category;
    var qbody = document.myForm.qbody;
    if(ttl.value==""){
      ttl.classList.add("border-primary","bg-warning","text-primary");
      return false;
    }
    else{
      ttl.classList.remove("border-primary","bg-warning","text-primary");
    }
    if(cat.value==0){
      cat.classList.add("border-primary","bg-warning");
      return false;
    }
    else{
      cat.classList.remove("border-primary","bg-warning");
    }
    // if(qbody.value==""){
    //   qbody.placeholder="Please add your question body";
    //   qbody.classList.add("border-primary","bg-warning");
    //   return false;
    // }
    // else{
    //   qbody.classList.remove("border-primary","bg-warning");
    // }
  }
</script>

@endpush
