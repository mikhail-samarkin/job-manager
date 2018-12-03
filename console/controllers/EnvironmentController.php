<?php
namespace app\console\controllers;

use yii\base\ErrorException;
use yii\helpers\Console;

/**
 * Class EnvironmentController
 * @package app\console\controllers
 */
class EnvironmentController extends \yii\console\Controller
{
    /**
     * Initiate application from source. Example run with default params: php yii environment/init
     * @param string $environment
     * @param string $overwrite
     */
    public function actionInit($environment = 'dev', $overwrite = 'y')
    {
        $pathFrom = \Yii::$app->basePath.'/environments/'.$environment.'/config/serv.env';
        $pathTo = \Yii::$app->basePath.'/config/serv.env';

        if (!is_writable(dirname($pathTo))) {
            Console::output('Folder '.dirname($pathTo).' not writable!');
            Console::output('Initiate application error!');
            exit();
        }

        if (file_exists($pathTo) && $overwrite === 'n') {
            Console::output('File with environment config is exist!');
            Console::output('Initiate application error!');
            exit();
        }

        try {
            $result = copy($pathFrom, $pathTo);

            if (!$result) {
                throw new ErrorException('Copy not completed');
            }
        } catch (ErrorException $e) {
            Console::output($e->getMessage());
            Console::output('Initiate application error!');
            exit;
        }

        Console::output('Initiate application success');
    }
}
