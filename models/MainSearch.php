<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Main;

/**
 * MainSearch represents the model behind the search form of `app\models\Main`.
 */
class MainSearch extends Main
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'genre_id', 'template_id', 'speech_id', 'code_id', 'sum', 'kanal', 'micf', 'role'], 'integer'],
            [['prog', 'comment', 'time_s', 'time_e', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->date)) {
            $this->date = date('d-m-Y');
        }
        return parent::init();
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
        $query = Main::find();

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
        if ($this->between === true) {
            $date = new \DateTime($this->date);
            $query->andFilterWhere(['between', 'date', $date->format('Y-m-01'), $date->format('Y-m-t')]);
        } else {
            $query->andFilterWhere(['DATE_FORMAT(date, "%d-%m-%Y")' => $this->date]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'genre_id' => $this->genre_id,
            'speech_id' => $this->speech_id,
            'code_id' => $this->code_id,
            'time_s' => $this->time_s,
            'time_e' => $this->time_e,
            'sum' => $this->sum,
            'kanal' => $this->kanal,
            'micf' => $this->micf,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'prog', $this->prog])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        if ($this->print === true) {
            $dataProvider->sort = ['defaultOrder' => ['date' => SORT_ASC, 'time_s' => SORT_ASC]];
        }
        $dataProvider->pagination = false;

        return $dataProvider;
    }
}
