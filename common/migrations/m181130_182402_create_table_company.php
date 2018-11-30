<?php
namespace app\common\migrations;

use yii\db\Migration;

/**
 * Class m181130_182402_create_table_company
 */
class m181130_182402_create_table_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job.company}}', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(255)->notNull()
        ]);

        $this->addForeignKey('vacancy_company','{{%job.vacancy}}', 'company_id',
            '{{%job.company}}', 'id'
        );

        $this->insert('{{%job.company}}', [
            'name'  => 'Рога и Копыта'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('vacancy_company','{{%job.vacancy}}', 'company_id');

        $this->dropTable('{{%job.company}}');

        return true;
    }

}
