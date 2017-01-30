<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad_seguimientos".
 *
 * @property string $id
 * @property string $actividad_id
 * @property string $usuario_id
 * @property string $fecha_seguimiento
 */
class ActividadSeguimientos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_seguimientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actividad_id', 'usuario_id', 'fecha_seguimiento'], 'required'],
            [['actividad_id', 'usuario_id'], 'integer'],
            [['fecha_seguimiento'], 'safe'],
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
            'usuario_id' => 'Usuario ID',
            'fecha_seguimiento' => 'Fecha Seguimiento',
        ];
    }

    /**
     * @inheritdoc
     * @return ActividadSeguimientosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActividadSeguimientosQuery(get_called_class());
    }
}
