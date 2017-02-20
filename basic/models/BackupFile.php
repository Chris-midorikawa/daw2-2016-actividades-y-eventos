<?php

namespace app\models;

use yii\base\Model;

/**
 * Backup
 *
 * Yii module to backup, restore databse
 *
 * @version 1.0
 * @author Shiv Charan Panjeta <shiv@toxsl.com> <shivcharan.panjeta@gmail.com>
 */
/**
 * UploadForm class.
 * UploadForm is the data structure for keeping
 */
class BackupFile extends Model
{
	public $id ;
	public $Nombre ;
	public $Tamano ;
	public $Fecha_creacion ;
	public $Fecha_modificacion ;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
				array(['id','Nombre','Tamano','Fecha_creacion','modified_time'], 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'Nombre'=>'Nombre de Archivo',
				'Tamano'=>'Tamano',
				'Fecha_creacion'=>'Fecha de Creacion',
				'Fecha_modificacion'=>'Fecha de Modificacion',
		);
	}
	public static function label($n = 1) {
		return Yii::t('app', 'Backup File|Backup Files', $n);
	}
}
