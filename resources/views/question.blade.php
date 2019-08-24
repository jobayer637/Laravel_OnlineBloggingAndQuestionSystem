@extends('layouts.frontend.dash')


@section("welcome")
<h3 class="mb-4">
	<a class="text-danger">{{$ques->title}}</a>
</h3>
 <h5> <span><a class="text-white" href="{{route('home')}}">Home</a></span> / <span><a class="text-white" href="#">{{$ques->category}}</a></span> / <span class="text-secondary">{{$ques->title}}</span></h5>
 <br>
@endsection

@section('content')
<div class="" style="background-color: #fff;">
    <div class="card-body shadow-sm">
        <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="mb-4 text-secondary">
                <a class="text-secondary" href="">{{$ques->title}}</a>
                </h3>
                <p class="dom text-justify text-secondary">
                  {!! html_entity_decode($ques->body) !!}
                </p>
                <hr>
								<ul class="nav nav-pills card-header-pills border-bottom">
									 <li class="nav-item">
										 <a class="nav-link" href="#"><i class="fa fa-thumbs-o-up"></i> 0</a>
									 </li>
									 <li class="nav-item">
										 <a class="nav-link" href="#"><i class="fa fa-newspaper-o"></i> {{$ques->category}}</a>
									 </li>
									 <li class="nav-item">
										 <a class="nav-link" href="#"><i class="fa fa-calendar"></i>
											 <?php
												 $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ques->created_at);
												 echo $dt->diffForHumans();
												?>
										 </a>
									 </li>
									 <li class="nav-item">
										 <a class="nav-link" href="#"><i class="fa fa-comments-o"></i>{{$ans->count('id')}} Answer</a>
									 </li>
									 <li class="nav-item">
										 <a class="nav-link" href="#"><i class="fa fa-eye"></i> {{$ques->view}} Views</a>
									 </li>
								</ul>
            </div>
    </div>
</div>

<!--Start Related Question -->
<!-- <div id="lans" class="mt-4" style="background-color: #fff;">
    <div class="card-header bg-white ml-2">
        <h3 class="text-muted">Related Question</h3>
    </div>
    <div class="card-body ml-2 mr-2">
       @foreach($relques as $rqs)
      <?php if(strcmp($rqs->title, $ques->title) == 0){continue;}
      else{ ?>
         >> <a href="{{route('question',$rqs->id)}}">{{$rqs->title}}</a><br>
        <?php } ?>
       @endforeach
    </div>
</div> -->
<!--End Related Question -->

<!-- Question Answer -->
<div class="mt-2 hide">
    <div class="card-header bg-white">
        <h3 class="text-secondary">Answer ({{$ans->count('id')}}) || <a href="#lans">Leave Answer</a></h3>
    </div>

    @foreach($ans as $vans)
    <div class="card-body shadow-sm mb-1 bg-white">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12">
								@if($vans->user->avatar=="profile.jpg")
								<img src="http://127.0.0.1:8000/storage/profile/{{$vans->user->image}}" height="50px" width="50px" style="border-radius:50%;">
								@else
								<img src="{{$vans->user->avatar}}" height="50px" width="50px" style="border-radius:50%;">
								@endif
            </div>
            <div class="col-lg-11 col-md-11 col-sm-12">
               <div class="row">
                   <div class="col-lg-8 col-md-8 col-sm-6 col-6 mb-2">
                       <strong>
                         <p class="text-secondary mb-0 pb-0">
                        {{$vans->user->name}}
                        </p>
                        <small class="mt-0 pt-0">
													<?php
														$dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $vans->created_at);
														echo $dt->diffForHumans();
													 ?>
												</small>
                       </strong>
                   </div>
                   <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                       @if(Auth::check())
                       <button onclick="shhd({{$vans->id}})" class="rbtn btn btn-sm btn-outline-primary float-right">Reply</button>
                       @else
                       <button onclick="alert('Please Log in')" class="rbtn btn btn-sm btn-outline-primary float-right" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">Reply</button>
                       @endif

                       @if(Auth::check() && Auth::user()->id==$vans->user_id)

                       <button class="btn btn-sm btn-outline-warning">Edit</button>
                       <button class="btn btn-sm btn-outline-warning">Delete</button>

                       @endif

                   </div>
               </div>
                <p class="dom text-justify text-secondary">
                  {!! html_entity_decode($vans->body) !!}
                </p>

                <div id="{{$vans->id}}" class="raf mt-2 d-none">
                    <form name="replyAns" method="post" action="{{route('replyans',$vans->id)}}" onsubmit="return replyAnswer()">
                        @csrf
                        <small class="text-success">Please briefly reply your answer</small>
                        <input class="d-none" type="text" name="qu_id" value="{{$ques->id}}">
                        <textarea  rows="3" name="reans" class="form-control" placeholder="Write your commetn & press Enter to  submit" required></textarea>
                        <button onclick="cbtn({{$vans->id}})" class="btn btn-sm btn-outline-primary mt-1">cancel</button>
                        <button class="btn btn-sm btn-outline-primary ml-1 mt-1" type="submit">submit</button>
                    </form>
                 </div>
                <!--Reply answer ------- -->
                @foreach($repans as $reans)
                @if($reans->ans_id==$vans->id)
                <hr>
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12">
												@if($reans->user->avatar=="profile.jpg")
												<img src="http://127.0.0.1:8000/storage/profile/{{$reans->user->image}}" height="50px" width="50px" style="border-radius:50%;">
												@else
												<img src="{{$reans->user->avatar}}" height="50px" width="50px" style="border-radius:50%;">
												@endif
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-12">
                       <div class="row">
                       <div class="col-lg-8 col-md-8 col-sm-6 col-6 mb-2">
                           <strong>
                             <p class="text-secondary mb-0 pb-0">
                            {{$reans->user->name}}
                            </p>
                            <small class="mt-0 pt-0">
															<?php
																$dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $reans->created_at);
																echo $dt->diffForHumans();
															 ?>
														</small>
                           </strong>
                       </div>
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                           @if(Auth::check() && Auth::user()->id==$reans->user_id)
                           <button class="btn btn-sm btn-outline-warning float-right ml-1">Edit</button>
                           <button class="btn btn-sm btn-outline-warning float-right">Delete</button>
                           @endif
                       </div>
                   </div>
                    <div>
                       <p class="dom text-justify text-secondary">
												 {!! html_entity_decode($reans->body) !!}
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

<!-- Comment section -->
<div class="mt-1" style="background-color: #fff;">
    <div class="card-header bg-white">
        <h3>Leave an answer</h3>
    </div>
    <div id="lans" class="card-body shadow-sm">
        @if(Auth::check())
            <p>Logged in as <strong class="text-muted">
							@if(Auth::user()->avatar=="profile.jpg")
							<img class="ml-4 pl-0" src="storage/profile/{{Auth::user()->image}}" height="20px" width="20px" style="border-radius:50%;">
							@else
							<img class="ml-4 pl-0" src="{{Auth::user()->avatar}}" height="20px" width="20px" style="border-radius:50%;">
							@endif
							{{Auth::user()->name}}</strong></p>
            <form class="mt-2" name="formAnswer" action="{{route('questionans', $ques->id)}}" method="post" onsubmit="return answerSubmit()">
            @csrf
               <textarea id="tinymce" name="qanswer" class="form-control" rows="5" placeholder="Write your Proper answer and submit..."></textarea>
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
<!-- End Comment section -->

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
