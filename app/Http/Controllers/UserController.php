<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Validator;

class UserController extends Controller
{
    /**
     * Controlador user
     *
     * @return void
     */
    public function __construct()
    {
        // se establece el middleware para validar por token solo para funciones especificas
        $this->middleware('auth', ['only' => [
            'register',
            'update',
            'getallusers',
            'getuserfromid',
            'deletefromid'
        ]]);
    }

         public function update(Request $request, $id)
    {
      $input = $request->all();
      $user = User::where('id', $id)->update($input);
      return response(NULL, 204);

    }

        public function getallusers()
    {
        $user = User::all();
        return response()->json($user, 200);
    }

    public function getuserfromid($id)
    {
        $user = User::find($id);
        return response()->json($user, 200);
    }

    public function deletefromid($id)
    {
        $user = User::destroy($id);
        return response(NULL, 204);
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
 
      
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $password = Crypt::encrypt($request->input('password'));
        $token = base64_encode(str_random(40));
        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'token' => $token,
        ]);
 
        
        return response(NULL,201);
    }

    public function login(Request $request)
    {
      
        $this->validate($request, [
       'email' => 'required',
       'password' => 'required'
        ]);
      $user = User::where('email', $request->input('email'))->first();
      $rpass = $request->input('password');
      $decry = Crypt::decrypt($user->password);

     if($rpass == $decry){
          $apikey = base64_encode(str_random(40));
          User::where('email', $request->input('email'))->update(['token' => "$apikey"]);
          return response()->json(['id' => $user->id, 'first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email,'token' => $apikey]);
      }else{
          return response('error: Error in user or password',401);
      }

//

    }
}
