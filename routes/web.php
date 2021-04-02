<?php
use App\Setting;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::post('contact', 'Admin\ContactController@store')->middleware('throttle:5');

Route::get('en/events', function(){
    return Redirect::to('en/events/usis-activities',301);
});
// Route::get('dich-vu/dich-vu-an-cu', function(){
//     return Redirect::to('dich-vu/dich-vu-an-cu-my',301);
// });

Route::get('tin-tuc-usis', function(){
    return Redirect::to('tin-tuc-usis/tin-tuc-my',301);
});
Route::get('en/news', function(){
    return Redirect::to('en/news/us-news',301);
});


// Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
Route::group(['prefix' => LaravelLocalization::setLocale()], function() {

    //sitemap
    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'du-an-sitemap.xml' : 'projects-sitemap.xml'], function() {
        Route::get('/','SiteController@pageSiteMap');
    });
    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'su-kien-sitemap.xml' : 'events-sitemap.xml'], function() {
        Route::get('/','SiteController@pageSiteMap');
    });
    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'doi-tac-sitemap.xml' : 'partners-sitemap.xml'], function() {
        Route::get('/','SiteController@pageSiteMap');
    });
    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'tin-tuc-sitemap.xml' : 'news-sitemap.xml'], function() {
        Route::get('/','SiteController@pageSiteMap');
    });
    
    Route::post('/contactUs', 'ContactController@contactUs')->name('contactUs');

    //download file
    Route::post('/downloadFile', 'ContactController@downloadFile')->name('downloadFile');

    //route tag
    Route::get('/tags/{slug}','SiteController@tags')->name('tags');

// begin

    // Route::get('/', 'SiteController@index')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('index');
    // if (str_contains(Request::path(), '/')) {
    //     return redirect('/en');
    // }

    Route::get('/', 'SiteController@index')->name('index');
    Route::get('/home', 'SiteController@home')->name('home');
    Route::get('/trang-chu', 'SiteController@home')->name('home');
    Route::group(['prefix' => (LaravelLocalization::setLocale() == 'vi') ? 'cong-trinh' : 'work'], function() {
        Route::get('/', 'SiteController@work')->name('work');
        Route::get('/{slug}', 'SiteController@workList')->name('workList');
        Route::get('/{slug}/{permalink}','SiteController@workDetail')->name('workdetai');
      //  Route::get('/{slug}/{partners}', 'SiteController@workLista')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('pro-Details');
    });
    
     Route::group(['prefix' => (LaravelLocalization::setLocale()== 'vi') ? 'cong-ty' : 'firm'], function() {
        Route::get('/', 'SiteController@firm')->name('firm');
        Route::get('/{slug}', 'SiteController@firmList')->name('firmList');
    });
    Route::get('/contacts', 'SiteController@getcontact')->name('getcontact');
    Route::post('/contacts', 'SiteController@postcontact')->name('postcontact');

// end
    Route::get('du-an/{slug}.html', 'SiteController@projectDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('projects-Detailshtml  ');
    Route::get('eb-5-projects/{slug}.html', 'SiteController@projectDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('projects-Detailshtml  ');

    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'dich-vu' : 'service'], function() {
        
        Route::get('/', 'SiteController@serive')->name('home-service');
        Route::get('{slug}/{permalink}/{partners}','SiteController@dtAncuChitiet')->name('dtAncuChitiet');
        Route::get('{slug}/{permalink}','SiteController@level3Dichvu')->name('level3Dichvu');
        Route::get('{slug}', 'SiteController@showPageDichVu')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('subpagedv');
        
     
    });



    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'cau-hoi-thuong-gap' : 'faqs'], function() {
        // Route::get('/', 'SiteController@faqs')->name('faqs');
        Route::get('/{slug}', 'SiteController@faqs')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('subfaqs');
    });

    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'tin-tuc-usis' : 'news'], function() {
        // Route::get('/', 'SiteController@news')->name('news');
        Route::get('/{slug}', 'SiteController@news')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('subnews');
        Route::get('/{slug}{suffix}', 'SiteController@newsDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('newsDetail');
    });
    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'cuoc-song-tai-my' : 'life-in-america'], function() {
        Route::get('/', 'SiteController@life')->name('life');
        Route::get('/{slug}', 'SiteController@life')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('sublife');
        Route::get('/{slug}{suffix}', 'SiteController@lifeDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('lifeDetail');
    });

    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'su-kien' : 'events'], function() {
        // Route::get('/', 'SiteController@events')->name('events');
        Route::get('/{slug}', 'SiteController@events')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('subevents');  
        Route::get('/{slug}{suffix}', 'SiteController@eventsDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('eventsnewsDetail');
    });

    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'luat-di-tru' : 'regulator-law'], function() {
        Route::get('/', 'SiteController@laws')->name('laws');
        Route::get('/{slug}', 'SiteController@lawsDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('lawsDetail');
    });

    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'huong-dan-dinh-cu-hoa-ky' : 'u.s.-immigrants-guidebook'], function() {
        Route::get('/', 'SiteController@huongdandinhcu')->name('huongdandinhcu');
        Route::get('/{slug}', 'SiteController@hddcDetail')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('hddcDetail');
    });
    

    Route::get('form/xac-nhan-dang-ky-tu-van-eb5','SiteController@formXacNhan')->name('formXacNhan');
    Route::get('cam-on/cam-on-dang-ky-tu-van-eb5','SiteController@thanksforregis')->name('formXacNhan');

    
    Route::get('loginJLB', 'Admin\LoginController@showLoginForm')->name('login_admin');
    Route::post('loginJLB', 'Admin\LoginController@login');

    //doitac detail
    Route::get((LaravelLocalization::setLocale() =='') ? 'doi-tac/{slug}' : 'partners'.'/{slug}','SiteController@doitacDetail')->name('doitacDetail');

    //  Chi tiết hội đồng
    Route::group(['prefix' => (LaravelLocalization::setLocale() == '') ? 'hoi-dong' : 'assembly'], function() {
        Route::get('/{slug}','SiteController@hoidongDetail')->name('hoidongDetail');
    });
    

    //chi tiet hoat dong an cu
    Route::get('/hoat-dong-an-cu/{slug}','SiteController@hdAncuChitiet')->name('hdAncuChitiet');

    Route::get((LaravelLocalization::setLocale() =='') ? '/tim-kiem' : '/search','SiteController@search')->name('search');

    Route::post('/dang-tim-kiem','SiteController@searching')->name('searching');

    Route::get('{slug}', 'SiteController@showPage')->where('slug', '^(?!api\/)([A-Za-z0-9\-\/]+)')->name('pagenosubfix');
    if (str_contains(Request::path(), '@dmin')) {
        require base_path('routes/admin.php');
    }
});


