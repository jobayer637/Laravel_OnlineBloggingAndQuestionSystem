<?php

namespace App\Http\Controllers;

use App\Like;
use App\Notifications\newQuestionNotification;
use App\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Category;
use App\Question;
use App\Answer;
use App\ReplyAns;
use App\Blog;
use App\Subscriber;
use App\Comment;
use App\replyComment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $types = Types::orderBy('name','asc')->get();
        $cans = Answer::all();
        $subscriber = Subscriber::all();
        $ques = Question::latest()->paginate(15);
        return view('index' , compact('ques','cans','subscriber','types'));

    }

    public function home(){
        $id=0;
        $types = Types::orderBy('name','asc')->get();
        $cans = Answer::all();
        $subscriber = Subscriber::all();
        $ques = Question::latest()->paginate(15);
        return view('home' , compact('ques','cans','subscriber','types','id'));
    }

    public function ReadQuestion($id){
        $ques = Question::find($id);

        $userLike = Auth::check()?Like::where('user_id', Auth::user()->id)->where('question_id', $ques->id)->first():'';
        $like = Like::where('question_id', $ques->id)->where('isLike',1)->get();

        $ques->view = $ques->view+1;
        $ques->save();
        $relques = Question::where('type_id',$ques->type_id)->latest()->paginate(5);

        $ans  = Answer::all()->where('question_id',$id);
        $repans = ReplyAns::all();

        return view('question',compact('ques','ans','repans','relques','userLike','like'));
    }


    public function author(){
      return view('author/dashboard');
    }

    public function Blogpage(){
      $category_id = '';
      $allCat = Category::all();
      $getBlog = Blog::latest()->paginate(10);
      return view('blog', compact('getBlog','allCat','category_id'));
    }

    public function ReadBlog($category,$id, $title){
      $comment = Comment::all()->where('blog_id',$id);
      $reply_comment = replyComment::all();
      $read_blog = Blog::find($id);
      $read_blog->view = $read_blog->view+1;
      $read_blog->save();
      return view('read-blog',compact('read_blog','comment','reply_comment'));
    }

    public function BlogCats($categoryName,$id){
      $allCat = Category::all();
      $getBlog = Blog::where('category_id',$id)->latest()->paginate(10);
      return view('blog', compact('getBlog','allCat','categoryName'));
    }

    public function blogByCategory(Request $request){
        $category_id = $request->category;
        $allCat = Category::all();
        if($category_id==0){
            $getBlog = Blog::latest()->paginate(10);
        }
        else{
            $getBlog = Blog::where('category_id',$request->category)->latest()->paginate(10);
        }
        return view('blog', compact('getBlog','allCat','category_id'));
    }

}
