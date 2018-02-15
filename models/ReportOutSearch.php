<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Main;

/**
 * ReportOutSearch represents the model behind the search form of `app\models\ReportOut`.
 */
class ReportOutSearch extends Main
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'genre_id', 'speech_id', 'sum', 'role'], 'integer'],
            [['date', 'day_sum', 'month_sum', 'second_date','kanal'], 'safe'],
            [['year_sum', 'season_1_sum', 'season_2_sum', 'season_3_sum', 'season_4_sum'], 'number'],
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
        if (empty($this->second_date)) {
            $this->second_date = date('d-m-Y');
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
        $query = Main::find();//->joinWith('advertising a');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['date' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $date = new \DateTime($this->date);

        $query->select(['*']);

        // grid filtering conditions
        $query->andFilterWhere([
            'kanal' => $this->kanal,
            'role' => $this->role,
            'speech_id' => $this->speech_id
        ]);


        if (is_array($this->kanal)) {
            $query->andFilterWhere(['in', 'kanal', $this->kanal]);
        } else {
            $query->andFilterWhere(['kanal' => $this->kanal]);
        }

        if ($this->between === true) {
            $secondDate = new \DateTime($this->second_date);
            $query->andFilterWhere(['between', 'date', $date->format('Y-m-d'), $secondDate->format('Y-m-d')]);

            $dataProvider->sort = ['defaultOrder' => [$this->orderBy => SORT_ASC]];
            $dataProvider->pagination = false;
        } else if ($this->date) {
            $query->addSelect(["SUM(IF(DAY(date) = {$date->format("j")} AND MONTH(date) = {$date->format("m")}, sum, 0)) as day_sum"]);
            $query->addSelect(["SUM(IF(MONTH(date) = {$date->format("m")}, sum, 0)) as month_sum"]);
            $query->addSelect(['SUM(sum) as year_sum']);
            $query->addSelect(['SUM(IF(MONTH(date) <= 3, sum, 0)) as season_1_sum']);
            $query->addSelect(['SUM(IF(MONTH(date) >= 4 AND MONTH(date) <= 6, sum, 0)) as season_2_sum']);
            $query->addSelect(['SUM(IF(MONTH(date) >= 7 AND MONTH(date) <= 9, sum, 0)) as season_3_sum']);
            $query->addSelect(['SUM(IF(MONTH(date) >= 10, sum, 0)) as season_4_sum']);
            $query->addSelect(['SUM(IF(MONTH(date) = 1, sum, 0)) as month_1']);
            $query->addSelect(['SUM(IF(MONTH(date) = 2, sum, 0)) as month_2 ']);
            $query->addSelect(['SUM(IF(MONTH(date) = 3, sum, 0)) as month_3']);
            $query->addSelect(['SUM(IF(MONTH(date) = 4, sum, 0)) as month_4']);
            $query->addSelect(['SUM(IF(MONTH(date) = 5, sum, 0)) as month_5']);
            $query->addSelect(['SUM(IF(MONTH(date) = 6, sum, 0)) as month_6']);
            $query->addSelect(['SUM(IF(MONTH(date) = 7, sum, 0)) as month_7']);
            $query->addSelect(['SUM(IF(MONTH(date) = 8, sum, 0)) as month_8']);
            $query->addSelect(['SUM(IF(MONTH(date) = 9, sum, 0)) as month_9']);
            $query->addSelect(['SUM(IF(MONTH(date) = 10, sum, 0)) as month_10']);
            $query->addSelect(['SUM(IF(MONTH(date) = 11, sum, 0)) as month_11']);
            $query->addSelect(['SUM(IF(MONTH(date) = 12, sum, 0)) as month_12']);

            $query->andFilterWhere(['YEAR(date)' => $date->format("Y")]);
        }

        if ($this->group_filter) {
            $query->groupBy($this->group_filter);
        }
//      echo ($query->createCommand()->getRawSql());exit();
        return $dataProvider;
    }
}
