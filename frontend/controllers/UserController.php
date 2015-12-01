<?php

namespace frontend\controllers;
use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'user' => Yii::$app->user->identity
        ]);
    }

}
