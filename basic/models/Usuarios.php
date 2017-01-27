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

    /*VALIDAR USUARIO*/
    public static function ValidarUsuario($nick,$password)
    {
        $usuario=Usuarios::find()->where(['nick'=>$nick],['password'=>$password]);
var_dump($usuario);
        //return isset($usuario) ? new static($usuario) : null;
    }
    // DEVUELVE ID PARA $USER
    public static function findIdentity($id)
    {

        $user = Usuarios::find()
            ->Where("id=:id", ["id" => $id])
            ->one();

        return isset($user) ? new static($user) : null;
    }
    // FUNCION PARA DEVOLVER SI ES ADMIN O NO
    public static function isAdmin(){

        if(Yii::$app->user->identity->rol=='A'){
            return true;
        }else{ return false;}
    }
    //FUNCION PARA DEVOLVER SI ES PATROCINADOR O NO
    public static function isPatrocinador(){
        if(Yii::$app->user->identity->rol=='P'){
            return true;
        }else{ return false;}
    }
    //FUNCION PARA DEVOLVER SI ES MODERADOR O NO
    public static function isModerador(){
        if(Yii::$app->user->identity->rol=='M'){
            return true;
        }else{ return false;}
    }
    //FUNCION PARA DEVOLVER SI ES NORMAL O NO
    public static function isNormal(){
        if(Yii::$app->user->identity->rol=='N'){
            return true;
        }else{ return false;}
    }



    /*CREADO POR ERNESTO NO BORRAR!!*/
    public function getAvisosRecibidos(){
        return $this->hasMany(UsuarioAvisos::className(), ['destino_usuario_id' => 'id']);
    }

    public function getAvisosEnviados(){
        return $this->hasMany(UsuarioAvisos::className(), ['origen_usuario_id' => 'id']);
    }

}
