<?php
namespace frontend\models;

use yii\base\Model;
use Yii;
/**
 * Password reset request form
 */
class StartingMailForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],            
        ];
    }
    
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {

        return \Yii::$app->mailer->compose(['html' => 'startingMail-html', 'text' => 'startingMail-text'])
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . 'Echos-Libres'])
            ->setTo($this->email)
            ->setSubject('Confirmation d\'inscription')
            ->send();


    }    
}