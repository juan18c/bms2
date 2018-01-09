<?php

class BmsModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'catalogo.models.*',
			'catalogo.controllers.*',
			'catalogo.components.*',
			'configuracion.models.*',
			'configuracion.controllers.*',
			'configuracion.components.*',
			'seguridad.models.*',
			'seguridad.controllers.*',
			'seguridad.components.*',
			'bms.models.*',
			'bms.components.*',
			'bms.controllers.*'			
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			Yii::app()->theme = 'admin';
			// CHtml::$errorContainerTag = 'div';
			// CHtml::$errorCss = 'has-error';
			return true;
		}
		else
			return false;
	}
}
