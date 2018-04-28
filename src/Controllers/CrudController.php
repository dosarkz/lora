<?php
namespace Dosarkz\Dosmin\Controllers;

use Dosarkz\Dosmin\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrudController extends Controller
{
    /**
     * @var
     */
    protected $model;
    /**
     * @var
     */
    protected $viewPath;
    /**
     * @var
     */
    protected $formUrl;
    /**
     * @var string default = $modelUrl
     */
    protected $afterSaveRedirectUrl = '/';
    /**
     * @var array
     */
    protected $indexParams = [];
    /**
     * @var array
     */
    protected $createParams = [];
    /**
     * @var array
     */
    protected $editParams = [];
    /**
     * @var array
     */
    protected $showParams = [];
    /**
     * @var array rules for Validator to store modelClass object
     */
    protected $storeValidationRules = [];
    /**
     * @var array rules for Validator to update modelClass object
     */
    protected $updateValidationRules = [];

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getFormUrl()
    {
        return $this->formUrl;
    }

    /**
     * @param mixed $formUrl
     */
    public function setFormUrl($formUrl)
    {
        $this->formUrl = $formUrl;
    }

    /**
     * @return mixed
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * @param mixed $viewPath
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    /**
     * @return array
     */
    public function getIndexParams()
    {
        return $this->indexParams;
    }

    /**
     * @param array $indexParams
     */
    public function setIndexParams($indexParams)
    {
        $this->indexParams = $indexParams;
    }

    /**
     * @return array
     */
    public function getCreateParams()
    {
        return $this->createParams;
    }

    /**
     * @param array $createParams
     */
    public function setCreateParams($createParams)
    {
        $this->createParams = $createParams;
    }

    /**
     * @return array
     */
    public function getEditParams()
    {
        return $this->editParams;
    }

    /**
     * @param array $editParams
     */
    public function setEditParams($editParams)
    {
        $this->editParams = $editParams;
    }

    /**
     * @return array
     */
    public function getShowParams()
    {
        return $this->showParams;
    }

    /**
     * @param array $showParams
     */
    public function setShowParams($showParams)
    {
        $this->showParams = $showParams;
    }

    /**
     * @var
     */
    private $module;

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param $module_alias
     */
    public function setModule($module_alias)
    {
        $module =  Module::where('alias', $module_alias)->first();

        if(!$module)
        {
            return app()->abort(400, 'Module with slug name [' . $module_alias . '] not found');
        }

        $this->module = $module;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->getModel();
        $this->modelCondition($model);
        $this->setIndexParams([
            'models' => $model->orderBy('id', 'DESC')->paginate(15),
            'module'    =>  $this->module,
            'url' => $this->getFormUrl()
        ]);
        return view(sprintf('%s.index', $this->getViewPath()),$this->getIndexParams());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->getModel();

        $this->setIndexParams([
            'model' => $model,
            'url' => $this->getFormUrl(),
            'module'    =>  $this->module,
            'viewPath' => $this->getViewPath()
        ]);
        return view(sprintf('%s.create', $this->getViewPath()),$this->getIndexParams());
    }


    protected function beforeSave(&$data, $model)
    {

    }

    /**
     * @param Request $request
     */
    protected function beforeValidate(Request $request)
    {   }

    /**
     * @param $model
     */
    protected function modelCondition(&$model)
    {   }

    protected function afterSave($model)
    {    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->beforeValidate($request);
        $this->validate($request, $this->storeValidationRules);

        $data = $request->all();
        $model = $this->getModel();
        $this->beforeSave($data, $model);
        $created_model = $model->create($data);
        $this->afterSave($created_model);

        return redirect($this->afterSaveRedirectUrl)->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->getModel()->find($id);

        if(!$model)
        {
            abort(404);
        }

        $this->setShowParams([
            'model' => $model,
            'url' => $this->getFormUrl(),
            'module'    =>  $this->module,
            'viewPath' => $this->getViewPath()
        ]);
        return view(sprintf('%s.show', $this->getViewPath()),$this->getShowParams());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->getModel()->find($id);
        if (!$model) {
            return $this->create();
        }

        $this->setIndexParams([
            'model' => $model,
            'url' => $this->getFormUrl(),
            'module'    =>  $this->module,
            'viewPath' => $this->getViewPath()
        ]);
        return view(sprintf('%s.edit', $this->getViewPath()),$this->getIndexParams());
    }

    /**
     * @description invoked before updating new model
     * @param $data Request data
     */
    protected function beforeUpdate(&$data, $model)
    {
        $this->beforeSave($data, $model);
    }

    protected function afterUpdate($model)
    {
        $this->afterSave($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->beforeValidate($request);
        $this->validate($request, $this->updateValidationRules);

        $model = $this->getModel()->findOrFail($id);
        $data = $request->except(['_method', '_token']);

        $this->beforeUpdate($data, $model);
        $model->update($data);
        $this->afterUpdate($model);

        return redirect($this->afterSaveRedirectUrl)->with('success','success');
    }

    protected function beforeDestroy($id)
    {   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->getModel()->find($id);
        $this->beforeDestroy($id);
        $model->delete();

        return redirect($this->afterSaveRedirectUrl)->with('success', 'deleted');
    }

    /**
     * @param $str
     * @param bool $append_date
     * @return string
     */
    public static function trans_url($str, $append_date = false)
    {
        $tr = array(
            "А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d",
            "Е" => "e", "Ё" => "yo", "Ж" => "j", "З" => "z", "И" => "i",
            "Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n",
            "О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
            "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "c", "Ч" => "ch",
            "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
            "Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-", "." => "", "," => "", "/" => "-", "!" => "", "?" => "", "\"" => "", "'" => "", "%" => "", "["
            => "", "]" => "", "{" => "", "}" => ""
        );

        $str = trim($str);

        if ($append_date) {
            $result = time() . '-' . strtr($str, $tr);
        } else {
            $result = strtr($str, $tr) . '-'. time();
        }

        return $result;
    }

}