<?php
namespace app\common\repositories;

use app\common\entities\Vacancy\Vacancy;
use app\common\entities\Vacancy\VacancyId;
use app\common\exceptions\NotFoundException;

interface VacancyRepository
{
    /**
     * @param VacancyId $id
     * @return Vacancy
     * @throws NotFoundException
     */
    public function get(VacancyId $id): Vacancy;

    public function add(Vacancy $vacancy): void;

    public function save(Vacancy $vacancy): void;

    public function remove(Vacancy $vacancy): void;

    public function all(): array;

    public function nextId(): VacancyId;
}
