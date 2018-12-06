<?php
declare(strict_types=1);
namespace app\tests\unit\common\services;

use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;
use app\common\exceptions\NotFoundException;
use app\common\repositories\ARVacancyRepository;
use app\tests\fixtures\VacancyFixture;
use DateTime;
use Faker\Factory;

/**
 * Class VacancyServiceTest contains test methods VacancyService
 *
 * @package app\tests\unit\common\services
 */
class ARVacancyRepositoryTest extends \Codeception\Test\Unit
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
     * @param $id
     *
     * @param $expectTitle
     * @param $expectDescription
     * @param $expectDateCreate
     * @throws \app\common\exceptions\NotFoundException
     * @dataProvider getGetProvider
     */
    public function testGet($id, $expectTitle, $expectDescription, $expectDateCreate): void
    {
        $repository = $this->getARVacancyRepository();

        $vacancyDto = $repository->get($id);

        static::assertTrue($vacancyDto instanceof VacancyDto);
        static::assertTrue($vacancyDto->getDateCreate() instanceof DateTime);
        static::assertEquals($expectTitle, $vacancyDto->getTitle());
        static::assertEquals($expectDescription, $vacancyDto->getDescription());
        static::assertEquals($expectDateCreate, $vacancyDto->getDateCreate());
    }

    /**
     * Provider for testGet
     *
     * @return array
     */
    public function getGetProvider(): array
    {
        return [
            [
                1,
                'Title first vacancy',
                'Description first vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                2,
                'Title two vacancy',
                'Description two vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                3,
                'Title three vacancy',
                'Description three vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                4,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                5,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                6,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                7,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                8,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                9,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ],
            [
                10,
                'Title any vacancy',
                'Description any vacancy',
                DateTime::createFromFormat('U', '1544085689')
            ]
        ];
    }

    /**
     * @expectedException \app\common\exceptions\NotFoundException
     */
    public function testGetNotFoundException(): void
    {
        $repository = $this->getARVacancyRepository();

        $repository->get(PHP_INT_MAX);
    }

    /**
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testAdd()
    {
        $repository = $this->getARVacancyRepository();

        $vacancyDto = (new VacancyDto())
            ->setTitle('My Title')
            ->setDescription('My Description');

        $vacancyDto = $repository->add($vacancyDto);

        static::assertTrue($vacancyDto instanceof VacancyDto);
        static::assertNotEquals(null, $vacancyDto->getId());
        static::assertTrue(is_int($vacancyDto->getId()));
    }

    /**
     *
     * @expectedException \RuntimeException
     */
    public function testAddRunTimeException()
    {
        $repository = $this->getARVacancyRepository();

        $faker = Factory::create();

        $vacancyDto = (new VacancyDto())
            ->setTitle($faker->sentence(100))
            ->setDescription('My Description');

        $repository->add($vacancyDto);
    }

    /**
     * @expectedException \app\common\exceptions\NotFoundException
     */
    public function testSaveNotFoundException(): void
    {
        $repository = $this->getARVacancyRepository();

        $vacancyDto = (new VacancyDto())
            ->setId(PHP_INT_MAX)
            ->setTitle('My Title')
            ->setDescription('My Description');

        $repository->save($vacancyDto);
    }

    /**
     * @expectedException \RuntimeException
     * @throws NotFoundException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function testSaveRunTimeException(): void
    {
        $repository = $this->getARVacancyRepository();

        $faker = Factory::create();

        $vacancyDto = (new VacancyDto())
            ->setId(1)
            ->setTitle($faker->sentence(100))
            ->setDescription('My Description');

        $repository->save($vacancyDto);
    }

    /**
     * @throws NotFoundException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function testSave(): void
    {
        $repository = $this->getARVacancyRepository();

        $vacancyDto = (new VacancyDto())
            ->setId(1)
            ->setTitle('My new title')
            ->setDescription('My new description');

        $repository->save($vacancyDto);

        $actualVacancy = Vacancy::findOne(1);
        $actualDateCreateTime = DateTime::createFromFormat('U', (string)$actualVacancy->date_create);

        static::assertEquals($vacancyDto->getTitle(), $actualVacancy->title);
        static::assertEquals($vacancyDto->getDescription(), $actualVacancy->description);
        static::assertTrue($actualDateCreateTime instanceof DateTime);
        static::assertEquals($vacancyDto->getDateCreate()->format('Y-m-d H:i:s'), $actualDateCreateTime->format('Y-m-d H:i:s'));
    }

    /**
     * @expectedException \app\common\exceptions\NotFoundException
     */
    public function testRemoveNotFoundException(): void
    {
        $repository = $this->getARVacancyRepository();

        $vacancyDto = (new VacancyDto())
            ->setId(PHP_INT_MAX)
            ->setTitle('My Title')
            ->setDescription('My Description');

        $repository->remove($vacancyDto);
    }

    /**
     * @throws NotFoundException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function testRemove(): void
    {
        $repository = $this->getARVacancyRepository();

        $id = 1;
        $vacancyDto = (new VacancyDto())
            ->setId($id)
            ->setTitle('My Title')
            ->setDescription('My Description');

        $repository->remove($vacancyDto);

        $actualVacancy = Vacancy::findOne($id);

        static::assertEquals(null, $actualVacancy);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param int $expectedCount
     * @throws \Exception
     * @dataProvider getAllProvider
     */
    public function testAll(int $limit, int $offset, int $expectedCount): void
    {
        $repository = $this->getARVacancyRepository();

        $vacanciesDto = $repository->all($limit, $offset);

        static::assertTrue(is_array($vacanciesDto));
        static::assertCount($expectedCount, $vacanciesDto);
    }

    /**
     * @return array
     */
    public function getAllProvider()
    {
        return [
            [1, 0, 1],
            [10, 5, 6]
        ];
    }

    /**
     * Get Vacancy Service object
     *
     * @return ARVacancyRepository
     */
    private function getARVacancyRepository(): ARVacancyRepository
    {
        return new ARVacancyRepository();
    }
}
