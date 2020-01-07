<?php
namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers;

use Dosarkz\Lora\Installation\Modules\Lora\Models\Module;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Image;
use Dosarkz\Lora\Installation\Modules\Lora\Models\SuperUser;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\PostSettingRequest;
use Dosarkz\Lora\Installation\Modules\Lora\Http\Requests\ResetPasswordRequest;
use Dosarkz\LaravelUploader\BaseUploader;
use Illuminate\Support\Facades\Hash;

class AppController extends BasicController
{
    public function index()
    {
        $countSuperUsers = SuperUser::all()->count();
        $count_modules = Module::all()->count();
        return $this->view('main.index', compact('countSuperUsers', 'count_modules'));
    }

    public function getResetPassword()
    {
        return $this->view('main.reset_password');
    }

    public function postResetPassword(ResetPasswordRequest $request)
    {
        if (Hash::check($request->input('old_password'), auth()->guard('admin')->user()->password))
        {
            auth()->guard('admin')->user()->password = bcrypt($request->input('password'));
            auth()->guard('admin')->user()->save();

            return redirect()->back()->with('success','Success');
        }

        return redirect()->back()->with('error','Error');
    }

    public function settings()
    {
        return $this->view('main.settings');
    }


    public function postSettings(PostSettingRequest $request)
    {
        if (Hash::check($request->input('old_password'), auth()->guard('admin')->user()->password))
        {
            auth()->guard('admin')->user()->password = bcrypt($request->input('password'));
            auth()->guard('admin')->user()->save();

            return redirect()->back()->with('success',trans('admin::base.password_updated'));
        }

        if($request->has('image'))
        {
            $user = auth()->guard('admin')->user();

            if($user->image)
            {
                if(file_exists(public_path($user->image->getThumb())))
                {
                    unlink(public_path($user->image->getThumb()));
                }

                if(file_exists(public_path($user->image->getFullImage())))
                {
                    unlink(public_path($user->image->getFullImage()));
                }

            }
           $uploader =  BaseUploader::image($request->file('image'));

            $image = Image::create([
                'name' => $uploader->getFileName(),
                'thumb' => $uploader->getThumb(),
                'path' => $uploader->getDestination(),
            ]);

            auth()->guard('admin')->user()->update([
                'avatar' => $image->id
            ]);
        }

        if($request->has('locale'))
        {
            app()->setLocale($request->input('locale'));
            session()->put('locale', $request->input('locale'));
        }

        return redirect()->back()->with('success', trans('lora::base.settings_updated'));
    }

    public function removeImage()
    {
        $model = auth()->guard('admin')->user();

        if($model->image)
        {
            if(file_exists(public_path($model->image->getThumb())))
            {
                unlink(public_path($model->image->getThumb()));
            }

            if(file_exists(public_path($model->image->getFullImage())))
            {
                unlink(public_path($model->image->getFullImage()));
            }

            $model->image->delete();
        }

        $model->avatar = null;
        $model->save();

        return redirect()->back()->with('success', 'Фото успешно удалено');
    }
}
