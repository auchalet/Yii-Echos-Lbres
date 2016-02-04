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
        ]);
        
        
    }
    
    
    /* Non utilisée : lien vers profil en frontend
    public function actionProfile($id_user)
    {
        $user = User::findIdentity($id_user);
        
        
        //Dans l'idéal redirige vers la page profil du front -- Ne marche pas
        return $this->renderPartial('@frontend/user/profile', [
            'user' => $user
        ]);
    }
     * 
     */
    
    
    public function actionDisable($id_user)
    {
        return $this->redirect(['list']);
    }
    
    
    public function actionUpdate($id_user)
    {
        $model = new User;
        $user = User::findIdentity($id_user);
        $users = User::getAll();       
        
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            var_dump($model);die;
            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Modification réussie');
                return $this->redirect(['list']);
            }
            
            

        }
        
        return $this->renderAjax('update', [
            'user' => $user,
            'model' => $model,
            'users' => $users
        ]);
    }

}
