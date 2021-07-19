<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Usuário ' . $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
?>
<div class="usuario-view box box-primary">
    <div class="box-header">
        <?= var_dump($model->id) ?>
    </div>
    <div class="box-body table-responsive ">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'nome',
                'cpf',
                'email:email',
                'telefone',
                'Foto',
                'data_de_nascimento:date',
                'cep',
                'endereco',
                'complemento',
                'bairro',
                'cidade',
                'estado',
                'status',
                'created_at:datetime',
                'updated_at:datetime',
                'created_by',
                'updated_by',
            ],
        ]) ?>
    </div>
</div>
