<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use App\MenuItem;
use App\Price;
use App\Certificate;
use App\Settings;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\RequestUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $menuItems;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this -> menuItems = MenuItem::where('menu_id' ,
            Settings::first()->user_top_menu)
            ->orderBy('order')
            ->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private function getPage(Request $request){
        $page = Pages::findSlug($request->segment(1));
        if(empty($page)){
            $page = Pages::find(Settings::first()->default_page_header);
        }
        return $page;
    }
    public function index(Request $request)
    {
        $page = $this->getPage($request);

        return view('home',[
            'page'      => $page,
            'menuItems' => $this->menuItems
        ]);
    }

    public function about_me(Request $request){
        $page         = $this->getPage($request);
        $certificates = Certificate::orderBy('order')->get();
        return view('about_me', [
            'page'          => $page,
            'menuItems'     => $this->menuItems,
            'certificates'  => $certificates
        ]);
    }

    public function contact(Request $request){
        $page = $this->getPage($request);
        return view('contact', [
            'page'     => $page,
            'menuItems'=> $this->menuItems
        ]);
    }


    public function prices(Request $request){
        $page  = $this->getPage($request);
        $price = Price::findByStatus('PUBLISHED');

        return view('price', [
            'page'      => $page,
            'menuItems' => $this->menuItems,
            'price'     => $price
        ]);
    }

    public function exchangeRatePrice(Request $request)
    {
        if ($request->ajax()) {
            $price = Price::findByStatus('PUBLISHED');
            if (isset($_GET) && !empty($_GET['currency']) && $_GET['currency'] != "UAH") {
                $currency = $_GET['currency'];
                if (@$json = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json')) {
                    $obj = json_decode($json, true);
                    if (!empty($obj)) {
                        foreach ($obj as $rate) {
                            if ($rate['cc'] == $currency) {
                                foreach ($price as $value) {
                                    $priceFloat = $value->price_UAH / $rate['rate'];
                                    $priceInt = round($priceFloat / 5, 0, PHP_ROUND_HALF_UP);
                                    $priceCurrecy [$value->id] = $priceInt * 5;
                                }
                                return Response::json(['success' => true, 'price' => $priceCurrecy], 200);
                            }
                        }
                    }
                }

                if (!isset($priceCurrecy)) {
                    return Response::json(['success' => false], 400);
                }
            }
            if ($_GET['currency'] == "UAH") {
                foreach ($price as $value) {
                    $priceCurrecy [$value->id] = $value->price_UAH;
                }
                return Response::json(['success' => true, 'price' => $priceCurrecy], 200);
            }
        }
    }

    public function sendEmail(Request $request)
    {
        if ($request->ajax()){
            $validator = Validator::make($request->all(), [
                'phone' => 'required|min:10|phone',
                'name'  => 'required|min:3'
            ]);
            $errors = implode(' ', $validator->messages()->all());

            if ($validator->fails()){
                    return Response::json(['success' => false, 'errors' => $errors], 400);
            }

            $formData = $request->except('_token');
            Mail::send('email.request_user', ['content' => $formData], function ($m) {
                $m->to(Settings::first()->email)->subject('Заявка на консультацию');
            }) ;
            if(Mail::failures()){
                return Response::json([
                    'success' => false,
                    'errors'  => "Не удалось отправить заявку, пожалуйста, попробуйте еще раз."
                ], 400);

            }else{
                DB::beginTransaction();
                try {
                    if(Auth::user()){
                        $formData['user_id'] = Auth::user()->id;
                    }
                    $formData['created_at'] = Carbon::now();
                    RequestUser::create($formData);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                }
                return Response::json([
                    'success' => true
                ], 200);
            }
        }
    }
}
