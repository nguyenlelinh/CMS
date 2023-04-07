<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\BaseController;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Login The User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt(['ADM_email' => $request->input('email'), 'password' =>$request->input('password')])){
                return redirect()->route('show-login')->with('error','Email và mật khẩu không chính xác ');

            }


            $user = User::where('ADM_email', $request->email)->first();
            $user->createToken("API TOKEN")->plainTextToken;
            return redirect('cms/dashboard.vsp');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function showLogin(){
        return view('auth.login');
    }


    }
