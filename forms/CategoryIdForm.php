<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 23:44
 */

namespace app\forms;


use app\models\Category;
use yii\base\Model;

class CategoryIdForm extends Model
{
    /**
     * @var int
     */
    public $categoryId;

    public function rules()
    {
        return [
            [['categoryId'], 'required'],
            [['categoryId'], 'integer'],
            ['categoryId', 'exist', 'targetClass' => Category::class, 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }
}