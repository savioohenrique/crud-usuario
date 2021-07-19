<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\validators\ImageValidator;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $nome
 * @property string $cpf
 * @property string $email
 * @property string $telefone
 * @property string|null $Foto
 * @property string $data_de_nascimento
 * @property string $cep
 * @property string $endereco
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $verification_token
 */
class Usuario extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $url;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['cpf', 'number', 'max' => 99999999999],
            ['cpf', 'string', 'min' => 11, 'max' => 11],
            ['telefone', 'number', 'max' => 999999999999],
            ['telefone', 'string','min' => 8, 'max' => 12],
            ['password_hash', 'string', 'min' => 8],
            ['cep', 'string', 'min' => 8, 'max' => 8],
            ['email', 'email'],
            ['url', 'file'],

            [['username', 'auth_key', 'password_hash', 'nome', 'cpf', 'email', 'telefone', 'data_de_nascimento', 'cep', 'endereco', 'bairro', 'cidade', 'estado', 'created_at'], 'required'],
//            [['data_de_nascimento'], 'safe'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'nome', 'email', 'url', 'endereco', 'complemento', 'bairro', 'cidade', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['estado'], 'string', 'max' => 2],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],

            ['created_by', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            ['updated_by', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
          TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuário',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Senha',
            'password_reset_token' => 'Password Reset Token',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'Foto' => 'Foto',
            'data_de_nascimento' => 'Data De Nascimento',
            'cep' => 'Cep',
            'endereco' => 'Endereço',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'status' => 'Status',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
            'created_by' => 'Criado por',
            'updated_by' => 'Atualizado por',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

}
