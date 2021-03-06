<?php
declare(strict_types=1);
namespace App\Controllers;

use App\App;
use App\Models\PostsModel;
use App\models\UsersModel;
use Database\seeders\UserTableSeeder;
use Tinkle\Controller;
use Tinkle\interfaces\ControllerInterface;
use Tinkle\Library\Console\Application\Controllers\DB;
use Tinkle\Library\Console\Application\Controllers\Make;
use Tinkle\Middlewares\AuthMiddleware;
use Tinkle\Request;
use Tinkle\Response;
use Tinkle\Tinkle;
use Tinkle\View;


class AppController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));

        //$this->registerMiddleware(new TestMiddleware());
        parent::__construct();


    }


    /**
     * @param Request $request
     * @param Response $response
     */
    public function home(Request $request, Response $response)
    {
            echo "<h1>HOMEPAGE</h1>";
    }



    public function check(\Closure $given)
    {
        dd($given);
    }





    public function MyFolder(Request $request, Response $response)
    {

        $userModel = new UsersModel();
        $this->prepareView('homepage')->withModels([$userModel])->responseCode(200);
        $this->display();

    }


    public function item(Request $request, Response $response)
    {

        echo "<h1>Item Loaded</h1>";

    }
















    public function contact(Request $request, Response $response)
    {
        $userModel = new User();

        if($request->isPost())
        {
            $uImage = $request->request->get('userImage');
            $userModel->loadData($request->getAllContent());
            if($userModel->validate() && $userModel->login())
            {
                echo "Hello";
            }else{
                echo "gello";
            }
        }

        echo "Hello";


    }






    public function show(Request $request, Response $response)
    {
//        $userModel = new UsersModel();
//
//        if($request->isPost())
//        {
//
//
//
//            $uImage = $request->prepareUpload('userImage');
//
//            if(is_array($uImage))
//            {
//                if($request->upload($uImage,''))
//                {
//                    echo "Upload Complete";
//                }else{
//                    echo "Upload Failed";
//                }
//            }else{
//                echo "Upload Failed";
//            }
//
//
//
//
//            $data = ['data'=>$request->getAllContent(),'image'=>$uImage['details']['hash']];
//
//
//            $userModel->loadData($data);
//
//            if($userModel->validate() && $userModel->login())
//            {
//                echo "Hello";
//            }else{
//                echo "gello";
//            }
//        }

        $userModel = new UsersModel();
        $this->prepareView('test')->withModels([$userModel])->responseCode(200);
        $this->display();


    }


    public function load(Request $request, Response $response)
    {



//            echo "Load methods";
            return "Loading method For Api ";


    }


}