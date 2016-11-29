<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property string $referencia
 * @property string $cifnif
 * @property string $nombre
 * @property string $apellidos
 * @property string $domFiscal
 * @property string $domEnvio
 * @property string $notas
 * @property string $email
 * @property string $password
 *
 * @property Pedidos[] $pedidos
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['referencia', 'cifnif', 'nombre', 'apellidos', 'domFiscal', 'email', 'password'], 'required'],
            [['notas'], 'string'],
            [['referencia', 'cifnif'], 'string', 'max' => 10],
            [['nombre', 'apellidos', 'domFiscal', 'domEnvio'], 'string', 'max' => 250],
            [['email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'referencia' => 'Referencia',
            'cifnif' => 'Cifnif',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'domFiscal' => 'Dom Fiscal',
            'domEnvio' => 'Dom Envio',
            'notas' => 'Notas',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['refCli' => 'referencia']);
    }
}
