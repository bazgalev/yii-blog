<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 09.01.2019
 * Time: 20:00
 */

namespace app\controllers;


use app\models\Article;
use app\models\Category;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class AuthController extends Controller
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest()
    {
        $user=User::findOne(1);

        Yii::$app->user->login($user);

        if(Yii::$app->user->isGuest){
            echo 'Ты гость';
        }else{
            echo 'Ты пользователь';
        }
    }
}