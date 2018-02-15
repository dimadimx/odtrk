<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Main */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-out-search row">
    <?php $form = ActiveForm::begin([
        'action' => ($model->group_filter == 'genre_id') ? ['genre'] : ['speech'],
        'method' => 'get',
    ]); ?>
    <div class="col-sm-2">
        <?php $model->date = (int)$model->date ? $model->date : ''; ?>
        <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
            'options'       => ['placeholder' => ''],
            'pluginOptions' => [
                'autoclose' => true,
                'format'    => 'dd-mm-yyyy'
            ]
        ]); ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'kanal')->widget(\kartik\select2\Select2::classname(), [
            'data'          => \app\models\Main::channelList(),
            'options'       => [
                'prompt'   => 'Не задано',
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        //            ->dropDownList(\app\models\Main::channelList(),['prompt' => 'Не задано', 'multiple'=>'multiple'])    ?>
    </div>
    <div class="col-sm-2">
        <div class="form-group" style="padding-top: 24px">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
