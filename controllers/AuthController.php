<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 09.01.2019
 * Time: 20:00
 */

namespace app\controllers;


use app\forms\LoginVkForm;
use app\forms\SignupForm;
use app\models\User;
use app\services\AuthService;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;
use app\forms\LoginForm;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    public function __construct(string $id, Module $module, AuthService $service, array $config = [])
    {
        $this->authService = $service;
        parent::__construct($id, $module, $config);
    }

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

        $form = new LoginForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->authService->login($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);

                return $this->goBack();
            } catch (\DomainException $e) {
                $form->addError('password', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
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

    /**
     * @return string|Response
     */
    public function actionSignup()
    {
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $user = $this->authService->signup($form);
            $user->save();

            return $this->redirect(['auth/login']);
        }

        return $this->render('sign-up', [
            'model' => $form,
        ]);
    }

    public function actionLoginVk()
    {
        $form = new LoginVkForm();

        if ($form->load(Yii::$app->request->get()) && $form->validate()) {
            $user = new User();

            if ($user->saveFromVk($form->uid, $form->first_name, $form->photo)) {
                return $this->redirect(['site/index']);
            }
        }
        return $this->render('login');
    }
}