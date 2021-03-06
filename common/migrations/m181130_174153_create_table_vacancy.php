<?php
declare(strict_types=1);
namespace app\common\migrations;

use yii\db\Migration;

/**
 * Class m181130_174153_create_table_vacancy
 *
 * Migration create table storage vacancies AND schema for table
 *
 */
class m181130_174153_create_table_vacancy extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp(): void
    {
        $this->db->createCommand('CREATE SCHEMA job')->execute();

        $this->createTable('{{%job.vacancy}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string(255)->notNull(),
            'description'   => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeDown(): bool
    {
        $this->dropTable('{{%job.vacancy}}');

        $this->db->createCommand('DROP SCHEMA job')->execute();

        return true;
    }
}
