<?php
namespace app\common\repositories;

use app\common\entities\Vacancy\Vacancy;
use app\common\entities\Vacancy\VacancyId;
use app\common\exceptions\NotFoundException;
use Ramsey\Uuid\Uuid;

class ARVacancyRepository implements VacancyRepository
{

    /**
     * @param VacancyId $id
     * @return Vacancy
     * @throws NotFoundException
     */
    public function get(VacancyId $id): Vacancy
    {
        if (!$vacancy = Vacancy::findOne($id->getId())) {
            throw new NotFoundException('Vacancy not found.');
        }
        return $vacancy;
    }

    /**
     * @param Vacancy $vacancy
     * @throws \Throwable
     */
    public function add(Vacancy $vacancy): void
    {
        if (!$vacancy->insert()) {
            throw new \RuntimeException('Adding error.');
        }
    }

    /**
     * @param Vacancy $vacancy
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function save(Vacancy $vacancy): void
    {
        if ($vacancy->update() === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Vacancy $vacancy
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Vacancy $vacancy): void
    {
        if (!$vacancy->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    /**
     * @return VacancyId
     * @throws \Exception
     */
    public function nextId(): VacancyId
    {
        return new VacancyId(Uuid::uuid4()->toString());
    }

    public function getAll(): array
    {
        $vacancies = Vacancy::find()->all();
        return $vacancies;
    }
}
