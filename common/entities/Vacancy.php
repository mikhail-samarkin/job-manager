<?php
declare(strict_types=1);
namespace app\common\entities;

use yii\db\ActiveRecord;

/**
 * Class Active Record: Vacancy
 *
 * @property int $id
 * @property string $title
 * @property string $description
 *
 * @package app\common\entities\Vacancy
 */
class Vacancy extends ActiveRecord
{
    /**
     * Table storage vacancies
     *
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%job.vacancy}}';
    }
}
