<?php

namespace App\Providers;

use App\Dish;
use App\Group;
use App\Page;
use App\Category;
use App\Project;
use Cache;
use File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use LaravelLocalization;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('current_locale', LaravelLocalization::getCurrentLocale());

        View::composer(['layouts.app', 'site.*'], function($view) {
            $data['currentUser'] = auth()->guard('customer')->user();
            if (!\App::runningInConsole()) {
                $data['bodyClass'] = \Route::currentRouteName() !== NULL
                    ? \Route::currentRouteName()
                    : strtolower(str_replace('Controller@', '-', array_last(explode('\\', \Route::currentRouteAction()))));
            }
            $view->with($data);
        });

        View::composer(['site.order.dishes', 'site.order.mobile'], function($view) {
            $data['side_groups'] = Cache::remember('groups.side', 1440, function() {
                return Group::with(['dishes' => function($query) {
                    $query->whereNull('dishes.dish_id')->with('resource', 'child');
                }])->where('is_side', true)->get()->keyBy('id')->all();
            });
            $view->with($data);
        });

        View::composer(['admin.dish.create', 'admin.dish.edit'], function ($view) {
            $data['dishes'] = Dish::where('type', Dish::TYPE_SIDE)->whereNull('dish_id')->orderBy('id', 'desc')->get()->pluck('title', 'id')->all();
            list($data['groups'], $data['side_groups']) = Group::splitGroups();
            $view->with($data);
        });
      
        View::composer('admin.page.form', function ($view) {
           $data['categories']  = Category::orderBy('id','desc')->get(['id','title'])->pluck('title','id')->all();
           array_unshift($data['categories'],'None');
          // var_dump($data);die;
            $view->with($data);
        });
        View::composer('admin.service.form', function ($view) {
            $data['render'] = Project::orderBy('id', 'desc')->get()->pluck('render', 'id')->all();

            $data['render'] = array('Địa chỉ','Email','Icon');
            
            $view->with($data);
        });
        View::composer('admin.other.form', function ($view) {
            
            $data['hot_news'] = array('Mobile');
            array_unshift($data['hot_news'],'PC');
           // var_dump($data);die;
            $view->with($data);
        });
        
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
