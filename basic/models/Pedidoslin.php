<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidoslin".
 *
 * @property integer $idLinea
 * @property string $serie
 * @property integer $numero
 * @property integer $orden
 * @property string $refArt
 * @property string $texto
 * @property integer $cantidad
 * @property double $precio
 * @property double $iva
 * @property double $importeBase
 * @property double $cuotaIva
 *
 * @property Articulos $refArt0
 * @property Pedidos $serie0
 */
class Pedidoslin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidoslin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serie', 'numero', 'orden', 'texto', 'cantidad', 'precio', 'iva', 'importeBase', 'cuotaIva'], 'required'],
            [['numero', 'orden', 'cantidad'], 'integer'],
            [['texto'], 'string'],
            [['precio', 'iva', 'importeBase', 'cuotaIva'], 'number'],
            [['serie'], 'string', 'max' => 4],
            [['refArt'], 'string', 'max' => 10],
            [['refArt'], 'exist', 'skipOnError' => true, 'targetClass' => Articulos::className(), 'targetAttribute' => ['refArt' => 'referencia']],
            [['serie', 'numero'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['serie' => 'serie', 'numero' => 'numero']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idLinea' => 'Id Linea',
            'serie' => 'Serie',
            'numero' => 'Numero',
            'orden' => 'Orden',
            'refArt' => 'Ref Art',
            'texto' => 'Texto',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'iva' => 'Iva',
            'importeBase' => 'Importe Base',
            'cuotaIva' => 'Cuota Iva',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefArt0()
    {
        return $this->hasOne(Articulos::className(), ['referencia' => 'refArt']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSerie0()
    {
        return $this->hasOne(Pedidos::className(), ['serie' => 'serie', 'numero' => 'numero']);
    }
}
