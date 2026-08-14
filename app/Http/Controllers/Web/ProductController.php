<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCate;
use App\Models\ProductTag;
use App\Models\Spu;
use App\Models\Theme;
use App\Repositories\BrandRepository;
use App\Repositories\CateRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index(ProductRepository $productRepository){
        $products = $productRepository->all();

        return template('product.index',compact('products'));
    }


    public function show($id){
        $product = Product::where('id',$id)->where('status',1)->first();

        if(!$product){
            abort(404);
        }

        $goods_thumbnail_untreated = app('cache.config')->get('goods_thumbnail');
        $goods_thumbnail = [];
        if($goods_thumbnail_untreated){
            $goods_thumbnail = json_decode($goods_thumbnail_untreated,true);
        }

        $goods_delivery_untreated = app('cache.config')->get('goods_delivery');
        $goods_delivery = [];
        if($goods_delivery_untreated){
            $goods_delivery = json_decode($goods_delivery_untreated,true);
        }

        $goods_payment_untreated = app('cache.config')->get('goods_payment');
        $goods_payment = [];
        if($goods_payment_untreated){
            $goods_payment = json_decode($goods_payment_untreated,true);
        }

        $goods_comments_untreated = app('cache.config')->get('goods_comments');
        $goods_comments = [];
        if($goods_comments_untreated){
            $goods_comments = json_decode($goods_comments_untreated,true);
        }

        $goods_instructions_untreated = app('cache.config')->get('goods_instructions');
        $goods_instructions = [];
        if($goods_instructions_untreated){
            $goods_instructions = json_decode($goods_instructions_untreated,true);
        }

        $discount = Product::where('status',1)->where('market_price','>',$product->market_price)->get();


        return template('product.show',compact('product','goods_thumbnail','goods_delivery','goods_payment','goods_comments','goods_instructions','discount'));
    }
}
