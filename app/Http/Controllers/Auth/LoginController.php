<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected function authenticated(Request $request, $user)
    protected function authenticated(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    // Check if the user exists and email is verified
    $user = User::where('email', $request->email)->first();
    // dd($user->status);
    if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
        if($user->status ===0){
            Auth::logout();
            return redirect('/login')->withErrors(['Your account is inactive. Please contact support.']);
      }
        $user = Auth::user();
        return redirect('/dashboard');
    }
    return redirect('/login');

        // $user = Auth::user();
        // dd($user); 
        
    }

    public function logout(Request $request)
    {
        Auth::logout();  // Log the user out
        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate CSRF token

        return redirect('/');  // Redirect after logout (you can change this)
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
