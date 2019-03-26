<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\select2;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form ActiveForm */
?>
<div class="project-modify" id="project">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description') ?>
    <?= $form->field($model, 'publishers_url') ?>
    <?= $form->field($model, 'download_url') ?>
    <?= $form->field(new \yii\base\DynamicModel(['authors']), 'authors')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Author::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select authors ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
