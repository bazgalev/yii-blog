<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \app\models\Article[] $popularPosts */
/** @var \app\models\Category[] $categories */
/** @var yii\web\View $this */
/** @var \app\models\Article $article */

$this->title = 'Main page'
?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <?php foreach ($dataProvider->getModels() as $article): ?>
                    <article class="post">

                        <div class="post-thumb">
                            <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]) ?>">
                                <img src="<?= $article->getImage(); ?>" alt="">
                            </a>
                            <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]) ?>"
                               class="post-thumb-overlay text-center">
                                <div class="text-uppercase text-center">View Post</div>
                            </a>
                        </div>

                        <div class="post-content">

                            <header class="entry-header text-center text-uppercase">
                                <h6>
                                    <a href="<?= Url::toRoute(['article/category', 'categoryId' => $article->category_id]) ?>">
                                        <?= $article->category->title; ?>
                                    </a>
                                </h6>
                                <h1 class="entry-title">
                                    <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]) ?>">
                                        <?= $article->title; ?>
                                    </a>
                                </h1>
                            </header>

                            <div class="entry-content">
                                <p>
                                    <?= $article->desription; ?>
                                </p>

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]) ?>"
                                       class="more-link">
                                        Continue Reading
                                    </a>
                                </div>
                            </div>

                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By
                                    <a href="#"><?= $article->user->name ?></a> On <?= $article->getDate(); ?>
                                </span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li>
                                    <?= (int)$article->viewed; ?>
                                </ul>
                            </div>

                        </div>

                    </article>
                <?php endforeach; ?>

                <?= LinkPager::widget(['pagination' => $dataProvider->getPagination(), 'maxButtonCount' => 5]); ?>
            </div>

            <!--Start of sidebar-->
            <?= $this->render('/partials/sidebar', [
                'popularPosts' => $popularPosts,
                'categories' => $categories,
            ]) ?>
            <!--End of sidebar-->
        </div>
    </div>
</div>
<!-- end main content-->
