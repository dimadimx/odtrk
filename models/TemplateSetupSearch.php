<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TemplateSetup;

/**
 * TemplateSetupSearch represents the model behind the search form of `app\models\TemplateSetup`.
 */
class TemplateSetupSearch extends TemplateSetup
{
    public $sum_all;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'template_id', 'telecast_id', 'genre_id', 'speech_id', 'code_id', 'kanal', 'micf', 'role'], 'integer'],
            [['sum'], 'number'],
            [['comment', 'time_s', 'time_e', 'sum_all'], 'safe'],
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
        $query = TemplateSetup::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['time_s' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'template_id' => $this->template_id,
            'telecast_id' => $this->telecast_id,
            'genre_id' => $this->genre_id,
            'speech_id' => $this->speech_id,
            'code_id' => $this->code_id,
            'sum' => $this->sum,
            'kanal' => $this->kanal,
            'micf' => $this->micf,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'time_s', $this->time_s])
            ->andFilterWhere(['like', 'time_e', $this->time_e])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
