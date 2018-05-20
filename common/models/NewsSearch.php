<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\News;

/**
 * app\models\NewsSearch represents the model behind the search form about `app\models\News`.
 */
 class NewsSearch extends News
{
    public $orderby;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','created_at', 'updated_at', 'author', 'editor'], 'integer'],
            [['title', 'body', 'description', 'orderby'], 'safe'],
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

        if (@$params['NewsSearch']['orderby'] == 'asc') {
            $query = News::find()->orderBy('updated_at ASC');
        } else {
            $query = News::find()->orderBy('updated_at DESC');
        }

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author' => $this->author,
            'editor' => $this->editor,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
