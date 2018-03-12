<?php

namespace App\Modules\Office\Http\Controllers;


use App\Modules\Office\Http\Requests\NewOrderRequest;
use App\Modules\Office\Http\Requests\ReservationOfficeRequest;
use App\Modules\Office\Models\Office;
use Dosarkz\LaravelAdmin\Controllers\ModuleController;
use Illuminate\Support\Facades\Mail;

class FrontendController extends ModuleController
{

    public function __construct()
    {
        $this->setModule('office');
        $this->setModel(new Office());
    }


    public function index()
    {
        $offices = Office::where('status_id', Office::STATUS_ACTIVE)
            ->get();

        return view($this->getModule()->alias.'::frontend.index', compact('offices'));
    }

    public function newOrder(NewOrderRequest $request)
    {
        Mail::send($this->getModule()->alias.'::frontend.emails.new_office_order', ['request' => $request->all()], function ($mail) {
            $mail->from(env('MAIL_USERNAME'), 'EmeraldTower');
            $mail->to(env('MAIL_NEW_OFFICE_ORDER_TO'))
                ->subject('Заявка на арендную площадь с сайта emeraldtower.kz');
        });

       // $data = array();
        //$data['success'] = true;
        //return response()->json($data);

        return redirect()->back()->with('success', 'success');
    }

    public function reservation(ReservationOfficeRequest $request)
    {
        Mail::send($this->getModule()->alias.'::frontend.emails.reservation_office_order', ['request' => $request->all()], function ($mail) {
            $mail->from(env('MAIL_USERNAME'), 'EmeraldTower');
            $mail->to(env('MAIL_RESERVATION_OFFICE_ORDER_TO'))
                ->subject('Заявка на бронирование офиса с сайта emeraldtower.kz');
        });

        // $data = array();
        //$data['success'] = true;
        //return response()->json($data);

        return redirect()->back()->with('success', 'success');
    }


}
