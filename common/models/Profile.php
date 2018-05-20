<?php
namespace common\models;

use Yii;
use dektrium\user\models\Profile as BaseProfile;
use common\helpers\Image;

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

    public function getProducts($uid = 0)
    {
        if ($uid == 0 || true) {
            $uid = Yii::$app->user->id;
        }

        $uid = $this->user_id;

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM products WHERE ((author=:uid))',
            [':uid' => $uid]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            $product = \common\models\Products::findOne(['id' => $item['id']]);
            if (isset($product->id)) {
                $items[] = $product;
            }
        }
        return $items;
    }

    public function getNews($uid = 0)
    {
        if ($uid == 0 || true) {
            $uid = Yii::$app->user->id;
        }

        $uid = $this->user_id;

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM news WHERE ((author=:uid))',
            [':uid' => $uid]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            $product = \common\models\News::findOne(['id' => $item['id']]);
            if (isset($product->id)) {
                $items[] = $product;
            }
        }
        return $items;
    }

    public function getStreams($uid = 0)
    {
        if ($uid == 0 || true) {
            $uid = Yii::$app->user->id;
        }

        $uid = $this->user_id;

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM streams WHERE ((author=:uid))',
            [':uid' => $uid]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            $product = \common\models\Stream::findOne(['id' => $item['id']]);
            if (isset($product->id)) {
                $items[] = $product;
            }
        }
        return $items;
    }

}