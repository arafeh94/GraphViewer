<?php

/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 9/20/2019
 * Time: 4:56 AM
 */

use yii\widgets\ActiveForm;
use yii\bootstrap\Html;

/* @var $this \yii\web\View */
/* @var $model \app\models\Author */
?>

<div class="graph-modify">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->label(false)->hiddenInput() ?>
    <?= $form->field($model, 'name')->label('Name') ?>
    <?= $form->field($model, 'address')->label('Web Address') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- graph-modify -->

