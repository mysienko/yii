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
        return [
            [['avatar', 'image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],

        ];
    }


    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->avatar && ($width || $height)){
            return Image::thumb('/upload/avatar/'.$this->avatar, $width, $height, $crop);
        }
        return Image::thumb('/upload/no-foto.jpg', $width, $height, $crop);
    }

}