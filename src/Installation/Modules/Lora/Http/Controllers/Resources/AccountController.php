<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\Resources;

use Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\BasicController;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\StoreSuperUserRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\UpdateSuperUserRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Models\SuperUserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends BasicController
{
    public function __construct()
    {
        $model = config('superUser.admin.model');
        $this->setModel(new $model);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = $this->getModel()->paginate();

        return view('superUser::index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $model = $this->getModel();
        return view('superUser::create', compact('model'));
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

        return redirect()->back()->with('success', trans('lora::base.resource_created'));
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
