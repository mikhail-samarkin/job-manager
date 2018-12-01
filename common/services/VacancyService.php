<?php
namespace app\common\services;

use app\common\dispatchers\EventDispatcher;
use app\common\entities\Vacancy\Vacancy;
use app\common\entities\Vacancy\VacancyId;
use app\common\repositories\VacancyRepository;

class VacancyService
{
    private $vacancyRepository;
    private $eventDispatcher;

    public function __construct(VacancyRepository $vacancyRepository, EventDispatcher $eventDispatcher)
    {
        $this->vacancyRepository = $vacancyRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getPreparedVacancies()
    {
        $vacancies = $this->vacancyRepository->all();
        return $vacancies;
    }

    public function generateRandomVacancies()
    {
        $count = rand(10, 100);
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->title;
            $description = $faker->text;
            $vacancy = new Vacancy($this->vacancyRepository->nextId(), $title, $description);
            $this->vacancyRepository->add($vacancy);
            $this->eventDispatcher->dispatch($vacancy->releaseEvents());
        }

        return $count;
    }
}
