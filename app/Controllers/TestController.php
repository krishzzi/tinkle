<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\Posts;

use App\Models\UsersModel;
use Database\migrations\m001CreateUsersMigration;
use Tinkle\Controller;
use Tinkle\Database\Database;

use Tinkle\DB;
use Tinkle\Library\Debugger\Debugger;
use Tinkle\Request;
use Tinkle\Response;
use Tinkle\Tinkle;

/**
 * Class TestController
 * @package tinkle\app\controllers
 * @author : krishanu.info@gmail.com
 * @version : 1.0
 */
class TestController extends Controller
{

       /**
        * TestController constructor.
        */
       public function __construct()
       {
           // Todo $this->registerMiddleware('middleware_name');
           parent::__construct();
           // Todo $this->setPlugin('plugin_name',['callbackClass','method']);
       }


        /**
         * @param Request $request
         * @param Response $response
         */
       public function home(Request $request, Response $response)
       {
            echo "<h1>Test Controller Home</h1>";

           // $post = new PostsModel();

           //dd(Tinkle::$app->db->getConnect());

//
          // dd(Tinkle::$app->db->getConnect()->getTable('users'));
//           dd(Tinkle::$app->db->getConnect()->dbExist('tinkle'));

           //dd(Tinkle::$app->db->getConnect()->columnExist('username','users'));
//           $post = new PostsModel();
//                 ddump($post);
//           $post->author_id = 2;

         //  $post->find(1)->where();

//          ddump();
           //  ddump($post->findAll());


//           $user = new UsersModel();
//           ddump($user);


           $flights =  Posts::where('destination', 'Paris');






          // $results = DB::select('select * from users where id = ?', [1]);
          //dd(DB::select('select * from users where id = ?', [1]));


//            $app = new m001CreateUsersMigration();
//           $app->up();









       }


       public function check(Database $db)
       {

       }









}