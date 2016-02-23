<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "moderation_page".
 *
 * @property integer $id
 * @property string $comment
 * @property integer $vote
 * @property integer $user_id
 * @property integer $page_id
 *
 * @property SitePage $page
 * @property User $user
 */
class ModerationPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'moderation_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment', 'vote', 'user_id', 'page_id'], 'required'],
            [['comment'], 'string'],
            [['vote', 'user_id', 'page_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'vote' => 'Vote',
            'user_id' => 'User ID',
            'page_id' => 'Page ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(SitePage::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
