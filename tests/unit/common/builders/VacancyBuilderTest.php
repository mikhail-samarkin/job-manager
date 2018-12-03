<?php
declare(strict_types=1);
namespace app\tests\unit\common\builders;

use app\common\builders\VacancyBuilder;
use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;

/**
 * Class VacancyServiceTest contains methods for testing VacancyService
 *
 * @package app\tests\unit\common\builders
 */
class VacancyServiceTest extends \Codeception\Test\Unit
{

    /**
     * Test method buildVacancy
     *
     * @param $title
     * @param $description
     *
     * @dataProvider buildVacancyProvider
     */
    public function testBuildVacancy($title, $description): void
    {
        $vacancyBuilder = $this->getVacancyBuilder();

        $vacancyDto = (new VacancyDto())
            ->setTitle($title)
            ->setDescription($description);

        $vacancy = $vacancyBuilder->buildVacancy($vacancyDto);

        $this->assertTrue($vacancy instanceof Vacancy);
        $this->assertTrue($vacancy->title === $vacancyDto->getTitle());
        $this->assertTrue($vacancy->description === $vacancyDto->getDescription());
    }

    /**
     * Provider for testBuildVacancy
     *
     * @return array
     */
    public function buildVacancyProvider(): array
    {
        return [
            ['title', 'description']
        ];
    }

    /**
     * Get VacancyBuilder object
     *
     * @return VacancyBuilder
     */
    private function getVacancyBuilder(): VacancyBuilder
    {
        return new VacancyBuilder();
    }
}
