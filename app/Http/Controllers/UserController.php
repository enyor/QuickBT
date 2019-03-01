<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
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
 
        $hasher = app()->make('hash');
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $password = $hasher->make($request->input('password'));
        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
        ]);
 
        $res['success'] = true;
        $res['message'] = 'Success register!';
        $res['data'] = $user;
        return response($res);
    }

    public function login(Request $request)
    {
        /*if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) { //Validamos que el user existe en bbdd 
            $user = Auth::user(); //Login
            $success['token'] =  $user->createToken('MyApp')->accessToken; //creamos el token
            //return response()->json(['success' => $success], 200);
            return response()->json($user, 200);

        } else {
            return response()->json(['error'=>'Unauthorised'], 401); 
        }*/
        $hasher = app()->make('hash');
 
        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
 
        if ( ! $login) {
            $res['success'] = false;
            $res['message'] = 'Your email or password incorrect!';
            return response($res);
        } else {
            if ($hasher->check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['success'] = true;
                    $res['api_token'] = $api_token;
                    $res['message'] = $login;
                    return response($res);
                }
            } else {
                $res['success'] = true;
                $res['message'] = 'You email or password incorrect!';
                return response($res);
            }
        }
    

//

    }
}
