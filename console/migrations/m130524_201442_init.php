<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'nome' => $this->string()->notNull(),
            'cpf' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'telefone' => $this->string()->notNull(),
            'Foto' => $this->string(),
            'data_de_nascimento' => $this->date()->notNull(),
            'cep' => $this->string()->notNull(),
            'endereco' => $this->string()->notNull(),
            'complemento' => $this->string(),
            'bairro' => $this->string()->notNull(),
            'cidade' => $this->string()->notNull(),
            'estado' => $this->string(2)->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),

        ], $tableOptions);

        $this->insert('{{%user}}',[
            'username' => 'savio',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('senha'),
            'nome' => 'Sávio Henrique',
            'cpf' => '09024916445',
            'email' => 'araujosavio99@gmail.com',
            'telefone' => '999999999',
            'data_de_nascimento' => '1999-10-01',
            'cep' => '59072-590',
            'endereco' => 'Rua Dantas Barreto',
            'complemento' => '',
            'bairro' => 'Cidade Nova',
            'cidade' => 'Natal',
            'estado' => 'RN',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => null,

        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
