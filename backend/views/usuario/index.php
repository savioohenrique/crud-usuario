<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Cadastrar Usuário', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'id',
                'username',
                 'nome',
                 'cpf',
                 'email:email',
                 'telefone',
                 'data_de_nascimento:date',
                 'created_at:date',
                 'updated_at:date',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
