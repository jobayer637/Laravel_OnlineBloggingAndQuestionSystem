<div class="col-lg-3 col-md-3">
   <div class="sticky-top">
        <!-- start right content -->
    <div class="mt-4" style="background-color: #fff;">
        <div class="card-body shadow-sm text-muted">
            <h4 class="text-muted" style="font-weight:bold;"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i> Recent Posts</h4>
            <?php use App\Blog; $blog = Blog::latest()->paginate(5); ?>
            @foreach($blog as $blog)
                <hr>
                <a href="{{route('read_blog',[$blog->category->name,$blog->id,$blog->slug])}}" class="card-link text-dark">{{$blog->title}}</a>
            @endforeach
        </div>
    </div>

    <div class="mt-4" style="background-color: #fff;">
        <div class="card-body shadow-sm text-justify text-muted">
            <h4 class="text-muted" style="font-weight:bold;"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i> Categories</h4>
            <?php use App\Category; $cat = Category::all(); ?>
            @foreach($cat as $value)
                <hr>
                <a href="{{route('blogCats',[$value->name,$value->id])}}" class="card-link text-dark p-0 m-0" style="font-size:17px; font-weight:100;">{{$value->name}}</a>
             @endforeach
        </div>
    </div>
    <?php
    use App\User;
    use App\question;
    use App\Comment;
    use App\Answer;
    use App\Subscriber;
    $user = User::all();
    $question = Question::all();
    $blog = Blog::all();
    $comment = Comment::all();
    $answer = Answer::all();
    $subscriber = Subscriber::all();
     ?>
    <div class="mt-4 " style="background-color: #fff;">
        <div class="card-body shadow-sm text-justify text-muted ">
            <h4 class="text-dark" style="font-weight:bold;"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i> Stats</h4>

            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-users"></i> Users</strong>
                <span class="badge badge-dark">{{$user->count('id')}}</span>
              </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-bell"></i> Subscribers</strong>
                <span class="badge badge-dark">{{$subscriber->count('id')}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-hashtag"></i> Blogs</strong>
                <span class="badge badge-dark">{{$blog->count('id')}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-question-circle"></i> Questions</strong>
                <span class="badge badge-dark">{{$question->count('id')}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-comments"></i> Comments</strong>
                <span class="badge badge-dark p-1">{{$comment->count('id')}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-star"></i> Answers</strong>
                <span class="badge badge-dark">{{$answer->count('id')}}</span>
              </li>
            </ul>

        </div>
    </div>
    <!-- end right content -->
   </div>
</div>
