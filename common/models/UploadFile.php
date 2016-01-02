<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uploaded_file".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property integer $size
 * @property string $type
 */
class UploadFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upload_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['filename'], 'string', 'max' => 256],
            [['type'], 'string', 'max' => 32],
            [['extension'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'filename' => 'Filename',
            'size' => 'Size',
            'type' => 'Type',
            'extension' => 'Extension'
        ];
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    
    
    /** ?? Créer fonction avatar qui ajoute le fichier dans le BD puis le relie à l'user_account ?? **/
    public function addFile($file, $type = null)
    {
        if($file != NULL) {
            
            $name = explode('.', $file->name);
            $this->filename = $file->name;            
            $this->name = $name[0];
            $this->extension = $name[1];
            $this->type = $file->type;
            $this->size = $file->size;
            $this->alt = $this->name;
            if($this->save()) {

                return $this->id;
            }
            else {
                return false;
            }
            
            
        }
    }
    
}
