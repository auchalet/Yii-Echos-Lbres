<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%forum_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property double $status
 * @property integer $id_user
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 *
 * @property User $idUser
 * @property ForumTopic[] $forumTopics
 */
class ForumCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forum_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status', 'id_user', 'createdAt', 'updatedAt'], 'required'],
            [['status'], 'number'],
            [['id_user'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['meta_title', 'meta_description', 'meta_keyword'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'id_user' => 'Id User',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumTopics()
    {
        return $this->hasMany(ForumTopic::className(), ['id_category' => 'id']);
    }
}
