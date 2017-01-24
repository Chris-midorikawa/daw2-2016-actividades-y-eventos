<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

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

class Avisos extends \yii\db\ActiveRecord
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
            [['id', 'fecha', 'clase_aviso_id', 'texto', 'destino_usuario_id', 'origen_usuario_id'], 'required'],
            [['id', 'destino_usuario_id', 'origen_usuario_id', 'actividad_id', 'comentario_id'], 'integer'],
            [['fecha', 'fecha_lectura', 'fecha_borrado', 'fecha_aceptado'], 'safe'],
            [['clase_aviso_id'], 'string', 'max' => 1],
            [['texto'], 'string', 'max' => 140],
        ];
    }

    /*Función que devuelve la lista fija de clases de avisos*/
    /*Códigos de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, M=Mensaje Genérico,...*/
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
            'fecha' => 'Fecha y Hora',
            'clase_aviso_id' => 'Clase Aviso ID',
            'texto' => 'Mensaje',
            'destino_usuario_id' => 'Destino',
            'origen_usuario_id' => 'Origen',
            'claseAvisoInstancia' => 'Clase Aviso', //variable virtual
            'actividad_id' => 'Actividad relacionada',
            'comentario_id' => 'Comentario relacionado',
            'fecha_lectura' => 'Fecha y Hora de lectura',
            'fecha_borrado' => 'Fecha y Hora de la marca de borrado',
            'fecha_aceptado' => 'Fecha y Hora de aceptación del aviso',
        ];
    }

}
