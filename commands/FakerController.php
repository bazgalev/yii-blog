<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 30.11.2019
 * Time: 21:52
 */

namespace app\commands;


use app\models\Article;
use Faker\Factory;
use yii\console\Controller;

class FakerController extends Controller
{
    /**
     * @throws \yii\db\Exception
     */
    public function actionRun()
    {
        $faker = Factory::create('ru_RU');

        $posts = [];
        for ($i = 0; $i < 35; $i++) {
            $posts[] = [
                'title' => $faker->realText(15),
                'desription' => $faker->realText(35),
                'content' => $faker->realText(),
                'date' => $faker->date(),
                'image' => 'c32d5cc49087cd1435e12a798c607c30.jpg',
                'viewed' => $faker->numberBetween(0, 40),
                'category_id' => $faker->numberBetween(2, 6),
                'author_id' => 1
            ];
        }

        \Yii::$app->db->createCommand()->batchInsert(Article::tableName(), [
            'title', 'desription', 'content', 'date', 'image', 'viewed', 'category_id', 'author_id'
        ], $posts)->execute();
    }
}