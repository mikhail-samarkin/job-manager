<?php
declare(strict_types=1);
namespace app\tests\unit\common\services;

use app\common\dto\VacancyDto;
use app\common\repositories\ARVacancyRepository;
use app\common\services\VacancyService;
use app\tests\fixtures\VacancyFixture;
use DateTime;

/**
 * Class VacancyServiceTest contains test methods VacancyService
 *
 * @package app\tests\unit\common\services
 */
class VacancyServiceTest extends \Codeception\Test\Unit
{

    /**
     * Test method getPreparedVacancies
     *
     * @param $page - number page
     * @param $expectedCount - count vacancies on output
     *
     * @throws \Exception
     * @dataProvider getPreparedVacanciesProvider
     */
    public function testGetPreparedVacancies($page, $expectedCount): void
    {
        $vacancyRepository = $this->getARVacancyRepositoryMock();
        $vacancyRepository->method('all')
            ->willReturn($this->getReturnMethodAll());

        $vacancyService = $this->getVacancyService($vacancyRepository);

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
        $expectedCount = 1;
        return [
            [$page, $expectedCount]
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getReturnMethodAll(): array
    {
        $vacanciesDto = [];
        $vacanciesDto [] = (new VacancyDto())
            ->setTitle('Title first vacancy')
            ->setDescription('Description first vacancy')
            ->setDateCreate(DateTime::createFromFormat('U', '1544085689'));

        return $vacanciesDto;
    }

    /**
     * Get Vacancy Service object
     *
     * @param ARVacancyRepository $vacancyRepository
     * @return VacancyService
     */
    private function getVacancyService(ARVacancyRepository $vacancyRepository): VacancyService
    {
        return new VacancyService($vacancyRepository);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getARVacancyRepositoryMock()
    {
        return $this->createMock(ARVacancyRepository::class);
    }
}
