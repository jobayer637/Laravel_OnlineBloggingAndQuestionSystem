<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    function likeUnlike(Request $request){
        $likeVlaue = $request->likeValue;
        $likeId = $request->likeId;
        $questionId = $request->questionId;

        if($likeId==0){
            $newLike = new Like;
            $newLike->user_id = Auth::user()->id;
            $newLike->question_id = $questionId;
            $newLike->isLike = $likeVlaue;
            $newLike->save();
            $allLikes = Like::where('question_id',$questionId)->where('isLike',1)->get();
            $output ='
            <a data-like="'.$newLike->id.'" onclick="changeLike()" data-question="'.$questionId.'" data-value="0" id="likeId"  class="nav-link text-primary"  style="cursor: pointer;"><i class="fa fa-thumbs-up" style="font-size:19px"></i> '.$allLikes->count('id').'</a>
            ';
            return response($output);
        }else{
            $like = Like::where('id',$likeId)->first();
            $like->isLike = $likeVlaue;
            $like->update();
            $updateAllLikes = Like::where('question_id',$questionId)->where('isLike',1)->get();
            if($like->isLike==1){
                $output ='
                    <a data-like="'.$like->id.'" onclick="changeLike()" data-question="'.$questionId.'" data-value="0" id="likeId"  class="nav-link text-primary"  style="cursor: pointer;"><i class="fa fa-thumbs-up" style="font-size:19px"></i> '.$updateAllLikes->count('id').'</a>
                ';
                return response($output);
            }
            else{
                $output ='
                    <a data-like="'.$like->id.'" onclick="changeLike()" data-question="'.$questionId.'" data-value="1" id="likeId"  class="nav-link text-primary"  style="cursor: pointer;"><i class="fa fa-thumbs-o-up" style="font-size:19px"></i> '.$updateAllLikes->count('id').'</a>
                ';
                return response($output);
            }
        }
    }

    function getLiveValue(Request $request){
        $allLikes = Like::where('question_id',$request->get('questionId'))->where('isLike',1)->get();
        return response($allLikes->count('id'));
    }
}
