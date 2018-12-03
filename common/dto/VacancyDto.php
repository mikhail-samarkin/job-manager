<?php
namespace app\common\dto;

class VacancyDto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
