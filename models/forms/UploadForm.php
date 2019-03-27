<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 5/16/2018
 * Time: 3:34 AM
 */

namespace app\models\forms;

use app\components\Tools;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }

    /**
     * @param $directory
     * @return bool|string
     */
    public static function save($directory = '')
    {
        $upload = new UploadForm();
        $upload->file = UploadedFile::getInstance($upload, 'file');
        if ($upload->file && $upload->validate()) {
            Tools::createFolder($directory);
            $path = $directory . '/' . $upload->file->baseName . '.' . $upload->file->extension;
            if ($upload->file->saveAs($path)) return $path;
            return null;
        }
        return null;
    }
}