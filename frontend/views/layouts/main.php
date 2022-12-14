<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <?php $this->head() ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175557358-1"></script>

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <div id="app">
        <div class="main-wrapper">
            <?= $this->render('header') ?>
            <?= $this->render('sidebar') ?>
            <!-- <div class="container"> -->
            <div class="main-content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
            <?= $this->render('footer') ?>
        </div>
    </div>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();