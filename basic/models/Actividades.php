<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividades".
 *
 * @property string $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $fecha_celebracion
 * @property integer $duracion_estimada
 * @property string $detalles_celebracion
 * @property string $direccion
 * @property string $como_llegar
 * @property string $notas_lugar
 * @property string $area_id
 * @property string $notas
 * @property string $url
 * @property string $imagen_id
 * @property integer $edad_id
 * @property integer $publica
 * @property integer $visible
 * @property integer $terminada
 * @property string $fecha_terminacion
 * @property string $notas_terminacion
 * @property integer $num_denuncias
 * @property string $fecha_denuncia1
 * @property integer $bloqueada
 * @property string $fecha_bloqueo
 * @property string $notas_bloqueo
 * @property integer $max_participantes
 * @property integer $min_participantes
 * @property integer $reserva_participantes
 * @property string $formulario_participacion
 * @property integer $votosOK
 * @property integer $votosKO
 * @property string $crea_usuario_id
 * @property string $crea_fecha
 * @property string $modi_usuario_id
 * @property string $modi_fecha
 * @property string $notas_admin
 */
class Actividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public static function edades(){ return [0=>'Todas las edades',
		1=>'Bebé (0 a 3 años)', 
		2=>'Infantil (4 a 9)', 
		3=>'Alevín (10 a 14)', 
		4=>'Juvenil (15 a 17)', 
		5=>'Adulto Joven (18-25)', 
		6=>'Adulto Medio (26-35)', 
		7=>'Adulto Mayor (36-65)', 
		8=>'Tercera Edad (>66)'];
	}
	public static function terminada(){ return [0=>'No',
		1=>'Realizada', 
		2=>'Suspendida', 
		3=>'Cancelada por inadecuada', ];
	}
    public static function tableName()
    {
        return 'actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo', 'descripcion', 'detalles_celebracion', 'direccion', 'como_llegar', 'notas_lugar', 'notas', 'url', 'notas_terminacion', 'notas_bloqueo', 'formulario_participacion', 'notas_admin'], 'string'],
            [['fecha_celebracion', 'fecha_terminacion', 'fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['duracion_estimada', 'area_id', 'edad_id', 'publica', 'visible', 'terminada', 'num_denuncias', 'bloqueada', 'max_participantes', 'min_participantes', 'reserva_participantes', 'votosOK', 'votosKO', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
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
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fecha_celebracion' => 'Fecha Celebracion',
            'duracion_estimada' => 'Duracion Estimada',
            'detalles_celebracion' => 'Detalles Celebracion',
            'direccion' => 'Direccion',
            'como_llegar' => 'Como Llegar',
            'notas_lugar' => 'Notas Lugar',
            'area_id' => 'Area ID',
            'notas' => 'Notas',
            'url' => 'Url',
            'imagen_id' => 'Imagen ID',
            'edad_id' => 'Edad ID',
            'publica' => 'Publica',
            'visible' => 'Visible',
            'terminada' => 'Terminada',
            'fecha_terminacion' => 'Fecha Terminacion',
            'notas_terminacion' => 'Notas Terminacion',
            'num_denuncias' => 'Num Denuncias',
            'fecha_denuncia1' => 'Fecha Denuncia1',
            'bloqueada' => 'Bloqueada',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'notas_bloqueo' => 'Notas Bloqueo',
            'max_participantes' => 'Max Participantes',
            'min_participantes' => 'Min Participantes',
            'reserva_participantes' => 'Reserva Participantes',
            'formulario_participacion' => 'Formulario Participacion',
            'votosOK' => 'Votos Ok',
            'votosKO' => 'Votos Ko',
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'notas_admin' => 'Notas Admin',
        ];
    }
}
