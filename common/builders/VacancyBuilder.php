<?php
namespace app\common\builders;

use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;

class VacancyBuilder
{
    public function buildVacancy(VacancyDto $vacancyDto)
    {
        $vacancy = new Vacancy();
        $vacancy->title = $vacancyDto->getTitle();
        $vacancy->description = $vacancyDto->getDescription();

        return $vacancy;
    }
}
