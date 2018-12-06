<?php
declare(strict_types=1);
namespace app\common\services;

use app\common\dto\VacancyDto;
use app\common\repositories\VacancyRepositoryInterface;

/**
 * VacancyService contains methods for getting, add and change Vacancy object
 *
 * @package app\common\services
 */
class VacancyService
{
    /**
     * @var VacancyRepositoryInterface $repository
     */
    private $repository;

    /**
     * VacancyService constructor.
     *
     * Inject VacancyRepositoryInterface to service
     *
     * @param VacancyRepositoryInterface $repository
     */
    public function __construct(VacancyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get array vacancies
     *
     * @param $page
     * @return array
     */
    public function getPreparedVacancies($page): array
    {
        $limit = 10;

        $offset = ($page - 1) * $limit;

        /** @var VacancyDto[] $vacancies */
        $vacancies = $this->repository->all($limit, $offset);

        foreach ($vacancies as &$vacancy) {
            $vacancy = $vacancy->toArray();
        }

        return $vacancies;
    }

}
