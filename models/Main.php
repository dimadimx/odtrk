<?php

namespace app\models;

use Yii;
use app\models\traits\GeneralTraits;

/**
 * This is the model class for table "{{%main}}".
 *
 * @property integer $id
 * @property string $prog
 * @property integer $genre_id
 * @property integer $speech_id
 * @property integer $code_id
 * @property string $comment
 * @property string $time_s
 * @property string $time_e
 * @property integer $sum
 * @property string $date
 * @property integer $kanal
 * @property integer $micf
 * @property integer $auto
 * @property integer $role
 *
 * @property int $template_id
 * @property Telecast $telecast
 * @property Genre $genre
 * @property Code $code
 * @property Speech $speech
 *
 * @property string $year_sum
 * @property string $day_sum
 * @property string $month_sum
 * @property string $month_1
 * @property string $month_2
 * @property string $month_3
 * @property string $month_4
 * @property string $month_5
 * @property string $month_6
 * @property string $month_7
 * @property string $month_8
 * @property string $month_9
 * @property string $month_10
 * @property string $month_11
 * @property string $month_12
 * @property string $season_1_sum
 * @property string $season_2_sum
 * @property string $season_3_sum
 * @property string $season_4_sum
 * @property string $group_filter
 * @property string $second_date
 * @property string $orderBy
 * @property boolean $between
 * @property boolean $print
 */
