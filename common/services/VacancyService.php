<?php
namespace app\common\services;

use app\common\entities\Vacancy;

class VacancyService
{
    public function getPreparedVacancies()
    {
        $vacancies = Vacancy::find()->asArray()->all();

        return $vacancies;
    }

    /**
     * @return int
     */
    public function generateRandomVacancies()
    {
        $count = rand(10, 100);
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->title;
            $description = $faker->text;

            $vacancy = new Vacancy();
            $vacancy->title = $title;
            $vacancy->description = $description;
            $vacancy->save();

        }

        return $count;
    }
}
