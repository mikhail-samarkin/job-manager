<?php
namespace app\common\migrations;

use yii\db\Migration;

/**
 * Class m181130_174153_create_table_vacancy
 */
class m181130_174153_create_table_vacancy extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {

        $this->db->createCommand('CREATE SCHEMA job')->execute();

        $this->createTable('{{%job.vacancy}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string(255)->notNull(),
            'description'   => $this->string(1000)->notNull(),
            'company_id'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job.vacancy}}');

        $this->db->createCommand('DROP SCHEMA job')->execute();

        return true;
    }

}
