<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PassportController extends Controller
{
    //

    public $successStatus = 200;

        /**
         * login api
         *
         * @return \Illuminate\Http\Response
         */
        public function login(Request $request)
        {
            $user = User::where('email', $request->input('email'))->first();
            if($user){

                 if(Hash::check($request->input('password'), $user->password)){
                    $success['token'] =  $user->createToken('MyApp')->accessToken;
                    return response()->json(['success' => $success], $this->successStatus);
                  }else{
                   return response()->json(['status' => 'fail'],401);

                }
            }else{
            return response()->json(['status' => 'fail'],401);

            }



        }

        /**
         * Register api
         *
         * @return \Illuminate\Http\Response
         */
        public function register(Request $request)
        {
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;

            return response()->json(['success'=>$success], $this->successStatus);
        }

        /**
         * details api
         *
         * @return \Illuminate\Http\Response
         */
        public function getDetails()
        {
            $user = Auth::user();
            return response()->json(['success' => $user], $this->successStatus);
        }

}
