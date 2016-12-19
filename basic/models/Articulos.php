<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "articulos".
 *
 * @property string $referencia
 * @property string $texto
 * @property double $precio
 * @property double $iva
 * @property string $notas
 *
 * @property Pedidoslin[] $pedidoslins
 */
class Articulos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['referencia', 'texto', 'precio', 'iva'], 'required'],
            [['precio', 'iva'], 'number'],
            [['notas'], 'string'],
            [['referencia'], 'string', 'max' => 10],
            [['texto'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'referencia' => 'Referencia',
            'texto' => 'Texto',
            'precio' => 'Precio',
            'iva' => 'Iva',
            'notas' => 'Notas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoslins()
    {
        return $this->hasMany(Pedidoslin::className(), ['refArt' => 'referencia']);
    }

}
