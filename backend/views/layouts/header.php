<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$usuario = \common\models\Usuario::findIdentity(Yii::$app->user->id);

if ($usuario == null){
    $foto = "user_image.png";
    $user = "Visitante";
} else {
    $user = $usuario->username;
    if ($usuario->Foto == null) {
        $foto = "user_image.png";
    } else{
        $foto = $usuario->Foto;
    }
}

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">U</span><span class="logo-lg">' . "Crud Usuário" . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/fotos/<?= $foto ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"> <?= $user ?>  </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/fotos/<?= $foto ?>" class="img-circle"
                                 alt="User Image"/>
                            <p>
                                <?= $user ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sair',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat btn-outline-secondary']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
