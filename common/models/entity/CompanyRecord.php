<?php
namespace app\common\models\entity;

class CompanyRecord extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%job.company}}';
    }

    public function getVacancies() {
        $this->hasMany(VacancyRecord::class, ['company_id'  => 'id']);
    }
}