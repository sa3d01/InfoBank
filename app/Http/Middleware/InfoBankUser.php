<?php

namespace App\Http\Middleware;

use App\Traits\ClientRequestTrait;
use Closure;
use Illuminate\Http\Request;

class InfoBankUser
{
    use ClientRequestTrait;


    public function handle(Request $request, Closure $next)
    {
        $token =$request->header('Authorization');
        if ($token == null) {
            $response = [
                'status' => 401,
                'message' => 'Wrong Authorization..',
            ];
            return response()->json($response, 401);
        }
        try {
            $response=$this->getUserByToken($token);
            $success=$response["profile_client"];
        }catch (\Exception $e){
            $response = [
                'status' => 401,
                'message' => 'Wrong Authorization..',
            ];
            return response()->json($response, 401);
        }
        return $next($request);
    }
}
