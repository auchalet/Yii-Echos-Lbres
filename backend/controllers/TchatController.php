<?php

namespace backend\controllers;

class TchatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
