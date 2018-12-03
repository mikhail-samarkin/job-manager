<?php
namespace app\tests\unit\common\builders;

use app\common\builders\VacancyBuilder;
use app\common\dto\VacancyDto;
use app\common\entities\Vacancy;

class VacancyServiceTest extends \Codeception\Test\Unit
{

    /**
     * @param $title
     * @param $description
     *
     * @dataProvider buildVacancyProvider
     */
    public function testBuildVacancy($title, $description)
    {
        $vacancyBuilder = $this->getVacancyBuilder();

        $vacancyDto = (new VacancyDto())
            ->setTitle($title)
            ->setDescription($description);

        $vacancy = $vacancyBuilder->buildVacancy($vacancyDto);

        $this->assertTrue($vacancy instanceof Vacancy);
    }

    public function buildVacancyProvider()
    {
        return [
            ['title', 'description']
        ];
    }

    private function getVacancyBuilder()
    {
        return new VacancyBuilder();
    }
}
