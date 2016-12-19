<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%areas}}".
 *
 * @property integer $id
 * @property string $clase_area_id
 * @property string $nombre
 * @property integer $area_id
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%areas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clase_area_id', 'nombre'], 'required'],
            [['id', 'area_id'], 'integer'],
            [['clase_area_id'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    public static function getArrayTipoAreas()
    {
        return [
            '0' => 'Planeta',
            '1' => 'Continente',
            '2' => 'Pais',
            '3' => 'Estado',
            '4' => 'Region',
            '5' => 'Provincia',
            '6' => 'Poblacion',
            '7' => 'Barrio',
            '8' => 'Zona',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clase_area_id' => 'Clase Area ID',
            'nombre' => 'Nombre',
            'area_id' => 'Area ID',
        ];
    }

    /**
     * @inheritdoc
     * @return AreasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreasQuery(get_called_class());
    }
}
