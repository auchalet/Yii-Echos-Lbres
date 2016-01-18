<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;
use yii\base\Model;
use yii;

/**
 * Description of UpdateLogsForm
 *
 * @author didou
 */
class UpdateUserForm extends Model 
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            ['password', 'string'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            
        ];
    }
    
    
    public function updateLogs($user)
    {
        // NE PAS DECRYPTER UN MDP // COMPARER VALEUR DU HASH //
        //echo "<pre>";var_dump($this);echo "</pre>";
        //var_dump($user->password_hash);
        //var_dump(crypt('didoujah', $user->password_hash));die;
        //var_dump(Yii::$app->getSecurity()->decryptByPassword($user->password_hash, '$2y$13$'));
        
        if($this->validate()) {
            if($user->username != $this->username) {
                $user->username = $this->username;
            }
            
            if($user->email != $this->email) {
                $user->email = $this->email;
            }
            if($this->password && $this->password === $this->password_repeat) {
                // generates the hash (usually done during user registration or when the password is changed)
                $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                
                if(Yii::$app->getSecurity()->validatePassword($this->password, $hash)) {
                    $user->password_hash = $hash;
                }
            }
            
            
            if($user->save()) {
                return true;
            }
            
        }
        
        
        return false;
    }
    

}
