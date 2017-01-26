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


    public function getParticipantes()
    {
        return $this->hasMany(Usuarios::className(), ['id'=>'usuario_id'])
                ->viaTable('actividad_participantes', ['actividad_id'=>'id']);
    }
	// public longLabels=[
            // 'id' => 'ID',
            // 'titulo' => 'Titulo corto o slogan para la actividad.',
            // 'descripcion' => 'Descripción breve de la actividad o NULL si no es necesaria.',
            // 'fecha_celebracion' => 'Fecha y Hora de celebración de la actividad o NULL si no se conoce (mostrar próximamente).',
            // 'duracion_estimada' => 'Tiempo en Minutos de duración estimada de la actividad, si es CERO no se conoce o no es relevante.',
            // 'detalles_celebracion' => 'Detalles de celebración de la actividad si es necesario o NULL si no hay.',
            // 'direccion' => 'Dirección concreta del lugar de celebración de la actividad o NULL si no se conoce, aunque no debería estar vacío este dato.',
            // 'como_llegar' => 'Notas sobre cómo llegar a la dirección indicada o NULL si no hay indicaciones de como llegar.',
            // 'notas_lugar' => 'Notas adicionales sobre el lugar de celebración de la actividad que no forman parte de la dirección o de las indicaciones, o NULL si no hay.',
            // 'area_id' => 'Area/Zona de celebración de la actividad o CERO si no existe o aún no está indicado (como si fuera NULL).',
            // 'notas' => 'Notas adicionales sobre la actividad que no forman parte de las posibles notas anteriores o NULL si no hay.',
            // 'url' => 'Dirección web externa (opcional) que enlaza con la página \"oficial\" de la actividad o NULL si no hay.',
            // 'imagen_id' => 'Nombre identificativo (fichero interno) con la imagen principal o \"de presentación\" de la actividad, o NULL si no hay.',
            // 'edad_id' => 'Edad recomendada por Rango de Edades: 0=Todas las edades, 1=Bebé (0 a 3 años), 2=Infantil (4 a 9), 3=Alevín (10 a 14), 3=Juvenil (15 a 17), 4=Adulto Joven (18-25), 5=Adulto Medio (26-35), 6=Adulto Mayor (36-65), 7=Tercera Edad (>66).',
            // 'publica' => 'Indicador de actividad para todos los usuarios o solo para los registrados: 0=Privada, 1=Publica.',
            // 'visible' => 'Indicador de actividad visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.',
            // 'terminada' => 'Indicador de actividad terminada: 0=No, 1=Realizada, 2=Suspendida, 3=Cancelada por Inadecuada, ...',
            // 'fecha_terminacion' => 'Fecha y Hora de terminación de la actividad. Debería estar a NULL si no está terminada.',
            // 'notas_terminacion' => 'Notas visibles sobre el motivo de la terminación de la actividad.',
            // 'num_denuncias' => 'Contador de denuncias de la actividad o CERO si no ha tenido.',
            // 'fecha_denuncia1' => 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
            // 'bloqueada' => 'Indicador de actividad bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...',
            // 'fecha_bloqueo' => 'Fecha y Hora del bloqueo de la actividad. Debería estar a NULL si no está bloqueada o si se desbloquea.',
            // 'notas_bloqueo' => 'Notas visibles sobre el motivo del bloqueo de la actividad o NULL si no hay -se muestra por defecto según indique \"bloqueada\"-.',
            // 'max_participantes' => 'Indica si está abierta la participación y el número máximo de participantes que pueden apuntarse en la actividad, 0:No se admiten participantes, >0:Ese valor límite, -1:No hay límite máximo.',
            // 'min_participantes' => 'Indica el número de participantes apuntados para que la actividad se lleve a cabo, >=0:Ese valor mínimo, -1:No hay mínimo.',
            // 'reserva_participantes' => 'Valor lógico para indicar si se admiten o no participantes en reserva en caso de que esté abierta la participación de la actividad con el \"participantes_maxima\".',
            // 'formulario_participacion' => 'Bloque de información con la configuración de los campos de datos requeridos para el formulario de registro de participación en la actividad. Será NULL si no necesita configuración de datos adicionales.',
            // 'votosOK' => 'Contador de votos a favor para la actividad.',
            // 'votosKO' => 'Contador de votos encontra para la actividad.',
            // 'crea_usuario_id' => 'Usuario que ha creado la actividad o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
            // 'crea_fecha' => 'Fecha y Hora de creación de la actividad o NULL si no se conoce por algún motivo.',
            // 'modi_usuario_id' => 'Usuario que ha modificado la actividad por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
            // 'modi_fecha' => 'Fecha y Hora de la última modificación de la actividad o NULL si no se conoce por algún motivo.',
            // 'notas_admin' => 'Notas adicionales para los administradores sobre la actividad o NULL si no hay.',
        // ];
}
