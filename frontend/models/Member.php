<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id_member
 * @property string $adhesion
 * @property string $position
 * @property integer $paid
 * @property integer $user_id
 *
 * @property User $user
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adhesion'], 'safe'],
            [['paid', 'user_id'], 'integer'],
            [['position'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_member' => 'Id Member',
            'adhesion' => 'Adhesion',
            'position' => 'Position',
            'paid' => 'Paid',
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
