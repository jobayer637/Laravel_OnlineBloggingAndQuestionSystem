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
   <br><hr>
   <small id="copyMsg" class="text-warning d-none">copied current blog url</small>
   <input title="copy current blog url" class="form-control btn rounded-0" readonly id="copyUrl" type="text" value="{{Request::url()}}">
  </h5>
 <br>
@endsection

@section('content')
@if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="alert alert-warning text-danger border-danger alert-dismissible fade show" role="alert">
    <strong class="">Opps! </strong> {{$error}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endforeach
@endif
<!-- Main content -->
<div class="" style="background-color: #fff;">
    <div class="card rounded-0">
      <div class="card-body">
          <h3 class="text-secondary" style="font-weight:bold;">{{$read_blog->title}}</h3>
          @if($read_blog->image==NULL)
          @else
              <img src="{{URL::to('storage/blog/'.$read_blog->image)}}" class="img-fluid w-100 card-img mb-2 rounded-0" alt="Responsive image">
          @endif
            <ul class="nav nav-pills card-header-pills border-bottom">
               <li class="nav-item">
                 <a class="nav-link" href="#">
                   @if($read_blog->user->avatar=="profile.jpg")
                   <img class="b_p_i" src="{{URL::to('storage/profile/'.$read_blog->user->image)}}" alt="Profile-image">
                   @else
                   <img class="b_p_i" src="{{$read_blog->user->avatar}}" alt="Profile-image">
                   @endif
                   Jobayer Hossain</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="{{route('blogCats',[$read_blog->category->name,$read_blog->category_id])}}"><i class="fa fa-newspaper-o"></i> {{$read_blog->category->name}}</a>
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
                 <a class="nav-link" href="#"><i class="fa fa-comments-o"></i> {{$read_blog->comments->count()}} Comment</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="fa fa-eye"></i> {{$read_blog->view}} Views</a>
               </li>
               <li class="mt-2">
                 <?php $url = Request::url(); ?>
                 <?php echo '<iframe src="https://www.facebook.com/plugins/share_button.php?href='.$url.'&layout=button_count&size=small&appId=2570270953200939&width=69&height=20" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>'; ?>

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
        <h3 class="text-secondary">Comment {{$read_blog->comments->count()}} || <a href="#lans">Leave a comment</a></h3>
    </div>

    @foreach($comment as $comnt)
    <div id="deleteCommentId_{{$comnt->id}}">
      <div  class="card-body shadow-sm mb-1 bg-white">
          <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-12">
                  @if($comnt->user->avatar=="profile.jpg")
                  <img src="{{URL::to('storage/profile/'.$comnt->user->image)}}" height="50px" width="50px" style="border-radius:50%;">
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
                          <small class="mt-0 pt-0">
                            <?php
                              if($comnt->created_at!=$comnt->updated_at){
                                $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comnt->updated_at);
                                echo "updated ".$dt->diffForHumans();
                              }
                              else{
                                $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comnt->created_at);
                                echo $dt->diffForHumans();
                              }
                             ?>
                          </small>
                         </strong>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                         @if(Auth::check())
                         <button title="Reply" value="{{$comnt->id}}"  data-id="replyCommentBtnId_{{$comnt->id}}" class="replyCommentBtnClass btn btn-sm btn-outline-primary float-right"><i class="fa fa-reply"></i></button>
                         @else
                         <a title="Reply" class="pleaseSigninClass rbtn btn btn-sm btn-outline-primary float-right" id="pleaseSigninId" href="#topHeader"><i class="fa fa-reply"></i></a>
                         @endif

                         @if(Auth::check() && Auth::user()->id==$comnt->user_id)
                         <!-- <form action="{{route('delete',$comnt->id)}}" method="post"> -->
                           @csrf
                           <button title="Delete" data-id="{{$comnt->id}}" data-route="{{route('delete',$comnt->id)}}"  class="deleteBtnClass btn btn-outline-danger btn-sm float-right mr-1"><i class="fa fa-trash-o"></i></button>
                         <!-- </form> -->
                          <button  title="Edit" value="{{$comnt->id}}"  data-id="editCommentBtnId_{{$comnt->id}}" class="editCommentBtnClass btn btn-sm btn-outline-info float-right mr-1"><i class="fa fa-edit"></i></button>
                         @endif
                     </div>
                 </div>

                  <div class="commentSection">
                    <div id="showCommentField_{{$comnt->id}}" class="viewComment">
                      <p class="text-justify text-secondary">
                        {!! html_entity_decode($comnt->body) !!}
                      </p>
                    </div>
                    <!-- edit comment form -->
                    <div id="editCommentFormId_{{$comnt->id}}" class="editComment" style="display:none">
                      <form name="replyComntForm" method="post" action="{{route('editComment',[$comnt->id,$read_blog->id])}}" onsubmit="return replyComment()">
                          @csrf
                           <textarea id="tinymce" name="comment" class="form-control mb-1 replyComment" rows="3">{{$comnt->body}}</textarea>
                          <button  type="button" value="{{$comnt->id}}"  class="cancelCommentFormBtnClass btn btn-sm btn-outline-primary mt-1 mb-1">cancel</button>
                          <button  class="btn btn-sm btn-outline-primary ml-1 mt-1 mb-1" type="submit">submit</button>
                      </form>
                    </div>
                  </div>

                  <div id="replyCommentFormId_{{$comnt->id}}" class="raf mt-2" style="display:none;">
                      <form name="replyComntForm" method="post" action="{{route('replyComment',[$comnt->id,$read_blog->id])}}" onsubmit="return replyComment()">
                          @csrf
                          <small class="text-success">Please briefly reply your answer</small>
                           <textarea id="tinymce" name="replyComnt" class="form-control mb-1 replyComment" rows="3" placeholder="Write your Proper comment and submit..."></textarea>
                          <button  type="button" value="{{$comnt->id}}"  class="cancelCommentFormBtnClass btn btn-sm btn-outline-primary mt-1 mb-1">cancel</button>
                          <button class="btn btn-sm btn-outline-primary ml-1 mt-1 mb-1" type="submit">submit</button>
                      </form>
                   </div>

                  <!--Reply answer ------- -->
                  @foreach($reply_comment as $rep_comnt)
                  @if($rep_comnt->comment_id==$comnt->id)
                  <hr>
                  <div class="row">
                      <div class="col-lg-1 col-md-1 col-sm-12">
                          @if($rep_comnt->user->avatar=="profile.jpg")
                          <img src="{{URL::to('storage/profile/'.$rep_comnt->user->image)}}" height="50px" width="50px" style="border-radius:50%;">
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
                              <small class="mt-0 pt-0">
                                <?php
                                  if($rep_comnt->created_at!=$rep_comnt->updated_at){
                                    $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rep_comnt->updated_at);
                                    echo "updated ".$dt->diffForHumans();
                                  }
                                  else{
                                    $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rep_comnt->created_at);
                                    echo $dt->diffForHumans();
                                  }
                                 ?>
                              </small>
                             </strong>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                             @if(Auth::check() && Auth::user()->id==$rep_comnt->user_id)
                             <form action="{{route('replyCommentDelete',$rep_comnt->id)}}" method="post">
                               @csrf
                               <!-- <input onclick="return confirm('dkjfkdjf');" type="submit" class="btn btn-outline-danger btn-sm float-left mr-1" value="Delete"> -->
                               <button title="Delete" onclick="return confirm('Are you sure you`d like to delete this comment?');"  class="btn btn-outline-danger btn-sm float-right" name="button"><i class="fa fa-trash-o"></i></button>
                             </form>
                              <button onclick="repComntEditBtn({{$rep_comnt->id}})" title="Edit" class="btn btn-sm btn-outline-info float-right mr-1"><i class="fa fa-edit"></i></button>
                             @endif
                         </div>
                     </div>
                      <div>
                          <div id="rc_{{$rep_comnt->id}}" class="">
                              <p class="text-justify text-secondary">
                                {!! html_entity_decode($rep_comnt->body) !!}
                              </p>
                          </div>
                         <p class="dom text-justify text-secondary">
                           <!-- reply comment edit form -->
                           <form id="rcd_{{$rep_comnt->id}}" style="display:none"  name="replyAns_edit" method="post" action="{{route('replyCommentEdit',[$read_blog->id,$comnt->id,$rep_comnt->id])}}" onsubmit="return replyAnswer_edit()">
                               @csrf
                                <textarea id="tinymce" name="repComnt" class="form-control mb-1" rows="4" placeholder="Write your Proper comment and submit..." required>{{$rep_comnt->body}}</textarea>
                               <button onclick="repComntEditBtn({{$rep_comnt->id}})" type="button" class="btn btn-sm btn-outline-primary mt-1 mb-1">cancel</button>
                               <input class="btn btn-sm btn-outline-primary ml-1 mt-1 mb-1" type="submit">
                           </form>
                          </p>
                      </div>
                      </div>

                  </div>
                  @endif
                  @endforeach
                  <!--end of reply  answer --------->
              </div>
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
            <p>Logged in as <strong class="text-muted">
              @if(Auth::user()->avatar=="profile.jpg")
							<img class="ml-4 pl-0" src="{{URL::to('storage/profile/'.Auth::user()->image)}}" height="20px" width="20px" style="border-radius:50%;">
							@else
							<img class="ml-4 pl-0" src="{{Auth::user()->avatar}}" height="20px" width="20px" style="border-radius:50%;">
							@endif
              {{Auth::user()->name}}
            </strong></p>
            <div id="showMyComnt">

            </div>
            <!-- <form class="mt-2" name="formAnswer" action="{{route('comment', $read_blog->id)}}" method="post" onsubmit="return answerSubmit()"> -->
               <div id="commentDivId">
                 @csrf
                 <textarea id="tinymce" name="blogComment" rows="5" placeholder="Write your Proper answer and submit..."></textarea>
                 <input type="submit" id="submitCommentBtnId" class="btn btn-primary w-100 mt-1" data-route="{{route('comment', $read_blog->id)}}" value="Submit">
               </div>
            <!-- </form> -->
        @else
        <span class=" navbar-toggler">
        <a id="pleaseSigninId" href="#topHeader" style="cursor:pointer;" class="text-primary"><i class="fa fa-user"></i>Please  SIgn in</a>
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
<!-- end text editor -->

