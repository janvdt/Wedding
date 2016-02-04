<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

}
