<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Exibir Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nome;
?>
<div class="usuario-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Tem certeza que deseja deletar esse usuário?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
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
