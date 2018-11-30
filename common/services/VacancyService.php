<?php
namespace app\common\services;

use app\common\models\entity\VacancyRecord;

class VacancyService
{
    public function getPreparedVacancies()
    {
        $vacancies = VacancyRecord::find()->asArray()->all();
        return $vacancies;
    }
}