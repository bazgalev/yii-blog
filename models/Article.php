<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $desription
 * @property string $content
 * @property string $date
 * @property string $image
 * @property int $viewed
 * @property int $status
 * @property int $category_id
 * @property int $author_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 * @property Tag[] $tags
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @param int $limit
     * @return Article[]
     */
    public static function getPopularPosts($limit = 3): array
    {
        return self::find()->orderBy('viewed desc')->limit($limit)->all();
    }

    /**
     * @param int $limit
     * @return Article[]
     */
    public static function getRecentPosts($limit = 4)
    {
        return self::find()->orderBy('date desc')->limit($limit)->all();
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desription', 'content'], 'string'],
            [['date'], 'safe'],
            [['viewed', 'status', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
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
            'desription' => 'Desription',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'author_id' => 'Author ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::class, ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    /**
     * Save image filename into database
     * @param $filename
     * @return bool
     */
    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    /**
     * @return string path to image file
     */
    public function getImage(): string
    {
        return !is_null($this->image) ?
            '/uploads/' . $this->image :
            '/uploads/default.jpg';
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Save category id of Article model
     * @param int $category_id
     */
    public function saveCategory(int $category_id): void
    {
        $category = Category::findOne($category_id);

        if ($category != null) {
            $this->link('category', $category);
        }
    }

    /**
     * @return int id of selected category of model Article
     */
    public function getSelectedCategoryId()
    {
        if ($this->category) {
            return $this->category->id;
        }

        return 0;
    }

    /**
     * @return array of id=>title of model Tag for this Article
     */
    public function getSelectedTagsIds()
    {
        if ($this->tags) {
            return ArrayHelper::getColumn($this->tags, 'id');
        }

        return 0;
    }

    public function getTagsString()
    {
        $tags = $this->getSelectedTagsIds();
        $string = '';

        if ($tags) {
            foreach ($tags as $tag) {

                $string .= $tag;

                if ($tag != end($tags)) {
                    $string .= ', ';
                }
            }
        }

        return $string;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    public function saveTags($selectedTags)
    {
        if (is_array($selectedTags)) {

            $this->clearTags();

            foreach ($selectedTags as $sTag) {
                $modelTag = Tag::findOne($sTag);
                $this->link('tags', $modelTag);
            }
        }
    }

    /**
     * Unlink tag and article
     */
    private function clearTags()
    {
        foreach ($this->tags as $tag) {
            $this->unlink('tags', $tag, true);
        }
    }

    /**
     * Return formatted datetime
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date, 'long');
    }

    /**
     * Save article into db
     */
    public function saveArticle()
    {
        $this->author_id = Yii::$app->user->id;
        return $this->save();
    }

    public function updateCounter()
    {
        $this->viewed += 1;

        return $this->save();
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public static function getDataProvider(int $pageSize = 5): ActiveDataProvider
    {
        return self::createDataProvider(Article::find(), $pageSize);
    }

    public static function getCategoryDataProvider(int $categoryId, int $pageSize = 5): ActiveDataProvider
    {
        $query = Article::find()->where(['category_id' => $categoryId]);
        return self::createDataProvider($query, $pageSize);
    }

    private static function createDataProvider(ActiveQuery $query, $pageSize = 5): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ],
        ]);
    }

}
