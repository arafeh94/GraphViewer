<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 3/23/2019
 * Time: 8:19 PM
 */

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
                    <?= \yii\bootstrap4\Html::a(FAS::icon('pen-fancy', ['style' => 'color:#6c757d']), ['graph/update', 'graphId' => $graph->id], ['class' => 'float-right']) ?>

                </div>
                <div class="card-body">
                    <?= $graph->description ?>
                </div>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'graph_input']); ?>
            <div class="card" style="margin-top: 16px">
                <div class="card-header">
                    Input
                    <?= \yii\bootstrap4\Html::tag('span', FAS::icon('download', ['style' => 'color:#6c757d']), ['onclick' => 'saveToFile(this)', 'class' => 'float-right']) ?>
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
                    <?php elseif ($result === false): ?>
                        <span class="help-block"> Error while parsing results</span>
                    <?php else: ?>
                        Provide Input To Generate The Graph
                    <?php endif; ?>
                    <div><b><span id="wait" style="color: #1b6d85"></span></b></div>
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
        $('#graph_input').submit(function () {
            $('#wait').text('please wait...');
        })
    });

    function saveToFile(textArea) {
        let textToWrite = $('#json_area').text();
        let textFileAsBlob = new Blob([textToWrite], {type: 'text/plain'});
        let fileNameToSaveAs = 'data_set.json';

        let downloadLink = document.createElement("a");
        downloadLink.download = fileNameToSaveAs;
        downloadLink.innerHTML = "Download File";
        if (window.webkitURL != null) {
            downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
        }
        else {
            downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
            downloadLink.onclick = destroyClickedElement;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
        }

        downloadLink.click();
    }
</script>