<?php

namespace App\Modules\Article\Http\Controllers;

use Dosarkz\Dosmin\Controllers\CrudController;
use App\Modules\Article\Models\Article;
use App\Modules\Image\Models\Image;
use Dosarkz\LaravelUploader\BaseUploader;
use Illuminate\Http\Request;

class BackendController extends CrudController
{
    protected $storeValidationRules = [
        'title' => 'required',
        'short_description'  => 'required',
        'description'  => 'required',
    ];

    public $afterSaveRedirectUrl = '/admin/article';

    public function __construct()
    {
        $this->setModel(new Article());
        $this->setViewPath('article::backend');
        $this->setFormUrl('admin/article');
        $this->setModule('article');
    }

    protected function beforeValidate(Request $request)
    {
        $request->merge([
            'user_id' => auth()->guard('admin')->user()->id,
            'url' => $this->trans_url($request->input('title'))
        ]);
    }

    protected function beforeSave(&$data, $model)
    {
        if (request()->hasFile('image_id'))
        {
            $uploader = BaseUploader::image(request()->file('image_id'), null, true, 800, null, 360);

            $image = Image::create([
                'name' => $uploader->getFileName(),
                'thumb' => $uploader->getThumb(),
                'path' => $uploader->getDestination(),
            ]);

            $data['image_id'] = $image->id;
        }
    }

    public function show($alias)
    {
        $model = $this->getModel()->where('url', $alias)->first();

        if(!$model)
        {
            abort(404);
        }

        $this->setShowParams([
            'model' => $model,
            'url' => $this->getFormUrl(),
            'viewPath' => $this->getViewPath()
        ]);
        return view(sprintf('%s.show', $this->getViewPath()),$this->getShowParams());
    }

    /**
     * @param $page_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage($page_id)
    {
        $article = Article::findOrFail($page_id);

        if(!$article->image_id)
        {
            return redirect()->back();
        }

        $image = Image::findOrFail($article->image_id);

        if(file_exists(public_path($image->getThumb())))
        {
            unlink(public_path($image->getThumb()));
        }
        if(file_exists(public_path($image->getFullImage())))
        {
            unlink(public_path($image->getFullImage()));
        }

        $image->delete();

        $article->image_id = Null;
        $article->save();

        return redirect()->back()->with('success', trans('admin::base.photo_deleted'));
    }
}