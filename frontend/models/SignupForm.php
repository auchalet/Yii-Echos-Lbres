<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            

            
            if ($this->sendEmail($user->auth_key)) {
                if($user->save()) {
                    $account = new Account();
                    $account->user_id = $user->id;

                    if($account->save()) {
                        return $user;
                    }                
                    
                }

            }
        }

        return null;
    }
    
    
    public function sendEmail($auth_key)
    {
        return \Yii::$app->mailer->compose(['html' => 'signupConfirm-html', 'text' => 'signupConfirm-text'], ['auth_key' => $auth_key])
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Echos-Libres'])
            ->setTo($this->email)
            ->setSubject('Confirmation d\'inscription ' . $this->username)
            ->send();        
        
    }

}