<!-- start blog comment area -->
<script type="text/javascript">
$("#submitCommentBtnId").on('click', function(){
  var commentValue = tinyMCE.get('tinymce').getContent();
  var token = $('input[name=_token]').val();
  var route = $(this).data('route');
  $.ajax({
    type: 'post',
    url: route,
    data:{
      _token:token,
      commentValue:commentValue,
    },
    success: function(data){
      $("#showMyComnt").html(data);
    },
  });
});
</script>
<!-- end blog comment area -->

<!-- start comment Delete -->
<script type="text/javascript">
  $(".deleteBtnClass").on('click', function(){
    if(!confirm('are you sure?')) return false;
      var cmntDeleteId = $(this).data('id');
      var route = $(this).data('route');
      var token = $('input[name=_token]').val();
      var cmntId = "deleteCommentId_"+cmntDeleteId;
      $.ajax({
        type:'post',
        url:route,
        data:{
          _token:token,
        },
        success:function(data){
          $("#"+cmntId).hide();
        },
      });
  });
</script>
<!-- end comment Delete -->

<!-- start reply comment -->
<script type="text/javascript">
  $(".replyCommentBtnClass").on('click', function(){
  var repComntId = $(this).val();
    $("#replyCommentFormId_"+repComntId).slideToggle(10);
    $("#editCommentFormId_"+repComntId).slideUp(10);
    $("#showCommentField_"+repComntId).slideDown(10);
  });
  $(".cancelCommentFormBtnClass").on('click', function(){
  var repComntId = $(this).val();
    $("#replyCommentFormId_"+repComntId).slideUp(10);
    $("#editCommentFormId_"+repComntId).slideUp(10);
    $("#showCommentField_"+repComntId).slideDown(10);
  });
  $(".cancelCommentFormBtn").on('click', function(){
  var repComntId = $(this).val();
    $("#replyCommentFormId_"+repComntId).slideUp(10);
    $("#editCommentFormId_"+repComntId).slideUp(10);
    $("#showCommentField_"+repComntId).slideDown(10);
  });
</script>
<!-- end reply comment -->

<!-- start edit comment -->
<script type="text/javascript">
  $(".editCommentBtnClass").on('click', function(){
  var editComntBtnId = $(this).val();
    $("#editCommentFormId_"+editComntBtnId).slideToggle(10);
    $("#showCommentField_"+editComntBtnId).slideToggle(10);
    $("#replyCommentFormId_"+editComntBtnId).slideUp(10);
  });

</script>
<!-- end edit comment -->

<!-- start edit reply comment -->
<script type="text/javascript">
  function repComntEditBtn(rci){
    var rcd ="rcd_"+rci;
    if(document.getElementById("rcd_"+rci).id==rcd){
      $( "#rcd_"+rci ).slideToggle( "slow");
      $( "#rc_"+rci ).slideToggle( "slow" );
    }
  }
</script>
<!-- end edit reply comment -->

<!-- start copy current blog url -->
<script type="text/javascript">
  $("#copyUrl").on('click', function(){
    $("#copyUrl").select();
    document.execCommand("copy");
    $("#copyMsg").removeClass('d-none');
  });
</script>
<!-- end copy current blog url -->
@endpush
