<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\replyComment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function Comment($id, Request $request){
      $commentValue = $request->get('commentValue');
      $getComnt = new Comment;
      $getComnt->user_id = Auth::user()->id;
      $getComnt->blog_id = $id;
      $getComnt->body = $commentValue;
      $getComnt->save();
      $deleteMsg = "'are you sure?'";
      $editMst = "'Please refresh this page'";
      $token = '@csrf';
      $comnt = Comment::latest()->first();
      $output ='<div  class="card-body shadow-sm mb-1 bg-white">
          <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-12">
              '.(Auth::check()?'<img src="'.$comnt->user->avatar.'" height="50px" width="50px" style="border-radius:50%;">':'<img src="'.'storage/profile/'.$comnt->user->image.'" width="50px" style="border-radius:50%;">').'
              </div>
              <div class="col-lg-11 col-md-11 col-sm-12">
                 <div class="row">
                     <div class="col-lg-8 col-md-8 col-sm-6 col-6 mb-2">
                         <strong>
                           <p class="text-secondary mb-0 pb-0">
                          '.$comnt->user->name.'
                          </p>
                          <small class="mt-0 pt-0">
                          '.$comnt->created_at.'
                          </small>
                         </strong>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                         <button title="Reply" onclick="alert('.$editMst.')" class="rbtn btn btn-sm btn-outline-primary float-right"><i class="fa fa-reply"></i></button>
                         <button title="Delete" data-id="'.$comnt->id.'" data-route="'.route('delete',$comnt->id).'"  class="deleteBtnClass btn btn-outline-danger btn-sm float-right mr-1"><i class="fa fa-trash-o"></i></button>
                          <button onclick="alert('.$editMst.')" title="Edit" class="btn btn-sm btn-outline-info float-right mr-1"><i class="fa fa-edit"></i></button>
                     </div>
                 </div>

                  <div class="commentSection">
                    <div id="comnt_'.$comnt->id.'" class="viewComment">
                      <p class="text-justify text-secondary">
                        '.html_entity_decode($comnt->body).'
                      </p>
                    </div>
                  </div>
              </div>
          </div>
      </div>';
      return response($output);
    }

    public function editComment($id, $blogId, Request $request){
      $validatedData = $request->validate([
       'comment' => 'required',
      ]);

      $comnt = Comment::find($id);
      $comnt->user_id = Auth::user()->id;
      $comnt->blog_id = $blogId;
      $comnt->body = $request->comment;
      $comnt->save();
      return back();
    }

    public function ReplyComment($id,$blogId, Request $request){
      $validatedData = $request->validate([
       'replyComnt' => 'required',
      ]);

      $comnt = new replyComment;
      $comnt->user_id = Auth::user()->id;
      $comnt->blog_id = $blogId;
      $comnt->comment_id = $id;
      $comnt->body = $request->replyComnt;
      $comnt->save();
      return back();
    }
    public function ReplyCommentEdit($blogId, $comneId, $id, Request $request){
      $validatedData = $request->validate([
       'repComnt' => 'required',
      ]);

      $comnt = replyComment::find($id);
      $comnt->user_id = Auth::user()->id;
      $comnt->blog_id = $blogId;
      $comnt->comment_id = $comneId;
      $comnt->body = $request->repComnt;
      $comnt->save();
      return back();
    }

    public function DeleteComment(Request $request, $id){
      Comment::find($id)->delete();
      return response($id);
    }

    public function DeleteReplyComment($id){
      replyComment::find($id)->delete();
      return back();
    }
}
