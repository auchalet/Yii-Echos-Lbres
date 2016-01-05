<?php

namespace frontend\controllers;
use common\models\LoginForm;
use common\models\UploadForm;
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
use frontend\models\Member;
use frontend\models\Account;
use common\models\User;
use frontend\models\UpdateUserForm;
use yii\web\UploadedFile;
use common\models\UploadFile;

class UserController extends \yii\web\Controller
{
    public function actionIndex($id_user = null)
    {
        if($id_user == NULL) {
            $user = Yii::$app->user->identity;
        }
        else {
            $user = User::findIdentity($id_user);
        }

        $accountUser = $user->findAccount();
        
        $avatar = $accountUser->getAvatar();
        
        $memberUser = $user->findMember();        
        //var_dump($accountUser, $memberUser); die;
        
        
        return $this->render('index', [
            'user' => $user,
            'account' => $accountUser,
            'member' => $memberUser,
            'avatar' => $avatar
        ]);
    }
    
    
    /**
     * Modifie les informations d'identification de l'User en cours, ou de l'User $id_user
     * @param int $id_user
     * @return type
     */
    public function actionUpdateLogs($id_user = null)
    {
        $model = new UpdateUserForm;
        
        if($id_user) {
            $user = User::findIdentity($id_user);
        } 
        else {
            $user = Yii::$app->user->identity;
        }
        
        var_dump(Yii::$app->request->post());
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            
            if($model->updateLogs($user)){
                
                Yii::$app->getSession()->setFlash(
                    'success','Modification réussie'
                );

                return $this->redirect(['index']);
            }
        }
        else {
            return $this->render('update-user', [
                'model' => $model,
                'user' => $user
            ]);
        }
        
    }
    
    public function actionUpdateAccount($id_user = null)
    {
        $model = new Account;
        
        if($id_user) {
            $account = User::findIdentity($id_user)->findAccount();
            //var_dump($user->username);die;
        } else {
            $account = Yii::$app->user->identity->findAccount();

            if(Yii::$app->session->get('account') == null){
                Yii::$app->session->set('account', Yii::$app->user->findAccount()); 
            }
        }    
       
        if($model->load(Yii::$app->request->post() && $model->validate())) {
            
        }
        else {
            return $this->render('update-account', [
                'model' => $model,
                'account' => $account
            ]);
        }
        
    }
    
    
    public function actionNewsletter($sub)
    {
        if($sub == 1) {
            var_dump('Subscribe newsletter');
        }
        elseif($sub == 0) {
            var_dump('Unsubscribe newsletter');
        }
        else {
            return false;
        }

    }
    
    /**
     * 
     */
    public function actionChangeAvatar($id_user = null)
    {
        $model = new UploadForm;        
        
        //Récupération du dossier frontend/web/uploads/sha1(login)/
        if($id_user == NULL) {
            $user = Yii::$app->user->identity;
            
        } else {
            $user = User::findIdentity($id_user);    
        }
        
        $accountUser = $user->findAccount();

        
        if($accountUser->getAvatar() != NULL) {
            $avatar = UploadFile::findIdentity($accountUser->avatar);
        }
        else {
            $avatar = NULL;
        }

        //var_dump($avatar);die;
        if (Yii::$app->request->isPost) {
            
            //Chemin du dossier upload de l'User
            $hash = sha1($user->username);
            $path = 'uploads/'.$hash;            
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($id = $model->uploadAvatar($path)) {
                
                //Association user
                $accountUser->updateAvatar($id);
              
                // file is uploaded successfully
                Yii::$app->getSession()->setFlash(
                    'success','Avatar changé'
                );                
                return $this->redirect(['index']);
            }
            else {
                echo "Echec de l'upload";
            }
        }

        return $this->renderAjax('change-avatar', [
            'model' => $model,
            'user' => $user,
            'avatar' => $avatar
                ]);
    }
    
    
    /**
     * Changement de l'avatar de l'utilisateur COURANT
     * @param String $type
     */
    public function actionSwitchAvatar() {
        
        if(Yii::$app->request->isPost && Yii::$app->request->post('t')) {
            if(Yii::$app->session->get('account')) {
                $account = Yii::$app->session->get('account');
            } else {
                $user = Yii::$app->user->identity;
                $account = $user->findAccount();
            }
            
            switch (Yii::$app->request->post('t')) {
                case 'avatar-default':
                    $type = 0;

                    break;
                case 'avatar-perso':
                    $type = 1;

                    break;
                case 'gravatar':
                    $type = 2;

                    break;

            }
            
            if($account->switchAvatar($type)) {
                return $account->getAvatar();
            }
           
            
        }
        
        return false;
        
        
        
        
    }

}
