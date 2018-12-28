<?php

use yii\db\Migration;

/**
 * Class m181228_222201_tag_table
 */
class m181228_222201_tag_table extends Migration
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
        echo "m181228_222201_tag_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tag',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('tag');
    }

}
