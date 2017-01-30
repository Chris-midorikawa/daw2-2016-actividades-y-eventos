<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad_comentarios".
 *
 * @property string $id
 * @property string $actividad_id
 * @property string $crea_usuario_id
 * @property string $crea_fecha
 * @property string $modi_usuario_id
 * @property string $modi_fecha
 * @property string $texto
 * @property string $comentario_id
 * @property integer $cerrado
 * @property integer $num_denuncias
 * @property string $fecha_denuncia1
 * @property integer $bloqueado
 * @property string $fecha_bloqueo
 * @property string $notas_bloqueo
 */
class ActividadComentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_comentarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actividad_id', 'texto'], 'required'],
            [['actividad_id', 'crea_usuario_id', 'modi_usuario_id', 'comentario_id', 'cerrado', 'num_denuncias', 'bloqueado'], 'integer'],
            [['crea_fecha', 'modi_fecha', 'fecha_denuncia1', 'fecha_bloqueo'], 'safe'],
            [['texto', 'notas_bloqueo'], 'string'],
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
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'texto' => 'Texto',
            'comentario_id' => 'Comentario ID',
            'cerrado' => 'Cerrado',
            'num_denuncias' => 'Num Denuncias',
            'fecha_denuncia1' => 'Fecha Denuncia1',
            'bloqueado' => 'Bloqueado',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'notas_bloqueo' => 'Notas Bloqueo',
        ];
    }

    /**
     * @inheritdoc
     * @return ActividadComentariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActividadComentariosQuery(get_called_class());
    }
}
