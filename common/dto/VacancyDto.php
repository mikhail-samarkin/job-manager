<?php
declare(strict_types=1);
namespace app\common\dto;

use DateTime;

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
     * @var DateTime $dateCreate
     */
    private $dateCreate;

    /**
     * By default, sets $dateCreate as the current date.
     *
     * VacancyDto constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->dateCreate = new DateTime();
    }

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
     * @param int $id
     * @return VacancyDto
     */
    public function setId(int $id): VacancyDto
    {
        $this->id = $id;

        return $this;
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

    /**
     * @return DateTime
     */
    public function getDateCreate(): DateTime
    {
        return $this->dateCreate;
    }

    /**
     * @param DateTime $createDate
     * @return VacancyDto
     */
    public function setDateCreate(DateTime $createDate): VacancyDto
    {
        $this->dateCreate = $createDate;

        return $this;
    }

    /**
     * Convert this object to array for output
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'date_create'   => $this->dateCreate->format('Y-m-d H:i:s')
        ];
    }
}
