<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SpeechSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="speech-search row">

    <?php $form = ActiveForm::begin([
        'action' => ['type-out'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-3">
        <?php $model->date = (int)$model->date ? $model->date : '';?>
        <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-mm-yyyy'
            ]
        ]); ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'kanal')->dropDownList(\app\models\Main::channelList(),['prompt' => 'Не задано']) ?>
    </div>

    <div class="col-sm-2">
        <div class="form-group" style="padding-top: 24px">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
