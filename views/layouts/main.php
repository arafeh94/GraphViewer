<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\models\User;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <?php
        NavBar::begin(['brandLabel' => 'Matlab Graphs Viewer']);
        echo Nav::widget([
            'items' => [
                ['label' => 'Projects', 'url' => ['/project/view']],
                ['label' => Yii::$app->user->isGuest ? 'Login' : 'Logout(' . User::get()->username . ')',
                    'url' => Yii::$app->user->isGuest ? ['/site/login'] : ['/site/logout']],
                ['label' => 'About', 'url' => ['/site/about']],
            ],
            'options' => ['class' => 'navbar-nav'],
        ]);
        NavBar::end();
        ?>
        <div class="content">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Graph Viewer <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
