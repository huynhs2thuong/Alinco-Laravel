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
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use LaravelLocalization;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Illuminate\Support\Facades\Route;

//custom pagination
use App\Support\Collection;
class PageController extends Controller
{
    public function __construct() {
        Page::addGlobalScope(new ActiveScope);
        Post::addGlobalScope(new ActiveScope);
        Category::addGlobalScope(new ActiveScope);
    }

    public function index() {
        $services  = Page::where('template','service')->orderBy('id','asc')->get();
        $i = 0;
        foreach ($services as $service) {
            if($service->feature){
                $feature = Resource::where('id',$service->feature)->first();
                $services[$i]->featureImage = $feature;
            }else{
                $services[$i]->featureImage = '';
            }
           $i++;
        }
        $projects = Project::where('cat_id',49)->orderBy('sticky','desc')->orderBy('ordering','desc')->orderBy('created_at','desc')->orderBy('id','desc')->limit(10)->get();
        $event = Post::where('cid',2)->where('cat_id',3);
        if(\Lang::getLocale() == 'en'){
            $event = $event->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $event = $event->orderBy('updated_at','desc')->limit(10)->get();
        $news = Post::where('active',1)->where('cid',8)->whereRaw('cat_id IN (13)');
        if(\Lang::getLocale() == 'en'){
            $news = $news->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $news = $news->orderBy('sticky','desc')->orderBy('ordering','desc')->orderBy('created_at','desc')->limit(4)->get();
        $dautudc = Page::where('id_pro',1);
        if(\Lang::getLocale() == 'en'){
            $dautudc = $dautudc->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
        }
        $dautudc = $dautudc->orderBy('updated_at','desc')->limit(10)->get();

    
        $page = Page::where('template','home')->orderBy('id','desc')->first();
        // var_dump($event);die;
        //hình slide
        $slides = [];
        if(!empty($page->gallery)){
            foreach ($page->gallery as $gallery) {
                $image = Resource::where('id',$gallery)->first();
                $slides[] = $image;
            }
        }
       
        $slug_v1 = 'dich-vu-an-cu-my';
        $slug_v2 = 'hoat-dong-an-cu';
        $videos = Post::where('cat_id',53)->where('active',1);
 
        if(\Lang::getLocale() == 'en'){
            $videos = $videos->whereRaw("LENGTH(SUBSTRING_INDEX(title,'[:en]',-1)) > 3");
            $slug_v1 = 'us-settlement-service';
            $slug_v2 = 'activities';
        }
       
        $videos = $videos->limit(3)->orderBy('id','desc')->get();
        

        // $galleries = empty($page->gallery) ? [] : Resource::whereIn('id', $page->gallery)->get();
        //link image service
        $resource = Resource::where('type','page')->pluck('name','id');
        $meta_tite = $page->meta_title;
        $mea_desc = $page->meta_desc;
        return view('page.home',compact('services','projects','event','news','dautudc','page','resource','meta_tite','mea_desc','slides','videos','slug_v1','slug_v2'));
    }
}