<?php
declare(strict_types=1);
namespace app\common\dto;

/**
 * Class VacancyDto contains fields Vacancy object
 *
 * @package app\common\dto
 */
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
     * Get identificator Vacancy
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get title Vacancy
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title Vacancy
     *
     * @param string $title
     * @return VacancyDto
     */
    public function setTitle(string $title): VacancyDto
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get description Vacancy
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description Vacancy
     *
     * @param string $description
     * @return VacancyDto
     */
    public function setDescription(string $description): VacancyDto
    {
        $this->description = $description;

        return $this;
    }
}
