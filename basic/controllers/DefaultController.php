<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\data\ArrayDataProvider;
use yii\web\HttpException;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;
use yii\helpers\Html;
use yii\grid\GridView;

class DefaultController extends Controller {
	public $menu = [ ];
	public $tables = [ ];
	public $fp;
	public $file_name;
	public $enableZip = true;
	public $_path = null;
	public $back_temp_file = 'daw2_actividades_backup_';
	// public $layout = '//layout2';

	public function permisos()
    {
      
      //solo podrán acceder los admins

        
       if (Yii::$app->user->isGuest || Usuarios::isNormal()){
            $this->goHome();
        }
        else if( Usuarios::isAdmin()){
            $a=1; //variable para no dejarlo en blaco el if y que funcione
        }
        
        
    }

	public function getModule() {
		return $this->module;
	}
	protected function getPath() {
		if (isset ( $this->module->path ))
			$this->_path = $this->module->path;
		else
			$this->_path = Yii::$app->basePath . '/_backup/';
		
		if (! file_exists ( $this->_path )) {
			mkdir ( $this->_path );
			chmod ( $this->_path, '777' );
		}
		return $this->_path;
	}
	public function execSqlFile($sqlFile) {
		$message = "ko";
		
		if (file_exists ( $sqlFile )) {
			$sqlArray = file_get_contents ( $sqlFile );
//echo '<pre>'; print_r( $sqlArray); echo '</pre>';
			$cmd = Yii::$app->db->createCommand ( $sqlArray );
			try {
//echo '<pre>'; print_r( $cmd); echo '</pre>';
				$cmd->execute();
        $message = "ok";
			} catch ( Exception $e ) {
				$message = $e->getMessage ();
			}
		}
		return $message;
	}
	public function getColumns($tableName) {
		$sql = 'SHOW CREATE TABLE ' . $tableName;
		$cmd = Yii::$app->db->createCommand ( $sql );
		$table = $cmd->queryOne ();
		
		$create_query = $table ['Create Table'] . ';';
		
		$create_query = preg_replace ( '/^CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $create_query );
		$create_query = preg_replace ( '/AUTO_INCREMENT\s*=\s*([0-9])+/', '', $create_query );
		if ($this->fp) {
			$this->writeComment ( 'TABLE `' . addslashes ( $tableName ) . '`' );
			$final = 'DROP TABLE IF EXISTS `' . addslashes ( $tableName ) . '`;' . PHP_EOL . $create_query . PHP_EOL . PHP_EOL;
			fwrite ( $this->fp, $final );
		} else {
			$this->tables [$tableName] ['create'] = $create_query;
			return $create_query;
		}
	}
	public function getData($tableName) {
		$sql = 'SELECT * FROM ' . $tableName;
		$cmd = Yii::$app->db->createCommand ( $sql );
		$dataReader = $cmd->query ();
		
		if ($this->fp) {
			if( $dataReader->rowCount >0 )$this->writeComment ( 'TABLE DATA ' . $tableName );
		}
		
		foreach ( $dataReader as $data ) {
			$data_string = '';
			$itemNames = array_keys ( $data );
			$itemNames = array_map ( "addslashes", $itemNames );
			$items = join ( '`,`', $itemNames );
			$itemValues = array_values ( $data );
			$itemValues = array_map ( "addslashes", $itemValues );
			$valueString = join ( "','", $itemValues );
			$valueString = "('" . $valueString . "'),";
			$values = "\n" . $valueString;
			if ($values != "") {
				$data_string .= "INSERT INTO `$tableName` (`$items`) VALUES" . rtrim ( $values, "," ) . ";" . PHP_EOL;
			}
			if ($this->fp) {
				fwrite ( $this->fp, $data_string );
			}
		}

		if ($this->fp) {
			if( $dataReader->rowCount >0 ){$this->writeComment ( 'TABLE DATA ' . $tableName );
			$final = PHP_EOL . PHP_EOL . PHP_EOL;
			fwrite ( $this->fp, $final );}
		}
	}
	public function getTables($dbName = null) {
		$sql = 'SHOW TABLES';
		$cmd = Yii::$app->db->createCommand ( $sql );
		$tables = $cmd->queryColumn ();
		return $tables;
	}
	public function StartBackup($addcheck = true) {
		$this->file_name = $this->path . $this->back_temp_file . date ( 'Y.m.d_H.i.s' ) . '.sql';
		$this->fp = fopen ( $this->file_name, 'w+' );
		
		if ($this->fp == null)
			return false;
		fwrite ( $this->fp, '-- -------------------------------------------' . PHP_EOL );
		if ($addcheck) {
			fwrite ( $this->fp, 'SET AUTOCOMMIT=0;' . PHP_EOL );
			fwrite ( $this->fp, 'START TRANSACTION;' . PHP_EOL );
			fwrite ( $this->fp, 'SET SQL_QUOTE_SHOW_CREATE = 1;' . PHP_EOL );
		}
		fwrite ( $this->fp, 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;' . PHP_EOL );
		fwrite ( $this->fp, 'SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;' . PHP_EOL );
		fwrite ( $this->fp, '-- -------------------------------------------' . PHP_EOL );
		return true;
	}
	public function EndBackup($addcheck = true) {
		fwrite ( $this->fp, '-- -------------------------------------------' . PHP_EOL );
		fwrite ( $this->fp, 'SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;' . PHP_EOL );
		fwrite ( $this->fp, 'SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;' . PHP_EOL );
		
		if ($addcheck) {
			fwrite ( $this->fp, 'COMMIT;' . PHP_EOL );
		}
		fwrite ( $this->fp, '-- -------------------------------------------' . PHP_EOL );
		fclose ( $this->fp );
		$this->fp = null;
		if ($this->enableZip) {
			
			$this->createZipBackup ();
		}
	}
	public function writeComment($string) {

			fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
			fwrite($this->fp, '-- ' . $string . PHP_EOL);
			fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);

	}
	public function actionCreate() {
		$tables = $this->getTables ();
		if (! $this->StartBackup ()) {
			
			// render error
			Yii::$app->user->setFlash ( 'success', "Error" );
			return $this->render ( 'index' );
		}
		
		foreach ( $tables as $tableName ) {
			$this->getColumns ( $tableName );
		}
		foreach ( $tables as $tableName ) {
			$this->getData ( $tableName );
		}
		
		$this->EndBackup ();
		
		$this->redirect ( array (
				'index' 
		) );
	}
	public function actionClean($redirect = true) {
		$ignore = array (
				'tbl_user',
				'tbl_user_role',
				'tbl_event' 
		);
		$tables = $this->getTables ();
		
		if (! $this->StartBackup ()) {
			// render error
			Yii::$app->user->setFlash ( 'success', "Error" );
			return $this->render ( 'index' );
		}
		
		$message = '';
		
		foreach ( $tables as $tableName ) {
			if (in_array ( $tableName, $ignore ))
				continue;
			fwrite ( $this->fp, '-- -------------------------------------------' . PHP_EOL );
			fwrite ( $this->fp, 'DROP TABLE IF EXISTS ' . addslashes ( $tableName ) . ';' . PHP_EOL );
			fwrite ( $this->fp, '-- -------------------------------------------' . PHP_EOL );
			
			$message .= $tableName . ',';
		}
		$this->EndBackup ();
		
		// logout so there is no problme later .
		Yii::$app->user->logout ();
		
		$this->execSqlFile ( $this->file_name );
		unlink ( $this->file_name );
		$message .= ' are deleted.';
		Yii::$app->session->setFlash ( 'success', $message );
		return $this->redirect ( array (
				'index' 
		) );
	}
	public function actionDelete($file) {
		/*---*X/
    $list = $this->getFileList ();
		$list = array_merge ( $list, $this->getFileList ( '*.zip' ) );
		$list = array_reverse($list);
		$file = $list [$id];
    //---*/
		$this->updateMenuItems ();
		if (isset ( $file )) {
			$sqlFile = $this->path . basename ( $file );
			if (file_exists ( $sqlFile ))
				unlink ( $sqlFile );
		} else
			throw new HttpException ( 404, Yii::t ( 'app', 'File not found' ) );
		return $this->redirect(['index']);
	}
	public function actionDownload($file = null) {
		$this->updateMenuItems ();
		if (isset ( $file )) {
			$sqlFile = $this->path . basename ( $file );
			if (file_exists ( $sqlFile )) {
				$request = Yii::$app->getRequest ();
				$request->sendFile ( basename ( $sqlFile ), file_get_contents ( $sqlFile ) );
			}
		}
		throw new HttpException ( 404, Yii::t ( 'app', 'File not found' ) );
	}
	protected function getFileList($ext = '*.sql') {
		$path = $this->path;
		$dataArray = array ();
		$list = array ();
		$list_files = glob ( $path . $ext );
		if ($list_files) {
			$list = array_map ( 'basename', $list_files );
			sort ( $list );
		}
		return $list;
	}
	public function actionIndex() {
		// $this->layout = 'column1';
		$this->updateMenuItems ();
		
		$list = $this->getFileList ();
		$list = array_merge ( $list, $this->getFileList ( '*.zip' ) );
		$dataArray = [ ];
		foreach ( $list as $id => $filename ) {
			$columns = array ();
			$columns ['id'] = $id;
			$columns ['Nombre'] = basename ( $filename );
			$columns ['Tamano'] = filesize ( $this->path . $filename );
			
			$columns ['Fecha_creacion'] = date ( 'Y-m-d H:i:s', filectime ( $this->path . $filename ) );
			$columns ['Fecha_modificacion'] = date ( 'Y-m-d H:i:s', filemtime ( $this->path . $filename ) );
			if (date ( 'M-d-Y' . ' \a\t ' . ' g:i A', filemtime ( $this->path . $filename ) ) > date ( 'M-d-Y' . ' \a\t ' . ' g:i A', filectime ( $this->path . $filename ) )) {
				$columns ['Fecha_modificacion'] = date ( 'M-d-Y' . ' \a\t ' . ' g:i A', filemtime ( $this->path . $filename ) );
			}
			
			$dataArray [] = $columns;
		}
		
		$dataProvider = new ArrayDataProvider ( [ 
				'allModels' => array_reverse ( $dataArray ),
				'sort' => [ 
						'attributes' => [ 
								'Fecha_modificacion' => SORT_ASC 
						] 
				] 
		] );
		
		return $this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionRestore($filename) {
		$this->updateMenuItems ();
		$message = 'OK. Done';
		$sqlZipFile = $this->path . basename ( $filename );
    $sqlFile = $this->unzip( $sqlZipFile );
    $descomprimido= ($sqlFile != false);
    if (!$descomprimido) $sqlFile= $sqlZipFile;
		$status = $this->execSqlFile( $sqlFile );
		if ($status=='ok') {
			Yii::$app->session->setFlash ( 'success', Yii::t ( 'app', 'Backup restored successfully.' ) );
      //if ($descomprimido) unlink( $sqlFile);
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			Yii::$app->session->setFlash ( 'error', Yii::t ( 'app', 'Error while restoring the backup.' ) );
		}
		return $this->render ( 'restore', array (
				'error' => $message 
		) );
	}
	public function actionUpload() {
		$model = new UploadForm ();
		if (isset ( $_POST ['UploadForm'] )) {
			$model->attributes = $_POST ['UploadForm'];
			$model->upload_file = \yii\web\UploadedFile::getInstance ( $model, 'upload_file' );
			if ($model->upload_file->saveAs ( $this->path . $model->upload_file )) {
				// redirect to success page
				return $this->redirect ( array (
						'index' 
				) );
			}
		}
		
		return $this->render ( 'upload', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Charge method to backup and create a zip with this
	 */
	private function createZipBackup() {
		$zip = new \ZipArchive ();
		$file_name = $this->file_name . '.zip';
		if ($zip->open ( $file_name, \ZipArchive::CREATE ) === TRUE) {
			$zip->addFile ( $this->file_name, basename ( $this->file_name ) );
			$zip->close ();
			
			@unlink ( $this->file_name );
		}
	}
	
	/**
	 * Method responsible for reading a directory and add them to the zip
	 *
	 * @param ZipArchive $zip        	
	 * @param string $alias        	
	 * @param string $directory        	
	 */
	private function zipDirectory($zip, $alias, $directory) {
		if ($handle = opendir ( $directory )) {
			while ( ($file = readdir ( $handle )) !== false ) {
				if (is_dir ( $directory . $file ) && $file != "." && $file != ".." && ! in_array ( $directory . $file . '/', $this->module->excludeDirectoryBackup ))
					$this->zipDirectory ( $zip, $alias . $file . '/', $directory . $file . '/' );
				
				if (is_file ( $directory . $file ) && ! in_array ( $directory . $file, $this->module->excludeFileBackup ))
					$zip->addFile ( $directory . $file, $alias . $file );
			}
			closedir ( $handle );
		}
	}
	/**
	 * Zip file execution
	 *
	 * @param string $zipFile
	 *        	Name of file zip
	 */
	private function unzip($sqlZipFile) {
		if (file_exists ( $sqlZipFile )) {
			$zip = new \ZipArchive ();
      $abierto= $zip->open( $sqlZipFile);
      $sqlZipFile = false;
			if ($abierto === true) {
				$zip->extractTo ( dirname ( $sqlZipFile ) );
				$zip->close ();
				$sqlZipFile = str_replace ( ".zip", "", $sqlZipFile );
			}
		}
		return $sqlZipFile;
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new UploadForm ();
		
		switch ($this->action->id) {
			case 'restore' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Inicio' ),
							'url' => Yii::$app->HomeUrl 
					);
				}
			case 'create' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Lista de Copias de Seguridad' ),
							'url' => array (
									'index'
							)
					);
				}
				break;
			case 'upload' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Crear Copia de Seguridad' ),
							'url' => array (
									'create' 
							) 
					);
				}
				break;
			default :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Crear Copia de Seguridad' ),
							'url' => array (
									'create' 
							)
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Subir Copia de Seguridad' ),
							'url' => array (
									'upload' 
							)
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Inicio' ),
							'url' => Yii::$app->HomeUrl
					);
				}
				break;
		}
	}
}
