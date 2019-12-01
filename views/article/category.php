<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

/** @var yii\web\view $this */
/** @var \yii\data\ActiveDataProvider $dp */
/** @var app\models\Article $article */
/** @var app\models\Article[] $popularPosts */
/** @var \app\models\Category[] $categories title */

$this->title = 'Categories';
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($dp->getModels() as $article): ?>
                    <article class="post post-list">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="post-thumb">
                                    <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]); ?>">
                                        <img src="<?= $article->getImage(); ?>" alt="" class="pull-left">
                                    </a>

                                    <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]); ?>"
                                       class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">View Post</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="post-content">
                                    <header class="entry-header text-uppercase">
                                        <h6>
                                            <a href="<?= Url::toRoute(['article/category', 'id' => $article->category_id]) ?>">
                                                <?= $article->category->title; ?>
                                            </a>
                                        </h6>

                                        <h1 class="entry-title">
                                            <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]); ?>">
                                                <?= $article->title; ?>
                                            </a>
                                        </h1>
                                    </header>
                                    <div class="entry-content">
                                        <p><?= $article->desription; ?></p>
                                    </div>
                                    <div class="social-share">
                                        <span class="social-share-title pull-left text-capitalize">By <?= $article->user->name ?>
                                            On <?= $article->getDate(); ?></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?= LinkPager::widget(['pagination' => $dp->getPagination(), 'maxButtonCount' => 5]); ?>

            </div>

            <?= $this->render('/partials/sidebar', [
                'popularPosts' => $popularPosts,
                'categories' => $categories,
            ]) ?>

        </div>
    </div>
</div>
