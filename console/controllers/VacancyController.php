<?php
declare(strict_types=1);
namespace app\console\controllers;

use app\common\builders\VacancyBuilder;
use app\common\dto\VacancyDto;
use yii\base\Module;
use yii\helpers\Console;

/**
 * Class VacancyController
 * @package app\console\controllers
 */
class VacancyController extends \yii\console\Controller
{
    /**
     * @var VacancyBuilder
     */
    private $vacancyBuilder;

    /**
     * VacancyController constructor.
     *
     * Inject VacancyBuilder
     *
     * @param string $id
     * @param Module $module
     * @param VacancyBuilder $vacancyBuilder - class for create Vacancy object
     * @param array $config
     */
    public function __construct(string $id, Module $module, VacancyBuilder $vacancyBuilder, array $config = [])
    {
        $this->vacancyBuilder = $vacancyBuilder;
        parent::__construct($id, $module, $config);
    }

    /**
     * Generate random vacancies
     */
    public function actionGenerate(): void
    {
        $count = $this->generateRandomVacancies();
        Console::output('Generated '.$count.' vacancies');
    }

    /**
     * Generate random vacancies from 10 to 100 count
     *
     * @return int
     */
    private function generateRandomVacancies(): int
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
