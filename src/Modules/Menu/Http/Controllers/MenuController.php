<?php

namespace Dosarkz\LaravelAdmin\Modules\Menu\Http\Controllers;

use Dosarkz\LaravelAdmin\Controllers\ModuleController;
use Dosarkz\LaravelAdmin\Modules\Menu\Http\Requests\StoreMenuRequest;
use Dosarkz\LaravelAdmin\Modules\Menu\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuController extends ModuleController
{
    public function __construct()
    {
        $model = config('menu.admin.model');
        $this->setModule(config('menu.module.alias'));
        $this->setModel(new $model);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = $this->getModel()->paginate();
        $module = $this->getModule();
        return view($this->getModule()->alias.'::index', compact('model', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $model = $this->getModel();
        $module = $this->getModule();
        return view($this->getModule()->alias.'::create', compact('model', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreMenuRequest $request)
    {
        $request->merge([
            'user_id' => auth()->guard('admin')->user()->id
        ]);

        $this->getModel()->create($request->all());
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view($this->getModule()->alias.'::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = $this->getModel()->findOrFail($id);
        $module = $this->getModule();
        return view($this->getModule()->alias.'::edit', compact('model', 'module'));
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMenuRequest $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        $model->update($request->all());

        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->getModel()->findOrFail($id);
        $model->delete();
        return redirect()->back()->with('success', 'deleted');
    }
}
