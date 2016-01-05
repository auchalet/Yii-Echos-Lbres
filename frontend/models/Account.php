<?php

namespace frontend\models;

use Yii;
use common\models\UploadFile;
use common\models\User;

/**
 * This is the model class for table "account".
 *
 * @property integer $id_account
 * @property string $pseudo
 * @property string $sex
 * @property string $age
 * @property integer $favorite_category
 * @property string $past
 * @property string $present
 * @property string $future
 * @property string $why_register
 * @property string $skills
 * @property string $interests
 * @property string $other
 * @property integer $newsletter
 * @property integer $user_id
 *
 * @property User $user
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pseudo', 'user_id'], 'required'],
            [['age', 'active_avatar'], 'integer'],
            [['favorite_category', 'newsletter', 'user_id', 'avatar'], 'integer'],
            [['past', 'present', 'future', 'why_register', 'skills', 'interests', 'other'], 'string'],
            [['pseudo', 'sex'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_account' => 'Id Account',
            'pseudo' => 'Pseudo',
            'sex' => 'Sex',
            'age' => 'Age virtuel',
            'favorite_category' => 'Rubrique favorite',
            'past' => 'Passé',
            'present' => 'Présent',
            'future' => 'Futur',
            'why_register' => 'Pourquoi suis-je inscrit ?',
            'skills' => 'Savoir et compétences',
            'interests' => 'Centre d\'intérêt',
            'other' => 'Expression Libre',
            'newsletter' => 'Inscription newsletter',
            'avatar' => 'Avatar',
            'active_avatar' => 'Choix Avatar',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->one();
    }
    
    
    //Renvoie l'avatar choisi par active_avatar de l'Account
    public function getAvatar()
    {
        switch ($this->active_avatar) {
            case 0:
                $path = '/uploads/'.sha1('base').'/avatar.jpg';

                break;
            case 1:
                $avatar = UploadFile::findIdentity($this->avatar);
                $path = '/uploads/'.sha1($this->getUser()->username).'/'.$avatar->filename;
                

                break;
            case 2:
                $path = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->getUser()->email))).'?d=identicon&s=60&r=G';


                break;

            default:
                $path = '/uploads/'.sha1('base').'/avatar.jpg';
                
                break;
        }
        
        
        return $path;
    }
    
    public function updateAvatar($idFile)
    {
        
        $this->avatar = $idFile;
        $this->active_avatar = 1;
        
        if($this->save()) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Change de type d'avatar : choix entre par défaut (0), image uploadée (1) ou gravatar (2)
     * @param int $idType
     */
    public function switchAvatar($idType)
    {
        if($idType <= 2 && $idType >= 0) {
            $this->active_avatar = $idType;
            
            if($this->save()) {
                return true;
            }
        }
        
        return false;
        
        
    }
}
