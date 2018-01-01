<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use AccountKit;

class AuthController extends Controller
{
    public function authenticate(Request $request) { 
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 200);
        }
        return response()->json(['token' => "$token"]);
    }

    public function user(Request $request)
    {
        return response()->json(['data'=> $request->user()], 200);
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        return response()->json(['success' => true], 200);
    }

    public function loginOAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);
        $data = [
            'name' => $request->get('name', $request->email),
            'email' => $request->email
        ];

        $token =  $this->oauthRegister($data);

        return response()->json(['token' => $token]);
    }

    /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return \Illuminate\Http\Response
    */
   public function redirectToProvider($provider)
   {
       return Socialite::driver($provider)->redirect();
   }

   /**
    * Obtain the user information from GitHub.
    *
    * @return \Illuminate\Http\Response
    */
   public function handleProviderCallback($provider)
   {
       $user = Socialite::driver($provider)->stateless()->user();
       $data = [
           'name' => $user->getName(),
           'email' => $user->getEmail()
       ];
       $token = $this->oauthRegister($data);
       setcookie('UUID', $token , time() + (86400 * 30), "/"); 
       return redirect()->to('http://localhost:3000');
   }

   public function oauthRegister($data)
   {
        $user = User::where('email', $data['email'])->first();
        if (! $user){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt(str_random(5))
            ]);
        }
       return JWTAuth::fromUser($user);
   }

    public function otp(Request $request)
    {
        $user = AccountKit::accountKitData($request->code);
        
        $data = [
            'name' => $user['id'],
            'email' => $user['phoneNumber'],
        ];

        $token =  $this->oauthRegister($data);

        return response()->json(['token' => $token]);
    }
}
