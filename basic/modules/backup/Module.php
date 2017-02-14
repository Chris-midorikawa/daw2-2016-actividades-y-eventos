<?php

namespace app\modules\backup;

class Module extends \yii\base\Module {
	public $controllerNamespace = 'app\controllers';
	public $path;
	public $fileList;
	public function init() {
		parent::init ();
		
		// custom initialization code goes here
	}
	public function getFileList() {
		return $this->fileList;
	}
}
