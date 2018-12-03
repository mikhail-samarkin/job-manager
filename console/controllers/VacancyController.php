<?php
namespace app\console\controllers;

use app\common\services\VacancyService;
use yii\base\Module;
use yii\helpers\Console;

/**
 * Class VacancyController
 * @package app\console\controllers
 */
class VacancyController extends \yii\console\Controller
{
    private $vacancyService;

    public function __construct(string $id, Module $module, VacancyService $vacancyService, array $config = [])
    {
        $this->vacancyService = $vacancyService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Generate random vacancies
     */
    public function actionGenerate() : void
    {
        $count = $this->vacancyService->generateRandomVacancies();
        Console::output('Generated '.$count.' vacancies');
    }
}
