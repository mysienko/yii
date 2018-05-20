<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Products;

/**
 * app\models\ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
 class ProductsSearch extends Products
{
    public $costmin;
    public $costmax;
    public $popular;
    public $discount;
    public $new;

    /**
     * @inheritdoc
     */
     public function rules()
     {
         return [
             [['id', 'created', 'updated', 'author', 'editor', 'lock'], 'integer'],
             [['title', 'body', 'description', 'image', 'currency', 'map', 'costmin', 'costmax', 'popular', 'discount', 'new'], 'safe'],
             [['price'], 'number'],
         ];
     }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'created' => $this->created,
            'updated' => $this->updated,
            'author' => $this->author,
            'editor' => $this->editor,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'map', $this->map]);

        if (isset($this->costmin) || isset($this->costmax)) {
            $query->andFilterWhere(['between', 'price', $this->costmin, $this->costmax]);
        }

        return $dataProvider;
    }
}
