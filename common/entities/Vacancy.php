<?php
namespace app\common\entities;

use yii\db\ActiveRecord;

/**
 * Class Vacancy
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @package app\common\entities\Vacancy
 */
class Vacancy extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%job.vacancy}}';
    }
}
