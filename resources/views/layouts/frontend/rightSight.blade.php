<div class="col-lg-3 col-md-3">
   <div class="sticky-top">
        <!-- start right content -->
    <div class="mt-4" style="background-color: #fff;">
        <div class="card-body shadow-sm text-justify text-muted">
            <h4 class="text-muted">Recent Question</h4>
            <?php use App\Question; $qus = Question::latest()->paginate(5); ?>
            @foreach($qus as $qs)
                <hr>
                <a href="{{route('question',$qs->id)}}" class="card-link text-dark">{{$qs->title}}</a>
            @endforeach
        </div>
    </div>

    <div class="mt-4" style="background-color: #fff;">
        <div class="card-body shadow-sm text-justify text-muted">
            <h4 class="text-muted" style="font-weight:bold;">Categories</h4>
            <?php use App\Category; $cat = Category::all(); ?>
            @foreach($cat as $value)
                <hr>
                <a href="{{route('blogCats',[$value->name,$value->id])}}" class="card-link text-dark">{{$value->name}}</a>
             @endforeach
        </div>
    </div>

    <div class="mt-4 " style="background-color: #fff;">
        <div class="card-body shadow-sm text-justify text-muted ">
            <h4 class="text-muted">Stats</h4>
            <hr>
            <p>Dark Net - Darknet</p>
            <hr>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. standard dummy text</p>
            <hr>
            <p>cybar security specilist hisabe j vabe carier horben</p>
            <hr>
            <p>Radix sort- java</p>
            <hr>
            <p>Thesis VS Project- 02 part</p>
        </div>
    </div>
    <!-- end right content -->
   </div>
</div>
