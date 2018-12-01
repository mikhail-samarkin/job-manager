<?php
namespace app\common\entities\Vacancy\Events;

use app\common\entities\Vacancy\VacancyId;

class VacancyDescriptionChanged
{
    private $vacancyId;
    private $description;

    public function __construct(VacancyId $vacancyId, $description)
    {
        $this->vacancyId = $vacancyId;
        $this->description = $description;
    }
}