<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;


/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
    public $file_private;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file', 'file_private'], 'file', 'maxFiles' => 100], // <--- here!
        ];
    }
}