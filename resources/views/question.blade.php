@extends('layouts.frontend.dash')


@section("welcome")
<h3 class="mb-4">
	<a class="text-danger">{{$ques->title}}</a>
</h3>
 <h5> <span><a class="text-white" href="{{route('home')}}">Home</a></span> / <span><a class="text-white" href="#">{{$ques->category}}</a></span> / <span class="text-secondary">{{$ques->title}}</span></h5>
 <br>
@endsection

@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endpush

@section('content')

<div class="" style="background-color: #fff;">
    <div class="card-body shadow-lg border border-secondary">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h4 class="mb-1 text-secondary"><a class="text-dark" href=""><strong class="text-dark">Q.</strong> {{$ques->title}}</a>
            </h4>
            <p class="dom text-justify text-secondary">
                {!! html_entity_decode($ques->body) !!}
            </p>

            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <div id="previousLikeId">
                        @if(Auth::check())
                            @csrf
                            @if(!$userLike)
                                <a data-like="0" data-question="{{$ques->id}}" data-value="1" id="likeId"  class="nav-link"  style="cursor: pointer;"><i class="fa fa-thumbs-o-up" style="font-size:19px"></i> {{$like->count('id')}}</a>
                            @else
                                @if($userLike->question_id==$ques->id && $userLike->isLike==1)
                                    <a data-like="{{$userLike->id}}" data-question="{{$ques->id}}" data-value="0" id="likeId"  class="nav-link text-primary"  style="cursor: pointer;"><i class="fa fa-thumbs-up" style="font-size:19px"></i> {{$like->count('id')}}</a>
                                @else
                                    <a data-like="{{$userLike->id}}" data-question="{{$ques->id}}" data-value="1" id="likeId"  class="nav-link"  style="cursor: pointer;"><i class="fa fa-thumbs-o-up" style="font-size:19px"></i> {{$like->count('id')}}</a>
                                @endif
                            @endif
                        @else
                            <a id="pleaseSigninId"  class="nav-link"  style="cursor: pointer;"><i class="fa fa-thumbs-o-up" style="font-size:19px"></i> {{$like->count('id')}}</a>
                        @endif
                    </div>

                    <div id="toggleLikeId">
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-newspaper-o"></i> {{$ques->type->name}}</a>
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
@if($relques->count('id')>1)
    <div id="lans" class="mt-1 shadow " style="background-color: #fff;">
        <div class="card-header bg-white ml-2">
            <h5 class="text-muted">Latest Related Questions</h5>
        </div>
        <div class="card-body ml-2 mr-2">

            @foreach($relques as $key=>$rqs)
                @if($ques->id==$rqs->id)
                    @continue
                @else
                    <strong>{{$key}}. </strong> <a href="{{route('question',$rqs->id)}}">{{$rqs->title}}</a><br>
                @endif
            @endforeach
        </div>
    </div>
@endif
<!--End Related Question -->

<!-- Question Answer -->
<div class="mt-1 hide shadow-lg bg-white" >
    <div class="card-header bg-white shadow-sm mb-1 border border-secondary">
        <h5 class="text-secondary">Total Answer ({{$ans->count('id')}}) || <a href="#answerBtnId" class="text-info">Leave Answer</a></h5>
    </div>

    @foreach($ans as $vans)
    <div id="showAnswerDiv_{{$vans->id}}" class="card-body shadow-lg mb-1 bg-white border border-secondary">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12">
                @if($vans->user->avatar=="profile.jpg")
                    <img src="{{URL::to('storage/profile/'.$vans->user->image)}}" height="50px" width="50px" style="border-radius:50%;">
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
                            	if($vans->created_at!=$vans->updated_at){
                            	    $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $vans->updated_at);
		                            echo "updated ". $dt->diffForHumans();
                            	}else{
                            	    $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $vans->created_at);
		                            echo $dt->diffForHumans();
                            	}
                            ?>
                        </small>
                       </strong>
                   </div>
                   <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                       @if(Auth::check())
                       <button onclick="shhd({{$vans->id}})" class="rbtn btn btn-sm btn-outline-primary float-right"><i class="fa fa-reply"></i></button>
                       @else
                       <button id="pleaseSigninId" href="#topHeader" class="pleaseSigninClass rbtn btn btn-sm btn-outline-primary float-right" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-reply"></i></button>
                       @endif

                       @if(Auth::check() && Auth::user()->id==$vans->user_id)

                       <a data-value="{{$vans->body}}" data-id="{{$vans->id}}" class="editBtnClass btn btn-sm btn-outline-info float-right mr-1" href="#editForm"><i class="fa fa-edit"></i></a>
                       <button data-route="{{route('deleteAnswer',$vans->id)}}" class="deleteAnswerBtn btn btn-sm btn-outline-danger float-right mr-1"><i class="fa fa-trash-o"></i></button>
                            @csrf
                       @endif

                   </div>
               </div>

                <div id="answerBody">
                    <div id="previousBody_{{$vans->id}}">
                        <p id="getAnswer_{{$vans->id}}" class="dom text-justify text-secondary d-none">
		                  {!! html_entity_decode($vans->body) !!}
		                </p>
                    </div>
                    <div id="updateBody_{{$vans->id}}">
                    </div>
                </div>


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
                    <div id="showReplyAnsId_{{$reans->id}}">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-12">
                                @if($reans->user->avatar=="profile.jpg")
                                    <img src="{{URL::to('storage/profile/'.$reans->user->image)}}" height="50px" width="50px" style="border-radius:50%;">
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
                                            <button data-route="{{route('deleteReplyAnswer',$reans->id)}}" class="deleteReplyAnswerBtn btn btn-sm btn-outline-danger float-right"><i class="fa fa-trash-o"></i></button>
                                            @csrf
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="dom text-justify text-secondary">
                                        {!! html_entity_decode($reans->body) !!}
                                    </div>
                                </div>
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

