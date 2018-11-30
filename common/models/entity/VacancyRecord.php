<?php
namespace app\common\models\entity;

class VacancyRecord extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%job.vacancy}}';
    }

    public function getCompany() {
        $this->hasOne(CompanyRecord::class, ['id'   => 'company_id']);
    }
}