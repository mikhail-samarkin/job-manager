<?php
namespace app\common\services;

use app\common\dispatchers\EventDispatcher;
use app\common\dto\VacancyDto;
use app\common\entities\Vacancy\Vacancy;
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
        /**
         * @var Vacancy[] $vacancies
         */
        $vacancies = $this->vacancyRepository->getAll();

        foreach ($vacancies as &$vacancy) {
            $vacancy = $vacancy->toArray();
        }

        return $vacancies;
    }

    public function generateRandomVacancies()
    {
        $count = rand(10, 100);
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->title;
            $description = $faker->text;

            $vacancyDto = (new VacancyDto())
                ->setId($this->vacancyRepository->nextId())
                ->setTitle($title)
                ->setDescription($description);

            $vacancy = new Vacancy($vacancyDto);
            $this->vacancyRepository->add($vacancy);
            $this->eventDispatcher->dispatch($vacancy->releaseEvents());
        }

        return $count;
    }
}
