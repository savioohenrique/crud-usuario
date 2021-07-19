<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Atualizar usuário: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="usuario-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
