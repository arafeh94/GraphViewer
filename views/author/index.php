<?php

/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 9/20/2019
 * Time: 4:53 AM
 */

/* @var $dataProvider \yii\data\ActiveDataProvider */

if ($error = Yii::$app->request->get('error', false)) {
    echo \yii\bootstrap4\Alert::widget(['body' => $error, 'options' => ['class' => 'alert-danger']]);
}

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => \yii\helpers\Html::a('Create', ['author/create'], ['class' => 'btn btn-primary', 'style' => 'margin-bottom:10px']),
    'columns' => [
        'name',
        'address',
        [
            'label' => 'Actions',
            'format' => 'raw',
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($model) {
                $delete = \yii\helpers\Html::a('Delete', ['author/delete', 'id' => $model->id]);
                $modify = \yii\helpers\Html::a('Modify', ['author/update', 'id' => $model->id]);
                return "$delete | $modify";
            },
        ],
    ],
]) ?>
