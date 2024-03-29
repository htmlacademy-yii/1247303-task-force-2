<?php

/** @var yii\web\View $this */
/** @var string $content */
/** @var $user */

use app\assets\AppAsset;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


if ($id = Yii::$app->user->getId()) {

    $user = User::findOne($id);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php if (!Yii::$app->user->isGuest): ?>
<header class="page-header">
    <nav class="main-nav">
        <a href='/' class="header-logo">
            <img class="logo-image" src="/img/logotype.png" width=227 height=60 alt="taskforce">
        </a>
        <div class="nav-wrapper">
            <ul class="nav-list">
                <li class="list-item list-item--active">
                    <a href="<?= Url::to('/tasks') ?>" class="link link--nav" >Новые</a>
                </li>
                <li class="list-item">
                    <a href="<?= Url::to('/tasks/my/progress') ?>" class="link link--nav" >Мои задания</a>
                </li>
                <?php if(!Yii::$app->user->identity->is_executor): ?>
                <li class="list-item">
                    <a href="<?= Url::to('/tasks/add') ?>" class="link link--nav" >Создать задание</a>
                </li>
                <?php endif; ?>
                <li class="list-item">
                    <a href="<?= Url::to('/user/edit') ?>" class="link link--nav" >Настройки</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="user-block">
        <a href="#">
            <img class="user-photo" src="<?= $user->avatar ?>" width="55" height="55" alt="Аватар">
        </a>
        <div class="user-menu">
            <p class="user-name"><?= $user->first_name ?></p>
            <div class="popup-head">
                <ul class="popup-menu">
                    <li class="menu-item">
                        <a href="<?= Url::to('/user/edit') ?>" class="link">Настройки</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="link">Связаться с нами</a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= Url::to('/site/logout') ?>" class="link">Выход из системы</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>
<main class="main-content container <?= (Yii::$app->request->url === '/user/edit') ? 'main-content--left container' : '' ?>">
    <?= $content ?>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
