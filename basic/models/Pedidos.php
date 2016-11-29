<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property string $serie
 * @property integer $numero
 * @property string $fecha
 * @property string $refCli
 * @property string $domEnvio
 * @property integer $estado
 * @property string $notas
 *
 * @property Clientes $refCli0
 * @property Pedidoslin[] $pedidoslins
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serie', 'numero', 'fecha', 'refCli', 'domEnvio'], 'required'],
            [['numero', 'estado'], 'integer'],
            [['fecha'], 'safe'],
            [['notas'], 'string'],
            [['serie'], 'string', 'max' => 4],
            [['refCli'], 'string', 'max' => 10],
            [['domEnvio'], 'string', 'max' => 250],
            [['refCli'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['refCli' => 'referencia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serie' => 'Serie',
            'numero' => 'Numero',
            'fecha' => 'Fecha',
            'refCli' => 'Ref Cli',
            'domEnvio' => 'Dom Envio',
            'estado' => 'Estado',
            'notas' => 'Notas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCli0()
    {
        return $this->hasOne(Clientes::className(), ['referencia' => 'refCli']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoslins()
    {
        return $this->hasMany(Pedidoslin::className(), ['serie' => 'serie', 'numero' => 'numero']);
    }
}
