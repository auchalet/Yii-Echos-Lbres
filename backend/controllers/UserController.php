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
        $current = Yii::$app->user->identity;
        $user = User::findId($id_user);
        
        if($user->status === 10) {
            $user->status = 0;
        } elseif ($user->status === 0) {
            $user->status = 10;
        } else {
            return false;
        }
        
        if($user->save()) {
            
            //Gérer le cas où l'User désactivé est l'user courant : ajouter confirm en JS sur vue + redirect sur Login
            if(!Yii::$app->user->identity) {
                return $this->redirect(['/site/login']);
            }
            
            return $this->redirect(['list']);
        }
    }
    
    
    public function actionUpdate($id_user)
    {
        
        $model = new User;
        
        $user = User::findId($id_user);
        
        
        if($user->load(Yii::$app->request->post()) && $user->validate()) {
            
            if($user->save()) {
                Yii::$app->getSession()->setFlash('success', 'Modification réussie');
                return $this->redirect(['list']);
            }   

        }
        
        return $this->renderAjax('update', [
            'user' => $user,
            'model' => $model
        ]);
    }

}
