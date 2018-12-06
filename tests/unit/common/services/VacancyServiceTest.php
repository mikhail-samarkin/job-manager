<?php
declare(strict_types=1);
namespace app\tests\unit\common\services;

use app\common\repositories\ARVacancyRepository;
use app\common\services\VacancyService;
use app\tests\fixtures\VacancyFixture;

/**
 * Class VacancyServiceTest contains test methods VacancyService
 *
 * @package app\tests\unit\common\services
 */
class VacancyServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Connect fixtures vacancy table for tests
     */
    protected function _before(): void
    {
        $this->tester->haveFixtures([
            'user' => [
                'class'     => VacancyFixture::class,
                'dataFile'  => codecept_data_dir() . 'vacancy.php'
            ]
        ]);
    }

    /**
     * Test method getPreparedVacancies
     *
     * @param $page - number page
     * @param $expectedCount - count vacancies on output
     *
     * @dataProvider getPreparedVacanciesProvider
     */
    public function testGetPreparedVacancies($page, $expectedCount): void
    {
        $vacancyService = $this->getVacancyService();

        $vacancies = $vacancyService->getPreparedVacancies($page);

        static::assertTrue(is_array($vacancies));
        static::assertCount($expectedCount, $vacancies);
        $vacancy = array_shift($vacancies);
        static::assertArrayHasKey('title', $vacancy);
        static::assertArrayHasKey('description', $vacancy);
        static::assertContains('Title first vacancy', $vacancy['title']);
        static::assertContains('Description first vacancy', $vacancy['description']);
    }

    /**
     * Provider for testGetPreparedVacancies
     *
     * @return array
     */
    public function getPreparedVacanciesProvider(): array
    {
        $page = 1;
        $expectedCount = 10;
        return [
            [$page, $expectedCount]
        ];
    }

    /**
     * Get Vacancy Service object
     *
     * @return VacancyService
     */
    private function getVacancyService(): VacancyService
    {
        return new VacancyService(new ARVacancyRepository());
    }
}
