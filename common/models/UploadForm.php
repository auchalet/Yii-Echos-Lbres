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
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }
    
    public function upload($path)
    {
        if ($this->validate()) {
            
            try {
                FileHelper::createDirectory ( $path, $mode = 509, $recursive = true );
                //var_dump(FileHelper::findFiles($path));
                $this->imageFile->saveAs( $path . '/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
                
                //Ajouter nouvel UploadFile() dans la BD -- Manque plus qu'à save
                $file = new UploadFile;

                return $file->addFile($this->imageFile);
                
                
                
            } catch (Exception $ex) {
                echo "Exception upload_file : ".$ex->getMessage();
            }

            
        } else {
            return false;
        }
    }
    
    public function uploadAvatar($path)
    {
        if ($this->validate()) {
            
            try {
                FileHelper::createDirectory ( $path, $mode = 509, $recursive = true );
                //var_dump(FileHelper::findFiles($path));
                $this->imageFile->saveAs( $path . '/avatar.' . $this->imageFile->extension);
                
                //Ajouter nouvel UploadFile() dans la BD -- Manque plus qu'à save
                $file = new UploadFile;
                
                $name = 'avatar';
                $filename = 'avatar.'.$this->imageFile->extension;
                return $file->addFile($this->imageFile, $name, $filename);
                
                
                
            } catch (Exception $ex) {
                echo "Exception upload_file : ".$ex->getMessage();
            }

            
        } else {
            return false;
        }
    }    
}