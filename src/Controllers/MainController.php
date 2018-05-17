<?php namespace Dosarkz\Dosmin\Controllers;

use Dosarkz\Dosmin\Models\Module;
use App\Modules\Image\Models\Image;
use App\Modules\SuperUser\Models\SuperUser;
use Dosarkz\Dosmin\Requests\PostSettingRequest;
use Dosarkz\Dosmin\Requests\ResetPasswordRequest;
use Dosarkz\LaravelUploader\BaseUploader;
use Illuminate\Support\Facades\Hash;

class MainController
{
    public function index()
    {
        $countSuperUsers = SuperUser::all()->count();
        $count_modules = Module::all()->count();
        return view('admin::main.index', compact('countSuperUsers', 'count_modules'));
    }

    public function getResetPassword()
    {
        return view('admin::main.reset_password');
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
        return view('admin::main.settings');
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

        return redirect()->back()->with('success', trans('admin::base.settings_updated'));
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