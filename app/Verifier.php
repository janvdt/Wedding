<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use OAuth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
          'email'    => $username,
          'password' => $password,
        ];

        if (Auth::once($credentials)) {
			return Auth::user()->id;
 		} else {
 			return false;
 		}
    }

    public function verifyFacebook($facebook_token)
    {

    	 	/**
           	* Get Facebook SDK
			*/

			$fb = OAuth::consumer('Facebook','http://google.be/');
		
			/**
			* Set code
			*/

			$fb->requestAccessToken($facebook_token);

			/**
			* Fetch Result
			*/

			$result = json_decode($fb->request('/me?fields=first_name,last_name,email,gender,location,birthday'),true);

			/**
			* Fetch user id
			*/

			$user = User::where(array('email' => $result['email']))->first();
			$user->email = $result['email'];
			$user->save();

			/**
			* Return
			*/

			return $user->id;
   	}

}
