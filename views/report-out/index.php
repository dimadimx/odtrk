<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вихідні дані: '.(($searchModel->group_filter == 'speech_id') ? Yii::t('app', 'По типу мовлення') : Yii::t('app', 'По жанру'));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-out-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="box-body table-responsive no-padding">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'speech_id',
                    'format'    => 'raw',
                    'value'     => function ($data) {
                        return Html::a(@$data->speech->name, ['/speech/view', 'id' => $data->speech_id], ['class' => 'link']);
                    },
                    'pageSummary'=>'Cума, хв.',
                    'visible' => $searchModel->group_filter == 'speech_id',
                ],
                [
                    'attribute' => 'genre_id',
                    'format'    => 'raw',
                    'value'     => function ($data) {
                        return Html::a(@$data->genre->name, ['/genre/view', 'id' => $data->genre_id], ['class' => 'link']);
                    },
                    'pageSummary'=>'Cума, хв.',
                    'visible' => $searchModel->group_filter == 'genre_id',
                ],
                [
                    'attribute' => 'day_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'year_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_1',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_2',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_3',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_1_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_4',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_5',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_6',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_2_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_7',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_8',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_9',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_3_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_10',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_11',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'month_12',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_4_sum',
                    'pageSummary' => true,
//                    'footer'    => 'test12',
                ],
            ],
            'beforeFooter' => [
                [
                    'columns' => [
                        ['content' => 'test'],
                        ['content' => 'test2']
                    ]
                ],
                [
                    'columns' => [
                        ['content' => 'test3'],
                        ['content' => 'test4']
                    ]
                ]
            ],
            'showFooter' => true,
            'responsive'=>true,
            'hover'=>true,
            'panel' => [
                'type'=>'primary',
            ],
            'toolbar' => [
                [
                    'content'=>
                        Html::a('<i class="glyphicon glyphicon-print key-print"></i>', ['print'], [
                            'title'=>Yii::t('app', 'Print'),
                            'class'=>'btn btn-success',
                            'target'=>'_blank',
                            'data' => [
                                'method' => 'get',
                                'params' => [
                                    'date'         => $searchModel->date,
                                    'kanal'        => $searchModel->kanal,
                                    'group_filter' => $searchModel->group_filter,
                                ]
                            ]
                        ]),
                ],
//                '{export}',
                '{toggleData}'
            ],
            'showPageSummary' => true,
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
<?php
$printScript = <<< JS
    $(document).keydown(function (e) {
        if (e.ctrlKey && e.altKey && e.keyCode == 80) {
            $('.key-print').click();
        }
    });
JS;
$this->registerJs($printScript);
?>
