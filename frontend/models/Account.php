<?php

namespace frontend\models;

use Yii;

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
            [['age'], 'integer'],
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
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    
    
    public function updateAvatar($idFile)
    {
        
        $this->avatar = $idFile;
        
        if($this->save()) {
            return true;
        }
        
        return false;
    }
}
