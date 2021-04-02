<?php

namespace App\Http\Controllers;

use App\City;

use DB;
use App\Tag;
use App\Page;
use App\Post;
use App\Category;
use App\Resource;
use App\Service;
use App\Module;
use App\Project;
use App\Scopes\ActiveScope;
use App\Store;
use App\Form;
use App\Blog;
use App\Contact;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use LaravelLocalization;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Illuminate\Support\Facades\Route;

//custom pagination
use App\Support\Collection;
use phpDocumentor\Reflection\Types\Null_;

class SiteController extends Controller
{
    private $menu_mapping;
    public function __construct() {
        Page::addGlobalScope(new ActiveScope);
        Post::addGlobalScope(new ActiveScope);
        Category::addGlobalScope(new ActiveScope);
    }

    private function menu_mapping_generate(){
        $menu_list = DB::table('tbl_categories')
            ->join('tbl_modules', 'tbl_categories.cid', '=', 'tbl_modules.id')
            ->select('tbl_modules.alias_vn AS module_alias_vn', 'tbl_modules.alias_en AS module_alias_en','tbl_categories.alias_vn', 'tbl_categories.alias_en' )
            ->get();
        // dd($menu_list);

        $menu_mapping_en = array(
            '/en' => '/vi', // Homepage
        );
        $menu_mapping_vi = array(
            '/vi' => '/en', // Homepage
        );
        if(!empty($menu_list)){
            foreach($menu_list as $menu){
                // Parent
                $url_vi = '/vi/'.$menu->module_alias_vn;
                $url_en = '/en/'.$menu->module_alias_en;
                $menu_mapping_en[$url_en] = $url_vi;
                $menu_mapping_vi[$url_vi] = $url_en;
                
                // Child
                $url_vi = '/vi/'.$menu->module_alias_vn.'/'.$menu->alias_vn;
                $url_en = '/en/'.$menu->module_alias_en.'/'.$menu->alias_en;
                $menu_mapping_en[$url_en] = $url_vi;
                $menu_mapping_vi[$url_vi] = $url_en;
                
            }
        }
        $menu_mapping = array();
        $menu_mapping['menu_mapping_en'] = $menu_mapping_en;
        $menu_mapping['menu_mapping_vi'] = $menu_mapping_vi;
        
        // dd($menu_mapping);
        $menu_mapping_json_str = json_encode($menu_mapping);

        return $menu_mapping_json_str;
    }

