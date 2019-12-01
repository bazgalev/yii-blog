<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 15.01.2019
 * Time: 0:43
 */

namespace app\forms;

use app\models\User;
use yii\base\Model;

class SignupForm extends Model
{
    /**
     * @var string $name
     */
    public $name;
    /**
     * @var string $email
     */
    public $email;
    /**
     * @var string $password
     */
    public $password;

    /**
     * Validation rules
     *
     * @return array of validation rules
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],
        ];
    }


}