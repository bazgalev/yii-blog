<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 01.12.2019
 * Time: 0:28
 */

namespace app\services;

use app\forms\LoginForm;
use app\forms\SignupForm;
use app\models\User;


class AuthService
{
    /**
     * Signup new User
     *
     * @param SignupForm $form
     * @return User
     */
    public function signup(SignupForm $form): User
    {
        return User::create($form->name, $form->email, $form->password);
    }

    /**
     * @param LoginForm $form
     * @return User
     */
    public function login(LoginForm $form): User
    {
        $user = User::findByEmail($form->email);
        if (is_null($user) || !$user->validatePassword($form->password)) {
            throw new \DomainException('Email or password incorrect');
        }
        return $user;
    }
}