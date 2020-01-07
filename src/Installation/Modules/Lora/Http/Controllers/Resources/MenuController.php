<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\Resources;

use Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\BasicController;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\StoreMenuRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\UpdateMenuRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Menu;
use Dosarkz\Lora\Installation\Modules\Lora\Models\MenuRole;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Role;
use Illuminate\Http\Response;

class MenuController extends BasicController
{
    public function __construct()
    {
        $this->setModel(new Menu());
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $models = Menu::paginate();
        return view('lora::menu.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $model = $this->getModel();
        $roles = Role::all();
        return view('lora::menu.create', compact('model','roles'));
    }

    /**
     * @param StoreMenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMenuRequest $request)
    {
        $request->merge([
            'user_id' => auth()->guard('admin')->user()->id
        ]);

        $model  = $this->getModel()->create($request->all());

        if($request->has('menuRole'))
        {
            MenuRole::where('menu_id',$model->id)->delete();

            foreach ($request->input('menuRole') as $role_id => $item) {
                MenuRole::firstOrCreate([
                    'menu_id' => $model->id,
                    'role_id' => $role_id
                ]);
            }
        }
        return redirect()->back()->with('success', trans('lora::base.resource_created'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('lora::menu.show');
    }

    public function edit($id)
    {
        $model = $this->getModel()->findOrFail($id);
        $roles = Role::all();
       return $this->view('menu.edit', compact('model', 'roles'));
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        if($request->has('menuRole'))
        {
            MenuRole::where('menu_id',$model->id)->delete();

            foreach ($request->input('menuRole') as $role_id => $item) {
                MenuRole::firstOrCreate([
                    'menu_id' => $model->id,
                    'role_id' => $role_id
                ]);
            }
        }

        $model->update($request->all());

        return redirect(route('lora.menus.index'))->with('success', trans('lora::base.resource_updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->model()->findOrFail($id);
        $model->delete();
        return redirect()->back()->with('success', trans('lora::base.resource_deleted'));
    }
}
