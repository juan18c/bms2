<?php

class TDespachoCabeceraController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$idc)
	{
		$model=TCotizacionController::loadModel($idc);		
		
		// $modelDBD=new TDatosBasicosDireccion;
		// $modelDBEmpresa=new TDatosBasicos;
		// $modelDBDEmpresa=new TDatosBasicosDireccion;

		$idBeneficiario = TBeneficiario::model()->find('t.id_beneficiario='.$model->id_beneficiario)->id;
		$modelBeneficiario= TBeneficiarioController::loadModel($idBeneficiario);		
		$modelDBBeneficiario= TDatosBasicosController::loadModel($modelBeneficiario->id_beneficiario);
		$modelParentesco= new TParentesco;

		$idHistoria = THistoriaMedica::model()->find('t.id_responsable='.$model->id_beneficiario)->id_historia_medica;
		$modelHM= THistoriaMedicaController::loadModel($idHistoria);
		
		$modelHMC= new THistoriaMedicaCaso;
		$modelHMD= new THistoriaMedicaDocumento;
		$modelHMM= new THistoriaMedicaCasoMedico;

		$modelMedico= new TMedico;
		$modelDBMedico= new TDatosBasicos;
		$modelDirMedico= new TDatosBasicosDireccion;
		$modelEspecialidad= new TEspecialidad;
		$modelProducto=new TProducto;

		$modelCot=new TCotizacion;
        $modelDB=new TDatosBasicos;
		$modelCarrito= TCarritoController::loadModel($model->id_carrito);
		$modelCartDet=new TCarritoDetalle('search');
        $modelCartDet->id_carrito = $modelCarrito->id_carrito;

        $direccion='';
		$direccion2='';
		
		if(isset($_GET['ajax'])){
			$modelCartDet->unsetAttributes();  // clear any default values
			if(isset($_GET['TCarritoDetalle']))
				$modelCartDet->attributes=$_GET['TCarritoDetalle'];

			if ($_GET['ajax'] == 'tcarrito-cotizacion-grid') {
				$modelCartDet->id_carrito = isset($_GET['idcarr'])? $_GET['idcarr'] : $model->id_carrito ;
				$this->renderPartial('application.modules.bms.views.tCotizacion._viewResumen', array('modelCar'=>$modelCartDet,'modelCartDet'=>$modelCartDet));
				exit();
			}
		}



		$criteriaCart=new CDbCriteria;		
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        $criteriaCart->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_estatus = 1 AND t.id_carrito='.$modelCarrito->id_carrito;
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);

		$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');

      	$criteria=new CDbCriteria;
       	$criteria->addSearchCondition('t.id_carrito',$modelCarrito->id_carrito, true, 'AND' );
        $criteria->addSearchCondition('t.id_estatus','1', true, 'AND');    	
    	$criteria->with = array('idProducto');    	
    	$dataProviderCart = new CActiveDataProvider( 'TCarritoDetalle', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>20) ) );

		$carritoDetalle = TCarritoDetalle::model()->findAll($criteria);
    	$criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');		        
        $criteriaTotal->condition='t.id_carrito = '.$modelCarrito->id_carrito;
	    $totalItems = $modelCartDet->find($criteriaTotal)->items;

	    if ($modelCarrito->id_direccion != '') {
	    	$modelDireccion = TDatosBasicosDireccionController::loadModel($modelCarrito->id_direccion);
	    	$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2.'<br>' : '' ;
	    	$direccion = $modelDireccion->direccion1.'<br>'.$direccion2.'Telefono: '.$modelDireccion->telefono_fijo.'<br>'.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'<br>'.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion;

	    }	

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['TCotizacion']))
		// {
		// 	$model->attributes=$_POST['TCotizacion'];
		// 	if($model->save())
		// 		$this->redirect(array('view','id'=>$model->id_cotizacion));
		// }

		//DATOS DE ORDEN
	    //$idOrden=TOrden::model()->find('t.id_cotizacion='.$model->id_cotizacion)->id_orden;
	    $modelOrden=TOrdenController::loadModel($id);

	    $paisCarrito = TCarrito::model()->find('t.id_carrito='.$modelCarrito->id_carrito);
		$pais = TDatosBasicosDireccion::model()->find('t.id_datos_basicos_direccion='.$paisCarrito->id_direccion);
		$envioPaisDestino = TEnvioPais::model()->with('idPais')->find('t.id_pais = '.$pais->id_pais);
		$porcentaje = $envioPaisDestino->porcentaje_monto;
		$tasaMin = $envioPaisDestino->tasa_minima;
		$costo = ($modelOrden->monto_total * $porcentaje) / 100;

		if ($costo <= $tasaMin) {
			$costoEnvio = $tasaMin;
		}else{
			$costoEnvio = number_format(($costo - $costo % 10)+10,0);
		}		
		
		$gastosTransferencia = $envioPaisDestino->gasto_transferencia;		

		$paisDestino = strtoupper($envioPaisDestino->idPais->descripcion);
		$paisAbreviatura = strtoupper($envioPaisDestino->idPais->abreviatura);

		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('update',array(
			'model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCartDet,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccion,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'modelOrden'=>$modelOrden,'envio'=>$costoEnvio,'gastos'=>$gastosTransferencia,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura,'modelCartDet'=>$modelCartDet

		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TDespachoCabecera']))
		{
			$model->attributes=$_POST['TDespachoCabecera'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_despacho));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TDespachoCabecera');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TDespachoCabecera('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TDespachoCabecera']))
			$model->attributes=$_GET['TDespachoCabecera'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TDespachoCabecera the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TDespachoCabecera::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TDespachoCabecera $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tdespacho-cabecera-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
