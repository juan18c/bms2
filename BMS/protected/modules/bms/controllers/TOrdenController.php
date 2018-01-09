<?php

class TOrdenController extends Controller
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
				'actions'=>array('index','view','admin','updateItemCart','deleteItemCart','conciliar','conciliarPago','detallePagoConciliado','updateAdmin'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','conciliar','conciliarPago','detallePagoConciliado','updateAdmin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','conciliar','conciliarPago','detallePagoConciliado','updateAdmin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($idc,$id)
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
	    $modelOrden=$this->loadModel($id);

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
	public function actionUpdateItemCart($id,$idR,$ido)
	{
		$model=TCarritoDetalleController::loadModel($id);
		//$idR = Yii::app()->user->id_persona;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST))
		{			
			$cantidad = $_POST['c'];			

			$model->cantidad= $cantidad;					

			if($model->save()){
				$criteriaCart=new CDbCriteria; 
		
				$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
		        $criteriaCart->condition='t.id_datos_basicos = '.$idR.' AND t.id_estatus = 1 AND isnull(t.id_tipo_accion)';
		        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
				$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);
				
				$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');
				Yii::app()->theme = 'bms';
		      	$this->layout ='//layouts/portalCliente';

		      	$criteria=new CDbCriteria;
		       	$criteria->addSearchCondition('t.id_carrito',$model->id_carrito, true, 'AND' );
		        $criteria->addSearchCondition('t.id_estatus','1', true, 'AND');		    	     	
		    	$criteria->with = array('idProducto');
		    	$dataProviderCart = new CActiveDataProvider( 'TCarritoDetalle', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>20) ) );

		    	$criteriaTotal=new CDbCriteria;
		        $criteriaTotal->select = array('count(*) as items');		        
		        $criteriaTotal->condition='t.id_carrito = '.$model->id_carrito;
			    $totalProducto = $model->find($criteriaTotal)->items;

				$criteria=new CDbCriteria;
                $criteria->select = array('sum((`tInventarios`.`precio`) * t.cantidad ) as total');
                $criteria->with = array('idProducto','idProducto.tInventarios');
                $criteria->condition='t.id_carrito = '.$model->id_carrito;
				$totalCarrito = $model->find($criteria)->total;			

				$modelOrden = $this->loadModel($ido);
			    $paisCarrito = TCarrito::model()->find('t.id_carrito='.$model->id_carrito);
				$pais = TDatosBasicosDireccion::model()->find('t.id_datos_basicos_direccion='.$paisCarrito->id_direccion);
				$envioPaisDestino = TEnvioPais::model()->with('idPais')->find('t.id_pais = '.$pais->id_pais);
				$porcentaje = $envioPaisDestino->porcentaje_monto;
				$tasaMin = $envioPaisDestino->tasa_minima;
				$costo = ($totalCarrito * $porcentaje) / 100;

				if ($costo <= $tasaMin) {
					$costoEnvio = $tasaMin;
				}else{
					$costoEnvio = number_format(($costo - $costo % 10)+10,0);
				}		
				
				$gastosTransferencia = $envioPaisDestino->gasto_transferencia;		

				$paisDestino = strtoupper($envioPaisDestino->idPais->descripcion);
				$paisAbreviatura = strtoupper($envioPaisDestino->idPais->abreviatura);

				$formTotal = $this->renderPartial('_viewTotalOrden',array('resumenCart'=>$resumenCart,'modelOrden'=>$modelOrden,'envio'=>$costoEnvio,'gastos'=>$gastosTransferencia,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura),true,false);
		    	
				echo CJSON::encode(array(
					'totalProducto' => $totalProducto,
					'totalCarrito' => $totalCarrito,
					'totalOrden' => $formTotal
				));

				Yii::app()->end();

				

			}else{
				echo "ocurrio un error";
			}

		}
		Yii::app()->end();
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateAdmin($idc,$id)
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
	    $modelOrden=$this->loadModel($id);

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

		// Yii::app()->theme = 'admin';
  //     	$this->layout ='//layouts/portalCliente';

		$this->render('updateAdmin',array(
			'model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCartDet,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccion,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'modelOrden'=>$modelOrden,'envio'=>$costoEnvio,'gastos'=>$gastosTransferencia,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura,'modelCartDet'=>$modelCartDet

		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteItemCart($id,$idR,$idCar,$ido)
	{
		TCarritoDetalleController::loadModel($id)->delete();
		//$idR = Yii::app()->user->id_persona;
		$model = new TCarritoDetalle;

		$model->id_carrito = $idCar;
		$idCarrito = TCarrito::model()->find('t.id_datos_basicos = '.$idR.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_carrito;
		$model->id_carrito = $idCarrito;

		$criteriaCart=new CDbCriteria; 
		
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        $criteriaCart->condition='t.id_datos_basicos = '.$idR.' AND t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion is null';
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);
		
		$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');
		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

      	$criteria=new CDbCriteria;
       	$criteria->addSearchCondition('t.id_carrito',$model->id_carrito, true, 'AND' );
        $criteria->addSearchCondition('t.id_estatus','1', true, 'AND');		    	     	
    	$criteria->with = array('idProducto');
    	$dataProviderCart = new CActiveDataProvider( 'TCarritoDetalle', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>20) ) );

    	$criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');		        
        $criteriaTotal->condition='t.id_carrito = '.$model->id_carrito;
	    $totalProducto = $model->find($criteriaTotal)->items;

		$criteria=new CDbCriteria;
        $criteria->select = array('sum((`tInventarios`.`precio`) * t.cantidad ) as total');
        $criteria->with = array('idProducto','idProducto.tInventarios');
        $criteria->condition='t.id_carrito = '.$model->id_carrito;
		$totalCarrito = $model->find($criteria)->total;			

		$modelOrden = $this->loadModel($ido);
			    $paisCarrito = TCarrito::model()->find('t.id_carrito='.$model->id_carrito);
				$pais = TDatosBasicosDireccion::model()->find('t.id_datos_basicos_direccion='.$paisCarrito->id_direccion);
				$envioPaisDestino = TEnvioPais::model()->with('idPais')->find('t.id_pais = '.$pais->id_pais);
				$porcentaje = $envioPaisDestino->porcentaje_monto;
				$tasaMin = $envioPaisDestino->tasa_minima;
				$costo = ($totalCarrito * $porcentaje) / 100;

				if ($costo <= $tasaMin) {
					$costoEnvio = $tasaMin;
				}else{
					$costoEnvio = number_format(($costo - $costo % 10)+10,0);
				}		
				
				$gastosTransferencia = $envioPaisDestino->gasto_transferencia;		

				$paisDestino = strtoupper($envioPaisDestino->idPais->descripcion);
				$paisAbreviatura = strtoupper($envioPaisDestino->idPais->abreviatura);

		$formTotal = $this->renderPartial('_viewTotalOrden',array('resumenCart'=>$resumenCart,'modelOrden'=>$modelOrden,'envio'=>$costoEnvio,'gastos'=>$gastosTransferencia,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura),true,false);
    	
		echo CJSON::encode(array(
			'totalProducto' => $totalProducto,
			'totalCarrito' => $totalCarrito,
			'totalOrden' => $formTotal,
			'totalItems' => $totalProducto
		));

		Yii::app()->end();		
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$origen)
	{
		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';
      	$model=$this->loadModel($id);
      	$modelCot= TCotizacionController::loadModel($model->id_cotizacion);
		$this->render('view',array(
			'model'=>$model,'origen'=>$origen,'modelCot'=>$modelCot
		));
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionConciliar($id)
	{
		
      	$model=$this->loadModel($id);
      	$modelCot= TCotizacionController::loadModel($model->id_cotizacion);
      	$modelPago= new TOrdenPago;

      	$formConciliar = $this->renderPartial('conciliar', array('model'=>$model,'modelCot'=>$modelCot,'modelPago'=>$modelPago),true,false);

		echo CJSON::encode(array(				
			'pagos'=> $formConciliar,			
		));

		Yii::app()->end();
	}

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionConciliarPago($id)
	{
		
      	$model=$this->loadModel($id);
      	$modelCot= TCotizacionController::loadModel($model->id_cotizacion);
      	$modelPago= new TOrdenPago;
      	$salida = 'error';
      	$montoConciliado=0;
      	
      	$montoPaypal=isset($_POST['montoRecibidoPaypal'])? $_POST['montoRecibidoPaypal'] : 0;
      	$montoDeposito=isset($_POST['montoRecibidoDeposito'])? $_POST['montoRecibidoDeposito'] : 0;
      	$montoEfectivo=isset($_POST['montoRecibidoEfectivo'])? $_POST['montoRecibidoEfectivo'] : 0;

      	$fechaPaypal=isset($_POST['fechaRecibidoPaypal'])? $_POST['fechaRecibidoPaypal'] : date("Y-m-d H:i:s");
      	$fechaDeposito=isset($_POST['fechaRecibidoDeposito'])? $_POST['fechaRecibidoDeposito'] : date("Y-m-d H:i:s");
      	$fechaEfectivo=isset($_POST['fechaRecibidoEfectivo'])? $_POST['fechaRecibidoEfectivo'] : date("Y-m-d H:i:s");
      	
		$montoConciliado= (int)trim($montoPaypal)+(int)trim($montoDeposito)+(int)trim($montoEfectivo);
		
      	if ($montoConciliado==$model->monto_total) {
      		
      		if ($montoEfectivo > 0) {      			
	      		$modelPagoEfectivo = new TOrdenPago;
	      		$modelPagoEfectivo->id_orden=$model->id_orden;
	      		$modelPagoEfectivo->monto=$montoEfectivo;
	      		$modelPagoEfectivo->id_medio_pago=7;
	      		if ($modelPagoEfectivo->save()) {
	      			$salida='ok';
	      		}
      		}

      		$model->id_estatus = 1;
      		if ($model->save()) {
      			$pagos = $modelPago->findAll('t.id_orden='.$model->id_orden);
      			foreach ($pagos as $key => $value) {
      				switch ($value->id_medio_pago) {
      					case '1':      						
      						$modelOrdenPago = TOrdenPagoController::loadModel($value->id_orden_pago);
      						$modelOrdenPago->monto_recibido_conciliado = $montoPaypal;
		      				$modelOrdenPago->fecha_pago_conciliado = $fechaPaypal;
      						$modelOrdenPago->id_estatus=1;
      						if ($modelOrdenPago->save()) {
      							$salida="ok";
      						}	      					
      						break;
      					case '4':
      						$modelOrdenPago = TOrdenPagoController::loadModel($value->id_orden_pago);
  							$modelOrdenPago->monto_recibido_conciliado = $montoDeposito;
		      				$modelOrdenPago->fecha_pago_conciliado = $fechaDeposito;
      						$modelOrdenPago->id_estatus=1;
      						if ($modelOrdenPago->save()) {
      							$salida="ok";
      						}      						
      						break;
      					case '7':      						
      						$modelOrdenPago = TOrdenPagoController::loadModel($value->id_orden_pago);
      						$modelOrdenPago->monto_recibido_conciliado = $montoEfectivo;
		      				$modelOrdenPago->fecha_pago_conciliado = $fechaEfectivo;
      						$modelOrdenPago->id_estatus=1;
      						if ($modelOrdenPago->save()) {
      							$salida="ok";
      						}
	      					break;
      					default:
      						$salida="error pagos";
      						break;      					
      				}
      			}
      			//PASAR A CREDITO BMS
      			//$modelCreditoBMS = new TCreditoBms;


      		}
      	}
      	

		echo CJSON::encode(array(				
			'salida'=> $salida,			
		));

		Yii::app()->end();
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionDetallePagoConciliado($id)
	{
		
      	$model=$this->loadModel($id);
      	$modelCot= TCotizacionController::loadModel($model->id_cotizacion);
      	$modelPago= new TOrdenPago;

      	$formConciliar = $this->renderPartial('conciliarDetallePago', array('model'=>$model,'modelCot'=>$modelCot,'modelPago'=>$modelPago),true,false);

		echo CJSON::encode(array(				
			'pagos'=> $formConciliar,			
		));

		Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TOrden;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TOrden']))
		{
			$model->attributes=$_POST['TOrden'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_orden));
		}

		$this->render('create',array(
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
		$dataProvider=new CActiveDataProvider('TOrden');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TOrden('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TOrden']))
			$model->attributes=$_GET['TOrden'];
		
		// Yii::app()->theme = 'bms';
  //     	$this->layout ='//layouts/column2';
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TOrden the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TOrden::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TOrden $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='torden-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
