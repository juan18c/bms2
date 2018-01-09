<?php

class DonacionModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'donacion.models.*',
			'donacion.components.*',
			'seguridad.models.*',
			'seguridad.components.*',
			'catalogo.models.*',
			'catalogo.components.*',
			'catalogo.controllers.*',
			'configuracion.models.*',
			'configuracion.components.*',
			'configuracion.controllers.*',
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
			$this->layout = '//layouts/portalDonador';
			return true;
		}
		else
			return false;
	}
}
