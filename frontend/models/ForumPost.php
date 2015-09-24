<?php

/**
 * Modèle de l'objet Post dans la BD
 * Accès aux attributs
 */

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%forum_post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property double $score
 * @property integer $id_user
 * @property integer $id_topic
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 *
 * @property ForumTopic $idTopic
 * @property User $idUser
 */
class ForumPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forum_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'score', 'id_user', 'id_topic', 'createdAt', 'updatedAt'], 'required'],
            [['content', 'meta_title', 'meta_description', 'meta_keyword'], 'string'],
            [['score'], 'number'],
            [['id_user', 'id_topic'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
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
            'content' => 'Content',
            'score' => 'Score',
            'id_user' => 'Id User',
            'id_topic' => 'Id Topic',
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
    public function getIdTopic()
    {
        return $this->hasOne(ForumTopic::className(), ['id' => 'id_topic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
