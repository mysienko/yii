<?php
namespace common\models;

use dektrium\user\models\Profile as BaseProfile;
use app\helpers\Image;

class Profile extends BaseProfile
{
    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $profileRules = [
            [['avatar', 'image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            ['phone', 'string', 'max' => 255],
            ['skype', 'string', 'max' => 255],
            ['icq', 'string', 'max' => 255],
        ];
        $rules = array_merge(parent::rules(), $profileRules);
        return $rules;
    }


    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->avatar && ($width || $height)){
            return Image::thumb('/upload/avatar/'.$this->avatar, $width, $height, $crop);
        }
        return Image::thumb('/upload/no-foto.jpg', $width, $height, $crop);
    }

}