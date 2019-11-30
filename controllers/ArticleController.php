<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 22:11
 */

namespace app\controllers;


use app\forms\CategoryIdForm;
use app\models\Article;
use app\models\Category;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use yii\web\Controller;

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

    public function actionCategory($categoryId)
    {
        $form = new CategoryIdForm(['categoryId' => $categoryId]);
        if ($form->validate()) {
            $dp = Article::getCategoryDataProvider($categoryId);
            $popularPosts = Article::getPopularPosts();
            $categories = Category::getAll();

            return $this->render('category', [
                'articles' => $dp->getModels(),
                'pagination' => $dp->getPagination(),
                'popularPosts' => $popularPosts,
                'categories' => $categories,
            ]);
        }
        throw new UnprocessableEntityHttpException('Invalid category id');
    }
}