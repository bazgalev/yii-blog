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
use app\forms\SignupForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\forms\LoginForm;

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

        $request = Yii::$app->request;

        $model = new LoginForm();

        if ($model->load($request->post()) && $request->isPost) {

            if ($model->login()) {

                return $this->goBack();
            }
        }


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

    public function actionSignup()
    {
        $model = new SignupForm();

        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->load($request->post());

            if ($model->signup()) {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('sign-up', [
            'model' => $model,
        ]);
    }

    public function actionLoginVk()
    {
        $request = Yii::$app->request;

        $uid = $request->get('uid');
        $firstName = $request->get('first_name');
        $photo = $request->get('photo');

        $user = new User();

        if ($user->saveFromVk($uid, $firstName, $photo)) {
            return $this->redirect(['site/index']);
        }

        return $this->render('login');
    }
}