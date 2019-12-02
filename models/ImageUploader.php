<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 02.01.2019
 * Time: 15:50
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUploader extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * Old version of file if exists
     * @var string
     */
    public $lastImageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'image']
        ];
    }

    /**
     * Upload image to /uploads dir
     * @return void
     */
    public function upload()
    {
        if ($this->validate() && !empty($this->imageFile)) {

            $this->deleteImage($this->lastImageFile);

            $this->imageFile->name = $this->generateUniqName();

            $this->save();
        }
    }

    /**
     * Generate unique filename
     * @return string
     */
    private function generateUniqName()
    {
        return strtolower(md5(uniqid($this->imageFile->getBaseName()))) .
            '.' . $this->imageFile->getExtension();
    }

    /**
     * @return string path to /uploads directory
     */
    private function getPath()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    /**
     * Save image file to server directory /uploads
     */
    private function save() //refactor path
    {
        return $this->imageFile->saveAs($this->getPath() . $this->imageFile->name);
    }

    /**
     * Delete image from /uploads
     * @param $filename
     */
    public function deleteImage($filename)
    {
        $path = $this->getPath() . $filename;
        if (file_exists($path) && is_file($path)) {
            unlink($path);
        }
    }


}