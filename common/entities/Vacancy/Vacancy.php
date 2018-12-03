<?php
namespace app\common\entities\Vacancy;

use app\common\dto\VacancyDto;
use app\common\entities\AggregateRoot;
use app\common\entities\EventTrait;
use app\common\repositories\InstantiateTrait;
use yii\db\ActiveRecord;

/**
 * Class Vacancy
 *
 * @property VacancyId $id
 * @property string $title
 * @property string $description
 * @package app\common\entities\Vacancy
 */
class Vacancy extends ActiveRecord implements AggregateRoot
{
    use EventTrait, InstantiateTrait;

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

    public function __construct(VacancyDto $vacancyDto)
    {
        $this->id = $vacancyDto->getId();
        $this->title = $vacancyDto->getTitle();
        $this->description = $vacancyDto->getDescription();
        $this->recordEvent(new Events\VacancyCreated($this->id));
        parent::__construct();
    }

    public function changeTitle($title)
    {
        $this->title = $title;
        $this->recordEvent(new Events\VacancyTitleChanged($this->id, $this->title));
    }

    public function changeDescription($description)
    {
        $this->description = $description;
        $this->recordEvent(new Events\VacancyDescriptionChanged($this->id, $this->description));
    }

    public static function tableName(): string
    {
        return '{{%job.vacancy}}';
    }

    public function afterFind(): void
    {
        $this->id = new VacancyId(
            $this->getAttribute('id')
        );

        $this->title =  $this->getAttribute('title');

        $this->description =  $this->getAttribute('description');

        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('id', $this->id->getId());

        $this->setAttribute('title', $this->title);

        $this->setAttribute('description', $this->description);

        return parent::beforeSave($insert);
    }

    public static function primaryKey()
    {
        return ['id'];
    }

}
