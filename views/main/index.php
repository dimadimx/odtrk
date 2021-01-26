<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mains');
$this->params['breadcrumbs'][] = $this->title;
$sum = $searchModel->sumAll();
?>
<div class="main-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-body table-responsive no-padding">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'layout'       => "{items}\n{summary}\n{pager}",
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'prog',
                    'format'    => 'raw',
                    'value'     => function ($data) {
                        return is_numeric($data->prog) ?
                            Html::a(@$data->telecast->name, ['/telecast/view', 'id' => $data->prog], ['class' => 'link'])
                            : $data->prog;
                    },
                    'filter'    => \app\models\Telecast::getList()
                ],
                [
                    'attribute' => 'genre_id',
                    'format'    => 'raw',
                    'value'     => function ($data) {
                        return Html::a(@$data->genre->name, ['/genre/view', 'id' => $data->genre_id], ['class' => 'link']);
                    },
                    'filter'    => \app\models\Genre::getList()
                ],
                [
                    'attribute' => 'speech_id',
                    'format'    => 'raw',
                    'value'     => function ($data) {
                        return Html::a(@$data->speech->name, ['/genre/view', 'id' => $data->speech_id], ['class' => 'link']);
                    },
                    'filter'    => \app\models\Speech::getList()
                ],
                [
                    'attribute' => 'code_id',
                    'format'    => 'raw',
                    'value'     => function ($data) {
                        return Html::a(@$data->code->name, ['/code/view', 'id' => $data->code_id], ['class' => 'link']);
                    },
                    'filter'    => \app\models\Code::getList()
                ],
                [
                    'attribute' => 'comment',
                    'visible' => \Yii::$app->user->can('managerRadio'),
                ],
                'time_s',
                [
                    'attribute' => 'time_e',
                    'footer'    => '<div class="kv-align-right">Власне: <br />Всього:</div>',
                ],
                [
                    'attribute' => 'sum',
                    'footer'    => "<div class='kv-align-left'>{$sum['secondSum']} хв. <br />{$sum['allSum']} хв.</div>",
                ],
                // 'date',
                // 'kanal',
                // 'micf',
                // 'role',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'responsive'=>true,
            'showFooter' => true,
            'hover'=>true,
            'panel' => [
                'type'=>'primary',
            ],
            'toolbar' => [
                [
                    'content'=>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create', 'Main'=>Yii::$app->getRequest()->getQueryParam('MainSearch')], [
                            'title'=>Yii::t('app', 'Create'),
                            'class'=>'btn btn-success'
                        ]) . ' '.
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('app', 'Reset')
                        ]) . ' '.
                        Html::a('<i class="glyphicon glyphicon-print key-print"></i> День', ['print'], [
                            'title'=>Yii::t('app', 'Print'),
                            'class'=>'btn btn-primary',
                            'target'=>'_blank',
                            'data' => [
                                'method' => 'get',
                                'params' => [
                                    'date'         => $searchModel->date,
                                    'kanal'        => $searchModel->kanal,
                                ]
                            ]
                        ]) . ' '.
                        Html::a('<i class="glyphicon glyphicon-print"></i> Місяць', ['prints'], [
                            'title'=>Yii::t('app', 'Print'),
                            'class'=>'btn btn-primary',
                            'target'=>'_blank',
                            'data' => [
                                'method' => 'get',
                                'params' => [
                                    'date'         => $searchModel->date,
                                    'kanal'        => $searchModel->kanal,
                                ]
                            ]
                        ]),
                ],
//                '{export}',
                '{toggleData}'
            ],
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