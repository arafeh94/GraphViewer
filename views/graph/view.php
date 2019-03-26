<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 3/23/2019
 * Time: 8:19 PM
 */
ini_set('max_execution_time', 0);

use \rmrevin\yii\fontawesome\FAS;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;

/**@var $graph \app\models\Graph */
/**@var $result string */
/**@var $input string */
?>
<div class="row">
    <div class="col-xs-6" style="width: 50%">
        <div style="margin: 8px">
            <div class="card">
                <div class="card-header">
                    <?= $graph->title ?>
                    <?= \yii\bootstrap4\Html::a(FAS::icon('pen-fancy', ['style' => 'color:black']), ['graph/update', 'graphId' => $graph->id]) ?>

                </div>
                <div class="card-body">
                    <?= $graph->description ?>
                </div>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card" style="margin-top: 16px">
                <div class="card-header">
                    Input
                </div>
                <div class="card-body">
                    <?= \yii\bootstrap4\Html::textarea('input', $input, ['id' => 'json_area', 'style' => 'width:100%;height:150px;resize:vertical']) ?>
                    <input type="file" name="fileInput" id="fileInput">
                </div>
            </div>
            <div class="card" style="margin-top: 16px">
                <div class="card-body">
                    <input type="submit" class="btn btn-success">
                    <input type="reset" class="btn btn-danger">
                    <?= Html::a('Back', ['project/view', 'focus' => $graph->project_id], [
                        'class' => 'btn btn-secondary'
                    ]) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-xs-6" style="width: 50%">
        <div style="margin: 8px">
            <div class="card">
                <div class="card-header">Graph Result</div>
                <div class="card-body">
                    <?php if ($result) : ?>
                        <?= Html::img("@web/$result", ['class' => 'pull-left img-responsive', 'style' => 'width:100%']); ?>
                    <?php else: ?>
                        Provide Input To Generate The Graph
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--suppress SpellCheckingInspection -->
<script>
    window.addEventListener('load', function () {
        $(document).ready(function () {
            let fileInput = $("input[type=file]");
            fileInput.click(function () {
                $(this).val("");
            });

            fileInput.change(function (elementId, event) {
                let file = document.getElementById("fileInput").files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.readAsText(file, "UTF-8");
                    reader.onload = function (evt) {
                        let result = evt.target.result;
                        $('#json_area').val(result);
                    };
                    reader.onerror = function (evt) {
                        alert('error while reading file');
                    };
                }
            });
        });
    })
</script>