    public function index() {
        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();
    //    var_dump($menu);die();
        $category = Category::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $category = $category->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $category = $category->orderBy('id','asc')->get();
        $hoidong = Post::where('desc_vn','hoidong')->orderBy('ordering','desc')->orderBy('created_at','desc')->get();
                
        
        $projects = Project::where('cid',1)->orderBy('sticky','desc')->orderBy('ordering','desc')->orderBy('created_at','desc')->orderBy('id','desc')->limit(10)->get();

        

    
        $page = Page::where('template','home')->orderBy('id','desc')->first();
        // var_dump($category);die;
        //hình slide
        $slides = Project::where('render',1)->orderBy('ordering','asc')->orderBy('created_at','desc')->orderBy('id','desc')->get();
        $data_pc = [];
            $data_pc['slide_pc']= $slides;
            $i= 0;
            foreach($data_pc['slide_pc'] as $slides_pc){
                $img = empty($slides_pc->resource_id) ? [] : Resource::where('id',$slides_pc->resource_id)->first();
                $data_pc['slide_pc'][$i]->image_pc = $img->name;
                $i++;
            }
        $slide_mobile = Project::where('render',1)->whereNotIn('invest_id',['Null'])->orderBy('ordering','asc')->orderBy('id','desc')->get();
        $data_mobile = [];
            $data_mobile['slide_mobile']= $slide_mobile;
           $i= 0;
           foreach($data_mobile['slide_mobile'] as $slides_mobile){
               $img = empty($slides_mobile->invest_id) ? [] : Resource::where('id',$slides_mobile->invest_id)->first();
               $data_mobile['slide_mobile'][$i]->image_mobile = $img->name;
               $i++;
           }
           
        $showWelcome = true;
        // $galleries = empty($page->gallery) ? [] : Resource::whereIn('id', $page->gallery)->get();
        //link image service
        $resource = Resource::where('type','page')->pluck('name','id');
        $meta_tite = '123';//$page->meta_title;
        $mea_desc = '123';//$page->meta_desc;
        $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
        $porfolio = Post::where('desc_vn','porfolio')->where('display','1')->first();
        return view('page.home',compact('hoidong','projects','menu','category','page','resource','meta_tite','mea_desc','showWelcome','data_pc','data_mobile','icon','porfolio'));
    }
    public function home() {
        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();
       // var_dump($menu);die();
        $category = Category::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $category = $category->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $category = $category->orderBy('id','asc')->get();
        $hoidong = Post::where('desc_vn','hoidong')->orderBy('ordering','desc')->orderBy('created_at','desc')->get();
                
        
        $projects = Project::where('cid',1)->orderBy('sticky','desc')->orderBy('ordering','desc')->orderBy('created_at','desc')->orderBy('id','desc')->limit(10)->get();
        

    
        $page = Page::where('template','home')->orderBy('id','desc')->first();
        // var_dump($category);die;
        //hình slide
        $slides = Project::where('render',1)->orderBy('ordering','asc')->orderBy('created_at','desc')->orderBy('id','desc')->get();
        $data_pc = [];
            $data_pc['slide_pc']= $slides;
            $i= 0;
            foreach($data_pc['slide_pc'] as $slides_pc){
                $img = empty($slides_pc->resource_id) ? [] : Resource::where('id',$slides_pc->resource_id)->first();
                $data_pc['slide_pc'][$i]->image_pc = $img->name;
                $i++;
            }
        $slide_mobile = Project::where('render',1)->whereNotIn('invest_id',['Null'])->orderBy('ordering','asc')->orderBy('id','desc')->get();
        $data_mobile = [];
            $data_mobile['slide_mobile']= $slide_mobile;
           $i= 0;
           foreach($data_mobile['slide_mobile'] as $slides_mobile){
               $img = empty($slides_mobile->invest_id) ? [] : Resource::where('id',$slides_mobile->invest_id)->first();
               $data_mobile['slide_mobile'][$i]->image_mobile = $img->name;
               $i++;
           }
           
        
        $showWelcome = false;
        // $galleries = empty($page->gallery) ? [] : Resource::whereIn('id', $page->gallery)->get();
        //link image service
        $resource = Resource::where('type','page')->pluck('name','id');
        $meta_tite = '123';//$page->meta_title;
        $mea_desc = '123';//$page->meta_desc;
        $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
        $porfolio = Post::where('desc_vn','porfolio')->where('display','1')->first();
        return view('page.home',compact('hoidong','projects','menu','category','page','resource','meta_tite','mea_desc','showWelcome','data_pc','data_mobile','icon','porfolio'));
    }
    public function work(Request $request){
        // FOR MULTILANG MENU
        $menu_mapping_json_str = $this->menu_mapping_generate();

        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();
        $category = Category::where('cid',1);
        if(\Lang::getLocale() == 'en'){
            $category = $category->whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:en]',-1)) > 3");
        }
        $category = $category->orderBy('id','asc')->get();
        if(\Lang::getLocale() == 'en'){
            $all = $category->where('alias_en','all')->first();
         }else{
            $all = $category->where('alias_vn','tat-ca')->first();
         }
         $projects = Project::whereNotIn('mcat_id',['Null'])->where('address',NULL)->where('active',1)->orderBy('created_at','desc')->orderBy('id','desc')->get();
         $data_img = [];
            $data_img['projects']= $projects;
            $i= 0;
            foreach($data_img['projects'] as $project){
                $mcat_id = (array) $project->mcat_id;
                $mcat_id = array_map('intval', $mcat_id);
                $data_img['projects'][$i]->cat_id = $mcat_id;
                $img = empty($project->resource_id) ? [] : Resource::where('id',$project->resource_id)->first();
                $data_img['projects'][$i]->image = $img->name;
                $i++;
        }
        
        $resource = Resource::where('type','page')->pluck('name','id');
        $meta_tite = '';//$page->meta_title;
        $mea_desc = '';//$page->meta_desc;
        $form = 'works';
        $check = 1; 
        $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();

