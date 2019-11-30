<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $article app\models\Article */
/* @var $categories array of app\models\Category models */
/* @var  \app\models\Comment[] $comments */
/* @var $commentForm \app\forms\CommentForm */

?>

<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <div class="bottom-comment"><!--bottom comment-->
            <!--                            <h4>3 comments</h4>-->

            <div class="comment-img">
                <img class="img-circle" width="80" src="<?= $comment->user->getAvatarUrl() ?>"
                     alt="<?= $comment->user->name ?>">
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

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>

        <?php if (Yii::$app->session->getFlash('comment')): ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin([
            'action' => Url::toRoute(['comment/create', 'postId' => $article->id]),
            'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']]) ?>

        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'commentText')
                    ->textarea([
                        'class' => 'form-control',
                        'placeholder' => 'Write Message',
                        'rows' => '6'])
                    ->label(false) ?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Post Comment</button>

        <?php ActiveForm::end(); ?>

    </div>
<?php endif; ?>

</div>