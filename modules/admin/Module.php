<?php

namespace app\modules\admin;

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
        $this->layoutPath='@app/modules/admin/views/layouts';

        //set filename of admin layout
        $this->layout = 'admin';
    }
}
