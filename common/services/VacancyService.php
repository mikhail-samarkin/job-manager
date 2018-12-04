<?php
declare(strict_types=1);
namespace app\common\services;

use app\common\entities\Vacancy;

/**
 * VacancyService contains methods for getting, add and change Vacancy object
 *
 * @package app\common\services
 */
class VacancyService
{
    /**
     * Get array vacancies
     *
     * @param $page
     * @return array
     */
    public function getPreparedVacancies($page): array
    {
        $perPage = 10;

        $offset = ($page - 1) * $perPage;

        $vacancies = Vacancy::find()
            ->limit($perPage)
            ->offset($offset)
            ->asArray()
            ->all();

        return $vacancies;
    }

}
