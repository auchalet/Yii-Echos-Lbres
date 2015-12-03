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
use common\repository\AccountRepository;
use common\repository\MemberRepository;
use frontend\models\Member;
use common\models\User;
use frontend\models\UpdateLogsForm;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        
        $accountUser = $user->findAccount()->one();        
        $memberUser = $user->findMember()->one();
        
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
        $model = new UpdateLogsForm;
        
        if($id_user) {
            $user = User::findIdentity($id_user);
            //var_dump($user->username);die;
        } else {
            $user = Yii::$app->user->identity;
        }
        
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            
            if($model->updateLogs($user)){
                
                Yii::$app->getSession()->setFlash(
                    'success','Password changed'
                );

                return $this->redirect('index');
            }
        }
        else {
            return $this->render('update-logs', [
                'model' => $model,
                'user' => $user
            ]);
        }
        
    }
    
    public function actionUpdateAccount()
    {
        var_dump('Update account');
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
        
    }

}
