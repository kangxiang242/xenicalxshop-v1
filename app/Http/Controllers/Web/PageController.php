<?php


namespace App\Http\Controllers\Web;


use App\Handlers\DeviceTypeHandlers;
use App\Models\Compute;
use App\Models\Faq;
use App\Models\Product;
use App\Repositories\FaqRepository;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function evaluate(Request $request){

        if($request->ajax() && $request->isMethod('POST')){
            $interpretation = app('cache.config')->get('interpretation');
            if($interpretation){
                $interpretation = json_decode($interpretation,true);
                $bmi_status = 2;
                if($request->bmi <= 18.4){
                    $bmi_status = 1;
                }elseif ($request->bmi >= 18.5 && $request->bmi <= 23.9){
                    $bmi_status = 2;
                }elseif ($request->bmi >= 24.0 && $request->bmi <= 27.9){
                    $bmi_status = 3;
                }elseif ($request->bmi >= 28){
                    $bmi_status = 4;
                }

                $inter = [];
                foreach ($interpretation as $item){
                    if($item['bmi'] == $bmi_status && $item['activity'] == $request->activityLevel){
                        $inter = $item;
                        break;
                    }
                }

                $goods = null;
                if($inter['goods']){
                    $goods = Product::with('attr')->where('id',$inter['goods'])->where('status',1)->first();
                }



                Compute::create([
                    'sex'=>$request->sex,
                    'age'=>$request->age,
                    'height'=>$request->height,
                    'weight'=>$request->weight,
                    'motion_level'=>$request->activityLevel,
                    'bmi'=>$request->bmi,
                    'bmr'=>$request->bmr,
                    'tdee'=>$request->tdee,
                    'ip'=>VehicleService::IP(),
                    'user_agent'=>$request->userAgent()
                ]);

                return template('evaluate-result',compact('inter','goods'))->with('bmi',$request->bmi)->with('tdee',$request->tdee)->with('bmr',$request->bmr);

            }
            return "";

        }


        return template('evaluate');
    }

    public function faq(){
        $faq = app(FaqRepository::class)->all();
        return template('faq',compact('faq'));
    }

    public function about(){
        $title = app('cache.config')->get('about_title');
        $content = app('cache.config')->get('about_content');
        $html_code = app('cache.config')->get('about_html_code');
        return template('page',compact('title','content','html_code'));
    }

    public function guide(){
        $title = app('cache.config')->get('notes_buy_title');
        $content = app('cache.config')->get('notes_buy_content');
        return template('page',compact('title','content'));
    }

}
