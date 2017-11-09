<?php namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class ModulesController
 * @package Dosarkz\LaravelAdmin\Controllers
 */
class ModulesController extends Controller
{
    public function index()
    {
        $modules = app()->modules->all();

        return view('admin::modules.index', compact('modules'));
    }
}