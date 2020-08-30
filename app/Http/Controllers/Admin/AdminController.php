<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Blog;
use App\Comment;
use App\Question;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;


class AdminController extends Controller
{
  public function admin(){
      $user = User::all();
      $question = Question::all();
      $blog = Blog::all();
      $comment = Comment::all();
      $answer = Answer::all();
      $subscriber = Subscriber::all();
    return view('admin/dashboard', compact('user','blog','question','comment','answer','subscriber'));
  }
}
