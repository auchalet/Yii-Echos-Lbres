<?php

namespace backend\controllers;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