<div id="editForm" class="card mt-3" style="background-color: #fff; display:none;">
	<div class="card-header text-danger">
		<h3>Edit Answer</h3>
	</div>
	<div class="card-body">
		@csrf
		<textarea id="tinymce" name="qanswer" class="form-control" rows="5" ></textarea>
		<a id="editSubmitBtn" data-route="{{route('editAnswer')}}" href="" class="btn btn-outline-primary btn-sm mt-1">Save Change</a>
		<a id="cancleBtn" class="btn btn-outline-info btn-sm mt-1" href="">Cancel</a>
		<a id="leaveAnsId"  class="btn btn-outline-info btn-sm mt-1" href="#answerBtnId">Leave an Answer</a>
	</div>
</div>

<!-- Answer section -->
<div id="answerBtnId" class="mt-1" style="background-color: #fff;">
    <div class="card-header bg-white">
        <h5>Leave your answer</h5>
    </div>
    <div id="lans" class="card-body shadow-sm">
        @if(Auth::check())
            <p>Logged in as <strong class="text-muted">
                    @if(Auth::user()->avatar=="profile.jpg")
                        <img class="ml-4 pl-0" src="{{URL::to('storage/profile/'.Auth::user()->image)}}" height="20px" width="20px" style="border-radius:50%;">
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
        <a id="pleaseSigninId" href="#topHeader" style="cursor:pointer;" class="text-primary"><i class="fa fa-user"></i>Please  SIgn in</a>
      </span>
        @endif
    </div>
</div>
<!-- End Comment section -->

    <div id="qmodel"></div>

@endsection

@push('jscript')
{{--    start like unlike section--}}
<script>
    $("#likeId").on('click', function () {
        changeLike();
    });

    function changeLike() {
        var likeValue = $("#likeId").data('value');
        var questionId = $("#likeId").data('question');
        var likeId = $("#likeId").data('like');
        var route ="{{route('likeUnlike')}}";
        var token = $('input[name=_token]').val();
        $.ajax({
            type:'post',
            url:route,
            data:{
                _token:token,
                likeValue:likeValue,
                questionId:questionId,
                likeId:likeId,
            },
            success: function (data) {
                $("#previousLikeId").remove();
                $("#toggleLikeId").empty();
                $("#toggleLikeId").append(data);
            }
        });
    }
</script>
{{--    end like unlike section--}}
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

{{--start delete answer part--}}
<script>
    $(".deleteAnswerBtn").on('click', function () {
        if(!confirm('Are you sure?')) return false;
        var route = $(this).data('route');
        var token = $('input[name=_token]').val();
        $.ajax({
            url:route,
            type:'post',
            data:{
                _token:token,
            },
            success:function (data) {
                $("#showAnswerDiv_"+data).remove();
            }
        })
    });
</script>
{{--end delete answer part--}}

<!-- start edit answer part -->
<script type="text/javascript">
	$(document).ready(function(){
		var getAnswerId;
		$(".editBtnClass").on('click', function(){
			var ansValue = $(this).data('value');
			getAnswerId = $(this).data('id');
			var editTinyMce = tinymce.get();
			editTinyMce[0].setContent(ansValue)
			$("#answerBtnId").addClass('d-none');
			$("#answerBtnId").removeClass('d-block');
			$("#editForm").addClass('d-block');
			$("#cancleBtn").attr('href','#showAnswerDiv_'+getAnswerId);
			$("#editSubmitBtn").attr('href','#showAnswerDiv_'+getAnswerId);
		});

		$("#leaveAnsId, #cancleBtn").on('click', function(){
			$("#answerBtnId").addClass('d-block');
			$("#editForm").removeClass('d-block');
		});

		$("#editSubmitBtn").on('click', function(){
			var route = $(this).data('route');
			var token = $('input[name=_token]').val();
			var editMce = tinymce.get();
			var editValue = editMce[0].getContent();
			$.ajax({
				type:'post',
				url:route,
				data:{
					_token:token,
					id:getAnswerId,
					editValue: editValue,
				},
				success:function(data){
					$("#answerBtnId").addClass('d-block');
					$("#editForm").removeClass('d-block');
					$("#previousBody_"+getAnswerId).remove();
					$("#updateBody_"+getAnswerId).text('');
					$("#updateBody_"+getAnswerId).append(data.body);
				},
			});
		});
	});
</script>
<!-- end edit answer part -->

{{--    start delete reply answer section--}}
<script>
    $(".deleteReplyAnswerBtn").on('click', function () {
        if(!confirm('Are you sure?')) return false;
        var route = $(this).data('route');
        var token = $('input[name=_token]').val();
        $.ajax({
            type:'post',
            url:route,
            data:{
                _token:token,
            },
            success:function (data) {
                $("#showReplyAnsId_"+data).remove();
            }
        })
    })
</script>
{{--    end delete reply answer section--}}

@endpush
