<?php

use yii\db\Migration;

/**
 * Class m181228_222111_article_table
 */
class m181228_222111_article_table extends Migration
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
        echo "m181228_222111_article_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'desription' => $this->text(),
            'content' => $this->text(),
            'date'=>$this->date(),
            'image'=>$this->string(),
            'viewed'=>$this->integer(),
            'status'=>$this->integer(),
            'category_id'=>$this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('article');
    }

}
