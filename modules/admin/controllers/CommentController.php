<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 17.01.2019
 * Time: 16:09
 */

namespace app\modules\admin\controllers;

use app\models\Comment;
use yii\web\Controller;

class CommentController extends Controller
{
    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $comments = Comment::getAllOrderByDate();

        return $this->render('index', [
            'comments' => $comments,
        ]);
    }

    /**
     * Delete selected Comment model from db
     *
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);

        if ($comment->delete()) {

            return $this->redirect(['comment/index']);
        }
    }


}