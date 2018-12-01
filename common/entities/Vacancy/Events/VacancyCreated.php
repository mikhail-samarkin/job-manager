<?php
namespace app\common\entities\Vacancy\Events;


use app\common\entities\Vacancy\VacancyId;

class VacancyCreated
{
    private $vacancyId;

    public function __construct(VacancyId $vacancyId)
    {
        $this->vacancyId = $vacancyId;
    }
}