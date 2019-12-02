<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @return Category[]
     */
    public static function getAll(): array
    {
        return self::find()->all();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Get all Article objects from Category object
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['category_id' => 'id']);
    }

    /**
     * Return an array where key is category id and value is category title
     * @return array id => title
     */
    public static function getCategoriesArray()
    {
        $categories = Category::find()->all();
        return ArrayHelper::map($categories, 'id', 'title');
    }

    public function getArticleCount()
    {
        return $this->getArticles()->count();
    }
}
