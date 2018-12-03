<?php
namespace app\tests\unit\common\services;

use app\common\builders\VacancyBuilder;
use app\common\services\VacancyService;
use app\tests\fixtures\VacancyFixture;

class VacancyServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => VacancyFixture::class,
                'dataFile' => codecept_data_dir() . 'vacancy.php'
            ]
        ]);
    }

    /**
     * @dataProvider getPreparedVacanciesProvider
     * @param $page
     * @param $expectedCount
     */
    public function testGetPreparedVacancies($page, $expectedCount)
    {
        $vacancyService = $this->getVacancyService();

        $vacancies = $vacancyService->getPreparedVacancies($page);

        $this->assertTrue(is_array($vacancies));
        $this->assertCount($expectedCount, $vacancies);
        $vacancy = array_shift($vacancies);
        $this->assertArrayHasKey('title', $vacancy);
        $this->assertArrayHasKey('description', $vacancy);
        $this->assertContains('Title first vacancy', $vacancy['title']);
        $this->assertContains('Description first vacancy', $vacancy['description']);
    }

    /**
     * @return array
     */
    public function getPreparedVacanciesProvider()
    {
        $page = 1;
        $expectedCount = 10;
        return [
            [$page, $expectedCount]
        ];
    }



    /**
     * @return VacancyService
     */
    private function getVacancyService()
    {
        $vacancyBuilder = new VacancyBuilder();
        return new VacancyService($vacancyBuilder);
    }
}
