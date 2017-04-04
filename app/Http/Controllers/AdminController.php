<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\MenuItem;
use App\Pages;
use App\User;
use App\DataType;
use App\DataRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\FileValidator;
use App\Price;
use App\Settings;
use Illuminate\Support\Facades\File;
class AdminController extends Controller
{
    private $menuItems;
    private $rightMenuItems;
    private $page;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this -> menuItems      = MenuItem::where('menu_id' , Settings::first()->admin_top_menu)->orderBy('order')->get();
        $this ->rightMenuItems  = MenuItem::where('menu_id' , Settings::first()->admin_left_menu)->orderBy('order')->get();
        $this ->page            = Pages::findSlug($request->segment(1));
        if(empty($this->page)){
            $page = Pages::find(Settings::first()->default_page_header);
        }
    }
    public function index()
    {
        return view('admin.index', [
            'page'          => $this->page,
            'menuItems'     => $this->menuItems,
            'rightMenuItems'=> $this->rightMenuItems
        ]);
    }
    public function browse($slug, Request $request)
    {
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (isset($dataType->model_name) && $dataType->model_name != "Settings") {
            $model           = "App\\".$dataType->model_name;
            $dataTypeContent = $model::orderBy('id', 'DESC')->get();

            if (view()->exists("admin.$slug.browse")) {
                $view = "admin.$slug.browse";
            }
            else {
                $view = "admin.general.browse";
            }
            if($view  && $dataTypeContent){
                return view($view, [
                    'page'            => $this->page,
                    'menuItems'       => $this->menuItems,
                    'rightMenuItems'  => $this->rightMenuItems,
                    'dataTypeContent' => $dataTypeContent,
                    'dataType'        => $dataType,
                ]);

            }else{
                return redirect('admin');
            }
        }
        return redirect('admin');
    }

    public function show($slug, $id)
    {
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (isset($dataType->model_name)) {
            $model           = "App\\".$dataType->model_name;
            $dataTypeContent = $model::find($id);

            if (view()->exists("admin.$slug.read")){
                $view = "admin.$slug.read";}
            else {
                $view = "admin.general.read";
            }
            if($view && $dataTypeContent){
                return view($view, [
                    'page'            => $this->page,
                    'menuItems'       => $this->menuItems,
                    'rightMenuItems'  => $this->rightMenuItems,
                    'dataTypeContent' => $dataTypeContent,
                    'dataType'        => $dataType
                ]);
            }else{
                return redirect("admin/$slug/browse");
            }
        }
        return redirect("admin/$slug/browse");
    }

    public function edit($slug, $id)
    {
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (isset($dataType->model_name)) {
            $model           = "App\\".$dataType->model_name;
            $dataTypeContent = $model::find($id);

            if (view()->exists("admin.$slug.edit-add")) {
                $view = "admin.$slug.edit-add";
            }
            else {
                $view = "admin.general.edit-add";
            }
            if($view  && $dataTypeContent){
                return view($view, [
                    'page'            => $this->page,
                    'menuItems'       => $this->menuItems,
                    'rightMenuItems'  => $this->rightMenuItems,
                    'dataTypeContent' => $dataTypeContent,
                    'dataType'        => $dataType
                ]);
            }else{
                return redirect("admin/$slug/browse");
            }
        }
        return redirect("admin/$slug/browse");
    }

    public function update(Request $request, $slug, $id)
    {
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (isset($dataType->model_name)) {
            $model           = "App\\" . $dataType->model_name;
            $dataTypeContent = $model::find($id);
            $formData        = $request->except('_token');
            $validator       = Validator::make($request->all(), $dataTypeContent->rules($id));

            if ($validator->fails()) {

                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::beginTransaction();
            try {
                if(!empty($formData['password'])){
                    $formData['password'] = bcrypt($formData['password']);
                }
                /*
                if(!empty($formData['deleteImage'])){
                    $filePath = public_path() . DIRECTORY_SEPARATOR . $formData['deleteImage'];
                    if(File::exists($filePath)){
                        File::delete($filePath);
                    }
                    $formData['image'] = "";
                }
                */
                $dataTypeContent->update($formData);
                DB::commit();

                if(method_exists($dataTypeContent, 'uploadFile')) {
                    $dataTypeContent->uploadFile($formData);
                }

            } catch (Exception $e) {
                DB::rollback();
            }

            /*

            if($request->file('image'))
            {
                $saveImage  = new UploadFilesController;
                $ret        = $saveImage->resizeSaveImage($request->file('image'), $dataTypeContent);
                if($ret !== true){
                if($ret !== true){
                    return redirect("admin/$slug/add")
                        ->with("errorsUpload", $ret)
                        ->withInput();
                }
            }
            */
            if($model == "App\Settings"){
                return redirect("admin/$slug/show/$id")
                    ->with('message', "Информация обновлена");
            }else {
                return redirect("admin/$slug/browse")
                    ->with('message', "Информация обновлена {$dataType->display_name_singular}");
            }
        } else {
            return redirect("admin/$slug/browse");
        }
    }

    public function add($slug){

        $dataType = DataType::where('slug', '=', $slug)->first();

        if (view()->exists("admin.$slug.edit-add")){
            $view = "admin.$slug.edit-add";}
        else {
            $view = "admin.general.edit-add";
        }

        return view($view, [
            'page'            => $this->page,
            'menuItems'       => $this->menuItems,
            'rightMenuItems'  => $this->rightMenuItems,
            'dataTypeContent' => Null,
            'dataType'        => $dataType
        ]);
    }

    public function createRecord(Request $request, $slug)
    {
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (isset($dataType->model_name)) {
            $model    = "App\\" . $dataType->model_name;
            $formData = $request->except('_token');

            if ($model && $formData) {
                /*
                try {
                    $model::create($formData);
                }
                catch (QueryException $exception) {
                    $errorInfo = implode(';', $exception->errorInfo);
                    return redirect("admin/$slug/browse")->with('errors', $errorInfo);
                }
                return redirect("admin/$slug/browse")->with('message', "Новая запись добавлена");
                */
                $currentModel = new $model;
                $validator    = Validator::make($request->all(), $currentModel->rules());
                if ($validator->fails()){
                    return redirect("admin/$slug/add")
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::beginTransaction();
                try {
                    if(!empty($formData['password'])){
                        $formData['password'] = bcrypt($formData['password']);
                    }
                    $newModel = $model::create($formData);
                    DB::commit();

                    if(method_exists($newModel, 'uploadFile')) {
                        $newModel->uploadFile($formData);
                    }

                } catch (Exception $e) {
                    DB::rollback();
                }

                /*
                if($request->file('image'))
                {
                    $saveImage = new UploadFilesController;
                    $ret = $saveImage->resizeSaveImage($request->file('image'), $newModel);
                    if($ret !== true){
                        return redirect("admin/$slug/browse")
                            ->with("errorsUplod", $ret)
                            ->withInput();
                    }
                }
                */
                return redirect("admin/$slug/browse")->with('message', "Новая запись добавлена");
            } else
                return redirect("admin/$slug/browse");
        } else
            return redirect("admin/$slug/browse");
    }

    public function deleteRecord(Request $request, $slug, $id)
    {
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (isset($dataType->model_name)) {
            $model = "App\\" . $dataType->model_name;

            DB::beginTransaction();
            try {
                $delModelRecord = $model::find($id);
                $delModelRecord->delete();
                //$model::destroy($id);
                DB::commit();
            }
            /*
            catch (QueryException $exception) {
                $errorInfo = implode(';', $exception->errorInfo);
                return redirect("admin/$slug/browse")->with('errors', $errorInfo);
            }*/
            catch (Exception $e) {
                return redirect("admin/$slug/browse")
                    ->withErrors(['errors' => $e->getMessage()]);
                //DB::rollback();
            }
            return redirect("admin/$slug/browse")->with('message', "Запись удалена");
        }else
            return redirect("admin/$slug/browse");
    }
}
