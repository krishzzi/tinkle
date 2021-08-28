<?php


namespace Config;
use Dotenv\Dotenv;
use App\models\UsersModel;
use Tinkle\Library\Essential\Essential;

class Config
{


    protected Config|array $config;
    protected Client $client;
    protected Database $database;
    protected App $app;
    protected static string $authModel = "App\models\UsersModel";

    /**
     * Config constructor.
     */
    public function __construct()
    {
        // Load Environment
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        $this->app = new App();
        $this->client = new Client();
        $this->database = new Database();
        $this->overRideSystem();



    }


    private function overRideSystem()
    {
        /**
         * REMEMBER THIS SETTING USEFULL IF YOU NEED A CUSTOM ENVIRONMENT WHERE YOU DON'T SEND SOME CUSTOM
         * PRE SETTINGS DEFINE IN START UP TINKLE
         */


    }





    public function getConfig()
    {
        $this->config ['app']= Essential::getHelper()->JsonToArray($this->app->getConfig());
        $this->config ['db']= Essential::getHelper()->JsonToArray($this->database->getConfig());
        $this->config ['client']= Essential::getHelper()->JsonToArray($this->client->getConfig());
        $this->config['userModel'] = self::$authModel;
        return $this->config;
    }








}