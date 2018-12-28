<?php

use yii\db\Migration;

/**
 * Class m181228_222536_comment_table
 */
class m181228_222536_comment_table extends Migration
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
        echo "m181228_222536_comment_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'user_id' => $this->integer(),
            'article_id'=>$this->integer(),
            'status'=>$this->integer()
        ]);

        /**
         * Create index for column 'user_id'
         */
        $this->createIndex(
            'idx-post-user_id',
            'comment',
            'user_id'
        );

        /**
         * Add foreign key to column 'user_id'
         */
        $this->addForeignKey(
            'fk-post-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        /**
         * Create index for column 'article_id'
         */
        $this->createIndex(
            'idx-post-article_id',
            'comment',
            'article_id'
        );

        /**
         * Add foreign key to column 'article_id'
         */
        $this->addForeignKey(
            'fk-article_id',
            'comment',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('comment');
    }

}
