<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вихідні дані: ' . (($searchModel->group_filter == 'speech_id') ? Yii::t('app', 'По типу мовлення') : Yii::t('app', 'По жанру'));
if ($searchModel->kanal)  $this->title .= "; Канал: {$searchModel->kanal}";
?>
<div class="container page">
    <div class="row">
        <div class="col-sm-12 text-left"><?php echo $this->title?></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><h3>ВІДОМІСТЬ</h3></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><h4>обліку передач <?php echo \app\models\Main::titlePrint($searchModel->date)?> <?php echo $searchModel->date ?></h4></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= GridView::widget([
                'dataProvider'    => $dataProvider,
                'layout'          => "{items}",
                'columns'         => [
                    [
                        'attribute'   => 'speech_id',
                        'format'      => 'raw',
                        'value'       => function ($data) {
                            return Html::a(@$data->speech->name, ['/speech/view', 'id' => $data->speech_id], ['class' => 'link']);
                        },
                        'pageSummary' => 'Cума',
                        'visible'     => $searchModel->group_filter == 'speech_id',
                    ],
                    [
                        'attribute'   => 'genre_id',
                        'format'      => 'raw',
                        'value'       => function ($data) {
                            return Html::a(@$data->genre->name, ['/genre/view', 'id' => $data->genre_id], ['class' => 'link']);
                        },
                        'pageSummary' => 'Cума',
                        'visible'     => $searchModel->group_filter == 'genre_id',
                    ],
                    [
                        'attribute'   => 'day_sum',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute'   => 'month_sum',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute'   => 'year_sum',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute'   => 'season_1_sum',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute'   => 'season_2_sum',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute'   => 'season_3_sum',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute'   => 'season_4_sum',
                        'pageSummary' => true,
                    ],
                ],
                'showPageSummary' => true,
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">Редактор випуску _____________</div>
    </div>
</div>
<style media="print">
    img {
        max-width: none !important;
    }

    a[href]:after {
        content: "";
    }
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
    }
</style>
<script>
        window.print();
</script>