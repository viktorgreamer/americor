<?php

use yii\db\Migration;

/**
 * Class m191116_205643_add_column_type_fax
 */
class m191116_205643_add_column_type_fax extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("{{%fax}}", 'type', $this->integer()->null()->comment('Type'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("{{%fax}}", 'type');

    }
}
