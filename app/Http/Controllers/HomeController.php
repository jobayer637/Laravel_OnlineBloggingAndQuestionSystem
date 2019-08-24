<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Question;
use App\Answer;
use App\ReplyAns;
use App\Blog;
use App\Comment;
use App\replyComment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cans = Answer::all();
        $ques = Question::latest()->paginate(4);
        return view('index' , compact('ques','cans'));

    }
    public function home()
    {
        $cans = Answer::all();
        $ques = Question::latest()->paginate(6);
        return view('home' , compact('ques','cans'));
    }
    public function ReadQuestion($id)
    {
        $ques = Question::find($id);
        $ques->view = $ques->view+1;
        $ques->save();
        $relques = Question::all()->where('category',$ques->category);
        $ans  = Answer::all()->where('ques_id',$id);
        $repans = ReplyAns::all();
        return view('question',compact('ques','ans','repans','relques'));
    }

    public function AskQuestion(){
        return view('/askquestion');
    }

    public function addQuestion(Request $request){
        $que = new Question;
        $que->user_id = Auth::user()->id;
        $que->title = $request->qtitle;
        $que->slug = str_slug($request->qtitle);
        $que->category = $request->category;
        if($request->qbody!=''){
          $que->body = $request->qbody;
        }
        $que->save();

        return redirect()->route('home');
    }

    public function author(){
      return view('author/dashboard');
    }

    public function Blogpage(){
      $allCat = Category::all();
      $getBlog = Blog::latest()->paginate(6);
      return view('blog', compact('getBlog','allCat'));
    }

    public function BlogCats($categoryName,$id){
      $allCat = Category::all();
      $getBlog = Blog::where('category_id',$id)->latest()->paginate(6);
      return view('blog', compact('getBlog','allCat','categoryName'));
    }

    public function ReadBlog($category,$id, $title){
      $comment = Comment::all()->where('blog_id',$id);
      $reply_comment = replyComment::all();
      $read_blog = Blog::find($id);
      return view('read-blog',compact('read_blog','comment','reply_comment'));
    }
}
