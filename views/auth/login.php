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
            <div class="col-md-6  col-md-offset-3 m-b-lg">

                <div class="bordered-form">
                    <h2>Login form</h2>
                    <small>Please fill the following fields to login</small>

                    <div class="row m-t-md">
                        <div class="col-md-6">
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'email'); ?>

                            <?= $form->field($model, 'password')->passwordInput(); ?>

                            <?= $form->field($model, 'rememberMe')->checkbox(); ?>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                        <div class="col-md-6">
                            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>
                            <script type="text/javascript">
                                VK.init({apiId: 6819652});
                            </script>

                            <!-- VK Widget -->
                            <div id="vk_auth"></div>
                            <script type="text/javascript">
                                VK.Widgets.Auth("vk_auth", {"authUrl": "/auth/login-vk"});
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
