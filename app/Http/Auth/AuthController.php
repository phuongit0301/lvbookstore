<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Models\User;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use Event;
use Session;
use App\Events\SendEmailWhenRegiterSuccess as SendEmail;
use App\Http\Requests\AuthFormRequest as AuthFormRequest;
use Illuminate\Http\Request;

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

    use ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(AuthFormRequest $request) {
        DB::beginTransaction();

        $activationCode = str_random(60);

        $arrData = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'activation_code' => $activationCode,
        ];

        if ($user = User::create($arrData)) {
            try {
               Event::fire(new SendEmail($user->id));
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }

            DB::commit();
            return redirect('/login');
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider() {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('facebook');
        }
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to('/');
        // $user->token;
    }

    private function findOrCreateUser($facebookUser) {
        $authUser = User::where('facebook_id', $facebookUser->getId())->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
        ]);
    }

    public function showLoginForm() 
    {
        return view('general.auth.login');
    }

    public function showRegistrationForm()
    {
        return view('general.auth.register');
    }

    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {            
            if (Auth::user()->activated != '1') {
                Auth::logout();
                return redirect('login')
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['Active' => 'You are not activated!']);
            }
            Session::put('lang', Auth::user()->lang);
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
