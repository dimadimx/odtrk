<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertisingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Advertisings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertising-index">
    <?php Pjax::begin(); ?>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'date:date',
                'time',
                [
                'attribute'     => 'kanal',
                'format'        => 'raw',
                'visible' => \Yii::$app->user->can('managerRadio'),
                'value'         => function ($data) {return \app\models\Main::channel($data->kanal);},
                'filter'=> \app\models\Main::channelList()
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'responsive'=>true,
            'hover'=>true,
            'panel' => [
                'type'=>'primary',
            ],
            'toolbar' => [
                [
                    'content'=>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                            'title'=>Yii::t('app', 'Create'),
                            'class'=>'btn btn-success'
                        ]) . ' '.
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('app', 'Reset')
                        ]),
                ],
//                '{export}',
                '{toggleData}'
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
