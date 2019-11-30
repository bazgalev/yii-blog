<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 21:05
 */

namespace app\controllers;


use app\models\Comment;
use app\forms\CommentForm;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UnprocessableEntityHttpException;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @param $postId
     * @return \yii\web\Response
     * @throws UnprocessableEntityHttpException
     */
    public function actionCreate($postId)
    {
        $form = new CommentForm();
        $form->load(Yii::$app->request->post());

        if ($form->validate()) {
            $comment = Comment::create($form->commentText, $postId, Yii::$app->user->id);
            $comment->save(false);

            Yii::$app->getSession()->setFlash('comment', 'Comment added!');
            return $this->redirect(Url::toRoute(['post/view', 'id' => $postId]));
        }

        throw new UnprocessableEntityHttpException('Comment posting error');
    }
}