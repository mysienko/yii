<?php
namespace frontend\controllers;

use common\models\File;
use yii\web\Controller;
use yii\web\UploadedFile;

class FilesController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionUpload($CKEditorFuncNum)
    {
        $file = UploadedFile::getInstanceByName('upload');
        if ($file) {
            $file_model = new File;
            if ($file_model->upload($file) && $file_model->save()) {
                return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("' . $CKEditorFuncNum . '", "' . $file_model->getUrl() . '", "");</script>';
            } else {
                return "Возникла ошибка при загрузке файла\n";
            }
        } else  {
            return "Файл не загружен\n";
        }
    }
}