class Main extends \yii\db\ActiveRecord
{
    use GeneralTraits;
    public $template_id;
    public $year_sum;
    public $season_1_sum;
    public $season_2_sum;
    public $season_3_sum;
    public $season_4_sum;
    public $day_sum;
    public $month_sum;
    public $month_1;
    public $month_2;
    public $month_3;
    public $month_4;
    public $month_5;
    public $month_6;
    public $month_7;
    public $month_8;
    public $month_9;
    public $month_10;
    public $month_11;
    public $month_12;
    public $group_filter;
    public $between;
    public $orderBy;
    public $second_date;
    public $print;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%main}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prog', 'genre_id', 'speech_id', 'code_id', 'time_s', 'time_e', 'kanal', 'date'], 'required'],
            [['genre_id', 'speech_id', 'code_id', 'sum', 'kanal', 'micf', 'role', 'template_id', 'auto'], 'integer'],
            [['year_sum', 'season_1_sum', 'season_2_sum', 'season_3_sum', 'season_4_sum', 'day_sum', 'month_sum'], 'number'],
            [['month_1', 'month_2', 'month_3', 'month_4', 'month_5', 'month_6', 'month_7', 'month_8', 'month_9', 'month_10', 'month_11', 'month_11'], 'number'],
            [['comment'], 'string'],
            [['time_s', 'time_e', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'prog'        => Yii::t('app', 'Prog'),
            'genre_id'    => Yii::t('app', 'Genre ID'),
            'speech_id'   => Yii::t('app', 'Speech ID'),
            'code_id'     => Yii::t('app', 'Code ID'),
            'comment'         => Yii::t('app', 'Comment'),
            'time_s'      => Yii::t('app', 'Time S'),
            'time_e'      => Yii::t('app', 'Time E'),
            'sum'         => Yii::t('app', 'Sum'),
            'date'        => Yii::t('app', 'Date'),
            'second_date' => Yii::t('app', 'Date'),
            'kanal'       => Yii::t('app', 'Kanal'),
            'auto'        => Yii::t('app', 'Рекрусивне збереження до кінця року'),
            'micf'        => Yii::t('app', 'Micf'),
            'role'        => Yii::t('app', 'Role'),
            'template_id' => Yii::t('app', 'Template ID'),
            'year_sum' => Yii::t('app', 'За рік'),
            'day_sum' => Yii::t('app', 'За день'),
            'month_sum' => Yii::t('app', 'За місяць'),
            'season_1_sum' => Yii::t('app', 'I кв.'),
            'season_2_sum' => Yii::t('app', 'II кв.'),
            'season_3_sum' => Yii::t('app', 'III кв.'),
            'season_4_sum' => Yii::t('app', 'IV кв.'),
            'month_1' => Yii::t('app', 'Січень'),
            'month_2' => Yii::t('app', 'Лютий'),
            'month_3' => Yii::t('app', 'Березень'),
            'month_4' => Yii::t('app', 'Квітень'),
            'month_5' => Yii::t('app', 'Травень'),
            'month_6' => Yii::t('app', 'Червень'),
            'month_7' => Yii::t('app', 'Липень'),
            'month_8' => Yii::t('app', 'Серпень'),
            'month_9' => Yii::t('app', 'Вересень'),
            'month_10' => Yii::t('app', 'Жовтень'),
            'month_11' => Yii::t('app', 'Листопад'),
            'month_12' => Yii::t('app', 'Грудень'),
        ];
    }

    /**
     * @inheritdoc
     * @return MainQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MainQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCode()
    {
        return $this->hasOne(Code::className(), ['id' => 'code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertising()
    {
        return $this->hasOne(Advertising::className(), ['date' => 'date'])->andOnCondition(['kanal' => 'kanal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelecast()
    {
        return $this->hasOne(Telecast::className(), ['id' => 'prog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeech()
    {
        return $this->hasOne(Speech::className(), ['id' => 'speech_id']);
    }

    /**
     * @return array
     */
    public function sumAll()
    {
        $query = self::find()->role();

        // add conditions that should always apply here
        $date = is_null($this->date) ? new \DateTime('now'): new \DateTime($this->date);
        // grid filtering conditions
        if ($this->between === true) {
            $query->andFilterWhere(['between', 'date', $date->format('Y-m-01'), $date->format('Y-m-t')]);
        } else {
            $query->andFilterWhere(['date' => $date->format('Y-m-d')]);
        }
        $query->andFilterWhere([
            'id'                            => $this->id,
            'prog'                          => $this->prog,
            'genre_id'                      => $this->genre_id,
            'speech_id'                     => $this->speech_id,
            'code_id'                       => $this->code_id,
            'sum'                           => $this->sum,
            'kanal'                         => $this->kanal,
            'micf'                          => $this->micf,
        ]);

        $query->andFilterWhere(['like', 'time_s', $this->time_s])
            ->andFilterWhere(['like', 'time_e', $this->time_e])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        $allSum = $query->sum('sum');

        $speech = Speech::find()->andFilterWhere(['like', 'name', 'Власне'])->role()->one();

        $query->andFilterWhere(['speech_id' => $speech->id]);

        $secondSum = $query->sum('sum');

        return ['allSum' => $allSum ? $allSum : 0, 'secondSum' => $secondSum ? $secondSum : 0];
    }

    /**
     * @return array
     */
    public static function channelList()
    {
        $channel = [
            User::RADIO => [
                25 => Yii::t('app', 'РСТ'),
                34 => Yii::t('app', 'Проводове'),
                99 => Yii::t('app', 'ФМ'),
                100 => Yii::t('app', 'УР1'),
                101 => Yii::t('app', 'УР2'),
                102 => Yii::t('app', 'УР3'),
            ],
            User::TB    => [
                25 => Yii::t('app', '25'),
                34 => Yii::t('app', '34'),
                99 => Yii::t('app', 'Цифрове'),
            ]
        ];

        return $channel[Yii::$app->user->identity->role];
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public static function channel($id)
    {
        $channelList = self::channelList();

        return $channelList[$id];
    }

    /**
     * @param ReportOutSearch[] $models
     *
     * @return array
     */
    public static function sortMicrophone($models)
    {
        $dataArr = array();
        foreach ($models as $value) {
            $dataArr[$value->date][] = $value;
        }
        ksort($dataArr);
        return $dataArr;
    }


    /**
     * @param MainSearch $mainSearch
     */
    public static function saveTemplate($mainSearch)
    {
        $templates = TemplateSetup::findAll(['template_id' => $mainSearch->template_id]);

        if (!is_null($templates)) {
            /** @var TemplateSetup $template */
            foreach ($templates as $template) {
                $model = new Main();
                $model->setAttributes($template->attributes);
                $model->prog = $template->telecast_id;
                $model->date = $mainSearch->date;
                $model->save();
            }
        }
    }

    public function beforeSave($insert)
    {
        $timeStart = new \DateTime($this->time_s);
        $timeEnd = new \DateTime($this->time_e);
        $diffTime = $timeEnd->diff($timeStart);
        $this->sum = $diffTime->i + ($diffTime->h * 60);
        $this->date = Yii::$app->formatter->asDate($this->date, 'php:Y-m-d');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function recursionSave()
    {
        $date = new \DateTime($this->date);
        $endYear = (int)$date->format('Y') + 1;
        $date = self::modifyRecursionDate($date);

        if($this->isNewRecord) {
            #insert
            $this->auto = 1;
            if ($this->save()) {
                while ($date->format('Y') < $endYear) {
                    $model = new Main();
                    $model->setAttributes($this->attributes);
                    $model->date = $date->format('Y-m-d');
                    $model->save();

                    $date = self::modifyRecursionDate($date);
                }
            }
        } else {
            #update
            if ($this->save()) {
                while ($date->format('Y') < $endYear) {
                    $model = Main::findOne(['date' => $date->format('Y-m-d'), 'time_s' => $this->time_s, 'time_e' => $this->time_e]);
                    $model->setAttributes($this->attributes);
                    $model->date = $date->format('Y-m-d');
                    $model->save();

                    $date = self::modifyRecursionDate($date);
                }
            }
        }
    }

    /**
     * @param $date \DateTime
     *
     * @return \DateTime
     */
    public static function modifyRecursionDate($date)
    {
        if (\Yii::$app->user->can('managerRadio')) {
            $date->modify('+14 day');
        } else {
            $date->modify('+7 day');
        }

        return $date;
    }

    /**
     * @param $date string
     *
     * @return string
     */
    public static function titlePrint($date)
    {
        $date = new \DateTime($date);
        $title = 'Філії ПАТ "НСТУ" "Чернівецька РД"';

        $dateODTRK = new \DateTime('01-10-2015');
        $dateHTKY = new \DateTime('19-01-2017');

        if ($date < $dateODTRK ) {
            $title = 'Чернівецької ОДТРК';
        } elseif ($date < $dateHTKY) {
            $title = 'Філії НТКУ "Чернівецька регіональна дирекція"';
        }

        return $title;
    }
}
