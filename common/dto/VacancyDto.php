<?php
namespace app\common\dto;

use app\common\entities\Vacancy\VacancyId;

class VacancyDto
{
    /**
     * @var VacancyId $id
     */
    private $id;
    /**
     * @var string $title
     */
    private $title;
    /**
     * @var string $description
     */
    private $description;

    /**
     * @return VacancyId
     */
    public function getId(): VacancyId
    {
        return $this->id;
    }

    /**
     * @param VacancyId $id
     * @return VacancyDto
     */
    public function setId(VacancyId $id): VacancyDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return VacancyDto
     */
    public function setTitle(string $title): VacancyDto
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return VacancyDto
     */
    public function setDescription(string $description): VacancyDto
    {
        $this->description = $description;

        return $this;
    }
}