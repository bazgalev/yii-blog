<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\PublicAsset;
use yii\helpers\Html;

PublicAsset::register($this);

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
    <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon-pazgalev.ico']); ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="\public\images\logo-pazgalev-black.png" alt="Logo"></a>
            </div>

            <div class="collapse navbar-collapse ml-auto" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav text-uppercase">
                    <li class="nav-item"><a href="/">Home</a></li>
                </ul>
                <ul class="nav navbar-nav text-uppercase navbar-right">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="nav-item"><a href="/auth/login">Login</a></li>
                        <li class="nav-item"><a href="/auth/signup">Sign up</a></li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="/auth/logout">
                                Logout(<?= Yii::$app->user->identity->name; ?>)
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
</nav>


<?= $content; ?>

<!--footer start-->
<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <aside class="footer-widget ">


                    <h3 class="text-uppercase">About</h3>
                    <p>This site - the result of work on on an educational project, during which I learned the basics
                        PHP framework Yii 2.0. Today I publish here my thoughts on various topics that interest me:
                        programming, beatmaking, film35, etc.
                    </p>

                </aside>
            </div>
            <div class="col-md-6">
                <aside class="footer-widget">

                    <h3 class="text-uppercase">contact Info</h3>

                    <p>Email: pazgalevm@gmail.com</p>
            </div>
            </aside>
        </div>


    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center"><a href="#"> &copy;
                            Copyright 2018-<?= date('Y') ?> Pazgalev</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
