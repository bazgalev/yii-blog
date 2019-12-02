<?php

namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        //custom init module start here

        //set path to layouts
        $this->layoutPath = '@app/modules/admin/views/layouts';

        //set filename of admin layout
        $this->layout = 'admin';
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException();
                },
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        }
                    ]
                ]
            ]
        ];
    }
}
