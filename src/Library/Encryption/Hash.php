<?php


namespace Tinkle\Library\Encryption;


use Tinkle\Tinkle;

class Hash
{


    public static Hash $hash;

    /**
     * Hash constructor.
     */
    public function __construct()
    {
        self::$hash = $this;
    }


    public static function make(string $string)
    {
        return password_hash($string,PASSWORD_BCRYPT);
    }


    public static function generate(string $_tokenKey)
    {
        $token = bin2hex(random_bytes(52));
        $token = password_hash($token,PASSWORD_DEFAULT);

        return $token;
    }


    public static function match(string $_sessionTokenKey,string $postTokenValue)
    {
        if(hash_equals(Tinkle::$app->session->get($_sessionTokenKey),$postTokenValue))
        {
            return true;
        }else{
            return false;
        }

    }

    public static function check(string $checkThis, string $checkWith)
    {
        if(hash_equals($checkWith,$checkThis))
        {
            return true;
        }
        return false;
    }





}