<?php

namespace App\Modules\SuperUser\Http\Controllers;

use Dosarkz\Dosmin\Controllers\ModuleController;
use App\Modules\SuperUser\Http\Requests\StoreSuperUserRequest;
use App\Modules\SuperUser\Http\Requests\UpdateSuperUserRequest;
use App\Modules\SuperUser\Models\SuperUserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperUserController extends ModuleController
{
    public function __construct()
    {
        $model = config('superUser.admin.model');
        $this->setModel(new $model);
        $this->setModule('superUser');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = $this->getModel()->paginate();
        $module = $this->getModule();

        return view('superUser::index', compact('model', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $model = $this->getModel();
        $module = $this->getModule();

        return view('superUser::create', compact('model', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreSuperUserRequest $request)
    {
        $request->merge([
            'password' => bcrypt($request->input('password'))
        ]);

        $user  =  $this->getModel()->create($request->all());

        SuperUserRole::firstOrCreate([
            'super_user_id' => $user->id,
            'role_id' => $request->input('role_id'),
        ]);

        return redirect()->back()->with('success', trans('admin::base.resource_created'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('superUser::show');
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

        return view('superUser::edit', compact('model', 'module'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSuperUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSuperUserRequest $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);
        $request->merge([
            'password' => bcrypt($request->input('password'))
        ]);

        SuperUserRole::firstOrCreate([
            'super_user_id' => $model->id,
            'role_id' => $request->input('role_id'),
        ]);

        $model->update($request->all());

        return redirect()->back()->with('success', trans('admin::base.resource_updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->getModel()->findOrFail($id);
        if($model->currentUser($id))
        {
            return redirect()->back()->with('error', 'You cannot delete current admin account');
        }

        $model->delete();
        return redirect()->back()->with('success', trans('admin::base.resource_deleted'));
    }
}
