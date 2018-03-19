<?php namespace Dosarkz\LaravelAdmin\Controllers;

use Dosarkz\LaravelAdmin\Models\Module;
use Dosarkz\LaravelAdmin\Modules\SuperUser\Models\SuperUser;
use Dosarkz\LaravelAdmin\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class MainController
{
    public function index()
    {
        $countSuperUsers = SuperUser::all()->count();
        $count_modules = Module::all()->count();
        return view('admin::main.index', compact('countSuperUsers', 'count_modules'));
    }

    public function getResetPassword()
    {
        return view('admin::main.reset_password');
    }

    public function postResetPassword(ResetPasswordRequest $request)
    {
        if (Hash::check($request->input('old_password'), auth()->guard('admin')->user()->password))
        {
            auth()->guard('admin')->user()->password = bcrypt($request->input('password'));
            auth()->guard('admin')->user()->save();

            return redirect()->back()->with('success','Success');
        }

        return redirect()->back()->with('error','Error');
    }
}