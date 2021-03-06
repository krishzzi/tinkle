<?php


namespace Tinkle\Databases;


use Tinkle\Databases\Driver\MySqlDriver;
use Tinkle\Databases\Driver\SqliteDriver;
use Tinkle\Exceptions\Display;
use Tinkle\Tinkle;
use \PDO;
/**
 * Class Database
 * @package Tinkle\Database
 */
class Database
{
    public static Database $database;
    public \PDO $pdo;
    protected static array $availableDrivers = ['mysql','sqlite'];
    protected static array $config;
    protected string $dsn;
    protected string $driver;
    protected string $host;
    protected int $port;
    protected string $name;
    protected string $user;
    protected string $password;
    protected array $options = [PDO::ATTR_PERSISTENT => true,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    /**
     * @var bool|\PDOStatement
     */
    private $stmt;

    /**
     * Database constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        self::$config = $config;
        self::$database = $this;
        $this->driver = self::$config['driver'] ?? '';
        $this->dsn = self::$config['dsn'] ?? '';
        $this->host = self::$config['host'] ?? '';
        $this->port = self::$config['port'] ?? 0;
        $this->name = self::$config['name'] ?? '';
        $this->user = self::$config['user'] ?? '';
        $this->password = self::$config['password'] ?? '';



        if($this->matchDriver())
        {
            if(strtolower(self::$config['driver']) === 'mysql')
            {
                $this->port = 3306;
                 $this->getMysqlConnection();
            }elseif (strtolower(self::$config['driver']) === 'sqlite')
            {
                $this->port = 0666;
               $this->getSqlite3Connection();
            }else{
                echo "Database Connection Error";
            }
        }

    }


    public function getConnect()
    {
        return $this->pdo;
    }

    public static function connect()
    {
        return self::$database->pdo;
    }


    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function exec(){
        return $this->pdo->exec();
    }


    public function lastID()
    {
        return $this->pdo->lastInsertId();
    }





    public function query($sql){
        $this->stmt = $this->pdo->prepare($sql);
    }





    // Bind values
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }


    public function debug()
    {
        return $this->stmt->debugDumpParams();
    }




    // Get result set as array of objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    // Get row count
    public function check(){
        if(empty($this->stmt->fetchAll(PDO::FETCH_OBJ))) {
            return false;
        } else {
            return true;
        }

    }









    protected function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }


    private function matchDriver()
    {
//       if(!empty(self::$config['driver']))
//       {
//           $appDriver[] = self::$config['driver'];
//       }else{
//           echo "Not Found Driver";
//       }


        if(array_intersect(PDO::getAvailableDrivers(),self::$availableDrivers,self::$config))
        {
            return true;
        }else{
            return false;
        }

    }




    private  function getMysqlConnection()
    {
        //[dsn] => mysql:host=localhost;port=3306;dbname=tinkle
        //$this->pdo = new \PDO($this->dsn,$this->user,$this->password,$this->options);
        try{

            try{
                $this->pdo = new \PDO("$this->driver:host=$this->host;port=$this->port;dbname=$this->name",$this->user,$this->password,$this->options);
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
                //Display PDO Errors
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);



            }catch (\PDOException $e) {
                $msg = '_msg='.$e->getMessage().'&_line='.$e->getline().'&_file='.$e->getFile().'&_code='. $e->getCode().'&_trace='. $e->getTraceAsString();
                throw new Display($msg);
            }

        }catch (Display $e)
        {

            $e->handle();
        }



    }


    private function getSqlite3Connection()
    {
        $sqlPath = Tinkle::$ROOT_DIR."database/$this->name.sq3";
        if(!file_exists($sqlPath));
        {
            $sqlite = fopen($sqlPath,'w+');
            fclose($sqlite);
        }

        $this->pdo = new PDO( "sqlite:$sqlPath",$this->user,$this->password,$this->options);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        //Display PDO Errors
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    }




}