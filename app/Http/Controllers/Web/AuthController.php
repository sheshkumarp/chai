<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Auth\LoginRequest;

use App\PasswordReset;

use App\User as BaseModel;

use App\Models\RememberMeModel;

use Illuminate\Http\Request;

use \Illuminate\Auth\Passwords\PasswordBroker;

use Hash;
use Mail;
use Cookie;
use Carbon\Carbon;

class AuthController extends Controller
{   
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;

    public function __construct(
       
        BaseModel $BaseModel,
        RememberMeModel $RememberMeModel,
        PasswordReset $PasswordResetModel,
        PasswordBroker $PasswordBroker
    )
    {

        $this->BaseModel = $BaseModel;   
        $this->RememberMeModel = $RememberMeModel;   
        $this->PasswordResetModel = $PasswordResetModel;
        $this->PasswordBroker = $PasswordBroker;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleView  = 'web.auth.';
        $this->ModulePath = 'web.auth.';   
        
        $this->rememberTitle = 'LARAVEL_RSESSION';
    }

    /*---------------------------------
    |   LOGIN
    ------------------------------------------*/

        public function login(Request $request)
        {
            $this->ViewData['moduleTitle']  = 'User Login';
            $this->ViewData['moduleAction'] = 'USER LOG IN';
            $this->ViewData['modulePath']   = $this->ModulePath.'login';
            
            if (!empty($_COOKIE[$this->rememberTitle])) 
            {
                $token = $_COOKIE[$this->rememberTitle];

                $this->ViewData['user'] = $this->RememberMeModel
                                        ->where('remember_token', $token)
                                        ->first();
            }

            return view($this->ModuleView.'login', $this->ViewData);
        }

        public function checkLogin(LoginRequest $request)
        {
            $this->JsonData['status'] = 'error';
            $this->JsonData['msg'] = 'Incorrect login details.';

            $credentials = [];
            $credentials['email']    = self::_validateUsername($request->username);
            $credentials['password'] = $request->password;

            $remember_me = !empty($request->remember) ? true : false;

            if (auth()->guard('web')->attempt($credentials, $remember_me)) 
            {

                if (auth()->user()->has('roles', '<', 1)) 
                {   

                    if (auth()->user()->status) 
                    {
                        self::_applyOrDestroyRemember($remember_me, $request);
                        $this->JsonData['status'] = 'success';
                        $this->JsonData['msg'] = 'Login successfull.';
                        $this->JsonData['url'] = route('web.dashboard');
                    
                    }
                    else
                    {
                        auth()->logout();
                        $this->JsonData['status'] = 'error';
                        $this->JsonData['msg'] = 'This account has deactivated, Please contact website administrator.';
                    }
                }
                else
                {
                    auth()->logout();
                }
            }

            return response()->json($this->JsonData);        
        }

        public function logout()
        {
            auth()->guard('admin')->logout();
            return redirect('admin');
        }

    /*---------------------------------
    |   FORGOT PASSWORD 
    ------------------------------------------*/

        public function forgotPassword()
        {
            $this->ViewData['moduleTitle']  = 'Forgot Password';
            $this->ViewData['moduleAction'] = 'FORGOT PASSWORD';
            $this->ViewData['modulePath']   = $this->ModulePath.'forgot.password';

            return view($this->ModuleView.'forgot-password', $this->ViewData);
        }
        
        public function forgotPasswordSubmit(ForgotPasswordRequest $request)
        {


            $this->JsonData['status'] = 'error';
            $this->JsonData['msg'] = 'Could not find an account with that email address.';

            $email = self::_validateUsername($request->username);
            
            $userCollection = $this->BaseModel->where('email',$email)->first();
          //  dd(count($userCollection->roles->pluck('guard_name')));
            if(count($userCollection->roles->pluck('guard_name')) > 0)
            {               

                if (!empty($userCollection)) 
                {
                    if (!$userCollection->status) 
                    {
                        $this->JsonData['status'] = 'error';
                        $this->JsonData['msg'] = 'User account has disabled. Please contact website administrator.';
                        return response()->json($this->JsonData);exit;
                    }


                    $userCollection->username = ucfirst($userCollection->first_name).' '.ucfirst($userCollection->last_name);
                    $token = $this->PasswordBroker->createToken($userCollection);

                    $userCollection->url = url('/admin/reset-password/'.$token);

                    try {

                        $result = Mail::to($userCollection->email)->send(new ForgotPasswordMail($userCollection,'admin'));

                        $post = $this->PasswordResetModel->create([
                            'email' => $userCollection->email,
                            'token' => $token
                        ]);

                        $this->JsonData['status']   = 'success';
                        $this->JsonData['url']      = route('admin.auth.login');
                        $this->JsonData['msg']      = 'Password reset link send successfully, Please check your email acount.';
                    } 
                   catch(\Exception $e) {

                        $this->JsonData['exception'] = $e->getMessage();
                        return response()->json($this->JsonData);exit;

                    }
                }
            }
            else
            {
               $this->JsonData['status'] = 'error';
                $this->JsonData['msg'] = 'Could not find an account with that email address.';
                return response()->json($this->JsonData);exit;
            
            }

            return response()->json($this->JsonData);                    
        }

