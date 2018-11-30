<?php namespace common\services;


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

    protected function _after()
    {
    }

    public function testGetPreparedVacancies()
    {
        $vacancyService = $this->getVacancyService();

        $vacancies = $vacancyService->getPreparedVacancies();

        $this->assertTrue(is_array($vacancies));
        $this->assertCount(1, $vacancies);
        $vacancy = array_shift($vacancies);
        $this->assertArrayHasKey('title', $vacancy);
        $this->assertArrayHasKey('description', $vacancy);
        $this->assertContains('Title first vacancy', $vacancy['title']);
        $this->assertContains('Description first vacancy', $vacancy['description']);
    }

    private function getVacancyService() {
        return new VacancyService();
    }
}