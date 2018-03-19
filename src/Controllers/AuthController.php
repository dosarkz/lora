<?php
namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\LaravelAdmin\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Dosarkz\LaravelAdmin\Modules\SuperUser\Models\SuperUser;

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
            $user = SuperUser::where('username',$request->input('username'))->first();
            Auth::guard('admin')->login($user);
            return redirect()->intended('admin')->with('success', 'Вы успешно авторизовались');
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