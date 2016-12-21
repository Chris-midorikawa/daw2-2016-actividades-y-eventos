<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usuarios}}".
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $nick
 * @property string $nombre
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $direccion
 * @property string $area_id
 * @property string $rol
 * @property integer $avisos_por_correo
 * @property integer $avisos_agrupados
 * @property integer $avisos_marcar_leidos
 * @property integer $avisos_eliminar_borrados
 * @property string $fecha_registro
 * @property integer $confirmado
 * @property string $fecha_acceso
 * @property integer $num_accesos
 * @property integer $bloqueado
 * @property string $fecha_bloqueo
 * @property string $notas_bloqueo
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usuarios}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'nick', 'nombre', 'apellidos', 'rol', 'confirmado'], 'required'],
            [['fecha_nacimiento', 'fecha_registro', 'fecha_acceso', 'fecha_bloqueo'], 'safe'],
            [['direccion', 'notas_bloqueo'], 'string'],
            [['area_id', 'avisos_por_correo', 'avisos_agrupados', 'avisos_marcar_leidos', 'avisos_eliminar_borrados', 'confirmado', 'num_accesos', 'bloqueado'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['nick'], 'string', 'max' => 25],
            [['nombre'], 'string', 'max' => 50],
            [['apellidos'], 'string', 'max' => 100],
            [['rol'], 'string', 'max' => 1],
            [['email'], 'unique'],
            [['nick'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Correo Electronico y \"login\" del usuario.',
            'password' => 'Password',
            'nick' => 'Nick',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'fecha_nacimiento' => 'Fecha de nacimiento del usuario o NULL si no lo quiere informar.',
            'direccion' => 'Direccion del usuario o NULL si no quiere informar.',
            'area_id' => 'Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
            'rol' => 'Código de la Clase / Tipo de Perfil: N=Normal, M=Moderador, P=Patrocinador, A=Administrador',
            'avisos_por_correo' => 'Indicador de si el usuario desea recibir correos con los avisos que se generan en el sistema para él o no.',
            'avisos_agrupados' => 'Indicador de si los avisos se envian directamente al generarlos, se agrupan en un solo correo, o lo que sea.',
            'avisos_marcar_leidos' => 'Indicador de marcar los correos leidos como borrados después de un tiempo  0:No marcar, >0:tiempo en días.',
            'avisos_eliminar_borrados' => 'Indicador para eliminar los correos borrados tras el tiempo indicado: >=1 día y <=1 año, o como se considere oportuno.',
            'fecha_registro' => 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).',
            'confirmado' => 'Indicador de usuario ha confirmado su registro o no.',
            'fecha_acceso' => 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.',
            'num_accesos' => 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.',
            'bloqueado' => 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...',
            'fecha_bloqueo' => 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
            'notas_bloqueo' => 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.',
        ];
    }
    public static function ListaRoles(){

        return[
            'N'->'Normal',
            'M'->'Moderador',
            'P'->'Patrocinador',
            'A'->'Administrador'
        ];
    }
    /**
     * @inheritdoc
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }
}
