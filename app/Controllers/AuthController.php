<?php

namespace App\Controllers;

use tinkle\app\models\Auth\LoginModel;
use tinkle\app\models\UsersModel;
use Tinkle\Controller;
use Tinkle\interfaces\ControllerInterface;
use Tinkle\Middlewares\AuthMiddleware;
use Tinkle\Request;
use Tinkle\Response;

/**
 * Class AuthController
 * @package tinkle\app\controllers
 */
class AuthController extends Controller implements ControllerInterface
{


    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
        parent::__construct();
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginModel();

        if($request->isPost())
        {

            $loginForm->loadData($request->getAllContent());
            if($loginForm->validate() && $loginForm->login())
            {
                // On Success

                $response->redirect('dashboard');
                return;
            }
        }








//        $this->setLayout('auth');
//        return $this->render('login', [
//            'model'=> $loginForm
//        ]);

        return $this->render('Auth/login',[
            'model'=> $loginForm
        ]);

    }






}
