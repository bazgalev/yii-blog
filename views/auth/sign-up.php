<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3 m-b-lg">

                <div class="bordered-form">
                    <h2>Sign up form</h2>
                    <small>Please fill the following fields to sign up</small>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name'); ?>

                    <?= $form->field($model, 'email'); ?>

                    <?= $form->field($model, 'password')->passwordInput(); ?>


                    <div class="form-group">
                        <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
