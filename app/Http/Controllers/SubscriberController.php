<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function addSubscriber(Request $request){
        $subscriber = new Subscriber;
        $subscriber->email = Auth::user()->email;
        $subscriber->save();
        $allSubscriber = Subscriber::count('id');
        $output='
        <button title="subscribe" class="allSubsClass btn btn-danger" type="button" onclick="userUnsubscribe()">
         <i class="fa fa-bell"></i> SUBSCRIBED '.$allSubscriber.'
        </button>
        ';
        return response($output);

    }

    public function unSubscribe(){
      $mail = Auth::user()->email;
      $unSubs = Subscriber::where('email', $mail)->first();
      $unSubs->delete();
      $allSubscriber = Subscriber::count('id');
      $output='
      <button title="subscribe" class="allSubsClass btn btn-danger" type="button" onclick="userSubscribe()" >
       <i class="fa fa-bell-slash"></i> SUBSCRIBE '.$allSubscriber.'
      </button>
      ';
      return response($output);
    }
}
