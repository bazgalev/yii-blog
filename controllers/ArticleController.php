<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 22:11
 */

namespace app\controllers;


use app\forms\CategoryIdForm;
use app\forms\CommentForm;
use app\models\Article;
use app\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller
{
    public function actionIndex(): string
    {
        $dp = Article::getDataProvider();
        $popularPosts = Article::getPopularPosts();
        $categories = Category::getAll();

        return $this->render('index', [
            'dataProvider' => $dp,
            'popularPosts' => $popularPosts,
            'categories' => $categories,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
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

    public function actionCategory($categoryId)
    {
        $form = new CategoryIdForm(['categoryId' => $categoryId]);
        if ($form->validate()) {
            $dp = Article::getCategoryDataProvider($categoryId);
            $popularPosts = Article::getPopularPosts();
            $categories = Category::getAll();

            return $this->render('category', [
                'dp' => $dp,
                'popularPosts' => $popularPosts,
                'categories' => $categories,
            ]);
        }
        return $this->goHome();
    }

    /**
     * @param int $id
     * @return Article
     * @throws NotFoundHttpException
     */
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