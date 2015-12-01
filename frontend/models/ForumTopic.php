<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%forum_topic}}".
 *
 * @property integer $id
 * @property string $title
 * @property double $status
 * @property integer $id_user
 * @property integer $id_category
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 *
 * @property ForumPost[] $forumPosts
 * @property ForumCategory $idCategory
 * @property User $idUser
 */
class ForumTopic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forum_topic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status', 'id_user', 'id_category', 'createdAt', 'updatedAt'], 'required'],
            [['status'], 'number'],
            [['id_user', 'id_category'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['meta_title', 'meta_description', 'meta_keyword'], 'string'],
            [['title'], 'string', 'max' => 100]
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
            'status' => 'Status',
            'id_user' => 'Id User',
            'id_category' => 'Id Category',
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
    public function getForumPosts()
    {
        return $this->hasMany(ForumPost::className(), ['id_topic' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory()
    {
        return $this->hasOne(ForumCategory::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
