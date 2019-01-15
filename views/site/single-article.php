<?php

use yii\helpers\Url;

/* @var $article app\models\Article */
/* @var $tags array of app\models\Tag models */
/* @var $categories array of app\models\Category models */
/* @var $comments array of app\models\Comment models */
/* @var $this yii\web\View */
/* @var $commentForm app\models\CommentForm */


$this->title = $article->title;
?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <article class="post">

                    <div class="post-thumb">
                        <a href="#">
                            <img src="<?= $article->getImage(); ?>" alt="">
                        </a>
                    </div>

                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6>
                                <a href="<?= Url::toRoute(['site/category', 'id' => $article->category_id]); ?>">
                                    <?= $article->category->title; ?>
                                </a>
                            </h6>

                            <h1 class="entry-title">
                                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]); ?>">
                                    <?= $article->title; ?>
                                </a>
                            </h1>
                        </header>

                        <div class="entry-content">
                            <?= $article->content; ?>
                        </div>

                        <div class="decoration">
                            <?php foreach ($tags as $tag): ?>
                                <a href="<?= Url::toRoute(['site/category', 'id' => $tag->id]); ?>"
                                   class="btn btn-default"><?= $tag->title; ?></a>
                            <?php endforeach; ?>
                        </div>

                        <div class="social-share">

                            <span class="social-share-title pull-left text-capitalize">
                                By Pazgalev On <?= $article->getDate(); ?>
                            </span>

                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>


                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="bottom-comment"><!--bottom comment-->
                            <!--                            <h4>3 comments</h4>-->

                            <div class="comment-img">
                                <img class="img-circle" width="80" src="<?= $comment->user->photo; ?>" alt="/uploads/default.jpg">
                            </div>

                            <div class="comment-text">
                                <a href="#" class="replay btn pull-right"> Replay</a>
                                <h5><?= $comment->user->name; ?></h5>

                                <p class="comment-date">
                                    <?= $comment->getDate(); ?>
                                </p>


                                <p class="para">
                                    <?= $comment->text; ?>.
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>

                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'action' => ['site/comment', 'id' => $article->id],
                        'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']]) ?>

                    <div class="form-group">
                        <div class="col-md-12">
                            <?= $form->field($commentForm, 'commentText')
                                ->textarea([
                                    'class' => 'form-control',
                                    'placeholder' => 'Write Message',
                                    'rows'=>'6'])
                                ->label(false) ?>
                        </div>
                    </div>
                    <button type="submit" class="btn send-btn">Post Comment</button>

                    <?php \yii\widgets\ActiveForm::end(); ?>

                </div>

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