<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Subscriber;
use App\Types;
use Illuminate\Http\Request;
use App\Question;
use Carbon\Carbon;

class SearchController extends Controller
{
  public function searchQuestion(Request $request){
      $id = $request->get('id');
      $tbs = Question::where('type_id',$id)->first();
    $output='';
    $value = $request->get('value');
    if($value!=''){
      $searchValue = Question::where('title','like','%'.$value.'%')
          ->orWhere('created_at', 'like','%'.$value.'%')
          ->paginate(6);
      foreach ($searchValue as $key => $value) {
        $output .='
        <a title="Posted by '.$value->user->name.'" href="'.route('question',$value->id).'" class="btn btn-light list-group-item p-2" style="text-align:left;">'.$value->title.'</a>
        ';
      }return response($output);
    }
    else{
      return response($output);
    }
  }

  public function searchQuestionByType(Request $request){
      $id = $request->type;
      if($id==0){
          $ques = Question::latest()->paginate(15);
      }else{
          $ques = Question::where('type_id',$id)->latest()->paginate(15);
      }

      $types = Types::orderBy('name','asc')->get();
      $cans = Answer::all();
      $subscriber = Subscriber::all();
      return view('home' , compact('ques','cans','subscriber','types','id'));
  }
}
