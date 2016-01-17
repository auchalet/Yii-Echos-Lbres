<?php

namespace backend\controllers;

class ForumController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
