<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Answer;
use App\ReplyAns;

class AnswerController extends Controller
{
    function Answer(Request $req, $id){
    	$ans = new Answer();
    	$ans->user_id = Auth::user()->id;
    	$ans->question_id = $id;
    	$ans->body = $req->qanswer;
    	$ans->save();
    	return redirect()->back();
    }

    function ReplyAnswer(Request $req, $id){
    	$reply_ans = new ReplyAns();
    	$reply_ans->user_id = Auth::user()->id;
    	$reply_ans->ans_id = $id;
    	$reply_ans->ques_id = $req->qu_id;
    	$reply_ans->body = $req->reans;
    	$reply_ans->save();
    	return redirect()->back();
    }

    function deleteAnswer($id){
        Answer::where('id',$id)->delete();
        return response($id);
    }

    function deleteReplyAnswer($id){
        ReplyAns::where('id',$id)->delete();
        return response($id);
    }

    function editAnswer(Request $relques){
      $id = $relques->id;
      $body = $relques->editValue;
      $editAns = Answer::where('id',$id)->first();
      $editAns->user_id = $editAns->user_id;
      $editAns->question_id = $editAns->question_id;
      $editAns->body = $relques->editValue;
      $editAns->update();

      return response($editAns);
    }
}
