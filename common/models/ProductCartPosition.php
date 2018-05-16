<?php

namespace app\models;

use Yii;
use yz\shoppingcart\CartPositionInterface;
use yii\base\Object;

 class ProductCartPosition extends Object implements CartPositionInterface
{
     use \yz\shoppingcart\CartPositionTrait;
    
    /**
     * @var Product
     */
    protected $_product;

    public $id;
    public $type;
    public $name;

    public function getId()
    {
        return $this->id;
        return md5(serialize([$this->id, $this->type]));
    }

    public function getPrice()
    {
        return $this->getProduct()->cost;
    }

    /**
     * @return Product
    */
    public function getProduct()
    {
        if ($this->_product === null) {
            $this->_product = Products::findOne($this->id);
        }
        return $this->_product;
    }
}
