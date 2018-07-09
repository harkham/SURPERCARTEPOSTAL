<?php
namespace App\Services\User;
use App\User;

class UserService
{

    public function findUserByToken($request)
    {
        $bearerToken = $request->header('Authorization');
        if(!empty($bearerToken))
        {
            $token = substr($bearerToken,strpos($bearerToken, " ") + 1);
            $user = User::where('api_token', $token)->first();
            if(!empty($user))
            {
                return $user;
            }
        }
        return null;
    }
}
