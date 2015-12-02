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
            [['age'], 'safe'],
            [['favorite_category', 'newsletter', 'user_id'], 'integer'],
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
            'age' => 'Age',
            'favorite_category' => 'Favorite Category',
            'past' => 'Past',
            'present' => 'Present',
            'future' => 'Future',
            'why_register' => 'Why Register',
            'skills' => 'Skills',
            'interests' => 'Interests',
            'other' => 'Other',
            'newsletter' => 'Newsletter',
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
}
