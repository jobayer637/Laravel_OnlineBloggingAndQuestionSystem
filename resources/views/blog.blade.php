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
 <h5> <span><a class="text-white" href="{{route('blog')}}">Blog</a></span> / <span class="text-dark">@foreach($allCat as $ac) {{$ac->id==$category_id?$ac->name:''}} @endforeach</span></h5>
 <br>
@endsection

@section('content')
<!-- blog navbar -->


<div class="form-group w-100">
    <form id="blogByCategoryId" method="post" action="{{route('blogSearchByCategory')}}">
        @csrf
        <select name="category"  class="selectCategoryClass form-control rounded-0 text-uppercase bg-light">
            <option selected value="0">Blogs</option>
            @foreach($allCat as $noc=>$cats)
                <option {{$category_id==$cats->id?'selected':''}}  value="{{$cats->id}}">{{$cats->name}}</option>
            @endforeach
        </select>
    </form>
</div>


@foreach($getBlog as $blog)
<div id="cbody" class="cbody">
  <div id="innerCbody" class="mt-2 innerCbody">
      <div class="card rounded-0">
        <div class="card-body">
            <h3 id="title" class="text-secondary" style="font-weight:bold;"><a href="{{route('read_blog',[$blog->category->name,$blog->id,$blog->slug])}}">{{$blog->title}}</a></h3>
            <!-- <p class="text-muted mt-2 text-justify" style="font-size:17px;">
            {!! html_entity_decode(str_limit($blog->body,200)) !!}
            <a href="{{route('read_blog',[$blog->category->name,$blog->id,$blog->title])}}" class="" name="button">Continue Reading</a>
            </p> -->
            <div class="blogBodyLimitClass text-muted mt-2 text-justify" data-value="{{$blog->body}}">

            </div>
            @if($blog->image==NULL)
            @else
              <img src="storage/blog/{{$blog->image}}" class="img-fluid w-100" alt="Responsive image" style="max-height:440px;">
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
                 <a class="nav-link" href="{{route('blogCats',[$blog->category->name,$blog->category_id])}}"><i class="fa fa-newspaper-o"></i> {{$blog->category->name}}</a>
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
                 <a class="nav-link" href="#"><i class="fa fa-comments-o"></i>
                   {{$blog->comments->count()}} Comment
                   @foreach($blog->comments as $cm)
                   <img title="{{$cm->user->name}}" src="{{$cm->user->avatar}}" class="rounded-circle" alt="" height="15px" width="15px">
                   @endforeach
                 </a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="fa fa-eye"></i> {{$blog->view}} Views</a>
               </li>
            </ul>

        </div>
      </div>
  </div>
</div>
@endforeach
<!-- start pagination section -->
<div class="mt-4">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <li class="page-item {{$getBlog->onFirstPage()?'disabled':''}}">
        <a class="page-link" href="{{$getBlog->previousPageUrl()}}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="">{{$getBlog->currentPage()}}</a></li>
      <li class="page-item {{$getBlog->hasMorePages()?'':'disabled'}}">
        <a class="page-link" href="{{$getBlog->nextPageUrl()}}">Next</a>
      </li>
    </ul>
  </nav>
</div>
<!-- end pagination section -->
@endsection


@push('jscript')
<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
<script type="text/javascript">
$("select.selectCategoryClass").on('change', function(){
    $("#blogByCategoryId").submit();
  });
</script>

<script type="text/javascript">
$(".blogBodyLimitClass").each(function(){
  var blogBody = $(this).data('value');
  if(blogBody.length>320)blogBody=blogBody.substring(0,320);
  $(this).append(blogBody+"....");
})
</script>
@endpush
