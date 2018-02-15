<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportOutSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Мікрофонна папка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-out-search box box-primary">
    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'action'  => ['microphone'],
            'method'  => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>
        <div class="col-xl-2 col-lg-3">
            <?php $searchModel->date = (int)$searchModel->date ? $searchModel->date : ''; ?>
            <?= $form->field($searchModel, 'date')->widget(\kartik\date\DatePicker::classname(), [
                'options'       => ['placeholder' => ''],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format'    => 'dd-mm-yyyy'
                ]
            ]); ?>
        </div>
        <div class="col-xl-2 col-lg-3">
            <?php $searchModel->second_date = (int)$searchModel->second_date ? $searchModel->second_date : ''; ?>
            <?= $form->field($searchModel, 'second_date')->widget(\kartik\date\DatePicker::classname(), [
                'options'       => ['placeholder' => ''],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format'    => 'dd-mm-yyyy'
                ]
            ]); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($searchModel, 'speech_id')->dropDownList(\app\models\Speech::getList(), ['prompt' => 'Не задано']); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($searchModel, 'kanal')->dropDownList(\app\models\Main::channelList(), ['prompt' => 'Не задано']) ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="padding-top: 24px">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
