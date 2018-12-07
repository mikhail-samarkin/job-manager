<?php
declare(strict_types=1);
namespace app\console\controllers;

use app\common\dto\VacancyDto;
use app\common\repositories\VacancyRepositoryInterface;
use Exception;
use Faker\Factory;
use Yii;
use yii\base\Module;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Class VacancyController
 * @package app\console\controllers
 */
class VacancyController extends Controller
{
    /**
     * @var VacancyRepositoryInterface
     */
    private $repository;

    /**
     * VacancyController constructor.
     *
     * Inject VacancyBuilder
     *
     * @param string $id
     * @param Module $module
     * @param VacancyRepositoryInterface $repository
     * @param array $config
     */
    public function __construct(string $id, Module $module, VacancyRepositoryInterface $repository, array $config = [])
    {
        $this->repository = $repository;
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
        $faker = Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->name;
            $description = $faker->text;

            try {
                $vacancyDto = (new VacancyDto())
                    ->setTitle($title)
                    ->setDescription($description);
            } catch (Exception $e) {
                Yii::warning('Error create VacancyDto object in console VacancyController');
                continue;
            }

            $this->repository->add($vacancyDto);
        }

        return $count;
    }
}
