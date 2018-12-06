<?php
declare(strict_types=1);

namespace app\common\repositories;

use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;
use app\common\exceptions\NotFoundException;
use DateTime;
use RuntimeException;

/**
 * Class ARVacancyRepository
 * @package app\common\repositories
 */
class ARVacancyRepository implements VacancyRepositoryInterface
{

    /**
     * @param int $id
     * @return VacancyDto
     * @throws NotFoundException
     * @throws \Exception
     */
    public function get(int $id): VacancyDto
    {
        if (!$vacancy = Vacancy::findOne($id)) {
            throw new NotFoundException('Vacancy not found.');
        }

        /**
         * @var DateTime $dateCreate
         */
        $dateCreate = DateTime::createFromFormat('U', (string)$vacancy['date_create']);

        $vacancyDto = (new VacancyDto())
            ->setTitle($vacancy->title)
            ->setDescription($vacancy->description)
            ->setDateCreate($dateCreate);

        return $vacancyDto;
    }

    /**
     * @param VacancyDto $vacancyDto
     * @return VacancyDto
     * @throws \Throwable
     */
    public function add(VacancyDto $vacancyDto): VacancyDto
    {
        $vacancy = new Vacancy();
        $vacancy->title = $vacancyDto->getTitle();
        $vacancy->description = $vacancyDto->getDescription();
        $vacancy->date_create = ($vacancyDto->getDateCreate())->getTimestamp();

        if (!$vacancy->insert()) {
            throw new RuntimeException('Adding error.');
        }

        $vacancyDto->setId($vacancy->id);

        return $vacancyDto;
    }

    /**
     * @param VacancyDto $vacancyDto
     * @throws NotFoundException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function save(VacancyDto $vacancyDto): void
    {
        if (!$vacancy = Vacancy::findOne($vacancyDto->getId())) {
            throw new NotFoundException('Vacancy not found.');
        }

        $vacancy->title = $vacancyDto->getTitle();
        $vacancy->description = $vacancyDto->getDescription();
        $vacancy->date_create = ($vacancyDto->getDateCreate())->getTimestamp();

        if ($vacancy->update() === false) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param VacancyDto $vacancyDto
     * @throws NotFoundException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(VacancyDto $vacancyDto): void
    {
        if (!$vacancy = Vacancy::findOne($vacancyDto->getId())) {
            throw new NotFoundException('Vacancy not found.');
        }

        if (!$vacancy->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     * @throws \Exception
     */
    public function all(int $limit, int $offset): array
    {
        $vacancies = Vacancy::find()
            ->limit($limit)
            ->offset($offset)
            ->asArray()
            ->all();

        $vacanciesDto = [];
        foreach ($vacancies as $vacancy) {
            /**
             * @var DateTime $dateCreate
             */
            $dateCreate = DateTime::createFromFormat('U', (string)$vacancy['date_create']);

            $vacanciesDto [] = (new VacancyDto())
                ->setId($vacancy['id'])
                ->setTitle($vacancy['title'])
                ->setDescription($vacancy['description'])
                ->setDateCreate($dateCreate);
        }

        return $vacanciesDto;
    }
}