<?php namespace Dosarkz\Dosmin\Controllers;

use App\Http\Controllers\Controller;
use Dosarkz\Dosmin\Models\Module;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

/**
 * Class ModulesController
 * @package Dosarkz\Dosmin\Controllers
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

    public function destroy($id)
    {
        $model = Module::findOrFail($id);

        if($model->menu)
        {
            $model->menu->menuItems()->delete();
            $model->menu->delete();
        }

        $module_name = ucfirst($model->alias);
        $providerStr = "'".$model->alias."' =>  \App\Modules\\$module_name\Providers\\$module_name"."ServiceProvider::class";

//        $this->replace_string_in_file(config_path('admin.php'),
//            $providerStr,
//            '');

        if(is_dir(app_path('Modules/'.$module_name)))
        {
        File::deleteDirectory(app_path('Modules/'.$module_name));
//            rmdir(app_path('Modules/'.$module_name));
        }

        $model->delete();


        return redirect()->back()->with('success', 'Модуль успешно удален');
    }

    function replace_string_in_file($filename, $string_to_replace, $replace_with){
        $content=file_get_contents($filename);
        $content_chunks=explode($string_to_replace, $content);
        $content=implode($replace_with, $content_chunks);
        file_put_contents($filename, $content);
    }
}