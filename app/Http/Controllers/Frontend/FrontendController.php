<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\MultiImg;
use App\Models\Page;
use App\Models\OrderDetail;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    /*=================== Start Index Methoed ===================*/
    public function index(Request $request)
    {    

        //Product All Status Active
        $products = Product::where('status',1)->orderBy('id','DESC')->get();

        // Search Start
        $sort_search =null;
        if ($request->has('search')){
            $sort_search = $request->search;
            $products = $products->where('name_en', 'like', '%'.$sort_search.'%');
            // dd($products);
        }else{
            $products = Product::where('status',1)->orderBy('id','DESC')->get();
        }
        // $products = $products->paginate(15);
        // Search Start

        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('status','=',1)->limit(5)->get();
        // Header Category End

        // Category Featured all
        $featured_category = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->limit(15)->get();
        
        //Slider
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(10)->get();
        // Product Top Selling
        $product_top_sellings = Product::where('status',1)->orderBy('id','ASC')->limit(2)->get();
        //Product Trending
        $product_trendings = Product::where('status',1)->orderBy('id','ASC')->skip(2)->limit(2)->get();
        //Product Recently Added
        $product_recently_adds = Product::where('status',1)->latest()->skip(2)->limit(2)->get();

        $product_top_rates = Product::where('status',1)->orderBy('regular_price')->limit(2)->get();
        // Home Banner
        $home_banners = Banner::where('status',1)->where('position',1)->orderBy('id','DESC')->get();

        // Daily Best Sells 
        $todays_sale  = OrderDetail::whereDay('created_at',date('d'))->get();
        // dd($todays_sale);

        //Home2 featured category
        $home2_featured_categories = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->get();
        // Hot deals product
        $hot_deals = Product::where('status',1)->where('is_deals',1)->latest()->take(4)->get();

        return view('frontend.home', compact('categories','sliders','featured_category','products','product_top_sellings','product_trendings','product_recently_adds','product_top_rates','home_banners','sort_search','todays_sale','home2_featured_categories','hot_deals'));
    } // end method

    /* ========== Start ProductDetails Method ======== */
    public function productDetails($slug){

        $product = Product::where('slug', $slug)->first();
        // dd($product);
        $multiImg = MultiImg::where('product_id',$product->id)->get();
        // dd($multiImg);

        /* ================= Product Color Eng ================== */
        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        /* ================= Product Size Eng =================== */
        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        /* ================= Realted Product =============== */
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$product->id)->orderBy('id','DESC')->get();

        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
        $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();
        return view('frontend.product.product_details', compact('product','multiImg','categories','new_products','product_color_en','product_size_en','relatedProduct'));
    }

    /* ========== Start CatWiseProduct Method ======== */
    public function CatWiseProduct(Request $request,$slug){

        $category = Category::where('slug', $slug)->first();
        // dd($category);
        
        $products = Product::where('status', 1)->where('category_id',$category->id)->orderBy('id','DESC')->paginate(5);
        // Price Filter
        if ($request->get('filter_price_start')!== Null && $request->get('filter_price_end')!== Null ){ 
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start>0 && $filter_price_end>0) {
                $products = Product::where('status','=',1)->where('category_id',$category->id)->whereBetween('regular_price',[$filter_price_start,$filter_price_end])->paginate(5);
                // dd($products);
            }

        }

        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->get();      
        // dd($products);

        return view('frontend.product.category_view',compact('products','categories','category'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

    /* ========== Start SubCatWiseProduct Method ======== */
    public function SubCatWiseProduct($id,$slug){

        $products = Product::where('status','=',1)->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(5);
        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
        $subcategory = SubCategory::find($id);
        $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

        return view('frontend.product.subcategory_view',compact('products','categories','subcategory','new_products'));
    } // end method
    /* ========== End SubCatWiseProduct Method ======== */

    /* ========== Start ChildCatWiseProduct Method ======== */
    public function ChildCatWiseProduct($id,$slug){

        $products = Product::where('status','=',1)->where('subsubcategory_id',$id)->orderBy('id','DESC')->paginate(5);
        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
        $subsubcategory = SubSubCategory::find($id);
        $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

        return view('frontend.product.childcategory_view',compact('products','categories','subsubcategory','new_products'));
    } // end method
    /* ========== End ChildCatWiseProduct Method ======== */

    /* ========== Start TagWiseProduct Method ======== */
    // public function TagWiseProduct($id,$slug){

    //     $products = Product::where('status','=',1)->where('tag_id',$id)->orderBy('id','DESC')->paginate(5);
    //     $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
    //     $tags = Tag::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
    //     $tag = Tag::find($id);
    //     $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

    //     return view('frontend.product.tag_view',compact('products','categories','tags','tag','new_products'));
    // } // end method
    /* ========== End TagWiseProduct Method ======== */


    /* ================= Start ProductViewAjax Method ================= */
    public function ProductViewAjax($id){

        $product = Product::with('category','brand')->findOrFail($id);
        $attribute_values = json_decode($product->attribute_values);

        $attributes = new Collection;
        foreach($attribute_values as $key => $attribute_value){
            $attr = Attribute::select('id','name')->where('id',$attribute_value->attribute_id)->first();
            // $attribute->name = $attr->name;
            // $attribute->id = $attr->id;
            $attr->values = $attribute_value->values;
            $attributes->add($attr);
        }
    

        return response()->json(array(
            'product' => $product,
            'attributes' => $attributes,
        ));
    }
    /* ================= END PRODUCT VIEW WITH MODAL METHOD =================== */


    public function pageAbout($slug){
        $page = Page::where('slug', $slug)->first();
        return view('frontend.settings.page.about',compact('page'));
    }

    /* ================= Start Product Search =================== */
    public function ProductSearch(Request $request){

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->searchCategory;
        // echo "$item";

        // Header Category Start //
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();
        if($category_id == 0){
            $products = Product::where('name_en','LIKE',"%$item%")->where('status'
            , 1)->latest()->get();
        }else{
            $products = Product::where('name_en','LIKE',"%$item%")->where('category_id', $category_id)->where('status'
            , 1)->latest()->get();
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();

        return view('frontend.product.search',compact('products','categories','attributes'));

    } // end method 

    /* ================= End Product Search =================== */

    /* ================= Start Advance Product Search =================== */
    public function advanceProduct(Request $request){

        // return $request;

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->category;
        // echo "$item";

        // Header Category Start //
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();

        if($category_id == 0){
            $products = Product::where('name_en','LIKE',"%$item%")->where('status'
            , 1)->latest()->get();
        }else{
            $products = Product::where('name_en','LIKE',"%$item%")->where('category_id', $category_id)->where('status'
            , 1)->latest()->get();
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();

        return view('frontend.product.advance_search',compact('products','categories','attributes'));

    } // end method 

    /* ================= End Advance Product Search =================== */

    /* ================= Start Hot Deals Page Show =================== */
    public function hotDeals(Request $request){

        // Hot deals product
        $products = Product::where('status',1)->where('is_deals',1)->paginate(5);

        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->where('is_deals',1)->latest()->paginate(10);
            // dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //
        return view('frontend.deals.hot_deals',compact('attributes','products'));

    } // end method 
} 
