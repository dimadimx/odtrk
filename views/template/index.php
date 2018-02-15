<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">
    <?php Pjax::begin(); ?>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'layout'       => "{items}\n{summary}\n{pager}",
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute'     => 'name',
                    'format'        => 'raw',
                    'value'         => function ($data) {
                        return Html::a($data->name, ['/template-setup/index/', 'TemplateSetupSearch' => ['template_id'=> $data->id]], ['class' => 'link']);
                    },
                ],
                [
                    'class'    => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons'  => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                '<i class="glyphicon glyphicon-eye-open"></i>',
                                ['/template-setup/index/', 'TemplateSetupSearch' => ['template_id'=> $model->id]],
                                ['title' => Yii::t('app','View'), 'data-pjax' => '0']);
                        },
                    ],
                ],
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
