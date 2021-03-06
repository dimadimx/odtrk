<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Main */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-view box box-primary">
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute'     => 'prog',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->telecast->name, ['/telecast/view', 'id' => $data->prog], ['class' => 'link']);
                    },
                ],
                [
                    'attribute'     => 'genre_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->genre->name, ['/genre/view', 'id' => $data->genre_id], ['class' => 'link']);
                    },
                ],
                [
                    'attribute'     => 'speech_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->speech->name, ['/genre/view', 'id' => $data->speech_id], ['class' => 'link']);
                    },
                ],
                [
                    'attribute'     => 'code_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->code->name, ['/code/view', 'id' => $data->code_id], ['class' => 'link']);
                    },
                ],
                'time_s',
                'time_e',
                [
                    'attribute'     => 'date',
                    'value'         => function ($data) {return (int)$data->date ? Yii::$app->formatter->asDate($data->date) : '';},
                ],
                'sum',
                [
                    'attribute'     => 'kanal',
                    'value'         => function ($data) {return \app\models\Main::channel($data->kanal);},
                ],
                [
                    'attribute' => 'comment',
                    'visible' => \Yii::$app->user->can('managerRadio'),
                ],
                [
                    'attribute' => 'micf',
                    'format' => 'boolean',
                ],
            ],
        ]) ?>
    </div>
</div>
