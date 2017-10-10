<?php namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin::auth.login');
    }
}