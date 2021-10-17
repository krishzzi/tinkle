<?php

namespace Tinkle\Database\Access\Mapper;

use Tinkle\Database\Access\Access;
use Tinkle\Exceptions\Display;

class Mapper
{

    private array|object $mapper=[];
    private string $table='';
    private array $bag=[];
    private array $error=[];
    private array|object $mapperBag=[];

    /**
     * @param string $table
     * @param array $bag
     * @throws \Tinkle\Exceptions\Display
     */
    public function __construct(string $table, array $bag)
    {
        $this->table = $table;
        $this->bag = $bag;
        $this->resolve();
    }


    private function resolve()
    {
        if(!isset($this->mapperBag[$this->table]))
        {
            $this->mapper = self::getMapper();
            $this->mapperBag[$this->table] = $this->mapper;
        }else{
            $this->mapper = $this->mapperBag[$this->table];
        }



        $this->matchParamWithMap();
    }


    public function verify()
    {
       // $this->mapper = [];
        if(empty($this->error))
        {
            return true;
        }else{
            return false;
        }

    }

    public function getError()
    {
        return $this->error;
    }





    /**
     * @throws \Tinkle\Exceptions\Display
     */
    private  function getMapper()
    {
        Access::setDebug('Searching mapper For '.$this->table);
        $tableMap = new TableMapper($this->table);
        $map= $tableMap->get();
        if(!empty($map))
        {
            Access::setDebug("Found Map For $this->table");
            return $map;
        }else{
            throw new Display(self::getTable()." - Table Mapping Failed!",Display::HTTP_SERVICE_UNAVAILABLE);
        }
    }




    private function getColumn()
    {
        if(isset($this->bag['column']))
        {
            return $this->bag['column'];
        }

    }

    private function getParam()
    {

        $param=[];

        if(isset($this->bag['param']))
        {
            foreach ($this->bag['param'] as $key => $value)
            {

                if(is_array($value))
                {
                    foreach ($value as $vKey => $vValue)
                    {
                        $param[$vKey] = $vValue;
                    }
                }else{
                    $param[$key] = $value;
                }


            }

        }

        return $param;

    }



    private function matchParamWithMap()
    {
        $allParam = $this->getParam();
        $totalParam = count($allParam);
        $verifiedParam = [];

        $tableMap = $this->mapper['map'];

        //dryDump($tableMap);

        foreach ($allParam as $pKey => $pValue)
        {

            if(isset($tableMap[str_replace(':','',$pKey)]))
            {
                $attrKey = $tableMap[str_replace(':','',$pKey)];
                $verifiedParam[$pKey]=true;
                $ext = 'is_'.$attrKey['Ext'];
                if($ext($pValue) && $attrKey['Size'] >=$pValue)
                {
                    continue;
                }




            }else{
                $this->error [] = "<b>" .$pKey . " </b> not found in <u> App\Model\ ". ucfirst($this->table) ."</u>";
                //throw new Display($pKey . " not present",503);
            }




        }

//        dryDump($this->error);

        if(empty($this->error))
        {
            return true;
        }else{
            return false;
        }





    }






}