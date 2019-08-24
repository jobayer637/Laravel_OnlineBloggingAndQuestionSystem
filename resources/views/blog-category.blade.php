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
 <h5> <span><a class="text-white" href="{{route('home')}}">Blog</a></span> / <span class="text-dark">Categories</span></h5>
 <br>
@endsection

@section('content')
<!-- Blog navbar -->
  <div class="card rounded-0 bg-white">
    <ul class="nav nav-pills">
      <li class="nav-item active">
        <a class="nav-link" href="#">Programming</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">General</a>
      </li>

    </ul>
  </div>
@foreach($getBlog as $blog)
<div class="mt-4" style="background-color: #fff;">
    <div class="card rounded-0">
      <div class="card-body">
          <h3 class="text-secondary" style="font-weight:bold;">{{$blog->title}}</h3>
          <p class="text-muted mt-2 text-justify" style="font-size:17px;">
          {!! html_entity_decode(str_limit($blog->body,300)) !!}
          </p>
          @if($blog->image==NULL)
          @else
            <img src="{{$blog->image}}" class="img-fluid w-100" alt="Responsive image" style="max-height:440px;">
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
               <a class="nav-link" href="#"><i class="fa fa-calendar"></i> 6 days ago</a>
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

@endpush
