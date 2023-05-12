<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Validator;
use Auth;
use GuzzleHttp\Client;
use App\User;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Http;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if(!Auth::check()){

            $client = new \GuzzleHttp\Client();
            $apiURL = 'http://127.0.0.1:8080/api/get-user';
            
            $token = \Cookie::get('token');
            // dd($token); 
    
            $response = $client->get($apiURL, 
                                        ['headers' => 
                                            [
                                                'Authorization' => "Bearer $token"
                                            ]
                                        ]);
    
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody(), true);
        
            // dd($responseBody['email']);

            $user_email = $responseBody['email'];

            $user = User::where('email', $user_email)->first();

            Auth::login($user);

            // dd($user);

        }

        if (! $request->expectsJson()) {

            return route('login');
        }
    }
}
