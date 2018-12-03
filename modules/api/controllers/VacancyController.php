<?php
namespace app\modules\api\controllers;

use app\common\services\VacancyService;
use yii\base\Module;

class VacancyController extends \yii\web\Controller
{
    protected $service;

    public function __construct($id, Module $module, VacancyService $vacancyService, array $config = [])
    {
        $this->service = $vacancyService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $page = \Yii::$app->request->get('page');

        is_null($page) && $page = 1;

        $vacancies = $this->service->getPreparedVacancies($page);

        return ['vacancies'  => $vacancies];
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'index'  => ['GET']
                ],
            ],
        ];
    }
}
