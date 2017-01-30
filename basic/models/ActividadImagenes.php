<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad_imagenes".
 *
 * @property string $id
 * @property string $actividad_id
 * @property integer $orden
 * @property string $imagen_id
 */
class ActividadImagenes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_imagenes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actividad_id', 'imagen_id'], 'required'],
            [['actividad_id', 'orden'], 'integer'],
            [['imagen_id'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actividad_id' => 'Actividad ID',
            'orden' => 'Orden',
            'imagen_id' => 'Imagen ID',
        ];
    }

    /**
     * @inheritdoc
     * @return ActividadImagenesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActividadImagenesQuery(get_called_class());
    }
}
