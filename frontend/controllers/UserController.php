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
        
        $avatar = UploadFile::findIdentity($accountUser->avatar);
        
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
        if($sub === 'subscribe') {
            var_dump('Subscribe newsletter');
        }
        elseif($sub === 'unsubscribe') {
            var_dump('Unsubscribe newsletter');
        }

    }
    
    /**
     * 
     */
    public function actionChangeAvatar($id_user = null)
    {
        $model = new UploadForm;
        
        /** Upload OK -- Manque : insertion fichier dans table uploaded_file + relié à table avatar.account **/
        $file = new UploadFile;
        
        //Récupération du dossier frontend/web/uploads/sha1(login)/
        if($id_user == NULL) {
            $user = Yii::$app->user->identity;
        } else {
            $user = User::findIdentity($id_user);    
        }
        
        //Chemin du dossier upload de l'User
        $hash = sha1($user->username);
        $path = 'uploads/'.$hash;
        
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($id = $model->upload($path)) {
                
                //Association user
                $accountUser = $user->findAccount();
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

        return $this->render('/tools/upload', [
            'model' => $model,
                ]);
    }

}
