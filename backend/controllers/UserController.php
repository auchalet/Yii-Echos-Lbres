<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionList()
    {
        $users = User::getAll();
        
        foreach ($users as $k => $v) {
            if($v->id) {
                $account[] = $v->findAccount();
            }
        }
        

        return $this->render('list', [
            'users' => $users,
            'account' => $account
        ]);
        
        
    }
    
    public function actionProfile()
    {
        return $this->render('profile');
    }
    
    
    public function actionDisable()
    {
        return $this->redirect(['list']);
    }
    
    
    public function actionUpdate()
    {
        return $this->render('update');
    }

}
