<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		Yii::app()->theme = 'bms';
		$this->layout ='//layouts/portalDonador';

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
		

		$modelUsuario=new TUsuario;

		$this->render('index',array(
			'modelUsuario'=>$modelUsuario,'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD,'modelOrden'=>$modelOrden,'modelDespacho'=>$modelDespacho
		));
		
	}
}