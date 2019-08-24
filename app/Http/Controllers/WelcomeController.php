<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class WelcomeController extends Controller
{
  public function welcome()
  {
      $cat = Category::all();
      return view('welcome' , compact('cat'));
  }
}
