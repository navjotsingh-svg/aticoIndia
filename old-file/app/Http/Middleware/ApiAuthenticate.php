<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use App\Models\UserDevice;
use App\Models\RecruiterProfile;
use App\Models\EmployeeProfile;

class ApiAuthenticate
{
    /**
     * Path for login with http basic authorization api.
     * @var string
     */
    protected $httpAuthLogin = 'api/v1/login';

    /**
     * Path for logout and clear authorization cache.
     * @var string
     */
    protected $httpAuthLogout = 'api/v1/logout';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
        try{ 
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {

           if (trim($_SERVER['PHP_AUTH_USER']) != '' && trim($_SERVER['PHP_AUTH_PW']) != '') {

               // login authorization code
               if (\Request::path() == $this->httpAuthLogin) {                
                   // validate user is authorized or not.
                   return $this->doLogin($request,false);

               } elseif (\Request::path() == $this->httpAuthLogout) {

                   // logout user & clear authorization cache.
                   return $this->doLogout();
               } else {
                   // if normal request validate user is authorized or not
                   if ($this->doLogin($request,true) === false) {
                       return apiResponse(false, 401, lang('auth.failed_login'));
                   }
                   else{
                   }
               }
           } else {
               return apiResponse(false, 401, lang('auth.auth_required'));
           }
        } else {
           return apiResponse(false, 401, lang('auth.auth_required'));
        }
        return $next($request);
        } catch (\Exception $exception) {
            return apiResponse(false, 500, lang('messages.server_error').$exception->getMessage());
        }
    }

    /**
     * Method is used for login authorization.
     *
     * @param bool $request
     *
     * @return Json|Response
     */


protected function doLogin(Request $_request,$request = false)
    {
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
        try {

            $credentials = [
                'email' => $username,
                'password' => $password,
                'status' => 1
            ];

            if (\Auth::once(['email' => $username, 'password' => $password, 'status' => 1]) ||
                \Auth::once($credentials)
                ) {
                $user = $this->updateLastLogin();
                if($user['type'] == 2){
                    $recruiter_profile = RecruiterProfile::where('recruiter_id', $user['id'])->first();
                    if(!empty($recruiter_profile->company_name) && !empty($recruiter_profile->designation) && !empty($recruiter_profile->address)){
                        $user['profile_status'] = 1;    
                    }
                    else{
                        $user['profile_status'] = 0;    
                    }
                }

                elseif($user['type'] == 1){
                    $employee_profile = EmployeeProfile::where('employee_id', $user['id'])->first();
                    if(!empty($employee_profile->resume) && !empty($employee_profile->functional_area_id) && !empty($recruiter_profile->designation)){
                        $user['profile_status'] = 1;    
                    }
                    else{
                        $user['profile_status'] = 0;    
                    }
                }


                // for notifications
                $userdevide=new UserDevice;
                $userdevide->user_id=\Auth::user()->id;
                $userdevide->device_token=$_request['device_token'];
                $userdevide->device_type=$_request['device_type'];
                $check = (new UserDevice)->checkExist($_request['device_token']);
                if (count($check) > 0) {
                    # code...
                }else{
                    $userdevide->save();
                }
                //dd($user);
            } else {
                //$this->loginAttemptsFailed($username);
                if ($request == true) {
                    return false;
                } else {
                    return apiResponse(false, 401, lang('auth.failed_login'));
                }
            }

            if (\Request::path() == $this->httpAuthLogin) {

                return apiResponse(true, 200, '', [], $user);
            }

        } catch (\Exception $e) {
            return apiResponse(false, 500, lang('messages.server_error').$e->getMessage());
        }
    }

  

    /**
     * Method is used for logout and clear authorization cache.
     *
     * @return  Response|Json
     */
    protected function doLogout()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            try {
                // unset the http auth values.
                $_SERVER['PHP_AUTH_USER'] = $_SERVER['PHP_AUTH_PW'] = '';
                unset($_SERVER['PHP_AUTH_USER']);
                unset($_SERVER['PHP_AUTH_PW']);
                return apiResponse(true, 200, lang('auth.logout'));

            } catch (\Exception $e) {
                return apiResponse(false, 500, lang('messages.server_error'));
            }
        }
    }

    /**
     * Method is used for update last login time.
     *
     * @return  Response
     */
    protected function updateLastLogin()
    {
        //(new User)->updateLastLogin();
        return \Auth::user();
        $id = \Auth::user()->id;
        $email = \Auth::user()->email;
        
        return [
            'id'        => $id,
            'email'     => $email
         ];
    }

    /**
     * Method is used for update last login time.
     *
     * @param string $username
     *
     * @return Response
     */
    protected function loginAttemptsFailed($username)
    {
        if($username != "") {
            (new User)->updateFailedAttempts($username);
        }
    }

    //Serach Key
    protected function multiKeyExists(array $arr, $key) {
        
        // is in base array?
        if (array_key_exists($key, $arr)) {
            return true;
        }

        // check arrays contained in this array
        foreach ($arr as $element) {
            if (is_array($element)) {
                if ($this->multiKeyExists($element, $key)) {
                    return true;
                }
            }
            
        }

        return false;
    }
}
