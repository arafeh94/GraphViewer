<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 1/22/2018
 * Time: 9:49 PM
 */

namespace app\components;

use yii\base\Component;
use yii\db\Connection;
use yii\helpers\Json;

class Tools extends Component
{
    static function forcePrint($message)
    {
        $message = Json::encode($message);
        throw new \RuntimeException($message);
    }

    static function var_dump($message)
    {
        die(var_dump($message));
    }

    static function prettyPrint($message)
    {
        $message = Json::encode($message);
        echo "<pre><code>$message</code></pre>";
    }

    static function console($msg)
    {
        $msg = json_encode($msg);
        \Yii::$app->view->registerJs("console.log({$msg})");
    }

    public static function currentDate($format = null)
    {
        $time = new \DateTime('now', new \DateTimeZone(\Yii::$app->params['timezone']));
        $format = $format == null ? \Yii::$app->params['dateTimeFormat'] : $format;
        return $time->format($format);
    }

    public static function random($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getLetterUntilNumberFound($str)
    {
        $matches = [];
        if (preg_match('/^([A-Z]+)([0-9]+)$/i', $str, $matches)) {
            return $matches ? $matches[1] : false;
        }
        return false;
    }


    static function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    static function createFolder($path)
    {
        if (!file_exists($path)) {
            return mkdir($path, 0777, true)
                ? $path : null;
        }
        return $path;
    }

    static function str_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

}