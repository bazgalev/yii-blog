<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 21:09
 */

namespace app\forms;


use yii\base\Model;

class LoginVkForm extends Model
{
    /**
     * @var string
     */
    public $uid;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $photo;

    public function rules()
    {
        return [
            [['uid', 'first_name', 'photo'], 'required'],
            [['uid', 'first_name', 'photo'], 'string'],
        ];
    }
}