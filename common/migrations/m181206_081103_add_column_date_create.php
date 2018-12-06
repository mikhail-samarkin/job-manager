<?php
declare(strict_types=1);

namespace app\common\migrations;

use yii\db\Migration;

/**
 * Class m181206_081103_add_column_date_create
 */
class m181206_081103_add_column_date_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job.vacancy}}', 'date_create', $this->integer(11)->defaultValue((new \DateTime())->getTimestamp()));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job.vacancy}}', 'date_create');

        return true;
    }

}
