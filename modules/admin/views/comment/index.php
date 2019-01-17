<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $comments array of app\models\Comment */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Comment</th>
            <th>Author</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment->id ?></td>
                <td><?= $comment->text ?></td>
                <td><?= $comment->date ?></td>
                <td><?= $comment->user->name ?></td>
                <td><a href="<?= Url::toRoute(['comment/delete', 'id' => $comment->id]) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>
