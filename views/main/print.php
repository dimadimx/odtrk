<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Main */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вхідні дані';
$sum = $searchModel->sumAll();
$dateFormat = $searchModel->between ? 'php:M Y' : 'php:d-m-Y';
?>
<style>
    .container {
        font-size:13px;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding:2px;
    }
    h3, .h3,h4, .h4 {
        margin: 5px;
    }
</style>
<div class="container page">
    <div class="row">
        <div class="col-sm-12 text-center"><h3>ВІДОМІСТЬ</h3></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><h4>обліку передач <?php echo \app\models\Main::titlePrint($searchModel->date)?></h4></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">_____________________, <?php echo Yii::$app->formatter->asDate($searchModel->date, $dateFormat); ?></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'       => "{items}",
                'columns'      => [
                    [
                        'attribute'     => 'date',
                        'value'         => function ($data) {return (int)$data->date ? Yii::$app->formatter->asDate($data->date) : '';},
                        'visible' => $searchModel->between,
                    ],
                    [
                        'attribute' => 'prog',
                        'format'    => 'raw',
                        'value'     => function ($data) {
                            return is_numeric($data->prog) ? @$data->telecast->name : $data->prog;
                        },
                        'filter'    => \app\models\Telecast::getList()
                    ],
                    [
                        'attribute' => 'genre_id',
                        'format'    => 'raw',
                        'value'     => function ($data) {
                            return @$data->genre->name;
                        },
                        'filter'    => \app\models\Genre::getList()
                    ],
                    [
                        'attribute' => 'speech_id',
                        'format'    => 'raw',
                        'value'     => function ($data) {
                            return @$data->speech->name;
                        },
                        'footer'    => '<div class="kv-align-right">Власне:</div>',
                        'filter'    => \app\models\Speech::getList()
                    ],
                    [
                        'attribute' => 'code_id',
                        'format'    => 'raw',
                        'value'     => function ($data) {
                            return @$data->code->name;
                        },
                        'footer'    => "<div class='kv-align-left'>{$sum['secondSum']}хв.</div>",
                        'filter'    => \app\models\Code::getList()
                    ],
                    // 'comment:ntext',
//                    'time_s',
                    [
                        'label'     => 'Хронометраж',
                        'attribute' => 'time_e',
                        'value'     => function ($data) {
                            return date('H:i',strtotime($data->time_s)).'-'.date('H:i',strtotime($data->time_e));
                        },
                        'footer'    => '<div class="kv-align-right">Всього:</div>',
                    ],
                    [
                        'label'     => 'Трив.хв',
                        'attribute' => 'sum',
                        'footer'    => "<div class='kv-align-left'>{$sum['allSum']}хв.</div>",
                    ],
                    // 'date',
                    // 'kanal',
                    // 'micf',
                    // 'role',
                ],
                'showFooter'   => true,
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">___________________</div>
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