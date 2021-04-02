<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends General
{
    const STATUS_PUBLIC  = 0;
    const STATUS_PRIVATE = 1;
    const STATUS_HIDDEN  = 2;

    protected $fillable = ['cid','cat_id','mcat_id','title', 'slug','slug_en','slug_vn','active','render','hot_news', 'sticky', 'description', 'excerpt','overview','progress','investor','address','lat','lng', 'resource_id', 'img_slide','invest_id','ordering','overview_id','canonical','created_at'];

    protected $multilingual = ['title', 'slug', 'description', 'excerpt','overview','progress','investor','address','canonical'];

    protected $casts = ['active' => 'boolean', 'sticky' => 'boolean', 'img_slide' => 'array','mcat_id' => 'array'];
    protected $hidden = ['pivot'];

    public function category() {
        return $this->belongsTo('App\Category','cat_id','id')->select(['tbl_categories.id','tbl_categories.title'])->orderBy('tbl_categories.id', 'desc');
    }

    public function module() {
        return $this->belongsTo('App\Module','cid','cid')->orderBy('tbl_modules.id', 'desc');
    }
}
