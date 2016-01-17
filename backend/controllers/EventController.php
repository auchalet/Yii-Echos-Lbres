<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class EventController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
