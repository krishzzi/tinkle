<?php

namespace App\Controllers\Front;

use App\Controllers\Payment\Payment;
use App\Plugins\Razorpay\Razorpay;
use Razorpay\Api\Api;
use Tinkle\Controller;
use Tinkle\Helpers\Helper;
use Tinkle\Helpers\STR;
use Tinkle\Request;
use Tinkle\Response;
use Tinkle\Tinkle;

/**
 * Class FrontController
 * @package tinkle\app\controllers
 * @author : krishanu.info@gmail.com
 * @version : 1.0
 */
class FrontController extends Controller
{





       /**
        * FrontController constructor.
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
       public function test(Request $request, Response $response)
       {
            echo "<h1>Testing page</h1>";

            ddump(Helper::STR()->lower('ABC'));
           ddump(Helper::STR()::lower('ABCdfsds'));

            ddump(STR::lower('XYZ'));



















       }











}