<?php

use yii\db\Migration;

/**
 * Handles adding author_id to table `article`.
 */
class m190115_155438_add_author_id_column_to_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'author_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'author_id');
    }
}
