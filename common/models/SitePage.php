<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "site_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $h1
 * @property string $h2
 * @property string $content
 * @property string $slug
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $category_id
 * @property integer $user_id
 *
 * @property SiteCategory $category
 * @property SitePageTag[] $sitePageTags
 * @property Tag[] $tags
 */
class SitePage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'h1', 'h2', 'content', 'slug', 'status', 'category_id', 'user_id'], 'required'],
            [['h1', 'h2', 'content', 'meta_description', 'meta_keywords'], 'string'],
            [['status', 'category_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 120],
            [['slug'], 'string', 'max' => 150]
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
            'h1' => 'H1',
            'h2' => 'H2',
            'content' => 'Content',
            'slug' => 'Slug',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(SiteCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitePageTags()
    {
        return $this->hasMany(SitePageTag::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('site_page_tag', ['page_id' => 'id']);
    }
}
