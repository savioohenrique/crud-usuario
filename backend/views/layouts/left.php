<?php

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

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/fotos/<?= $foto ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p> <?= $user ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Crud', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->isGuest == false],
                    ['label' => 'Usuários', 'url' => ['usuario/index'], 'visible' => Yii::$app->user->isGuest == false],
                ],
            ]
        ) ?>

    </section>

</aside>
