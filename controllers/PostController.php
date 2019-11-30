<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 20:55
 */

namespace app\controllers;


use app\models\Article;
use app\models\Category;
use app\forms\CommentForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionView($id): string
    {
        $article = $this->findArticle($id);
        $article->updateCounter();

        $popularPosts = Article::getPopularPosts();

        $model = new CommentForm();

        return $this->render('view', [
            'article' => $article,
            'popularPosts' => $popularPosts,
            'categories' => Category::getAll(),
            'commentForm' => $model,
        ]);
    }

    protected function findArticle(int $id): Article
    {
        /** @var Article $article */
        $article = Article::find()
            ->where(['id' => $id])
            ->with('tags')
            ->one();

        if ($article) {
            return $article;
        }
        throw new NotFoundHttpException('Article does not exist');
    }
}