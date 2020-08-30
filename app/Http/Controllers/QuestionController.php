<?php

namespace App\Http\Controllers;

use App\Question;
use App\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function AskQuestion(){
      $types = Types::all();
        return view('/askquestion', compact('types'));
  }

    public function addQuestion(Request $request){
        $que = new Question;
        $que->user_id = Auth::user()->id;
        $que->title = $request->qtitle;
        $que->slug = str_slug($request->qtitle);
        $que->type_id = $request->category;
        if($request->qbody!=''){
            $que->body = $request->qbody;
        }
        $que->save();
//        $users = Subscriber::all();
//        foreach ($users as $key => $users) {
//          Notification::route('mail', $users->email)
//          ->notify(new newQuestionNotification($que));
//        }
        return redirect()->route('home');
    }
}
