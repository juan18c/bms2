<?php

class TCotizacionController extends Controller
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
				'actions'=>array('index','view','updateCotOrden'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('cargar','update','admin','cotizacion','updateItemCart','deleteItemCart','createCart','createBeneficiario','updateBeneficiario','createCotizacion','createHistoriaMedica','buscarDocumentoHistoria','cargarModalDonacion'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','cotizacion','updateItemCart','deleteItemCart','createCart','cargar','cargarModalDonacion','createBeneficiario','updateBeneficiario','createCotizacion','createHistoriaMedica','buscarDocumentoHistoria'),
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
		$dataProvider=new CActiveDataProvider('TCotizacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TCotizacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TCotizacion']))
			$model->attributes=$_GET['TCotizacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */	
	public function actionCargar($idP,$idCot,$idCar)
	{
		if (empty($idCot)) {
			$model=new TCotizacion;
		}else $model=$this->loadModel($idCot);
		
		$modelDB=TDatosBasicosController::loadModel($idP);
		$modelDB->fecha_nacimiento = date('d/m/Y',strtotime($modelDB->fecha_nacimiento));

		if ($modelDB->ind_empresa == 1) {
			$encargadoEmpresa = TEmpresa::model()->find('t.id_empresa='.$idP)->id_responsable;
			$modelDBEmpresa = TDatosBasicosController::loadModel($encargadoEmpresa);			
		}else $modelDBEmpresa = new TDatosBasicos;

		$modelB=new TBeneficiario;
		$modelDBD=new TDatosBasicos;
		$model->id_responsable=$idP;
		
		$modelCar=new TCarritoDetalle('search');
		$modelCartDet=new TCarritoDetalle('search');
		$modelDireccion = new TDatosBasicosDireccion;
		$modelCot=new TCotizacion;
		$modelBeneficiario=new TBeneficiario;
		
		//$modelDB=new TDatosBasicos;
		$modelParentesco=new TParentesco;
		$modelMedico=new TMedico;
		$modelDBMedico=new TDatosBasicos;
		$modelDirMedico=new TDatosBasicosDireccion;
		$modelEspecialidad=new TEspecialidad;
		$modelProducto=new TProducto;

		$modelHM=new THistoriaMedica;
		$modelHMC=new THistoriaMedicaCaso;
		$modelHMD=new THistoriaMedicaDocumento;
		$modelHMM=new THistoriaMedicaCasoMedico;

		$direccion='';
		$direccion2='';
		$idCarrito='';
		$carrito='';
		$salida = '';

		//$this->performAjaxValidation(array($model,$modelDB));

		
		$modelCar->unsetAttributes();  // clear any default values
		if(isset($_GET['TCarritoDetalle']))
			$modelCar->attributes=$_GET['TCarritoDetalle'];

		if(isset($_GET['ajax'])){

			if ($_GET['ajax'] == 'tcarrito-cotizacion-grid') {
				$modelCar->id_carrito = $_GET['idcarr'];				
				$this->renderPartial('_viewResumen', array('modelCar'=>$modelCar,'modelCartDet'=>$modelCartDet ));
			}elseif ($_GET['ajax'] == 'tbeneficiario-cot-grid') {
				$modelBeneficiario=new TBeneficiario('search');
				$modelBeneficiario->unsetAttributes();  // clear any default values
				if(isset($_GET['TBeneficiario']))
					$modelBeneficiario->attributes=$_GET['TBeneficiario'];

				$this->renderPartial('application.modules.bms.views.tBeneficiario.adminCot', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'model'=>$model,'modelB'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad));
			}
		}		

		if (!empty($idCar)) {
			$carrito = TCarrito::model()->find("t.id_datos_basicos = ".$model->id_responsable." AND t.id_carrito = ".$idCar." AND t.id_estatus = 1 ");
		}else{
			$carrito = TCarrito::model()->find('t.id_datos_basicos = '.$model->id_responsable.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ');
		}


		if (empty($carrito)){
			$modelCarrito=new TCarrito;
			$modelCarrito->id_datos_basicos = $idP;			
			if ($modelCarrito->save()) {
				$idCarrito = $modelCarrito->id_carrito;
				$idCartDireccion=$modelCarrito->id_direccion;
			}else{
				
				echo CJSON::encode(array(	
					
					'salida' => "Error al crear el carrito de compra desde el cotizador desde el admin."
				));

				Yii::app()->end();

				exit();
			}

		}else{

			$idCarrito=$carrito->id_carrito;
			$idCartDireccion=$carrito->id_direccion;
		}

		$criteriaCart=new CDbCriteria; 
		
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        

        if (!empty($idCar)) {
        	$criteriaCart->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_estatus = 1 AND t.id_carrito = '.$idCar;
		}else{			
			$criteriaCart->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';
		}


        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);
		
		$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');

      	$criteria=new CDbCriteria;
       	$criteria->addSearchCondition('t.id_carrito',$idCarrito, true, 'AND' );
        $criteria->addSearchCondition('t.id_estatus','1', true, 'AND');
    	//$criteria->addSearchCondition('t.id_tipo_accion','IS NULL', true, 'AND');        	
    	$criteria->with = array('idProducto');
    	//$criteria->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';

    	$dataProviderCart = new CActiveDataProvider( 'TCarritoDetalle', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>20) ) );

    	$carritoDetalle = TCarritoDetalle::model()->findAll($criteria);
    	$modelCar->id_carrito = $idCarrito;
    	$criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');		        
        $criteriaTotal->condition='t.id_carrito = '.$modelCar->id_carrito;
	    $totalItems = $modelCar->find($criteriaTotal)->items;

	    
	    if ($idCartDireccion != '') {
	    	$modelDireccion = TDatosBasicosDireccionController::loadModel($idCartDireccion);
	    	$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2.'<br>' : '' ;
	    	$direccion = $modelDireccion->direccion1.'<br>'.$direccion2.'Telefono: '.$modelDireccion->telefono_fijo.'<br>'.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'<br>'.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion;
	    }

	    //Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false,'jquery.ba-bbq.js'=>false);

		$formCarrito = $this->renderPartial('application.modules.bms.views.tCotizacion.resumenCarrito',array(
			'model'=>$model,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccion,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelProducto'=>$modelProducto,'modelCartDet'=>$modelCartDet
		),true,false);

		//EVALUAR SI EL RESPONSABLE ESTA EN LA TABLA BENEFICIARIO COMO TITULAR
		$buscarTitular = TBeneficiario::model()->find('t.id_responsable='.$idP.' AND t.id_parentesco = 1');

		if (empty($buscarTitular)) {
			$modelBeneficiario->id_parentesco = 1;
			$modelBeneficiario->id_beneficiario = $idP;
			$modelBeneficiario->id_responsable = $idP;

			if ($modelBeneficiario->save()) {
				$salida = 'ok';
			}else{
				echo "Error al crear el titular como beneficiario";
				exit();
			}
		}

		$formBeneficiario = $this->renderPartial('application.modules.bms.views.tBeneficiario.adminCot', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'model'=>$model,'modelB'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad),true,false);

		//echo $formCarrito; exit();

		echo CJSON::encode(array(	
			'nombres' => $modelDB->nombres,
			'apellidos' => $modelDB->apellidos,
			'idtipoiden' => $modelDB->id_tipo_identificacion,
			'nroiden' => $modelDB->nro_identificacion,
			'edocivil' => $modelDB->estado_civil,
			'sexo' => $modelDB->sexo,
			'fechanac' => $modelDB->fecha_nacimiento,
			'telefonocel' => $modelDB->telefono_cel,
			'email' => $modelDB->email,
			'indempresa' => $modelDB->ind_empresa,

			'nombresE' => $modelDBEmpresa->nombres,
			'apellidosE' => $modelDBEmpresa->apellidos,
			'idtipoidenE' => $modelDBEmpresa->id_tipo_identificacion,
			'nroidenE' => $modelDBEmpresa->nro_identificacion,			
			'telefonocelE' =>$modelDBEmpresa->telefono_cel,
			'emailE' => $modelDBEmpresa->email,

			'datosenvio' => $model->datos_envio,
			'duraciontratamiento' => $model->duracion_tratamiento,
			'carrito'=> $formCarrito,
			'bene' => $formBeneficiario,
			'idCot'=> $idCot,
			'idP'=>$idP,
			'idCar'=>$idCarrito
		));

		Yii::app()->end();

		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);		
		
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
		$modelDonacion=new TDonacion;
		$modelRes=new TDatosBasicos;
		$modelRes=TDatosBasicosController::loadModel($model->id_responsable);

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
				$this->renderPartial('_viewResumen', array('modelCar'=>$modelCartDet,'modelCartDet'=>$modelCartDet));
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

	    $criteriaCart=new CDbCriteria;
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        $criteriaCart->condition='t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND (isnull(t.id_tipo_accion) or t.id_tipo_accion = 1)';
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['TCotizacion']))
		// {
		// 	$model->attributes=$_POST['TCotizacion'];
		// 	if($model->save())
		// 		$this->redirect(array('view','id'=>$model->id_cotizacion));
		// }
		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('update',array(
			'model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCartDet,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$model,'direccionEnvio'=>$direccion,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'modelCartDet'=>$modelCartDet,'modelDonacion'=>$modelDonacion,'modelRes'=>$modelRes,'resumenCart'=>$resumenCart

		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */	
	public function actionCreateCotizacion($idR,$idCot,$idCar)
	{
		$model=new TCotizacion;
		//$modelDB=new TDatosBasicos;		
		$modelCarrito=new TCarrito;	
		$salida = '';

		//$this->performAjaxValidation($model);

		if (isset($_POST)) {
			$idBeneficiario = $_POST['idbene'];
			$idHistoriasCaso = $_POST['idhistoria'];

			//$modelDB=TDatosBasicosController::loadModel($idR);
			//$modelDB->attributes = $_POST['TDatosBasicos'];

			//$valid=$modelDB->validate();
        	//$valid=$b->validate() && $valid;
 			//var_dump($valid);
 			//var_dump($modelDB->getErrors());
	        //if($valid)
	        //{
	        	//$modelDB->id_tipo_identificacion = $_POST['TDatosBasicos']['id_tipo_identificacion'];
	        	//$modelDB->nro_identificacion = $_POST['TDatosBasicos']['nro_identificacion'];
	        	//$modelDB->nombres=$_POST['TDatosBasicos']['nombres'];
	        	//$modelDB->apellidos=$_POST['TDatosBasicos']['apellidos'];
	        	//$modelDB->sexo= ($_POST['TDatosBasicos']['sexo'] == 1) ? 'F' : 'M';
	        	//$modelDB->estado_civil=$_POST['TDatosBasicos']['estado_civil'];
	        	//$modelDB->fecha_nacimiento=date("Y-m-d H:i:s",strtotime(str_replace('/','-',$_POST['TDatosBasicos']['fecha_nacimiento'])));
	        	//$modelDB->telefono_cel=$_POST['TDatosBasicos']['telefono_cel'];
	        	//$modelDB->email=$_POST['TDatosBasicos']['email'];
	        	//$modelDB->ind_empresa=$_POST['TDatosBasicos']['ind_empresa'];

	        	//if ($modelDB->save()) {
	        		// if ($modelDB->ind_empresa==1) {
	        		// 	$idEmpresa = TEmpresa::model()->find('t.id_empresa='.$modelDB->id_datos_basicos);
	        		// 	if (count($idEmpresa)>0) {
	        		// 		$modelDBEmpresa = TDatosBasicosController::loadModel($idEmpresa->id_responsable);
	        				
	        		// 	}else{
	        		// 		$modelDBEmpresa = new TDatosBasicos;	        				
	        		// 	}
	        			
	        		// 	$modelDBEmpresa->id_tipo_identificacion = $_POST['TDatosBasicos']['empresa']['id_tipo_identificacion'];
			        // 	$modelDBEmpresa->nro_identificacion = $_POST['TDatosBasicos']['empresa']['nro_identificacion'];
			        // 	$modelDBEmpresa->nombres=$_POST['TDatosBasicos']['empresa']['nombres'];
			        // 	$modelDBEmpresa->apellidos=$_POST['TDatosBasicos']['empresa']['apellidos'];			        	
			        // 	$modelDBEmpresa->telefono_cel=$_POST['TDatosBasicos']['empresa']['telefono_cel'];
			        // 	$modelDBEmpresa->email=$_POST['TDatosBasicos']['empresa']['email'];

			        // 	if ($modelDBEmpresa->save()) {
			        // 		if (count($idEmpresa)==0) {		        			
			        		
				       //  		$empresa = new TEmpresa;
				       //  		$empresa->id_empresa = $modelDB->id_datos_basicos;
				       //  		$empresa->id_responsable = $modelDBEmpresa->id_datos_basicos;
				       //  		if($empresa->save()) $salida = 'ok';

			        // 		}
			        // 	}
	        		// }else{
	        		// 	$idEmpresa = TEmpresa::model()->find('t.id_empresa='.$modelDB->id_datos_basicos);
	        		// 	if (count($idEmpresa)>0) 
	        		// 		$modelDBEmpresa = TEmpresaController::loadModel($idEmpresa->id_empresa)->delete();
	        		// }

	        		$model->attributes = $_POST['TCotizacion'];

	        		if (empty($idCot)) {
	        			
						if (empty($idCar)) {

							$idCar = $modelCarrito->find('t.id_datos_basicos = '.$idR.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_carrito;
							$model->codigo_cotizacion = 'C-'.str_pad($idCar, 5, "0", STR_PAD_LEFT).'-1-'.date('mY');
						}else{
							$model->codigo_cotizacion = 'C-'.str_pad($idCar, 5, "0", STR_PAD_LEFT).'-1-'.date('mY');
						}

	        		}else{

	        			$model = $this->loadModel($idCot);
	        		}        		
	        		
	        		$model->datos_envio = $_POST['TCotizacion']['datos_envio'];	        		
	        		if ($model->datos_envio != '') {
	        			$model->fecha_envio = date('Y-m-d H:i:s');
	        		}
	        		$model->duracion_tratamiento = $_POST['TCotizacion']['duracion_tratamiento'];
	         		$model->id_carrito = $idCar;					
					$model->id_responsable = $idR;		
					$model->id_beneficiario = $idBeneficiario;						
					
					//var_dump($model->getErrors());
	        		if ($model->save()) {
	        			
	        			
	        			//$arrHistoria = split(',',$idHistoriasCaso);

	     //    			if (!empty($idHistoriasCaso)) {
						    
						//     TCotizacionHistoriaMedicaCaso::model()->deleteAll('id_cotizacion = ' . $model->id_cotizacion);
						// }

	     //    			foreach ($arrHistoria as $key => $value) {

	     //    				$modelCHMC = new TCotizacionHistoriaMedicaCaso;
	     //    				$modelCHMC->id_historia_medica_caso = $value;
	     //    				$modelCHMC->id_cotizacion=$model->id_cotizacion;

	     //    				if($modelCHMC->save()) $salida = 'ok';
	     //    				else echo "error TCotizacionHistoriaMedicaCaso"; exit();
	     //    			}


	        			if (!empty($idHistoriasCaso)) {
						    
						    TCotizacionHistoriaMedicaCaso::model()->deleteAll('id_cotizacion = ' . $model->id_cotizacion);
						}
						
        				$modelCHMC = new TCotizacionHistoriaMedicaCaso;
        				$modelCHMC->id_historia_medica_caso = $idHistoriasCaso;
        				$modelCHMC->id_cotizacion=$model->id_cotizacion;
        				
        				if($modelCHMC->save()) $salida= 'ok';
        				else $salida= "error TCotizacionHistoriaMedicaCaso";
	        			        				
	        			$modelCarritoAccion= new TCarrito;
	        			$modelCarritoAccion = TCarritoController::loadModel($idCar);
	        			$modelCarritoAccion->id_tipo_accion=1;
	        			
	        			if($modelCarritoAccion->save()){
	        				$salida= "Registro Exitoso. Carrito";	        			
	        			}
	        		}

	        	//}	
	        	

	        //}else echo "invalid"; exit();

			
		}
		//var_dump($model->getErrors());
		echo $salida;

		Yii::app()->end();
	}


	public function actionCreateBeneficiario($idR)
	{
		$model=new TBeneficiario;		
		$modelDB=new TDatosBasicos;

		$modelResponsable= TDatosBasicosController::loadModel($idR);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{			
			$modelDB->attributes=$_POST['TDatosBasicos']['beneficiario'];			
			
			$nombres=$_POST['TDatosBasicos']['beneficiario']['nombres'];
			$apellidos=$_POST['TDatosBasicos']['beneficiario']['apellidos'];
			$modelDB->sexo = $_POST['TDatosBasicos']['beneficiario']['sexo'] == 1 ? 'F' : 'M';			
			$modelDB->fecha_nacimiento = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$_POST['TDatosBasicos']['beneficiario']['fecha_nacimiento'])));
			$modelDB->email='noaplica@bms.com';
			$modelDB->telefono_cel='0212-1234455';
			//$modelDB->telefono_cel = '0';

			if($_POST['TParentesco']['id_parentesco'] == 2 || $_POST['TParentesco']['id_parentesco'] == 8 ){
				
				$criteria=new CDbCriteria;
		        $criteria->select = array('max(t.titular) as titular','t.id_datos_basicos');
		        $criteria->condition="t.nro_identificacion = '".$modelResponsable->nro_identificacion."' AND t.titular != 0 AND upper(t.nombres) =  '".strtoupper($nombres)."' AND upper(t.apellidos) = '".strtoupper($apellidos)."'";

				$beneficiarioDB = TDatosBasicos::model()->find($criteria);
				
				if (!empty($beneficiarioDB->titular) && !empty($beneficiarioDB->id_datos_basicos)) {					
					$idBeneficiario = $beneficiarioDB->id_datos_basicos;								
					$modelDBB = TDatosBasicosController::loadModel($idBeneficiario);

					$modelDBB->attributes=$_POST['TDatosBasicos']['beneficiario'];
					$nroIdentificacion= ($_POST['TDatosBasicos']['beneficiario']['nro_identificacion'] != '')? $_POST['TDatosBasicos']['beneficiario']['nro_identificacion'] : $modelResponsable->nro_identificacion ;
					$modelDBB->email='noaplica@bms.com';
					if ($modelDBB->save()) {

						$model->id_beneficiario = $modelDBB->id_datos_basicos;
						$model->id_responsable = $idR;			
						$model->id_parentesco = $_POST['TParentesco']['id_parentesco'];

						$beneficiario = TBeneficiario::model()->find('t.id_beneficiario = '.$modelDBB->id_datos_basicos);

						if (empty($beneficiario)) {
						
							if ($model->save()) {

								echo CJSON::encode(array(
									'salida' => 'COMPLETO',
									'id'=>$model->id_beneficiario,
									'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El beneficiario fue creado exitosamente.</div>',
									'option' => $nombres.' '.$apellidos
								));

								Yii::app()->end();
							}
						}else{
							echo CJSON::encode(array(
									'salida' => 'COMPLETO',
									'id'=>$beneficiario->id_beneficiario,
									'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El beneficiario ya existe.</div>',
									'option' => ''
								));

								Yii::app()->end();

						}
					}					
				}

				$modelDB->nro_identificacion = $modelResponsable->nro_identificacion;
				$modelDB->titular=$beneficiarioDB->titular + 1;		
				
			}
						
			if($modelDB->save()){				

				$model->id_beneficiario = $modelDB->id_datos_basicos;
				$model->id_responsable = $idR;			
				$model->id_parentesco = $_POST['TParentesco']['id_parentesco'];
				
				if ($model->save()) {

					echo CJSON::encode(array(
						'salida' => 'COMPLETO',
						'id'=>$model->id_beneficiario,
						'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El beneficiario fue creado exitosamente.</div>',
						'option' => $model->idBeneficiarioDB->nombres.' '.$model->idBeneficiarioDB->apellidos
					));

					Yii::app()->end();
				}				
			}
			
		}
		
		echo CJSON::encode(array(
			'salida' => 'ERROR',			
			'mensaje' => 'Ocurrio un error por favor verifique'
		));
		Yii::app()->end();
		
	}

	public function actionUpdateBeneficiario($idR)
	{

		$salida = '';
		$model = new TCotizacion;
		$modelMedico=new TMedico;
		$modelDBMedico=new TDatosBasicos;
		$modelDirMedico=new TDatosBasicosDireccion;
		$modelEspecialidad=new TEspecialidad;
		
		$modelHM=new THistoriaMedica;
		$modelHMC=new THistoriaMedicaCaso;
		$modelHMD=new THistoriaMedicaDocumento;
		$modelHMM=new THistoriaMedicaCasoMedico;

		$idCotizacion='';
		$idBeneficiario='';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{			
			$idBeneficiario = $_POST['idb'];

			if ($_POST['idcot'] != '') {
				$idCotizacion = $_POST['idcot'];

				$model=$this->loadModel($idCotizacion);

				$model->id_beneficiario=$idBeneficiario;						
								
				if ($model->save()) {
					$salida = 'ACTUALIZADO';
				}	
			}

			$formHistoria = $this->renderPartial('application.modules.bms.views.tHistoriaMedica.adminCot', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMM'=>$modelHMM,'modelHMD'=>$modelHMD,'model'=>$model,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'idCotizacion'=>$idCotizacion,'idBeneficiario'=>$idBeneficiario),true,false);

			//BUSCAR LOS DOCUMENTOS ASOCIADOS A LA COTIZACION POR LA TABLA T_COTIZACION_HISTORIA_MEDICA_CASO
			//VERIFICAR SI TIENES HISTORIA SINO CREARSELA
			$historiaMedica = THistoriaMedica::model()->find('t.id_responsable = '.$idBeneficiario);
			if (count($historiaMedica)>0) {
				$idHM = $historiaMedica->id_historia_medica;
			}else{
				$modelHM_new = new THistoriaMedica;
				$modelHM_new->id_responsable = $idBeneficiario;
				if ($modelHM_new->save()) {
					$idHM = $modelHM_new->id_historia_medica;
				}
			}

			$idHMC = TCotizacionHistoriaMedicaCaso::model()->getDocumentos($idCotizacion);
			$gridHistoria='';
			if (!empty($idHMC)) {
							
				$gridHistoria = $this->renderPartial('application.modules.bms.views.tHistoriaMedica.admin', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'idDocumento'=>$idHMC,'idR'=>$idBeneficiario,'idHM'=>$idHM),true,false);
			}

			if ($idR == $idBeneficiario) {
				$option = '';
			}else{		
				
				if ($_POST['idcot'] == '') {
					$option = TDatosBasicos::model()->find('t.id_datos_basicos='.$idBeneficiario)->nombres.' '.TDatosBasicos::model()->find('t.id_datos_basicos='.$idBeneficiario)->apellidos;

				}else{

					$option = $model->idBeneficiario->idBeneficiarioDB->nombres.' '.$model->idBeneficiario->idBeneficiarioDB->apellidos;
				}
			}
			
			echo CJSON::encode(array(
				'salida' => 'COMPLETO',
				'id'=>$idBeneficiario,
				'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El beneficiario fue creado exitosamente.</div>',
				'option' => $option,
				'idhistoria'=>$idHM,
				'historia'=>$formHistoria,
				'documento'=>$gridHistoria
			));
			Yii::app()->end();
		}	

		echo CJSON::encode(array(
			'salida' => 'ERROR',			
			'mensaje' => 'Ocurrio un error por favor verifique'
		));
		Yii::app()->end();
		
	}


	public function actionCreateHistoriaMedica($idR)
	{

		$modelHM=new THistoriaMedica;
		$modelHMC=new THistoriaMedicaCaso;
		$modelHMD=new THistoriaMedicaDocumento;
		$modelHMM=new THistoriaMedicaCasoMedico;
		$salida='';
		$imagen='';

		// if(isset($_GET['ajax'])){

		// 	if ($_GET['ajax'] == 'thistoria-medica-grid') {
		// 		$idBeneficiario = $_POST['idb'];
		// 		$idCotizacion = $_POST['idcot'];

		// 		$this->renderPartial('application.modules.bms.views.tHistoriaMedica.admin', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'idDocumento'=>$idDocumento));
		// 	}
		// }		
				
		if (isset($_POST)) {
			$idBeneficiario = $_POST['idb'];
			$idCotizacion = $_POST['idcot'];
			$idCarrito = $_POST['idcar'];

			//$modelHMC->attributes=$_POST['THistoriaMedicaCaso'];
			$historia = THistoriaMedica::model()->find('t.id_responsable ='.$idBeneficiario);

			if (count($historia)>0) {
				$modelHMC->id_historia_medica = $historia->id_historia_medica;		
				$modelHM->id_historia_medica = $historia->id_historia_medica;		
			}else{
				//CREAR LA HISTORIA MEDICA
				$modelHM->id_responsable = $idBeneficiario;
				if ($modelHM->save()) {
					$modelHMC->id_historia_medica = $modelHM->id_historia_medica;
				}
			}
			
			$modelHMC->nombre=$_POST['THistoriaMedicaCaso']['nombre'];
			$modelHMC->tipo_carga=$_POST['THistoriaMedicaCaso']['tipo_carga'];	
			$modelHMC->fecha_realizacion=date('Y-m-d H:i:s',strtotime($_POST['THistoriaMedicaCaso']['fecha_realizacion']));
			/*SE COLOCA EL REGISTRO EN ESTATUS DE NUEVA COTIZACION PARA CUANDO SE GUARDE LA COTIZACION HACER UPDATE EN ESTOS REGISTROS */
			

			// if (!empty($idCotizacion)) {
			// 	$modelHMC->id_cotizacion = $idCotizacion;
			// }else {
			// 	$modelHMC->id_cotizacion = null;
			// 	$modelHMC->id_estatus=5;
			// }

			/*SE PUEDE CREAR EL ID DE COTIZACION DE UNA VEZ PERO HAY QUE PROBAR A VER QUE FORMA ES MEJOR*/
			// else{

			// 	$modelCotizacion=new TCotizacion;
			// 	$modelCarrito=new TCarrito;

			// 	if (empty($idCarrito)) {
			// 		$idCarrito = $modelCarrito->find('t.id_datos_basicos = '.$idR.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_carrito;
			// 	}
				
			// 	$modelCotizacion->id_carrito = $idCarrito;
			// 	$modelCotizacion->codigo_cotizacion = 'C-'.str_pad($idCarrito, 5, "0", STR_PAD_LEFT).'-1-'.date(mY);
			// 	$modelCotizacion->id_responsable = $idR;		

			// 	if ($modelCotizacion->save()) {
			// 		$modelHMC->id_cotizacion=$modelCotizacion->id_cotizacion;
			// 	}
			// }			
			
			if ($modelHMC->save()) {		
				
				$modelHMM->id_historia_medica_caso = $modelHMC->id_historia_medica_caso;
				$modelHMM->id_medico = $_POST['THistoriaMedicaCasoMedico']['id_medico'];

				if ($modelHMM->save()) {

					if (isset($_FILES)) {                        

                        $modelHMD->id_historia_medica_caso = $modelHMC->id_historia_medica_caso;
						$modelHMD->tamanio=$_FILES['THistoriaMedicaDocumento']['size']['ruta'];
						$modelHMD->tipo=$_FILES['THistoriaMedicaDocumento']['type']['ruta'];

						$imagen=CUploadedFile::getInstance($modelHMD,'ruta');
						$ext = pathinfo($imagen, PATHINFO_EXTENSION);
						$modelHMD->ruta='images/'.$imagen;

						if ($modelHMD->save()) {

							$mdelHMD_save = THistoriaMedicaDocumentoController::loadModel($modelHMD->id_historia_medica_documento);

							$mdelHMD_save->ruta='images/'.$modelHMD->id_historia_medica_documento.'-'.$modelHMC->nombre.'.'.$ext;

							if ($mdelHMD_save->save()) {
								$imagen->saveAs($mdelHMD_save->ruta);
							}
														
							$salida = 'COMPLETO';
						}                                
                    }

                    //$salida = 'COMPLETO';					
				}
			}

			$idHMC = TCotizacionHistoriaMedicaCaso::model()->getDocumentos($idCotizacion);
		}

		// $gridHistoria = $this->renderPartial('application.modules.bms.views.tHistoriaMedica.admin', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'idDocumento'=>$idDocumento),true,false);

		echo CJSON::encode(array(	
			'salida' => $salida,			
			'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El documento fue creado exitosamente.</div>',
			'option' => $modelHMC->nombre,			
			'id' => $modelHM->id_historia_medica,
			'idhmc'=> $modelHMC->id_historia_medica_caso,
			'idhmd'=> $modelHMD->id_historia_medica_documento,
			'idhmm'=>$modelHMM->id_historia_medica_medico,			
			'idbene' => $idBeneficiario,
			'idcot'=> $idCotizacion,
			'idcar'=>$idCarrito,
			'documento'=>$idHMC,
			'idDocumento'=>$_POST['iddocumento']
		));

		Yii::app()->end();

	}

	public function actionBuscarDocumentoHistoria($idR,$idHM,$idHMC)
	{
		$modelHM = new THistoriaMedica;
		$modelHMC = new THistoriaMedicaCaso;
		$gridHistoria = $this->renderPartial('application.modules.bms.views.tHistoriaMedica.admin', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'idDocumento'=>$idHMC,'idR'=>$idR,'idHM'=>$idHM),true,false);

		echo CJSON::encode(array(			
			'documento'=>$gridHistoria
		));

		Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateCart($idR)
	{
		$model=new TCarrito;
		$modelCartDet = new TCarritoDetalle;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{
			$idProd = $_POST['idP'];
			$cantidad = $_POST['c'];

			$carrito = $model->find('t.id_datos_basicos = '.$idR.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL '); //VALIDAR CONTRA VARIABLE DE SESION
			if (count($carrito) > 0) {				
				
				$carritoDet = $modelCartDet->find('t.id_producto = '.$idProd.' AND t.id_carrito = '.$carrito->id_carrito.' AND t.id_estatus = 1');

				if (count($carritoDet) > 0) {				

					//$modelCartDet->setScenario('update'); 
					$modelCartDet = TCarritoDetalleController::loadModel($carritoDet->id_carrito_detalle);
					$modelCartDet->cantidad = $modelCartDet->cantidad + $cantidad;
					if ($modelCartDet->save()) {
						$guardarDet = 1;
					}
				}else{	
					//$modelCartDet = new TCarritoDetalle;		
					$modelCartDet->id_carrito = $carrito->id_carrito;
					$modelCartDet->id_producto = $idProd;
					$modelCartDet->cantidad = $cantidad;

					//$modelCartDet->setScenario('insert'); 
					//print_r($modelCartDet); exit();
					if ($modelCartDet->save()) {
						$guardarDet = 1;
					}
				}
			}else{

				$model->id_datos_basicos = $idR; //VALIDAR CONTRA VARIABLE DE SESION
				if ($model->save()) {
					$modelCartDet = new TCarritoDetalle;
					$modelCartDet->id_carrito = $model->id_carrito;
					$modelCartDet->id_producto = $idProd;
					$modelCartDet->cantidad = $cantidad;

					if ($modelCartDet->save()) {
						$guardarDet = 1;
					}
				}
			}

			if ($guardarDet == 1) {
				$criteriaTotal=new CDbCriteria;
		        $criteriaTotal->select = array('count(*) as items');
		        $criteriaTotal->with = 'tCarritoDetalles';
		        $criteriaTotal->condition='t.id_datos_basicos = '.$idR.' AND t.id_carrito = '.$modelCartDet->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';

			    $totalProducto = TCarrito::model()->find($criteriaTotal)->items;

				$criteria=new CDbCriteria;
                $criteria->select = array('sum((`tInventarios`.`precio`) * `tCarritoDetalles`.`cantidad` ) as total');
                $criteria->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
                $criteria->condition='t.id_datos_basicos = '.$idR.' AND t.id_carrito = '.$modelCartDet->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';
				$totalCarrito = $model->find($criteria)->total;

				$criteriaCart=new CDbCriteria; 		
				$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
		        $criteriaCart->condition='t.id_datos_basicos = '.$idR.' AND t.id_carrito = '.$modelCartDet->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion is null ';
		        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		        $criteriaCart->order = 't.descripcion ASC';
				$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);
				
				$formTotal = $this->renderPartial('_viewTotalOrden',array('resumenCart'=>$resumenCart),true,false);

				echo CJSON::encode(array(
					'totalProducto' => $totalProducto,
					'totalCarrito' => $totalCarrito,
					'totalOrden' => $formTotal					
				));
			}

		}

		Yii::app()->end();
		
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateItemCart($id,$idR)
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

				$formTotal = $this->renderPartial('_viewTotalOrden',array('resumenCart'=>$resumenCart),true,false);
		    	
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteItemCart($id,$idR,$idCar)
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

		$formTotal = $this->renderPartial('_viewTotalOrden',array('resumenCart'=>$resumenCart),true,false);
    	
		echo CJSON::encode(array(
			'totalProducto' => $totalProducto,
			'totalCarrito' => $totalCarrito,
			'totalOrden' => $formTotal,
			'totalItems' => $totalProducto
		));

		Yii::app()->end();		
	}

	/**
	 * Manages all models.
	 */
	public function actionCotizacion($idCotizacion,$indM,$indC,$indL)
	{		
		$model=new TCotizacion;		
		$model=$this->loadModel($idCotizacion);
		$logo='themes/bms/images/logo-nombre.png';
		$dr='Dra.';
		$nombreMedico='Lenys Gonzalez';
		$especialidad='Gastropediatra';		

		//A: DATOS DEL RESPONSABLE
		$datosResp = TDatosBasicos::model()->with('idTipoIdentificacion')->find('t.id_datos_basicos= '.$model->id_responsable);
		$nombreResp = $datosResp->nombres.' '.$datosResp->apellidos;
		$nroidenResp = $datosResp->idTipoIdentificacion->abreviatura.' '.$datosResp->nro_identificacion;
		$titularResp = $datosResp->titular;
		// FIN A

		//B: DESCRIPCION DE LA COTIZACION
		$solicitudes='';
		
		$criteriaCart=new CDbCriteria; 		
		$criteriaCart->select=array('t.id_producto_tipo','t.descripcion');
        //$criteriaCart->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_carrito='.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion is null ';
        $criteriaCart->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_carrito='.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion = 1 ';
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
        $criteriaCart->order = 't.descripcion ASC';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart); 

		foreach ($resumenCart as $key => $value) {
			$solicitudes .= $value->descripcion.' y ';
		}

		$solicitudes = substr($solicitudes, 0, strlen($solicitudes) - 3);

		if ($model->id_responsable != $model->id_beneficiario) {
			$datosBene = TDatosBasicos::model()->with('idTipoIdentificacion')->find('t.id_datos_basicos= '.$model->id_beneficiario);
			$nroidenB = $datosBene->idTipoIdentificacion->abreviatura.' '.$datosBene->nro_identificacion;
			$titularB = $datosBene->titular;
			$nombreB = $datosBene->nombres.' '.$datosBene->apellidos;
			$parentescoB=TBeneficiario::model()->with('idParentesco')->find('t.id_beneficiario='.$model->id_beneficiario)->idParentesco->descripcion;
			$nombreBeneficiario = $parentescoB.' <b>'.$nombreB.'</b> ';

			if ($nroidenResp == $nroidenB AND $titularB != 0) {
				$cedulaB = '';
			}else $cedulaB = ' de '.$nroidenB;
		}else{
			$nombreBeneficiario = '<b>PERSONA</b>';
		}
		
		$edadBeneficiario=controller::calcularEdad(TDatosBasicos::model()->find('t.id_datos_basicos= '.$model->id_beneficiario)->fecha_nacimiento);

		setlocale(LC_ALL, 'spanish');		
		$fechaActual = strftime('%d de %B del %Y');

		// FIN B

		
		//C: DATOS DEL CARRITO
		$carritoLaboratorio = '';
		$carrito='';

		$productoTipo = VCarritoProductoTipo::model()->findAll('t.id_carrito = '.$model->id_carrito);
		foreach ($productoTipo as $key => $value) {			

			if ($value->id_producto_tipo == 2 ) {
					
				$productoLaboratorio = VCarritoProductoLaboratorio::model()->findAll('t.id_carrito = '.$model->id_carrito);

				foreach ($productoLaboratorio as $key3 => $value3) {

					$carritoLaboratorio .= '<tr>
					    	<td style="text-align:left; font-size:10px;" colspan="5" >
					    		<b>'.$value->descripcion.' de '.$value3->nombre.' '.$value3->ciudad.' '.$value3->pais.'</b>	
					    	</td>			    				    	
					  	</tr>';

					$criteriaD2 = new CDbCriteria;
					$criteriaD2->select= array('t.id_carrito_detalle','t.id_carrito','t.id_producto','t.cantidad','t.id_estatus' );
					$criteriaD2->with = array('idProducto'=>array('select'=>'idProducto.codigo, idProducto.descripcion'));
					$criteriaD2->condition = 't.id_carrito='.$model->id_carrito.' AND idProducto.id_producto_tipo = '.$value->id_producto_tipo.' AND idProducto.id_marca = '.$value3->id_marca;

					$carritoDetalle2 = TCarritoDetalle::model()->findAll($criteriaD2);

					foreach ($carritoDetalle2 as $key4 => $value4) {
						$codProducto = $value4->idProducto->codigo;
						$descProducto = $value4->idProducto->descripcion;
						$precio = TProducto::model()->getPrecio($value4->id_producto);
						$cantidad = $value4->cantidad;
						$monto = number_format($precio * $cantidad,2,',','.');

						$carritoLaboratorio .= '<tr>
				    	<td style="text-align:left; font-size:10px;" >
				    		'.$codProducto.'	    			
				    	</td>	
				    	<td style="text-align:left; font-size:10px;" >
				    		'.$descProducto.'	    			
				    	</td>	
				    	<td style="text-align:right; font-size:10px;" >
				    		'.number_format($precio,2,',','.').'	    			
				    	</td>
				    	<td style="text-align:right; font-size:10px;" >
				    		'.$cantidad.'	    			
				    	</td>		
				    	<td style="text-align:right; font-size:10px;" >
				    		'.$monto.'	    			
				    	</td>					    	
				  	</tr>';
					}

					$idProductoGastos = TProducto::model()->find("t.codigo = 'GASTOS' AND t.id_marca=".$value3->id_marca);
					$gastosLaboratorio = number_format(TProducto::model()->getPrecio($idProductoGastos->id_producto),2,',','.');

					$carritoLaboratorio .= '<tr>
				    	<td style="text-align:left; font-size:10px;" >
				    		GASTOS	    			
				    	</td>	
				    	<td style="text-align:left; font-size:10px;" >
				    		'.$idProductoGastos->descripcion.'	    			
				    	</td>	
				    	<td style="text-align:right; font-size:10px;" >
				    		'.$gastosLaboratorio.'	    			
				    	</td>
				    	<td style="text-align:right; font-size:10px;" >
				    		1	    			
				    	</td>		
				    	<td style="text-align:right; font-size:10px;" >
				    		'.$gastosLaboratorio.'	    			
				    	</td>					    	
				  	</tr>';

				}
				
				continue;
			}elseif ($value->id_producto_tipo == 1) {
				$carrito .= '<tr>';
			    $carrito .= '	<td style="text-align:left; font-size:10px;" colspan="5" >';			    
			    $carrito .= '		<b>'.$value->descripcion.' - Tratamiento según recipe médico para '.$model->duracion_tratamiento.'</b>';
			    $carrito .= '	</td>';
			  	$carrito .= '</tr>';

			}else{

				$carrito .= '<tr>';
			    $carrito .= '	<td style="text-align:left; font-size:10px;" colspan="5" >';			    
			    $carrito .= '		<b>'.$value->descripcion.'</b>';
			    $carrito .= '	</td>';
			  	$carrito .= '</tr>';
			}

			$criteriaD = new CDbCriteria;
			$criteriaD->select= array('t.id_carrito_detalle','t.id_carrito','t.id_producto','t.cantidad','t.id_estatus' );
			$criteriaD->with = array('idProducto'=>array('select'=>'idProducto.codigo, idProducto.descripcion'));
			$criteriaD->condition = 't.id_carrito='.$model->id_carrito.' AND idProducto.id_producto_tipo = '.$value->id_producto_tipo;

			$carritoDetalle = TCarritoDetalle::model()->findAll($criteriaD);			

			foreach ($carritoDetalle as $key2 => $value2) {				

				$codProducto = $value2->idProducto->codigo;
				$descProducto = $value2->idProducto->descripcion;
				$precio = TProducto::model()->getPrecio($value2->id_producto);
				$cantidad = $value2->cantidad;
				$monto = number_format($precio * $cantidad,2,',','.');

				$carrito .= '<tr>
				    	<td style="text-align:left; font-size:10px;" >
				    		'.$codProducto.'	    			
				    	</td>	
				    	<td style="text-align:left; font-size:10px;" >
				    		'.$descProducto.'	    			
				    	</td>	
				    	<td style="text-align:right; font-size:10px;" >
				    		'.number_format($precio,2,',','.').'	    			
				    	</td>
				    	<td style="text-align:right; font-size:10px;" >
				    		'.$cantidad.'	    			
				    	</td>		
				    	<td style="text-align:right; font-size:10px;" >
				    		'.$monto.'	    			
				    	</td>					    	
				  	</tr>';
			}
		}

		$criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');
        $criteriaTotal->condition="t.id_carrito= ".$model->id_carrito;
	    $totalProducto = TCarritoDetalle::model()->find($criteriaTotal)->items;

		$criteria=new CDbCriteria;
        $criteria->select = array('sum((`idProducto`.`precioWeb`) * `tCarritoDetalles`.`cantidad` ) as total');
        //$criteria->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
        $criteria->with = array('tCarritoDetalles','tCarritoDetalles.idProducto');
        //$criteria->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';
        $criteria->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion = 1';
		$totalCarrito = TCarrito::model()->find($criteria)->total;

		$criteriaSinExamen=new CDbCriteria;
        $criteriaSinExamen->select = array('sum((`idProducto`.`precioWeb`) * `tCarritoDetalles`.`cantidad` ) as total');
        $criteriaSinExamen->with = array('tCarritoDetalles','tCarritoDetalles.idProducto');
        //$criteriaSinExamen->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
        //$criteriaSinExamen->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL AND idProducto.id_producto_tipo <> 2';
        $criteriaSinExamen->condition='t.id_datos_basicos = '.$model->id_responsable.' AND t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND t.id_tipo_accion = 1 AND idProducto.id_producto_tipo <> 2';
		$totalCarritoSinExamen = TCarrito::model()->find($criteriaSinExamen)->total;
		//FIN C

		//D: GASTOS DE ENVIOS
		$costoEnvio= 0;
		$paisCarrito = TCarrito::model()->find('t.id_carrito='.$model->id_carrito);
		$pais = TDatosBasicosDireccion::model()->find('t.id_datos_basicos_direccion='.$paisCarrito->id_direccion);
		$envioPaisDestino = TEnvioPais::model()->with('idPais')->find('t.id_pais = '.$pais->id_pais);

		if (!empty($totalCarritoSinExamen)) {
			$porcentaje = $envioPaisDestino->porcentaje_monto;
			$tasaMin = $envioPaisDestino->tasa_minima;
			$costo = ($totalCarritoSinExamen * $porcentaje) / 100;

			if ($costo <= $tasaMin) {
				$costoEnvio = $tasaMin;
			}else{
				$costoEnvio = number_format(($costo - $costo % 10)+10,0);
			}		
		}

		$gastosTransferencia = $envioPaisDestino->gasto_transferencia;		
		$totalGeneral = number_format(($totalCarrito + $costoEnvio + $gastosTransferencia),2,',','.');
		
		$paisDestino = strtoupper($envioPaisDestino->idPais->descripcion);
		//FIN D

		//E: INFORMACION DE CUENTAS BANCARIAS
		$infoCuentas = '';
		
		if ($indC == 'true') {
			$infoCuentas = '<tr>
			    	<td align="left" style="border-top:2px solid #000; font-size:12px" colspan="5">
			    	Cualquier transferencia se realizara según la siguiente instrucción:<br>
			    	<b>Banco Intermediario: Standart Chartered Bank, New York</b> <br>
			    	Dirección Banco: 1 Madison Ave New York,NY 10010-3603,USA. ABA: 026002561 - SWIFT: SCBLUS33<br>
			    	<b>Banco Beneficiario/Receptor: Mercantil Bank Panamá, S.A.</b><br>
			    	Dirección Banco: Torre de las Americas, Punta Pacifica, Ciudad de Panamá, Panamá. SWIFT: MPANPAPA<br>
			    	<b>Beneficiario: BIO METABOLIC SERVICE S.A. - Cuenta Beneficiario: 43000000027</b><br>
			    	Dirección Beneficiario: Calle 50, PH Plaza Morica, San Francisco, Ciudad Panamá, Panamá<br>
			    	Teléfono/Fax: +507-456-7890 / email: biometabolicservice@gmail.com
			    	</td>					    	
			  	</tr>
			  	<tr>
					<td align="left" style="font-size:12px" colspan="5">Sin más que agregar y quedando a su entera disposición para cualquier aclaratoria, Atentamente...</td>
				<tr>';
		}
		//FIN E

		//F: MEMBRETE
		$membrete = '<td align="left" width="30%" style="vertical-align: text-top; height:120px;">&nbsp;</td>';
		$footer = '&nbsp;';
		if ($indM=='true') {
			$membrete = '<td align="left" width="30%" style="vertical-align: text-top;"><img src="'.$logo.'" align="center" width="200" style="vertical-align: text-top;" /><br>
					    <!-- <font size="2"> RIF: </font> --></td>';
			$footer = '<table width="100%" border="0" align="left" style="vertical-align:bottom; font-family:\'PT Sans\', sans-serif; font-size:10px;" >
				<tr><td align="left" style="border-top:2px solid #000;">www.biometabolicservice.com - Calle 50, PH Plaza Morica, San Francisco, Panamá, Panamá Telf: +5078367065 Whatsapp: +584143382203</td></tr>
			  	
			</table>';
		}
		//FIN F



	 	//$mpdf= Yii::app()->ePdf->mpdf('utf-8');
	 	$mpdf= Yii::app()->ePdf->mpdf('','Letter',0,'',8,8,63,8,8,8,'P');
	 	$mpdf->ignore_invalid_utf8 = true;
	 	$stylesheet = file_get_contents('http://104.197.207.184/themes/bms/css/fonts.css'); // external css
		

		//$mpdf->useOddEven = 1;
		
		// Define the Header/Footer before writing anything so they appear on the first page
		$mpdf->defHTMLHeaderByName('headerAlta','
			<table width="100%" border="0" align="center" style="font-family:\'PT Sans\', sans-serif; font-size:10px;">
			  	<tr>
				    '.$membrete.'
				    <td align="right">
				    	<span align="left" style="text-align:left;">
				    		<b>Ciudad de Panamá '.$fechaActual.'</b>				        
					    </span>
				    </td>						    
			  	</tr>
			  	<tr>
				    <td align="left" width="100%" colspan="2">
				    	<br>Señor(a):<b>'.$nombreResp.'/'.$nroidenResp.'</b>				   
				    </td>				   		    
			  	</tr>			  			
			</table>');
		
		$mpdf->defHTMLFooterByName('footerAlta',$footer);

		$mpdf->AddPage('P','','','','','','','55','25','','','html_headerAlta','','html_footerAlta','',1,0,1,0);
		
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML('	
			<table width="100%" cellpadding="4" border="0" align="center" style="font-family:\'PT Sans\', sans-serif; font-size:10px; border-spacing:0px; ">
				<tr>
			    	<td colspan="4" style="text-align:left; font-size:12px;" >
			    		En relación a su solicitud de '.$solicitudes.' para su '.$nombreBeneficiario.' de '.$edadBeneficiario.$cedulaB.', nos permitimos informarle los precios de los mismos:
			    	</td>					    	
			  	</tr>				    	
			  			    					
			</table>
			<table width="100%" cellpadding="4" border="0" align="center" style="font-family:\'PT Sans\', sans-serif; font-size:10px; border-spacing:0px; ">
				<tr>
			    	<td style="text-align:center; font-size:12px;" >
			    		<b>Item</b>	    			
			    	</td>	
			    	<td style="text-align:center; font-size:12px;" >
			    		<b>Descripción Productos</b>	    			
			    	</td>	
			    	<td style="text-align:center; font-size:12px;" >
			    		<b>Precio</b>	    			
			    	</td>
			    	<td style="text-align:center; font-size:12px;" >
			    		<b>Cant</b>	    			
			    	</td>		
			    	<td style="text-align:center; font-size:12px;" >
			    		<b>Monto</b>	    			
			    	</td>					    	
			  	</tr>			  	
			  	'.$carritoLaboratorio.'
			  	'.$carrito.'			  	
			  	<tr><td colspan="5"><hr></td></tr>
			  	<tr>
			  		<td colspan="2" style="text-align:left;">TOTAL DE PRODUCTOS COTIZADOS</td>
			  		<td style="text-align:right;">&nbsp;</td>
			  		<td style="text-align:right;">'.$totalProducto.'</td>
			  		<td style="text-align:right;">'.number_format($totalCarrito,2,',','.').'</td>
			  	</tr>
			  	<tr>
			  		<td colspan="2" style="text-align:left;">ENVIO A: '.$paisDestino.'</td>
			  		<td style="text-align:right;">&nbsp;</td>
			  		<td style="text-align:right;">USD</td>
			  		<td style="text-align:right;">'.number_format($costoEnvio,2,',','.').'</td>
			  	</tr>
			  	<tr>
			  		<td colspan="2" style="text-align:left;">GASTOS DE TRANSFERENCIA INTERNACIONAL</td>
			  		<td style="text-align:right;">&nbsp;</td>
			  		<td style="text-align:right;">USD</td>
			  		<td style="text-align:right;">'.number_format($gastosTransferencia,2,',','.').'</td>
			  	</tr>
			  	<tr>
			  		<td colspan="2" style="text-align:left;"><b>TOTAL GENERAL</b></td>
			  		<td style="text-align:right;">&nbsp;</td>
			  		<td style="text-align:right;"><b>USD</b></td>
			  		<td style="text-align:right;"><b>'.$totalGeneral.'</b></td>
			  	</tr>
			  	<tr><td colspan="5">&nbsp;</td></tr>
			  	<tr>
					<td align="left" colspan="5" style="font-size:12px">Este precio es en base a nuestro esquema de atención internacional e incluye los costos de envío a su país en base a las instrucciones por usted suministradas.</td>
				<tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				'.$infoCuentas.'
			</table>	


			<table width="100%" cellpadding="4" border="0" align="center" style="font-family:\'PT Sans\', sans-serif; font-size:10px; border-spacing:0px; ">
				<tr>
			    	<td style="text-align:center; font-size:12px;" >
			    		<br>_____________________________________<br>
			    		<b>Reinaldo Facendo<br>
			    		Director BMS<br>
			    		<i class="fa fa-mobile"></i> +58 414-3382203<br>
			    		<i class="fa fa-envelope"></i> biometabolicservice@gmail.com
			    		</b>

			    	</td>	
			    </tr>
			</table>		
			    		
						
  		',2);

		$mpdf->Output();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */	
	public function actionCargarModalDonacion($idP,$idCot)
	{
		if (empty($idCot)) {
			$model=new TCotizacion;
		}else $model=$this->loadModel($idCot);



		$modelResponsable=new TDatosBasicos;		
		$modelResponsable=TDatosBasicosController::loadModel($model->id_responsable);
	    $modelResponsable->fecha_nacimiento = date('d/m/Y',strtotime($modelResponsable->fecha_nacimiento));
	    $modelDBBeneficiario= TDatosBasicosController::loadModel($model->id_beneficiario);

		$modelB=new TDatosBasicos;
		$modelB=TDatosBasicosController::loadModel($model->id_beneficiario);

		$modelDB=new TDatosBasicos;
		$modelDona=new TDonacion;
		$modelDBMedico=new TDatosBasicos;
		$modelEspecialidad=new TEspecialidad;

		$criteriaCart=new CDbCriteria;
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        $criteriaCart->condition='t.id_carrito = '.$model->id_carrito.' AND t.id_estatus = 1 AND (isnull(t.id_tipo_accion) or t.id_tipo_accion = 1)';
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);

		
		$formCot = $this->renderPartial('application.modules.bms.views.tCarritoDetalle._formSolicitarDonacion',array('modelCot'=>$model,'modelBene'=>$modelB,'modelRes'=>$modelResponsable,'modelDB'=>$modelDB,'modelDonacion'=>$modelDona,'modelDBBeneficiario'=>$modelDBBeneficiario,'resumenCart'=>$resumenCart),true,false); 


		echo CJSON::encode(array(	
			'dona' => $formCot,
			'idCot'=> $idCot,
			'idP'=>$idP
		));

		Yii::app()->end();

	}


	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TCotizacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TCotizacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TCotizacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tcotizacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
