<?php


namespace AppBundle\Services\Utils;

/**
 * Class Debug
 * @package AppBundle\Service\Utils
 * @author Tiko Banyini
 */
class Debug
{

    /**
     * @param $var1
     * @param null $var2
     */
    static function check($var1, $var2 = null) {

        echo '<pre>';
        if (!$var2) {
            exit(print_r($var1, 1));
        }else{
            echo print_r($var1, 1);
            echo "\n";
            echo '<pre>';
            echo print_r($var2, 1);
            exit();
        }

    }

}