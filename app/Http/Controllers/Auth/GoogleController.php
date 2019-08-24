<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class GoogleController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
    	try{
    		$google_user = Socialite::driver('google')->user();
    		$old_google_user = User::where('g_id',$google_user->id)->first();
    		if($old_google_user){
    			Auth::login($old_google_user);
    			return redirect('/home');
    		}else{
    			$user = new User;
          if($google_user->email=="web.jobayer@gmail.com"){
            $user->role_id=1;
          }else{
            $user->role_id=2;
          }
		        $user->g_id=$google_user->id;
		        $user->name=$google_user->name;
		        $user->email=$google_user->email;
		        $user->password=bcrypt($google_user->id);
		        $user->avatar=$google_user->avatar;
		        $user->save();
		        Auth::login($user);
		        return redirect('/home');
    		}
    	}catch(\Exception $e){
    		return redirect('login/google');
    	}

        // try{
        // 	$google_user = Socialite::driver('google')->user();

	       //  $old_User = User::where('g_id',$google_user->id)->first();
	       //  if($old_User){
	       //  	Auth::login($oldUser);
	       //  	return redirect(('/home'));
	       //  }else{
	       //  	$user = new User;
		      //   $user->g_id=$fb_user->id;
		      //   $user->name=$fb_user->name;
		      //   $user->email=$fb_user->email;
		      //   $user->password=bcrypt($google_user->id);
		      //   $user->avatar=$google_user->avatar;
		      //   $user->save();
		      //   Auth::login($user);
		      //   return redirect()->back();
	       //  }
        // }catch(\Exception $ex){
        // 	return redirect('login/google');
        // }
    }
}
