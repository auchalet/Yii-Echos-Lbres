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
class UpdateLogsForm extends Model 
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    
    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'operator' => '=='],
            
        ];
    }
    
    
    public function updateLogs($user)
    {
        // NE PAS DECRYPTER UN MDP // COMPARER VALEUR DU HASH //
        
        //echo "<pre>";var_dump($user);echo "</pre>";
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
            
            
            
            exit;
            if($user->save()) {
                return true;
            }
            
        }
        
        
        var_dump($user->username);die;

        return false;
    }
    

}
