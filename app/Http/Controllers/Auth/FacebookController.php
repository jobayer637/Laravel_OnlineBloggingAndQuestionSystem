<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
       try{
       	$fb_user = Socialite::driver('facebook')->user();
        $oldUser = User::where('f_id',$fb_user->id)->first();
        if($oldUser){
        	Auth::login($oldUser);
        	// return redirect()->back();
          return back();
        }else{
        	$user = new User;
	        $user->f_id=$fb_user->id;
	        $user->name=$fb_user->name;
	        $user->email=$fb_user->email;
	        $user->password=bcrypt($fb_user->id);
	        $user->avatar=$fb_user->avatar;
	        $user->save();
	        Auth::login($user);
	        return back();
        }
       }catch(\Exception $ex){
       	return redirect('login/facebook');
       }
    }
}
