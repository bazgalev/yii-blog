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
            <div class="col-md-4 col-md-offset-4">
                <span class="border border-primary"></span>
                <form method="post" style="box-sizing:border-box;border:1px solid #333333;padding:30px;margin-bottom: 50px;border-radius: 15px;">
                    <div class="form-group">
                        <label for="exampleInputName">User name</label>
                        <input type="text" class="form-control" id="exampleInputName" placeholder="Enter username">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
