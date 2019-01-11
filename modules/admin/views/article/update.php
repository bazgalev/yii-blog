<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Update Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="article-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desription')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

        <?= $form->field($imageUploader, 'imageFile')->fileInput(['maxlength' => true]); ?>

        <div class="form-group">
            <label class="control-label" for="article-image">Current image</label>
            <?= Html::img($model->getImage(),[
                    'width'=>200,
            ]) ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="article-category">Category</label>
            <?= Html::dropDownList('category', $selectedCategory, $categories, [
                'prompt' => 'Set category, please',
                'id' => 'article-category',
                'class' => 'form-control ',
            ]) ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="article-tags">Tags</label>
            <?= Html::dropDownList('tags', $selectedTags, $tags, [
//            'prompt' => 'Set tags',
                'multiple' => true,
                'id' => 'article-tags',
                'class' => 'form-control ',
            ]) ?>
        </div>

        <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
