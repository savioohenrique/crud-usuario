<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password_hash')->input('password', ['maxlength' => true]) ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cpf')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Foto')->fileInput() ?>

        <?= $form->field($model, 'data_de_nascimento')->input('date') ?>

        <?= $form->field($model, 'cep')->textInput(['maxlength' => true]) ?>

        <div>
            <a class="btn btn-primary" id="viacep-link">Buscar</a>
        </div>

        <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'complemento')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'bairro')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>


    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    async function buscarCep(cep_para_buscar) {
        let cep = cep_para_buscar;

        let url = 'http://viacep.com.br/ws/' + cep + '/json';

        try {
            let response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            });
            let msg = await response.json();
            return msg;
        } catch (error) {
            console.log(error)
        }
    };

    async function preencerCampos(){
        let input_cep = document.getElementById('usuario-cep');
        let cep = input_cep.value;

        let viacep = await buscarCep(cep);
        if (!viacep['erro']){
            let input_endereco = document.getElementById('usuario-endereco');
            let input_complemento = document.getElementById('usuario-complemento');
            let input_bairro = document.getElementById('usuario-bairro');
            let input_cidade = document.getElementById('usuario-cidade');
            let input_estado = document.getElementById('usuario-estado');

            input_endereco.value = viacep['logradouro'];
            input_complemento.value = viacep['complemento'];
            input_bairro.value = viacep['bairro'];
            input_cidade.value = viacep['localidade'];
            input_estado.value = viacep['uf'];
        }else {
            alert('N??o foi poss??vel buscar os dados do cep pesquisado, por favor insir?? os campos manualmente.');
        }

    }

    var a_link =document.getElementById('viacep-link');

    a_link.addEventListener("click",preencerCampos);
</script>