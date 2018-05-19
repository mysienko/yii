<?php

namespace common\models;

use Yii;
use yii\helpers\BaseFileHelper;

/** * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $dir
 * @property string $file_name
 * @property string $original_file_name
 * @property integer $type
 * @property string $url
 */
class File extends \yii\db\ActiveRecord
{
    const TYPE_IMAGE = 1;
    const TYPE_OTHER = 15;

    /** * @inheritdoc */
    public static function tableName()
    {
        return 'files';
    }

    /** * @inheritdoc */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['dir', 'file_name', 'original_file_name'], 'string', 'max' => 800],
        ];
    }

    public function upload($file)
    {
        if (strpos($file->type, "image") !== false) {
            $this->type = self::TYPE_IMAGE;
            $out_dir = '/uploads/images/' . substr(md5(time()), 0, 2) . '/' . substr(md5(time() + 1), 0, 2) . '/';
        } else {
            $this->type = self::TYPE_OTHER;
            $out_dir = '/uploads/files/' . substr(md5(time()), 0, 2) . '/' . substr(md5(time() + 1), 0, 2) . '/';
        }
        $out_file_name = md5(time() + 2) . '.' . $file->extension;
        $out_file = $out_dir . $out_file_name;
        BaseFileHelper::createDirectory(Yii::getAlias("@webroot") . $out_dir);
        if ($file->saveAs(Yii::getAlias("@webroot") . $out_file)) {
            $this->dir = $out_dir;
            $this->file_name = $out_file_name;
            $this->uid = Yii::$app->user->identity->id;
            $this->original_file_name = $file->baseName . '.' . $file->extension;
            return true;
        } else {
            return false;
        }
    }

    public function getUrl()
    {
        return $this->dir . '/' . $this->file_name;
    }

    public function beforeDelete()
    {
        $file_name = Yii::getAlias('@webroot') . $this->dir . $this->file_name;
        if (file_exists($file_name) && !is_dir($file_name)) unlink($file_name);
        return parent::beforeDelete();
    }

    /** * @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dir' => 'Dir',
            'file_name' => 'File Name',
            'original_file_name' => 'Original File Name',
            'type' => 'Type',
            ];
    }
}

