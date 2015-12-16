<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload($path)
    {
        if ($this->validate()) {
            
            try {
                FileHelper::createDirectory ( $path, $mode = 509, $recursive = true );
                $this->imageFile->saveAs( $path . '/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
                
                //Ajouter nouvel UploadFile() dans la BD -- Manque plus qu'à save
                $file = new UploadFile;
                               
                $file->addFile($this->imageFile);
                
                    
            } catch (Exception $ex) {
                echo "Exception upload_file : ".$ex->getMessage();
            }

            
            return true;
        } else {
            return false;
        }
    }
}