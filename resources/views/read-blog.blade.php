@extends('layouts.frontend.dash')

@push('css')
<style media="screen">
.b_p_i{
  height:22px;
  width:22px;
  border-radius: 50%;
  margin-right: 4px;
}
</style>
@endpush

@section("welcome")
<h3 class="mb-4">
  <a class="text-light" style="font-weight: 900;">Add Question</a>
</h3>
 <h5>
   <a class="text-danger font-weight-bold" href="{{route('blog')}}">Blog</a> /
   <a  href="{{route('blogCats',[$read_blog->category->name,$read_blog->category_id])}}" class="text-danger font-weight-bold">{{$read_blog->category->name}}</a>/
   <a class="text-dark">{{$read_blog->title}}</a>
  </h5>
 <br>
@endsection

@section('content')
<!-- Main content -->
<div class="" style="background-color: #fff;">
    <div class="card rounded-0">
      <div class="card-body">
          <h3 class="text-secondary" style="font-weight:bold;">{{$read_blog->title}}</h3>
          @if($read_blog->image==NULL)
          @else
              <img src="http://127.0.0.1:8000/storage/blog/{{$read_blog->image}}" class="img-fluid w-100 card-img mb-2 rounded-0" alt="Responsive image">
          @endif
            <ul class="nav nav-pills card-header-pills border-bottom">
               <li class="nav-item">
                 <a class="nav-link" href="#">
                   @if($read_blog->user->avatar=="profile.jpg")
                   <img class="b_p_i" src="{{$read_blog->user->image}}" alt="Profile-image">
                   @else
                   <img class="b_p_i" src="{{$read_blog->user->avatar}}" alt="Profile-image">
                   @endif
                   Jobayer Hossain</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="fa fa-newspaper-o"></i> {{$read_blog->category->name}}</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="fa fa-calendar"></i>
                   <?php
                     $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $read_blog->created_at);
                     echo $dt->diffForHumans();
                    ?>
                </a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="fa fa-comments-o"></i> 0 Comment</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="fa fa-eye"></i> 8 Views</a>
               </li>
            </ul>

          <!-- <hr class="text-muted border border-secondary" > -->

          <p class="text-muted mt-2 text-justify" style="font-size:17px;">
          {!! html_entity_decode($read_blog->body) !!}
          </p>

      </div>
    </div>
</div>


