<?php
namespace app\common\services;

use app\common\builders\VacancyBuilder;
use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;

/**
 * Class VacancyService
 * @package app\common\services
 */
class VacancyService
{
    private $vacancyBuilder;

    public function __construct(VacancyBuilder $vacancyBuilder)
    {
        $this->vacancyBuilder = $vacancyBuilder;
    }

    /**
     * Get array vacancies
     *
     * @param $page
     * @return array
     */
    public function getPreparedVacancies($page) : array
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

    /**
     * Generate random vacancies from 10 to 100 count
     *
     * @return int
     */
    public function generateRandomVacancies() : int
    {
        $count = rand(10, 100);
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->name;
            $description = $faker->text;

            $vacancyDto = (new VacancyDto())
                ->setTitle($title)
                ->setDescription($description);

            $vacancy = $this->vacancyBuilder->buildVacancy($vacancyDto);

            $vacancy->save();
        }

        return $count;
    }
}
