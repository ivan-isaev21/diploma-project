<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Review;

/**
 * SearchReview represents the model behind the search form of `app\models\Review`.
 */
class SearchReview extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'name','comment'], 'safe'],
            [['tour_id', 'rating'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $tour_id=Yii::$app->request->get('tour_id');  
        $query = Review::find()->with('tour')->where(['tour_id'=>$tour_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tour_id' => $this->tour_id,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ;

        return $dataProvider;
    }
}