        return view('page.work', compact('menu','category','projects','resource','meta_tite','mea_desc','form','check','all','data_img','icon', 'menu_mapping_json_str'));
    }
    
    public function workList(Request $request, $slug){
        // FOR MULTILANG MENU
        $menu_mapping_json_str = $this->menu_mapping_generate();

        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();

        if($slug == ''){
            if(LaravelLocalization::getCurrentLocale() == 'vi'){
                $slug = 'quy-hoach-do-thi';
            }else{
                $slug = 'abc-dia';
            }
        }
        $category = Category::where('cid',1);

        //check page là list hay detail
        if(\Lang::getLocale() == 'en'){
            $checkPage= $category->where("alias_en",$slug)->first();
        }else{
            $checkPage= $category->where("alias_vn",$slug)->first();
        }
        $form = 'works';
       // var_dump($slug);die;
        
        if($checkPage){
            // $checkPage = $checkPage->pluck('cid', 'id');
            if(\Lang::getLocale() == 'en'){
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:en]',-1)) > 3");
             }else{
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:vi]',-1)) > 3");
             }
             $categories = $categories->where('cid',1)->orderBy('id','asc')->get();
             if(\Lang::getLocale() == 'en'){
                $all = $categories->where('alias_en','all')->first();
             }else{
                $all = $categories->where('alias_vn','tat-ca')->first();
             }
            
            $projects = Project::whereNotIn('mcat_id',['Null'])->where('address',NULL)->where('active',1)->orderBy('created_at','desc')->orderBy('id','desc')->get();
            $data_img = [];
            $data_img['projects']= $projects;
            $i= 0;
            foreach($data_img['projects'] as $project){
                $mcat_id = (array) $project->mcat_id;
                $mcat_id = array_map('intval', $mcat_id);
                $data_img['projects'][$i]->cat_id = $mcat_id;
                $img = empty($project->resource_id) ? [] : Resource::where('id',$project->resource_id)->first();
                $data_img['projects'][$i]->image = $img->name;
                $i++;
            }
            //var_dump($categories);die;
            $contents = array();
            foreach ($categories as $cats) {
                foreach ($projects as $pro) {
                    if ($cats->id == $pro->cat_id) {
                        $contents[$cats->id][] = $pro->id;
                        
                    }
                }
            }
            //     var_dump(json_encode($contents));
            // die();
            $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
            return view('page.workList', compact('menu','projects','slug','categories','form','checkPage','all','data_img','icon', 'menu_mapping_json_str'));
        }else{
            if(\Lang::getLocale() == 'en'){
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:en]',-1)) > 3");
             }else{
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:vi]',-1)) > 3");
             }
            $categories = $categories->where('cid',1)->orderBy('id','asc')->get();
            $projects = Project::where('address',NULL)->where('id',$slug)->first();
            $gallery = (array) $projects->img_slide;
            $gallery = Resource::whereIn('id', $gallery)->get();
            $related = Project::where('address',NULL)->get();
            $data_img = [];
            $data_img['related']= $related;
            $i= 0;
            foreach($data_img['related'] as $relateds){
                $img = empty($relateds->resource_id) ? [] : Resource::where('id',$relateds->resource_id)->first();
                $data_img['related'][$i]->image = $img->name;
                $i++;
            }
            $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
            return view('page.slideDetail',  compact('menu','form','categories','projects','gallery','data_img','icon', 'menu_mapping_json_str'));
        }
    }
    public function workDetail(Request $request,$slug,$permalink){
        // FOR MULTILANG MENU
        $menu_mapping_json_str = $this->menu_mapping_generate();

        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();

        if($slug == ''){
            if(LaravelLocalization::getCurrentLocale() == 'vi'){
                $slug = 'quy-hoach-do-thi';
            }else{
                $slug = 'abc-dia';
            }
        }
        $category = Category::where('cid',1);

        //check page là list hay detail
        if(\Lang::getLocale() == 'en'){
            $checkPage= $category->where("alias_en",$slug)->first();
        }else{
            $checkPage= $category->where("alias_vn",$slug)->first();
        }
        $form = 'works';
       // var_dump($slug);die;
        if(\Lang::getLocale() == 'en'){
            $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:en]',-1)) > 3");
            }else{
            $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:vi]',-1)) > 3");
            }
        $categories = $categories->where('cid',1)->orderBy('id','asc')->get();
        $projects = Project::where('address',NULL)->where('id',$permalink)->first();
        $gallery = (array) $projects->img_slide;
        $gallery = Resource::whereIn('id', $gallery)->get();
        if(\Lang::getLocale() == 'en'){
            $cat_id= $categories->where("alias_en",$slug)->first();
        }else{
            $cat_id= $categories->where("alias_vn",$slug)->first();
        }
        if($cat_id->id == 6){
            
            $related = Project::where('address',NULL)->whereNotIn('mcat_id',['Null'])->get();
        }
        else{
            $related = Project::where('address',NULL)->where ('mcat_id','LIKE', '%' . $cat_id->id . '%')->get();
        }
        $data_img = [];
        $data_img['related']= $related;
        $i= 0;
        foreach($data_img['related'] as $relateds){
            $img = empty($relateds->resource_id) ? [] : Resource::where('id',$relateds->resource_id)->first();
            $data_img['related'][$i]->image = $img->name;
            $i++;
        }
        $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
        return view('page.worksDetail',  compact('menu','form','categories','projects','gallery','data_img','icon','slug','cat_id', 'menu_mapping_json_str'));
    }
    public function firm(Request $request){
        // FOR MULTILANG MENU
        $menu_mapping_json_str = $this->menu_mapping_generate();

        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();
        $category = Category::where('cid',2);

        if(\Lang::getLocale() == 'en'){
            $category = $category->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $category = $category->orderBy('id','asc')->get();
        if(\Lang::getLocale() == 'en'){
            $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
         }else{
            $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
         }
        //  $about = $Post->where('id',1)->first();
        if(\Lang::getLocale() == 'en'){
            $about = $Post->where('alias_en','about')->where('active',1)->first();
         }else{
            $about = $Post->where('alias_vn','gioi-thieu')->where('active',1)->first();
         }
         $hoidong = Post::where('desc_vn','hoidong');
             if(\Lang::getLocale() == 'en'){
                $hoidongs = $hoidong->whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
             }else{
                $hoidongs = $hoidong->whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
             }
             $hoidongs = $hoidongs->where('active',1)->orderBy('ordering','asc')->get();
             $data = [];
             $data['hoidong']= $hoidongs;
            $i= 0;
           
            foreach($data['hoidong'] as $mem){
                $img = empty($mem->resource_id) ? [] : Resource::where('id',$mem->resource_id)->first();
                $data['hoidong'][$i]->image = $img->name;
                $i++;
            }
            $award =[];
            $giaithuong =  Post::where('cat_id',10)->where('active',1)->orderBy('created_at','desc')->orderBy('id','desc')->get();
             $j= 0;
             $award['giaithuong']= $giaithuong;
             foreach($award['giaithuong'] as $awards){
                $img = empty($awards->resource_id) ? [] : Resource::where('id',$awards->resource_id)->first();
                $award['giaithuong'][$j]->image = $img->name;
                $j++;
            }
            $blog =[];
            $tintuc = Post::where('cat_id',9)->where('active',1)->orderBy('created_at','desc')->orderBy('id','desc')->get();
            $k= 0;
             $blog['tintuc']= $tintuc;
             foreach($blog['tintuc'] as $tintuc){
                $img = empty($tintuc->resource_id) ? [] : Resource::where('id',$tintuc->resource_id)->first();
                $blog['tintuc'][$k]->image = $img->name;
                $k++;
            }
        $diachi_hn = Project::where('id','29')->first();
        $diachi_hcm = Project::where('id','28')->first();
        
        $email = Post::where('desc_vn','email')->orderBy('id','asc')->get();
        $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
        $porfolio = Post::where('desc_vn','porfolio')->where('display','1')->first();
       
        $meta_tite = '';//$page->meta_title;
        $mea_desc = '';//$page->meta_desc;
        $form = 'firm';
        $check = 2; 
        return view('page.firm', compact('menu','category','about','meta_tite','mea_desc','form','check','data','award','blog','diachi_hn','diachi_hcm','email','icon','porfolio', 'menu_mapping_json_str'));
    }

    public function firmList(Request $request, $slug){
        // FOR MULTILANG MENU
        $menu_mapping_json_str = $this->menu_mapping_generate();

         $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();
       
        if($slug == ''){
            if(LaravelLocalization::getCurrentLocale() == 'vi'){
                $slug = 'thong-tin';
            }else{
                $slug = 'about';
            }
        }
        $category = Category::where('cid',2);

        //check page là list hay detail
        if(\Lang::getLocale() == 'en'){
            $checkPage= $category->where("alias_en",$slug)->first();
        }else{
            $checkPage= $category->where("alias_vn",$slug)->first();
        }

        $form = 'firm';
       //var_dump($checkPage);die;
        if($checkPage){
            // $checkPage = $checkPage->pluck('cid', 'id');
            if(\Lang::getLocale() == 'en'){
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
             }else{
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
             }
             $categories = $categories->where('cid',2)->orderBy('id','asc')->get();
             if(\Lang::getLocale() == 'en'){
                $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
             }else{
                $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
             }
             //$about = $Post->where('id',1)->first();
             if(\Lang::getLocale() == 'en'){
                $about = $Post->where('alias_en','about')->where('active',1)->first();
             }else{
                $about = $Post->where('alias_vn','gioi-thieu')->where('active',1)->first();
             }
             //var_dump($about);die;
             $hoidong = Post::where('desc_vn','hoidong');
             if(\Lang::getLocale() == 'en'){
                $hoidongs = $hoidong->whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
             }else{
                $hoidongs = $hoidong->whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
             }
             $hoidongs = $hoidongs->where('active',1)->orderBy('ordering','asc')->get();
             $data = [];
             $data['hoidong']= $hoidongs;
            $i= 0;
            foreach($data['hoidong'] as $mem){
                $img = empty($mem->resource_id) ? [] : Resource::where('id',$mem->resource_id)->first();
                $data['hoidong'][$i]->image = $img->name;
                $i++;
            }
            $award =[];
            $giaithuong =  Post::where('cat_id',10)->where('active',1)->orderBy('created_at','desc')->orderBy('id','desc')->get();
             $j= 0;
             $award['giaithuong']= $giaithuong;
             foreach($award['giaithuong'] as $awards){
                $img = empty($awards->resource_id) ? [] : Resource::where('id',$awards->resource_id)->first();
                $award['giaithuong'][$j]->image = $img->name;
                $j++;
            }
            $blog =[];
            $tintuc = Post::where('cat_id',9)->where('active',1)->orderBy('created_at','desc')->orderBy('id','desc')->get();
            $k= 0;
             $blog['tintuc']= $tintuc;
             foreach($blog['tintuc'] as $tintuc){
                $img = empty($tintuc->resource_id) ? [] : Resource::where('id',$tintuc->resource_id)->first();
                $blog['tintuc'][$k]->image = $img->name;
                $k++;
            }
            $diachi_hn = Project::where('id','29')->first();
            $diachi_hcm = Project::where('id','28')->first();
            $email = Post::where('desc_vn','email')->get();
            $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
            $porfolio = Post::where('desc_vn','porfolio')->where('display','1')->first();
            return view('page.firmList', compact('menu','slug','categories','form','checkPage','about','data','award','blog','diachi_hn','diachi_hcm','email','icon','porfolio', 'menu_mapping_json_str'));
        }else{
            if(\Lang::getLocale() == 'en'){
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:en]',-1)) > 3");
             }else{
                $categories = Category::whereRaw("LENGTH(SUBSTRING_INDEX(slug,'[:vi]',-1)) > 3");
             }
             $categories = $categories->where('cid',2)->orderBy('id','asc')->get();
             if(\Lang::getLocale() == 'en'){
                $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
             }else{
                $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
             }
             if(\Lang::getLocale() == 'en'){
                $about = $Post->where('alias_en','about')->first();
             }else{
                $about = $Post->where('alias_vn','thong-tin')->first();
             }
             $blog = Post::where('id',$slug)->first();
                $ids = $blog->resource_id;
                $gallery = empty($ids) ? [] : Resource::where('id', $ids)->first();
            $icon = Post::where('desc_vn','icon')->orderBy('id','asc')->get();
            $diachi_hn = Project::where('id','29')->first();
            $diachi_hcm = Project::where('id','28')->first();
           
            $email = Post::where('desc_vn','email')->orderBy('id','asc')->get();
            $porfolio = Post::where('desc_vn','porfolio')->where('display','1')->first();
            
             return view('page.blogDetail',  compact('menu','categories','about','blog','gallery','diachi_hn','diachi_hcm','email','icon','porfolio', 'menu_mapping_json_str'));
             
             
        }
        
    }
    public function getcontact (Request $request){
        $menu = Module::where('active','1');
        if(\Lang::getLocale() == 'en'){
            $menu = $menu->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 1");
        }
        $menu = $menu->get();
        $category = Category::where('cid',2);

        if(\Lang::getLocale() == 'en'){
            $category = $category->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $category = $category->orderBy('id','asc')->get();
        if(\Lang::getLocale() == 'en'){
            $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
         }else{
            $Post = Post::whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
         }
         $about = $Post->where('id',1)->first();
         if(\Lang::getLocale() == 'en'){
            $about = $Post->where('alias_en','about')->first();
         }else{
            $about = $Post->where('alias_vn','about')->first();
         }
         $hoidong = Post::where('desc_vn','hoidong');
             if(\Lang::getLocale() == 'en'){
                $hoidongs = $hoidong->whereRaw("LENGTH(SUBSTRING_INDEX(alias_en,'[:en]',-1)) > 3");
             }else{
                $hoidongs = $hoidong->whereRaw("LENGTH(SUBSTRING_INDEX(alias_vn,'[:vi]',-1)) > 3");
             }
             $hoidongs = $hoidongs->orderBy('ordering','asc')->get();
             $data = [];
             $data['hoidong']= $hoidongs;
            $i= 0;
            foreach($data['hoidong'] as $mem){
                $img = empty($mem->resource_id) ? [] : Resource::where('id',$mem->resource_id)->first();
                $data['hoidong'][$i]->image = $img->name;
                $i++;
            }
            $page =[];
            $giaithuong = Page::where('active',1)->orderBy('id','desc')->get();
             $j= 0;
             $page['giaithuong']= $giaithuong;
             foreach($page['giaithuong'] as $awards){
                $img = empty($awards->resource_id) ? [] : Resource::where('id',$awards->resource_id)->first();
                $page['giaithuong'][$j]->image = $img->name;
                $j++;
            }
            $blog =[];
            $tintuc = Post::where('cat_id',9)->orderBy('id','desc')->get();
            $k= 0;
             $blog['tintuc']= $tintuc;
             foreach($blog['tintuc'] as $tintuc){
                $img = empty($tintuc->resource_id) ? [] : Resource::where('id',$tintuc->resource_id)->first();
                $blog['tintuc'][$k]->image = $img->name;
                $k++;
            }
        // var_dump($category);die;
        //hình slide
      
        

        // $galleries = empty($page->gallery) ? [] : Resource::whereIn('id', $page->gallery)->get();
        //link image service
        $resource = Resource::where('type','page')->pluck('name','id');
        $meta_tite = '';//$page->meta_title;
        $mea_desc = '';//$page->meta_desc;
        $form = 'firm';
        $check = 2; 
        return view('page.firm', compact('menu','category','about','resource','meta_tite','mea_desc','form','check','data','page','blog'));
    
    }
    public function postcontact (Request $request){
        
        $value['name'] = $_POST['name'];
        $value['phone'] = $_POST['phone'];
        $value['title'] = $_POST['title'];
        $value['message'] = $_POST['message'];
        $value["created_at"] = time();
        $value["updated_at"] = time();;
        //$value = $request->all();
             
        $new = Contact::create($value);
        // echo "<script>
        //     var url = window.location.href;
        //     if (url.includes('vi')) {
        //     alert('Cảm ơn bạn đã góp ý! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất');
        //     } else if (url.includes('en')) {
        //         alert('Thank you for feedback! We will contact you as soon as possible');
        //     }
        //     window.location='".url('/')."'
        // </script>";
        
        $getreturn = "success";
        return view('page.thanks'); 
     
    }

}
