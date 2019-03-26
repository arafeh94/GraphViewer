<?php

namespace app\components;

use app\components\Tools;

/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 3/23/2019
 * Time: 4:46 AM
 */
class Matlab extends \yii\base\Component
{

    /**
     * @param $function string matlab function name, same name as .m file
     * @param $input string preferred input as string in json format
     * @return array|string
     * @throws \Exception
     */
    static function exec($function, $input)
    {
        return \Yii::$app->matlab->run($function, $input);
    }

    //C:\Program Files\MATLAB\R2016a\bin\matlab.exe
    public $matlabExecutable = "";

    //C:\\wamp64\\tmp\\res
    public $outputDir = "";

    public function init()
    {
        parent::init();

    }

    /**
     * @param $function string matlab function name, same name as .m file
     * @param $input string preferred input as string in json format
     * @return string
     * @throws \Exception
     */
    private function run($function, $input)
    {
        if ($this->matlabExecutable == null || $this->outputDir == null) {
            throw new \Exception('parameters not specified');
        }

        $separator = DIRECTORY_SEPARATOR;
        $session = \Yii::$app->session->id;
        $outputLogFile = "{$this->outputDir}{$separator}" . Tools::random(6) . Tools::currentDate('yidhms') . '.log';
        $outputDir = "{$this->outputDir}{$separator}mat{$session}{$separator}";
        Tools::createFolder($outputDir);
        $cat = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? 'type' : 'cat';
        $cmd = <<<cmd
"$this->matlabExecutable" -nodisplay -nosplash -nodesktop -r "cd('m');try, $function('{$input}','{$outputDir}'),catch,exit,end,exit;" -wait -logfile "{$outputLogFile}" && {$cat} "{$outputLogFile}"
cmd;
        exec($cmd, $output, $ret);

        return $output;
    }

}