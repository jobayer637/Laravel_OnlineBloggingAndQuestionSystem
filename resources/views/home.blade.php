@extends('layouts.frontend.dash')
@section('title','Ask-anything/home')
@section("welcome")
 <div class="row">
            <div class="col-lg-4 pr-4">
                <h2 class="text-white mb-4">
                    Welcome to Ask Me Anything
                </h2>
                <p class="pr-4 text-white">Ask us anything anout thchnology! We'll try to give you comprehensive answers and provide as much help as we can. Our goal is to make this site helpful for students who are interested in programming, problem-solving,projects, and basically anything tech-related.</p>

                @if(Auth::check())
                <a href="{{route('askquestion')}}" class="btn btn-dark float-left mb-2">Ask question</a>
                @else
                <a style="cursor: pointer;" class="btn btn-dark float-left text-white mb-2" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">ASK-QUESTION</a>
                @endif

            </div>
            <div class="col-lg-8 col-md-8">
              <img class="shadow-sm" src="http://localhost:8000/storage/images/login_page/welcome.jpg" alt="" height="100%" width="100%" style="max-height:400px;">
            </div>
        </div>
@endsection

@section('content')
  <!-- start Priority and content section -->
  <div class="mt-2">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active pl-4 pr-4 text-secondary" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Question</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pl-4 pr-4 text-secondary" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Answered question</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pl-4 pr-4 text-secondary" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Unanswered question</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">

      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @foreach($ques as $value)
        <div class="mt-1" style="background-color: #fff;">
            <div class="card-body shadow-sm">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="mb-4">
                          <button class="mb-3 mr-4 btn rounded-0 p-0 pr-1 pl-1">{{$value->category}}</button>
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
                        <p class="dom text-justify text-secondary" style="font-size:17px;">
                          {{$value->body}}
                        </p>

                        <span class="mr-3">
                          @if($value->user->avatar=="profile.jpg")
                          <img class="ml-0 pl-0" src="storage/profile/{{$value->user->image}}" height="20px" width="20px" style="border-radius:50%;">
                          @else
                          <img class="ml-0 pl-0" src="{{$value->user->avatar}}" height="20px" width="20px" style="border-radius:50%;">
                          @endif
                          {{$value->user->name}}
                        </span>
                        <span class="mr-3">Answer-2</span>
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
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- end pagination section -->

  @push('jscript')
  <script type="text/javascript">
    var cp = document.getElementsByClassName("dom");
    var cpl = cp.length;
    var i,j;

    for(i=0;i<cpl;i++){
      var sp = cp[i].innerHTML;
      var l = sp.length;

      cp[i].innerHTML =" ";
      for(j=0;j<l;j++){
        cp[i].innerHTML += sp[j];
        if(j==200){
          cp[i].innerHTML += ".....";
          break;
        }
      }
    }
  </script>
  @endpush
@endsection
