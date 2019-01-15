<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 15.01.2019
 * Time: 19:57
 */

namespace app\models;

use yii\base\Model;
use Yii;

class CommentForm extends Model
{
    /**
     * Text of the comment
     *
     * @var string $commentText
     */
    public $commentText;

    public function rules()
    {
        return [
            [['commentText'], 'required'],
            [['commentText'], 'string', 'length' => [3, 250]],
        ];
    }

    /**
     * Save article comment into db
     *
     * @param int $articleId
     * @return bool
     */
    public function saveComment(int $articleId)
    {
        $comment = new Comment();

        $comment->text = $this->commentText;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $articleId;
        $comment->date = date('Y-m-d');

        return $comment->save();
    }
}