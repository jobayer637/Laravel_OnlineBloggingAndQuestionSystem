@extends('layouts.frontend.dash')
@section('title','Ask-anything/home')
@section("welcome")
    <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <form id="myFormId" method="post" action="{{route('searchQuestionByType')}}">
                    @csrf
                    <select name="type" id="inputState" class="form-control  rounded-0">
                        <option value="0" selected>Search by Question Types</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12 col-12">

        </div>
    </div>
@endsection

@section('content')
    <!-- Data search section -->
    <div class="card rounded-0">
        <div class="card-header p-0 m-0 bg-white">
            <div class="input-group ">
                <input id="searchQuestionId" type="text" class="form-control rounded-0" placeholder="Search here...">
            </div>
        </div>
        <ul id="showSearchValue" class="list-group list-group-flush">
            <!-- search data show here -->
        </ul>
    </div>
    <br>
    <!-- start Priority and content section -->
    <div class="mt-4" >
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @foreach($ques as $value)
                    <div class="mt-1" style="background-color: #fff;">
                        <div class="card-body shadow-sm">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="mb-4">

                                    <button class="mb-3 mr-4 btn rounded-0 p-0 pr-1 pl-1">{{$value->type->name}}</button>

                                    <button class="mb-3 btn bg-white rounded-0 p-0 pr-1 pl-1">
                                        <?php
                                        $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at);
                                        echo $dt->diffForHumans();
                                        ?>
                                    </button>

                                    <h4 class="mb-0 pb-0 text-secondary">
                                        <a class="text-dark mb-0 pb-0" href="{{route('question',$value->id)}}">{{$value->title}}</a>
                                    </h4>

                                </div>

                                <div data-value="{{$value->body}}" class="bodyLimit">
                                    <!-- question description -->
                                </div>

                                <span class="mr-3">
                          @if($value->user->avatar=="profile.jpg")
                                        <img class="ml-0 pl-0" src="storage/profile/{{$value->user->image}}" height="20px" width="20px" style="border-radius:50%;">
                                    @else
                                        <img class="ml-0 pl-0" src="{{$value->user->avatar}}" height="20px" width="20px" style="border-radius:50%;">
                                    @endif
                                    {{$value->user->name}}
                        </span>
                                <span class="mr-3">Answer {{$value->answers->count()}}</span>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            </div>

        </div>
    </div>
    <!-- end Priority and content section -->

    <!-- start pagination section -->
    <div class="mt-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item {{$ques->onFirstPage()?'disabled':''}}">
                    <a class="page-link" href="{{$ques->previousPageUrl()}}">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="">{{$ques->currentPage()}}</a></li>
                <li class="page-item {{$ques->hasMorePages()?'':'disabled'}}">
                    <a class="page-link" href="{{$ques->nextPageUrl()}}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- end pagination section -->

@endsection

@push('jscript')
    <!-- start search question part -->
    <script type="text/javascript">
        $("#inputState").on('change', function () {
            $("#myFormId").submit();
        });
        var typeId=0;
        $("#searchQuestionId").on('keyup', function(){
            $.ajax({
                type:'get',
                url:"{{route('searchQuestion')}}",
                data:{
                    value:$(this).val(),
                    id:typeId,
                },
                success:function(data){$("#showSearchValue").html(data)}
            });
        });
    </script>
    <!-- End search question part -->

    <!-- start subsribe &  unSubscribe part -->
    <script type="text/javascript">
        $("#subscribeBtn").on('click', function(){
            subscribe();
        });
        function userSubscribe(){
            subscribe();
        }
        function subscribe(){
            var subscriberEmail = $("#subscriberId").val();
            var token = $('input[name=_token]').val();
            if(subscriberEmail==''){
                alert("please enter your email");
            }else{
                $.ajax({
                    type: 'post',
                    url: "{{route('addSubscriber')}}",
                    data:{
                        _token:token,
                        email:subscriberEmail,
                    },
                    success:function(data){
                        $("#jobayer").html(data);
                    }
                });
            }
        }

        $("#unSubscribeId").on('click', function(){
            if (!confirm('Are you sure?')) return false;
            unSubscribe();
        });
        function userUnsubscribe(){
            if (!confirm('Are you sure?')) return false;
            unSubscribe();
        }
        function unSubscribe(){
            var token = $('input[name=_token]').val();
            $.ajax({
                type: 'post',
                url: "{{route('unSubscribe')}}",
                data:{
                    _token:token,
                },
                success:function(data){
                    $("#jobayer").html(data);
                }
            })
        }
    </script>
    <!-- End subsribe &  unSubscribe part -->

    <script type="text/javascript">
        $(".bodyLimit").each(function(){
            var val = $(this).data('value');
            if(val.length==0){
            }else{
                if(val.length > 200) val = val.substring(0,200);
                $(this).append(val+"....")
            }
        })
    </script>
@endpush
