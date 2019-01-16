<?php

namespace app\models;

use Yii;
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

    public static function getPopularPosts($limit = 3)
    {
        return self::find()->orderBy('viewed desc')->limit($limit)->all();
    }

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
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
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
    public function getImage()
    {
        if ($this->image) {
            return '/uploads/' . $this->image;
        } else {
            return '/uploads/default.jpg';
        }
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Save category id of Article model
     * @param $category_id
     * @return bool
     */
    public function saveCategory($category_id)
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
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
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
     * Get data for main section
     *
     * @param ActiveQuery $query
     * @param int $pageSize
     * @return array
     */
    public static function getMainSectionData(ActiveQuery $query, $pageSize = 5)
    {
        $count = $query->count();

        $pages = new Pagination([
            'totalCount' => $count,
            'pageSize' => $pageSize,
        ]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('date desc')
            ->all();

        return array(
            'models' => $models,
            'pages' => $pages,
        );
    }

    /**
     * Get array of all Tag models
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAllTags()
    {
        return $this->getTags()->all();
    }

    /**
     * Save article into db
     */
    public function saveArticle()
    {
        $this->author_id = Yii::$app->user->id;
        return $this->save();
    }

    public function getArticleComments()
    {
        return $this->comments;
    }

}
