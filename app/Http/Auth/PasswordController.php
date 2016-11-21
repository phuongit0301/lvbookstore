<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getReset() {
        return view('auth.reset');
    }

    public function confirm($activationCode) {

        if (!$activationCode) {
            App::abort(404, 'Activation Code not found');
        }

        $user = User::activateAccount($activationCode);

        if (!$user) {
            App::abort(404, 'User not found');
        }

        return redirect('/login')->with(['messages' => 'You have successfully verified your account.']);
    }
}
