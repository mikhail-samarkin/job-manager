<?php
namespace app\console\controllers;

use app\common\services\VacancyService;
use yii\base\Module;
use yii\helpers\Console;

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
    public function actionGenerate() {
        $count = $this->vacancyService->generateRandomVacancies();
        Console::output('Generated '.$count.' vacancies');
    }
}