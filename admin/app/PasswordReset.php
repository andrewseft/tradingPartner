<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class PasswordReset extends Model
{
    //

    protected $fillable = [
        'email', 'token'
    ];

    /*
		* Password reset request save and update
     */

    public function PasswordReset($user){
    	$data = $this->updateOrCreate(['email' => $user->email],['email' => $user->email,'token' => sha1(time())]);
        return $data;
    }

    /*
        ** Find token data
     */
    public function token($token){
        $data = $this->where('token', $token)
            ->firstOrFail();
        return $data;
    }
    
    
}
