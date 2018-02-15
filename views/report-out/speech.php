<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Outs');
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
                        return Html::a(@$data->speech->name, ['/genre/view', 'id' => $data->speech_id], ['class' => 'link']);
                    },
                    'pageSummary'=>'Cума',
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
                    'attribute' => 'season_1_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_2_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_3_sum',
                    'pageSummary' => true,
                ],
                [
                    'attribute' => 'season_4_sum',
                    'pageSummary' => true,
                ],
            ],
            'responsive'=>true,
            'hover'=>true,
//            'floatHeader'=>true,
//            'floatHeaderOptions'=>['scrollingTop'=>'50'],
            'panel' => [
//                'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Diario</h3>',
                'type'=>'primary',
//                'before'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//                'showFooter'=>false
            ],
            'showPageSummary' => true,
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