    /*---------------------------------
    |   RESET PASSWORD
    ------------------------------------------*/
   
        public function resetPassword($token)
        {
            $this->ViewData['moduleTitle']  = 'Reset Password';
            $this->ViewData['moduleAction'] = 'RESET PASSWORD';
            $this->ViewData['modulePath']   = $this->ModulePath.'reset.password';
            
            $collection = $this->PasswordResetModel
                            ->where('token',$token)
                            ->where('created_at','>',Carbon::now()->subHours(24))
                            ->first();

            if(!empty($collection))
            {
                $this->ViewData['email'] = $collection->email; 
                $this->ViewData['token'] = $token;

                return view($this->ModuleView.'.reset-password', $this->ViewData);
            }
            else
            {
                return view($this->ModuleView.'.reset-token-expired', $this->ViewData);
            }
        }

        public function resetPasswordSubmit(ResetPasswordRequest $request, $token)
        {
            $this->JsonData['status'] = 'error';
            $this->JsonData['msg'] = 'Failed to reset password, Token expired';
            
            $isValidObject = $this->PasswordResetModel->where('token',$token)->first();
            if($isValidObject)
            {
                $collection = $this->BaseModel->where('email',$isValidObject->email)->first();
                $this->BaseModel->where('id',$collection->id)->update(['password' => Hash::make($request->password)]);
                $this->PasswordResetModel->where('token',$token)->delete();

                $this->JsonData['status']   = 'success';
                $this->JsonData['url']      = route('admin.auth.login');
                $this->JsonData['msg']      = 'Password updated successfully.';
            }

            return response()->json($this->JsonData);
        }
    
    /*---------------------------------
    |   SUBTITUTE FUNCTIONS
    ------------------------------------------*/
        public function _validateUsername($username)
        {
            $email = $username;
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) 
            {
                $userCollection = $this->BaseModel->where('username',  $username)->first(); 
                if(empty($userCollection))
                {   
                    return response()->json($this->JsonData);exit;
                }
                if(!empty($userCollection) && !$userCollection->hasRole('super-admin'))
                {   
                    return response()->json($this->JsonData);exit;
                }
                
                $email = $userCollection->email;
            }

            return $email;
        }

        public function _applyOrDestroyRemember($remember_me, $request)
        {
            if ($remember_me) 
            {
                // removing database  record
                $this->RememberMeModel->where('user_id', auth()->user()->id)
                                        ->delete(); 

                // generating cokie
                $token = @time('YmdHisa').auth()->user()->remember_token;
                $minutes = @time() + (10 * 365 * 24 * 60 * 60);
                setcookie($this->rememberTitle,$token, $minutes);

                // register remember in database 
                $RememberMeModel = new $this->RememberMeModel;
                $RememberMeModel->user_id = auth()->user()->id;
                $RememberMeModel->username = $request->username;
                $RememberMeModel->password = $request->password;
                $RememberMeModel->remember_token = $token;
                $RememberMeModel->initial_login_date = Date('Y-m-d');
                $RememberMeModel->save();
            }
            else
            {
                if(!empty($_COOKIE[$this->rememberTitle]))
                {
                    // removing cookie
                    $remember_token = $_COOKIE[$this->rememberTitle];
                    setcookie($this->rememberTitle, null, -1);
                    unset($_COOKIE[$this->rememberTitle]);

                    // removing database  record
                    $this->RememberMeModel->where('remember_token', $remember_token)
                                        ->delete();                 
                }
            }  
        }
}