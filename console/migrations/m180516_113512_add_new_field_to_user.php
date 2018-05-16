<?php

use yii\db\Migration;

/**
 * Class m180516_113512_add_new_field_to_user
 */
class m180516_113512_add_new_field_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180516_113512_add_new_field_to_user cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%user}}', 'last_visit_at', $this->integer());
    }

    public function down()
    {
        echo "m180516_113512_add_new_field_to_user cannot be reverted.\n";
        $this->dropColumn('{{%user}}', 'last_visit_at');
        return false;
    }

}
