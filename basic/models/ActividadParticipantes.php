<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%actividad_participantes}}".
 *
 * @property string $id
 * @property string $fecha_registro
 * @property string $actividad_id
 * @property string $usuario_id
 * @property string $datos_participacion
 * @property string $fecha_cancelacion
 * @property string $notas_cancelacion
 */
class ActividadParticipantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%actividad_participantes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_registro', 'actividad_id', 'usuario_id', 'fecha_cancelacion'], 'required'],
            [['fecha_registro', 'fecha_cancelacion'], 'safe'],
            [['actividad_id', 'usuario_id'], 'integer'],
            [['datos_participacion', 'notas_cancelacion'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_registro' => 'Fecha y Hora de registro de participación en la actividad por parte del usuario.',
            'actividad_id' => 'Actividad relacionada',
            'usuario_id' => 'Usuario relacionado, que participara en la actividad.',
            'datos_participacion' => 'Datos adicionales del participante en su registro de participación. Será NULL mientras no haya un formulario de participación.',
            'fecha_cancelacion' => 'Fecha y Hora de cancelación de la participación por parte del usuario.',
            'notas_cancelacion' => 'Notas sobre el motivo de la cancelación de la participación del usuario o NULL si no lo indica o no hay.',
        ];
    }

    /**
     * @inheritdoc
     * @return ActividadParticipantesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActividadParticipantesQuery(get_called_class());
    }
}
