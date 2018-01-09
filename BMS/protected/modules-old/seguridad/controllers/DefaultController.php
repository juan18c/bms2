<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/portalCliente';
	
	public function actionIndex()
	{		
		$modelBeneficiario=new TBeneficiario('search');
		$modelBeneficiario->unsetAttributes();  // clear any default values
		if(isset($_GET['TBeneficiario']))
			$modelBeneficiario->attributes=$_GET['TBeneficiario'];

		$modelCotizacion=new TCotizacion('search');
		$modelCotizacion->unsetAttributes();  // clear any default values
		if(isset($_GET['TCotizacion']))
			$modelCotizacion->attributes=$_GET['TCotizacion'];

		$modelDBD=new TDatosBasicosDireccion('search');
		$modelDBD->unsetAttributes();  // clear any default values
		if(isset($_GET['TDatosBasicosDireccion']))
			$modelDBD->attributes=$_GET['TDatosBasicosDireccion'];


		$modelOrden=new TOrden('search');
		$modelOrden->unsetAttributes();  // clear any default values
		if(isset($_GET['TOrden']))
			$modelOrden->attributes=$_GET['TOrden'];

		$modelDespacho=new TDespachoCabecera('search');
		$modelDespacho->unsetAttributes();  // clear any default values
		if(isset($_GET['TDespachoCabecera']))
			$modelDespacho->attributes=$_GET['TDespachoCabecera'];

		$modelDonacion=new TDonacion('search');
		$modelDonacion->unsetAttributes();  // clear any default values
		if(isset($_GET['TDonacion']))
			$modelDonacion->attributes=$_GET['TDonacion'];
		

		$modelUsuario=new TUsuario;

		$this->render('index',array(
			'modelUsuario'=>$modelUsuario,'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD,'modelOrden'=>$modelOrden,'modelDespacho'=>$modelDespacho,'modelDonacion'=>$modelDonacion
		));
	}
	

	
}