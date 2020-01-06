<?php
namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\Auth;

use Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\BasicController;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Dosarkz\Lora\Installation\Modules\Lora\Models\SuperUser;

class LoginController extends BasicController
{
    public function showLoginForm()
    {
        return $this->view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only(['username', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = SuperUser::where('username',$request->input('username'))->first();
            Auth::guard('admin')->login($user);
            return redirect()->intended('lora')->with('success', trans('lora::base.you_have_successfully_logged_in'));
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
