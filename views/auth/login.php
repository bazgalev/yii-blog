<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-4 m-b-lg">


                <div class="bordered-form">
                <h2>Login form</h2>

                <?php $form = ActiveForm::begin([
//                    'options' => [
//                        'class' => 'bordered-form'
//                    ],
                ]); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'password')->passwordInput(); ?>

                <?= $form->field($model, 'rememberMe')->checkbox(); ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
