<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 15.01.2019
 * Time: 19:57
 */

namespace app\forms;

use yii\base\Model;
use Yii;

class CommentForm extends Model
{
    /**
     * @var string $commentText
     */
    public $commentText;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['commentText'], 'required'],
            [['commentText'], 'string', 'length' => [3, 250]],
        ];
    }
}