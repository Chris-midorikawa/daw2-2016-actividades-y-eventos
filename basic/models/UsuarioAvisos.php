<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usuario_avisos}}".
 *
 * @property string $id
 * @property string $fecha
 * @property string $clase_aviso_id
 * @property string $texto
 * @property string $destino_usuario_id
 * @property string $origen_usuario_id
 * @property string $actividad_id
 * @property string $comentario_id
 * @property string $fecha_lectura
 * @property string $fecha_borrado
 * @property string $fecha_aceptado
 */
class UsuarioAvisos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usuario_avisos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'required'],
            [['fecha', 'fecha_lectura', 'fecha_borrado', 'fecha_aceptado'], 'safe'],
            [['texto'], 'string'],
            [['destino_usuario_id', 'origen_usuario_id', 'actividad_id', 'comentario_id'], 'integer'],
            [['clase_aviso_id'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha y Hora de creación del aviso.',
            'clase_aviso_id' => 'código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, M=Mensaje Genérico,...',
            'texto' => 'Texto con el mensaje de aviso.',
            'destino_usuario_id' => 'Usuario relacionado, destinatario del aviso, o NULL si no es para administración y no está gestionado.',
            'origen_usuario_id' => 'Usuario relacionado, origen del aviso, o NULL si es del sistema.',
            'actividad_id' => 'Actividad relacionada o NULL si no tiene que ver con una actividad.',
            'comentario_id' => 'Comentario relacionado o NULL si no tiene que ver con un comentario.',
            'fecha_lectura' => 'Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.',
            'fecha_borrado' => 'Fecha y Hora de la marca de borrado del aviso o NULL si no se ha marcado como borrado.',
            'fecha_aceptado' => 'Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.',
        ];
    }


    /*Función que devuelve la lista fija de clases de avisos*/
    /*Códigos de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, M=Mensaje Genérico,...*/
    public static function getClasesAvisos()
    {
        return [
            'A' => 'Aviso',
            'N' => 'Notificación',
            'D' => 'Denuncia',
            'C' => 'Consulta',
            'M' => 'Mensaje',
        ];
    }

    /*A partir de un id_clase_aviso, devuelve el nombre de la clase*/
    public static function getClaseAviso($id_clase_aviso)
    {
        $clases_aviso = self::getClasesAvisos();
        if (isset($clases_aviso[$id_clase_aviso])){
            return $clases_aviso[$id_clase_aviso];
        } else {
            return false;
        }
    }

    /*Devuelve el nombre de la clase de aviso de la instancia actual*/
    public function getClaseAvisoInstancia()
    {
        $clases_aviso = self::getClasesAvisos();
        if (isset($clases_aviso[$this->clase_aviso_id])) {
            return $clases_aviso[$this->clase_aviso_id];
        } else {
            return false;
        }
    }


    /**
     * @inheritdoc
     * @return UsuarioAvisosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioAvisosQuery(get_called_class());
    }
}
