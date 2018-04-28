<?php

namespace Dosarkz\Dosmin\Modules\Menu\Http\Controllers;

use Dosarkz\Dosmin\Controllers\ModuleController;
use Dosarkz\Dosmin\Modules\Menu\Http\Requests\StoreMenuItemRequest;
use Dosarkz\Dosmin\Modules\Menu\Http\Requests\StoreMenuRequest;
use Dosarkz\Dosmin\Modules\Menu\Http\Requests\UpdateMenuItemRequest;
use Dosarkz\Dosmin\Modules\Menu\Http\Requests\UpdateMenuRequest;
use Dosarkz\Dosmin\Modules\Menu\Models\Menu;
use Dosarkz\Dosmin\Modules\Menu\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuItemController extends ModuleController
{
    public function __construct()
    {
        $model = MenuItem::class;
        $this->setModule(config('menu.module.alias'));
        $this->setModel(new $model);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        $model = $this->getModel()->where('menu_id', $id)->paginate();
        $module = $this->getModule();
        $menu = Menu::findOrFail($id);
        return view($this->getModule()->alias.'::item.index', compact('model', 'module', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        $model = $this->getModel();
        $module = $this->getModule();
        $menu = Menu::findOrFail($id);
        return view($this->getModule()->alias.'::item.create', compact('model', 'module', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreMenuItemRequest $request, $id)
    {
        $request->merge([
            'menu_id' => $id
        ]);

        $this->getModel()->create($request->all());
        return redirect()->back()->with('success', trans('admin::base.resource_created'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view($this->getModule()->alias.'::item.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($menu_id, $id)
    {
        $model = $this->getModel()->findOrFail($id);
        $module = $this->getModule();
        $menu = Menu::findOrFail($menu_id);
        return view($this->getModule()->alias.'::item.edit', compact('model', 'module', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMenuItemRequest $request, $menu_id, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        $request->merge([
            'menu_id' => $menu_id
        ]);

        $model->update($request->all());

        return redirect()->back()->with('success', trans('admin::base.resource_updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($menu_id, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        $model->delete();
        return redirect()->back()->with('success', trans('admin::base.resource_deleted'));
    }
}
