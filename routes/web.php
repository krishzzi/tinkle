<?php
use Tinkle\Router;
use Tinkle\Request;
//require "private.php";
// Still Need A Work
// Escape Full Controller Namespace or use tag.. load it in router with Env Controller Path or From Config

//
//
Router::get("",[\App\controllers\TestController::class,'home']);
Router::get("test",[\App\Controllers\Front\FrontController::class,'test']);
Router::group('admin')->get('dashboard',[\App\Controllers\AppController::class,'item']);

    Router::group('admin')->get('posts/item/{id}',[\App\Controllers\AppController::class,'item']);
//    Router::group('admin')->get('pages/item/{id}',[\App\Controllers\AppController::class,'item']);
//    Router::group('admin')->post('posts/item/{id}',[\App\Controllers\AppController::class,'item']);

//Router::put('user/hello/update',[\App\Controllers\AppController::class,'update']);

//Router::get('posts/name/{id}',function ($id) {echo "Hello $id";});
//Router::get('posts/name/{id}',[function (Request $request) {echo $request->getMethod();},'hello']);

//Router::get('posts/name/{id}',function ($id) {echo $id;});

//Router::get('posts/name/{id}',[function (Request $request)  {echo $request->getMethod();}]);

//
//Router::get('greeting', function () {
//    echo 'Hello World';
//});
//
//Router::get('greet', [function (Request $request) {
//    echo $request->getMethod();
//},\Tinkle\Tinkle::$app->request]);
//
Router::get('greet/ing/{id}', [function ($id) {
    echo 'Hello World'. $id;
}]);
//
//Router::get('greet/test/{id}', [function (\App\Controllers\TestController $id) {
//    echo $id->getId();
//},\App\Controllers\TestController::class]);
//



//Permanent Redirect
//Router::redirect('user/name','post/new',302);
//
//Router::get('posts/name/{id}',function (Request $request) {echo $request->getMethod();});
//

Router::get('user/bolo','This is Life');

//Router::post('posting/hello',[\App\Controllers\AppController::class,'load']);
Router::get('user/hello',[\App\Controllers\AppController::class,'load']);

Router::get('posting/hello',[\App\Controllers\AppController::class,'load']);
Router::redirect('user/name','post/new',301);


Router::group('admin')->get('posts/item/{id}',[\App\Controllers\AppController::class,'item']);
Router::group('admin')->get('pages/item/{id}',[\App\Controllers\AppController::class,'item']);