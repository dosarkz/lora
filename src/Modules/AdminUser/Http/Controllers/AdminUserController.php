<?php

namespace Dosarkz\LaravelAdmin\Modules\AdminUser\Http\Controllers;

use Dosarkz\LaravelAdmin\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminUserController extends ModuleController
{
    public function __construct()
    {
        $model = config('admin-user.model');
        $this->setModel(new $model);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = $this->getModel()->paginate();
        return view('adminUser::index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('adminUser::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('adminUser::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('adminUser::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
