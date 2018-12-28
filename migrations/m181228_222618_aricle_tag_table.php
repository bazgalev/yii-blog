<?php

use yii\db\Migration;

/**
 * Class m181228_222618_aricle_tag_table
 */
class m181228_222618_aricle_tag_table extends Migration
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
        echo "m181228_222618_aricle_tag_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);

        /**
         *  Create index for column `user_id`
         */
        $this->createIndex(
            'tag_article_article_id',
            'article_tag',
            'article_id'
        );

        /**
         * Add foreign key for table `user`
         */
        $this->addForeignKey(
            'tag_article_article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        /**
         * Create index for column `user_id`
         */
        $this->createIndex(
            'idx_tag_id',
            'article_tag',
            'tag_id'
        );

        /**
         * Add foreign key for table `user`
         */
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('tag');
    }

}
