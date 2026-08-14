<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\BrandRepository;
use App\Repositories\CateRepository;
use App\Repositories\FaqRepository;
use App\Repositories\NewRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index(ProductRepository $productRepository,NewRepository $newRepository){
        $products = $productRepository->limit(7)->all();

        $for_people_untreated = app('cache.config')->get('for_people');
        $for_people = [];
        if($for_people_untreated){
            $for_people = json_decode($for_people_untreated);
        }


        $news = $newRepository->top();

        return template('index',compact('products','news','for_people'));
    }


}
