<?php

use \yii\bootstrap4\Html;

/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 3/23/2019
 * Time: 6:18 AM
 *
 * @var \app\models\Project[] $projects
 * @var int $focus
 */
?>

<div id="accordion">
    <?php foreach ($projects as $project): ?>
        <div class="card" style="margin: 8px">
            <div class="card-header" id="project[<?= $project->id ?>]">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed font-weight-bold" data-toggle="collapse"
                            data-target="#collapseProject<?= $project->id ?>"
                            aria-expanded="<?= $focus == $project->id ? 'true' : 'false' ?>"
                            aria-controls="collapseProject<?= $project->id ?>">
                        <?= $project->title ?>
                    </button>
                </h5>
            </div>
            <div id="collapseProject<?= $project->id ?>" class="collapse <?= $focus == $project->id ? 'show' : '' ?>"
                 aria-labelledby="headingProject[<?= $project->id ?>]" data-parent="#accordion">
                <div class="card-body">
                    <div class="card" style="margin-bottom: 12px">
                        <div class="card-header">Description</div>
                        <div class="card-body">
                            <?= $project->description ?>
                        </div>
                    </div>

                    <div class="card" style="margin-bottom: 12px">
                        <div class="card-header">Graphs</div>
                        <div class="card-body">
                            <div class="graphs card-columns">
                                <?php foreach ($project->graphs as $graph): ?>
                                    <div id="graph<?= $graph->id ?>">
                                        <div class="card">
                                            <div class="card-body">
                                                <?= Html::a($graph->title, ['graph/view', 'graphId' => $graph->id], []) ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <div class="add-graph card">
                                    <div class="card-body">
                                        <?= Html::a('Add Graph', ['graph/create', 'projectId' => $project->id], []) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-columns">
                        <div class="card">
                            <div class="card-header">Authors</div>
                            <div class="card-body">
                                <?php if (empty($project->publishers_url)): ?>
                                    <?= "Not Available" ?>
                                <?php else: ?>
                                    <?php foreach ($project->authors as $author): ?>
                                        <?= Html::a($author->name, $author->address, ['target' => "_blank"]) ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">Publishers</div>
                            <div class="card-body">
                                <?php if (empty($project->publishers_url)): ?>
                                    <?= "Not Available" ?>
                                <?php else: ?>
                                    <?php foreach (explode(',', $project->publishers_url) as $url): ?>
                                        <?= Html::a($url, $url, ['target' => "_blank"]) ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">Download Paper</div>
                            <div class="card-body">
                                <?= Html::a('Download Link', $project->download_url,
                                    ['target' => "_blank"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div style='margin-top:8px'>
    <?= \yii\bootstrap\Html::a('Create Project', ['project/create'], [
        'class' => 'btn btn-success',
    ]) ?>
    <div class="btn text-info">
        Click on project title to expand it
    </div>
</div>