<div class="container-fluid" style="background-color: #2f3239;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark pt-4 pb-4" style="background-color: #2f3239;">
          <a class="navbar-brand" href="{{route('index')}}">ASK ANYTHING</a>
          <button id="toggleNavBarId" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item">
                <a class="nav-link {{Request::path()=='home'?'active border-bottom':''}} {{Request::path()=='/'?'active border-bottom':''}} {{Request::is('question/*')?'active border-bottom':''}}" href="{{route('home')}}">HOME</a>
              </li>

              <li class="nav-item {{Request::path()=='add-question'?'active border-bottom':''}}">
                @if(Auth::check())
                <a class="nav-link" href="{{route('askquestion')}}">ASK-QUESTION</a>
                @else
                <a style="cursor: pointer;" class="nav-link" id="signinForAskQuestionId">ASK-QUESTION</a>
                @endif
              </li>

              <li class="nav-item {{Request::path()=='blog'?'active border-bottom':''}} {{Request::is('blog/*')?'active border-bottom':''}}">
                <a class="nav-link" href="{{route('blog')}}">BLOG</a>
              </li>



              <li class="nav-item">
                <a class="nav-link  " href="#" tabindex="-1" aria-disabled="true">ABOUT-US</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>
</div>