<!-- Blog comment -->
<div class="mt-4 hide">
    <div class="card-header bg-white">
        <h3 class="text-secondary">Comment 4 || <a href="#lans">Leave a comment</a></h3>
    </div>

    @foreach($comment as $comnt)
    <div class="card-body shadow-sm mb-2 bg-white">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12">
								@if($comnt->user->avatar=="profile.jpg")
								<img src="http://127.0.0.1:8000/storage/profile/{{$comnt->user->image}}" height="50px" width="50px" style="border-radius:50%;">
								@else
								<img src="{{$comnt->user->avatar}}" height="50px" width="50px" style="border-radius:50%;">
								@endif
            </div>
            <div class="col-lg-11 col-md-11 col-sm-12">
               <div class="row">
                   <div class="col-lg-8 col-md-8 col-sm-6 col-6 mb-2">
                       <strong>
                         <p class="text-secondary mb-0 pb-0">
                        {{$comnt->user->name}}
                        </p>
                        <small class="mt-0 pt-0">{{$comnt->created_at}}</small>
                       </strong>
                   </div>
                   <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                       @if(Auth::check())
                       <button title="Reply" onclick="shhd({{$comnt->id}})" class="rbtn btn btn-sm btn-outline-primary float-right"><i class="fa fa-reply"></i></button>
                       @else
                       <button title="Reply" onclick="alert('Please Log in')" class="rbtn btn btn-sm btn-outline-primary float-right" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-reply"></i></button>
                       @endif

                       @if(Auth::check() && Auth::user()->id==$comnt->user_id)
                       <form action="{{route('delete',$comnt->id)}}" method="post">
                         @csrf
                         <!-- <input onclick="return confirm('dkjfkdjf');" type="submit" class="btn btn-outline-danger btn-sm float-left mr-1" value="Delete"> -->
                         <button title="Delete" onclick="return confirm('dkjfkdjf');"  class="btn btn-outline-danger btn-sm float-left" name="button"><i class="fa fa-trash-o"></i></button>
                       </form>
                        <button title="Edit" class="btn btn-sm btn-outline-info float-left ml-1"><i class="fa fa-edit"></i></button>
                       @endif
                   </div>
               </div>
                <p class="dom text-justify text-secondary">
                  {{$comnt->body}}
                </p>

                <div id="{{$comnt->id}}" class="raf mt-2 d-none">
                    <form name="replyAns" method="post" action="{{route('replyComment',[$comnt->id,$read_blog->id])}}" onsubmit="return replyAnswer()">
                        @csrf
                        <small class="text-success">Please briefly reply your answer</small>
                         <textarea id="tinymce" name="comment" class="form-control" rows="5" placeholder="Write your Proper comment and submit..." required></textarea>
                        <button onclick="cbtn({{$comnt->id}})" class="btn btn-sm btn-outline-primary">cancel</button>
                        <button class="btn btn-sm btn-outline-primary ml-1" type="submit">submit</button>
                    </form>
                 </div>
                <!--Reply answer ------- -->
                @foreach($reply_comment as $rep_comnt)
                @if($rep_comnt->comment_id==$comnt->id)
                <hr>
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12">
												@if($rep_comnt->user->avatar=="profile.jpg")
												<img src="http://127.0.0.1:8000/storage/profile/{{$rep_comnt->user->image}}" height="50px" width="50px" style="border-radius:50%;">
												@else
												<img src="{{$rep_comnt->user->avatar}}" height="50px" width="50px" style="border-radius:50%;">
												@endif
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-12">
                       <div class="row">
                       <div class="col-lg-8 col-md-8 col-sm-6 col-6 mb-2">
                           <strong>
                             <p class="text-secondary mb-0 pb-0">
                            {{$rep_comnt->user->name}}
                            </p>
                            <small class="mt-0 pt-0">{{$rep_comnt->created_at}}</small>
                           </strong>
                       </div>
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                           @if(Auth::check() && Auth::user()->id==$rep_comnt->user_id)
                           <form action="{{route('replyCommentDelete',$rep_comnt->id)}}" method="post">
                             @csrf
                             <!-- <input onclick="return confirm('dkjfkdjf');" type="submit" class="btn btn-outline-danger btn-sm float-left mr-1" value="Delete"> -->
                             <button title="Delete" onclick="return confirm('dkjfkdjf');"  class="btn btn-outline-danger btn-sm float-left" name="button"><i class="fa fa-trash-o"></i></button>
                           </form>
                            <button title="Edit" class="btn btn-sm btn-outline-info float-left ml-1"><i class="fa fa-edit"></i></button>
                           @endif
                       </div>
                   </div>
                    <div>
                       <p class="dom text-justify text-secondary">
                         {{$rep_comnt->body}}
                        </p>
                    </div>
                    </div>

                </div>
                @endif
                @endforeach
                <!--end of reply  answer ------- -->
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- comment section -->
<div class="mt-4" style="background-color: #fff;">
    <div class="card-header bg-white">
        <h3>Leave a comment</h3>
    </div>
    <div id="lans" class="card-body shadow-sm">
        @if(Auth::check())
            <p>Logged in as <strong class="text-muted">{{Auth::user()->name}}</strong></p>
            <form class="mt-2" name="formAnswer" action="{{route('comment', $read_blog->id)}}" method="post" onsubmit="return answerSubmit()">
            @csrf
               <textarea id="tinymce" name="comment" class="form-control" rows="5" placeholder="Write your Proper comment and submit..." required></textarea>
               <input class="btn btn-primary w-100 mt-1" type="submit" name="submit" value="Submit">
            </form>
        @else
        <span class=" navbar-toggler" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        @if(Auth::check())
        <small style="cursor:pointer;font-size:18px; font-weight:500;" class="text-white"><i class="fa fa-vcard-o" style="font-size:24px"></i> My Profile</small>
        @else
        <small style="cursor:pointer;" class="text-primary"><i class="fa fa-user"></i>Please  SIgn in</small>
        @endif
      </span>
        @endif
    </div>
</div>


@endsection

@push('jscript')
<!-- text editor -->
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
<!-- end text editor -->

<script type="text/javascript">
    function answerSubmit(){
        var cmntts = document.formAnswer.qanswer;
        if(cmntts.value==""){
            cmntts.classList.add("border-danger");
            return false;
        }
        else{
            cmntts.classList.remove("border-danger");
        }
    }
</script>

<script type="text/javascript">
    var rform = document.getElementsByClassName("raf");
    var rbt = document.getElementsByClassName("rbtn");
    var i;
    function shhd(v){
        for(i=0;i<rform.length;i++){
            if(v==rform[i].id){
                rform[i].classList.remove("d-none");
            }
            else{
                 rform[i].classList.add("d-none");
            }
        }
    }

    function cbtn(c){
        for(i=0;i<rform.length;i++){
            if(c==rform[i].id){
                rform[i].classList.add("d-none");
            }
        }
    }
</script>
@endpush
