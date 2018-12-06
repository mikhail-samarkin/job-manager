<?php
declare(strict_types=1);

namespace app\common\repositories;

use app\common\dto\VacancyDto;

/**
 * Class VacancyRepositoryInterface
 * @package app\common\repositories
 */
interface VacancyRepositoryInterface
{
    /**
     * @param int $id
     * @return VacancyDto
     */
    public function get(int $id): VacancyDto;

    /**
     * @param VacancyDto $vacancyDto
     * @return VacancyDto
     */
    public function add(VacancyDto $vacancyDto): VacancyDto;

    /**
     * @param VacancyDto $vacancyDto
     */
    public function save(VacancyDto $vacancyDto): void;

    /**
     * @param VacancyDto $vacancyDto
     */
    public function remove(VacancyDto $vacancyDto): void;

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function all(int $limit, int $offset): array;
}