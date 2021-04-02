<?php

define('FOLDER', '/');
// define('ADMINCP', 'cms');
$flag_https = false;
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
	define('PATH_URL', 'https://'.$_SERVER['HTTP_HOST'].FOLDER);
	// define('PATH_URL_ADMIN', 'https://'.$_SERVER['HTTP_HOST'].FOLDER.ADMINCP.'/');
	$flag_https = true;
}else{
	define('PATH_URL', 'http://'.$_SERVER['HTTP_HOST'].FOLDER);
	// define('PATH_URL_ADMIN', 'http://'.$_SERVER['HTTP_HOST'].FOLDER.ADMINCP.'/');
}

define('IS_LOCALHOST', true);
if(!IS_LOCALHOST && !$flag_https){
?>
<html>
<head>
<script>
var current_url = location.href;
current_url = current_url.replace('http','https');
location.href = current_url;
</script>
</head>
</html>
<?php
exit();
}

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
