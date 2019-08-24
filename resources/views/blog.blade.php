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
 <h5> <span><a class="text-white" href="{{route('blog')}}">Blog</a></span> / <span class="text-dark">{{Request::path()=='blog'?'Categories':$categoryName}}</span></h5>
 <br>
@endsection

@section('content')
<!-- blog navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#38cbcb;">
      <a class="navbar-brand {{Request::path()=='blog'?'active border-bottom text-white':''}}" href="{{route('blog')}}" style="font-size:14px;">BLOGS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          @foreach($allCat as $noc=>$cats)
          <?php $bc ='blog/'.$cats->name.'/'.$cats->id; ?>
          <li class="nav-item {{Request::path()==$bc?'active border-bottom':''}}">
            <a class="navbar-brand text-uppercase {{Request::path()==$bc?'text-white':''}}" href="{{route('blogCats',[$cats->name,$cats->id])}}" style="font-size:14px;">{{$cats->name}}</a>
          </li>
          @if($noc==5)
          @break
          @endif
          @endforeach
        </ul>
      </div>
    </nav>


@foreach($getBlog as $blog)
<div class="mt-2">
    <div class="card rounded-0">
      <div class="card-body">
          <h3 class="text-secondary" style="font-weight:bold;">{{$blog->title}}</h3>
          <p class="text-muted mt-2 text-justify" style="font-size:17px;">
          {!! html_entity_decode(str_limit($blog->body,300)) !!}
          </p>
          @if($blog->image==NULL)
          @else
            <img src="http://127.0.0.1:8000/storage/blog/{{$blog->image}}" class="img-fluid w-100" alt="Responsive image" style="max-height:440px;">
          @endif
          <hr class="text-muted">

          <ul class="nav nav-pills card-header-pills">
             <li class="nav-item">
               <a class="nav-link" href="#">
                 @if($blog->user->avatar=="profile.jpg")
                 <img class="b_p_i" src="{{$blog->user->image}}" alt="Profile-image">
                 @else
                 <img class="b_p_i" src="{{$blog->user->avatar}}" alt="Profile-image">
                 @endif
                 {{$blog->user->name}}
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#"><i class="fa fa-newspaper-o"></i> {{$blog->category->name}}</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#"><i class="fa fa-calendar"></i>
                 <?php
                   $dt= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at);
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
           <a href="{{route('read_blog',[$blog->category->name,$blog->id,$blog->title])}}" class="btn btn-info float-right rounded-0" name="button">Continue Reading</a>
      </div>
    </div>
</div>
@endforeach
@endsection


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
