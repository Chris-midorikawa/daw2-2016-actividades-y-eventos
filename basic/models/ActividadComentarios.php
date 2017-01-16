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
            'actividad_id' => 'Actividad relacionada',
            'crea_usuario_id' => 'Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
            'crea_fecha' => 'Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.',
            'modi_usuario_id' => 'Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
            'modi_fecha' => 'Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.',
            'texto' => 'El texto del comentario.',
            'comentario_id' => 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.',
            'cerrado' => 'Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)',
            'num_denuncias' => 'Contador de denuncias del comentario o CERO si no ha tenido.',
            'fecha_denuncia1' => 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
            'bloqueado' => 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
            'fecha_bloqueo' => 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
            'notas_bloqueo' => 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.',
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
