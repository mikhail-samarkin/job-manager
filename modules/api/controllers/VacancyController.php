<?php
declare(strict_types=1);
namespace app\modules\api\controllers;

use app\common\services\VacancyService;
use yii\base\Module;

/**
 * Class contains public api for getting, add and change Vacancy object
 *
 * @package app\modules\api\controllers
 */
class VacancyController extends \yii\web\Controller
{
    /**
     * @var VacancyService
     */
    protected $service;

    /**
     * VacancyController constructor.
     *
     * Inject VacancyService
     *
     * @param $id
     * @param Module $module
     * @param VacancyService $vacancyService - service for getting, add and change Vacancy object
     * @param array $config
     */
    public function __construct($id, Module $module, VacancyService $vacancyService, array $config = [])
    {
        $this->service = $vacancyService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Get list vacancies
     *
     * @GET
     *  int page - number page
     *
     * @return array
     */
    public function actionIndex(): array
    {
        $page = \Yii::$app->request->get('page');

        is_null($page) && $page = 1;

        $vacancies = $this->service->getPreparedVacancies($page);

        return ['vacancies'  => $vacancies];
    }

    /**
     * @inheritdoc
     */
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
