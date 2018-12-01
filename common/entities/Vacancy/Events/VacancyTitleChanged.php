<?php
namespace app\common\entities\Vacancy\Events;

use app\common\entities\Vacancy\VacancyId;

class VacancyTitleChanged
{
    private $vacancyId;
    private $title;

    public function __construct(VacancyId $vacancyId, $title)
    {
        $this->vacancyId = $vacancyId;
        $this->title = $title;
    }
}
