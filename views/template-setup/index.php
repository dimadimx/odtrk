<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TemplateSetupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Template Setups');
$this->params['breadcrumbs'][] = $this->title;
$sum = $searchModel->sumAll();
?>
<div class="template-setup-index">
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
                [
                    'attribute'     => 'template_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->template->name, ['/template/view', 'id' => $data->template_id], ['class' => 'link']);
                    },
                    'filter'=> \app\models\Template::getList()
                ],
                [
                    'attribute'     => 'telecast_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->telecast->name, ['/telecast/view', 'id' => $data->telecast_id], ['class' => 'link']);
                    },
                    'filter'=> \app\models\Telecast::getList()
                ],
                [
                    'attribute'     => 'genre_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->genre->name, ['/genre/view', 'id' => $data->genre_id], ['class' => 'link']);
                    },
                    'filter'=> \app\models\Genre::getList()
                ],
                [
                    'attribute'     => 'speech_id',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a(@$data->speech->name, ['/genre/view', 'id' => $data->speech_id], ['class' => 'link']);
                    },
                    'filter'=> \app\models\Speech::getList()
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
                // 'kanal',
                // 'micf',
                // 'role',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'responsive'=>true,
            'hover'=>true,
            'showFooter' => true,
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
