<?php
namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\LaravelAdmin\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only(['username', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('admin');
        }

        return redirect()->back()->withInput()->withErrors(['username' => 'Username is entered incorrectly']);
    }

    /**
     * User logout.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::guard('admin')->logout();
        session()->forget('url.intented');
        return redirect(route('admin.getLogin'));
    }
}