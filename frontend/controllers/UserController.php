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

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        
        $accountUser = $user->findAccount();        
        $memberUser = $user->findMember();
        
        //var_dump($accountUser, $memberUser); die;
        
        
        return $this->render('index', [
            'user' => $user,
            'account' => $accountUser,
            'member' => $memberUser
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
            //var_dump($user->username);die;
        } else {
            $user = Yii::$app->user->identity;
        }
        
        
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
        if($sub === 'subscribe') {
            var_dump('Subscribe newsletter');
        }
        elseif($sub === 'unsubscribe') {
            var_dump('Unsubscribe newsletter');
        }

    }
    
    
    public function actionChangeAvatar()
    {
        $model = new UploadForm();
        
        //Récupération du dossier frontend/web/uploads/sha1(login)/
        $user = Yii::$app->user->identity;
        $hash = sha1($user->username);

        $path = 'uploads/'.$hash;
        
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload($path)) {
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

        return $this->render('/tools/upload', [
            'model' => $model,
                ]);
    }

}
