<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers;

use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\StoreRoleRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\UpdateRoleRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoraRoleController extends BasicController
{
    public function __construct()
    {
        $this->setModel(new Role());
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = $this->getModel()->paginate();
        return view($this->getModule()->alias . '::backend.index', compact('model', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $model = $this->getModel();
        return view($this->getModule()->alias . '::backend.create', compact('model', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->getModel()->create($request->all());

        return redirect('/admin/' . $this->getModule()->alias)
            ->with('success', trans('admin::base.resource_created'));
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
     * @param UpdateRoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        $model->update($request->only('name', 'status_id'));

        return redirect('/admin/' . $this->getModule()->alias)->with('success', trans('admin::base.resource_updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->getModel()->findOrFail($id);
        $model->delete();
        return redirect()->back()->with('success', trans('admin::base.resource_deleted'));
    }
}
