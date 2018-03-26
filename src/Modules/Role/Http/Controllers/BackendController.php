<?php

namespace Dosarkz\LaravelAdmin\Modules\Role\Http\Controllers;

use Dosarkz\LaravelAdmin\Controllers\ModuleController;
use Dosarkz\LaravelAdmin\Modules\Role\Http\Requests\StoreRoleRequest;
use Dosarkz\LaravelAdmin\Modules\Role\Http\Requests\UpdateRoleRequest;
use Dosarkz\LaravelAdmin\Modules\Role\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BackendController extends ModuleController
{
    public function __construct()
    {
        $this->setModule('role');
        $this->setModel(new Role());
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = $this->getModel()->paginate();
        $module = $this->getModule();
        return view($this->getModule()->alias . '::backend.index', compact('model', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $model = $this->getModel();
        $module = $this->getModule();
        return view($this->getModule()->alias . '::backend.create', compact('model', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $model = $this->getModel()->create($request->all());

        return redirect('/admin/' . $this->getModule()->alias)->with('success', 'success');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
      //  return view($this->getModule()->alias . '::show');
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
        return view($this->getModule()->alias . '::backend.edit', compact('model', 'module'));
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        $model->update($request->only('name'));

        return redirect('/admin/' . $this->getModule()->alias)->with('success', 'success');
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