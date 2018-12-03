<?php
namespace app\common\builders;

use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;

class VacancyBuilder
{
    /**
     * Build Vacancy from VacancyDto
     *
     * @param VacancyDto $vacancyDto
     * @return Vacancy
     */
    public function buildVacancy(VacancyDto $vacancyDto) : Vacancy
    {
        $vacancy = new Vacancy();

        $vacancy->title = $vacancyDto->getTitle();
        $vacancy->description = $vacancyDto->getDescription();

        return $vacancy;
    }
}
