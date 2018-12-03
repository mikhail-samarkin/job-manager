<?php
declare(strict_types=1);
namespace app\common\builders;

use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;

/**
 * Builder Vacancy object class
 *
 * Used by services with Vacancy
 *
 * @package app\common\builders
 */
class VacancyBuilder
{
    /**
     * Build Vacancy from VacancyDto
     *
     * @param VacancyDto $vacancyDto - Data Transfer Object Vacancy
     * @return Vacancy
     */
    public function buildVacancy(VacancyDto $vacancyDto): Vacancy
    {
        $vacancy = new Vacancy();

        $vacancy->title = $vacancyDto->getTitle();
        $vacancy->description = $vacancyDto->getDescription();

        return $vacancy;
    }
}
