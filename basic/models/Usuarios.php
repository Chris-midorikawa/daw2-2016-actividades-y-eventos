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


    /* LISTA ROLES USUARIOS */
    public static function ListaRoles(){

        return[
            'N'=>'Normal',
            'M'=>'Moderador',
            'P'=>'Patrocinador',
            'A'=>'Administrador',
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'nick', 'nombre', 'apellidos', 'rol','fecha_nacimiento'], 'required'],
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
            'email' => 'Correo Electronico ',
            'password' => 'Contraseña',
            'nick' => 'Nick',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'fecha_nacimiento' => 'Fecha de nacimiento',
            'direccion' => 'Direccion',
            'area_id' => 'Area/Zona de localización',
            'rol' => 'Rol. Por defecto N',
            'avisos_por_correo' => 'Avisos por correo',
            'avisos_agrupados' => 'Avisos agrupados',
            'avisos_marcar_leidos' => 'Marcar correos como leidos. Indicar dias',
            'avisos_eliminar_borrados' => 'Eliminar correos borrados. Indicar dias',
            'fecha_registro' => 'Fecha y Hora de registro ',
            'confirmado' => 'Registro confirmado',
            'fecha_acceso' => 'Fecha y Hora del ultimo acceso',
            'num_accesos' => 'Num de intentos de login fallidos',
            'bloqueado' => 'Usuario bloqueado',
            'fecha_bloqueo' => 'Fecha y Hora del bloqueo',
            'notas_bloqueo' => 'Notas',
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
