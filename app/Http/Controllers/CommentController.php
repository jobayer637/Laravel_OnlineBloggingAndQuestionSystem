<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\replyComment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function Comment($id, Request $request){
      $comnt = new Comment;
      $comnt->user_id = Auth::user()->id;
      $comnt->blog_id = $id;
      $comnt->body = $request->comment;
      $comnt->save();
      return back();
    }

    public function ReplyComment($id,$blogId, Request $request){
      $comnt = new replyComment;
      $comnt->user_id = Auth::user()->id;
      $comnt->blog_id = $blogId;
      $comnt->comment_id = $id;
      $comnt->body = $request->repComnt;
      $comnt->save();
      return back();
    }

    public function DeleteComment($id){
      Comment::find($id)->delete();
      return back();
    }

    public function DeleteReplyComment($id){
      replyComment::find($id)->delete();
      return back();
    }
}
