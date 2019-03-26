<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \rmrevin\yii\fontawesome\FAR;

/* @var $this yii\web\View */
/* @var $model app\models\Graph */
/* @var $form ActiveForm */
?>
<div class="graph-modify">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'project_id')->label(false)->hiddenInput() ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description') ?>
    <?= $form->field($model, 'default_input')->textarea(['style' => 'height:180px', 'placeholder' => 'JSON formatted input']) ?>
    <?= $form->field(new \app\models\forms\UploadForm(), 'file')->fileInput()->label('Matlab File ' . \yii\bootstrap4\Html::a(FAR::icon('question-circle'), ['site/help', 'about' => 'Matlab File'])) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- graph-modify -->
