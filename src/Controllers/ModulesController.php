<?php namespace Dosarkz\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\LaravelAdmin\Models\Module;
use Illuminate\Http\Request;

/**
 * Class ModulesController
 * @package Dosarkz\LaravelAdmin\Controllers
 */
class ModulesController extends Controller
{
    public function index()
    {
        $modules = Module::all();

        return view('admin::modules.index', compact('modules'));
    }

    public function settings($module_alias)
    {
        $model = Module::where('alias', $module_alias)->first();

        if(!$model)
        {
            return redirect()->back()->with('error', 'Error');
        }

        return view('admin::modules.settings', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $model = Module::findOrFail($id);

        if($request->has('menu_active'))
        {
            $request->merge([
                'menu_active' => true
            ]);
        }else{
            $request->merge([
                'menu_active' => false
            ]);
        }


        $model->update($request->all());
        return redirect()->back()->with('success', 'Success');
    }
}