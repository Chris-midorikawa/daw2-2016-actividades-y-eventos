<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_avisos".
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
 * @p   roperty string $fecha_aceptado
 */
class Avisos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_avisos';
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

public static function getClasesAvisos()
    {
        return [
            'A' => 'Avisos',
            'N' => 'Notificaciones',
            'D' => 'Denuncias',
            'C' => 'Consultas',
            'M' => 'Mensajes',
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
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'clase_aviso_id' => 'Clase Aviso ID',
            'texto' => 'Texto',
            'destino_usuario_id' => 'Destino Usuario ID',
            'origen_usuario_id' => 'Origen Usuario ID',
            'actividad_id' => 'Actividad ID',
            'comentario_id' => 'Comentario ID',
            'fecha_lectura' => 'Fecha Lectura',
            'fecha_borrado' => 'Fecha Borrado',
            'fecha_aceptado' => 'Fecha Aceptado',
        ];
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
