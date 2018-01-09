<?php

class TCarritoDetalleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */	

	public function init()
	{
   		
      	Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';
   		parent::init();
	}

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
				'actions'=>array('create','update','cartPrevio','checkoutCarrito','delete','createDireccion','modificarDireccion','verificarDireccion','createBeneficiario','createMedico','createCotizacion','checkoutCotizacion','procesarPago','updateBeneficiario','createHistoriaMedica'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','cartPrevio','checkoutCarrito','createDireccion','modificarDireccion','verificarDireccion','createBeneficiario','createMedico','createCotizacion','checkoutCotizacion','procesarPago','updateBeneficiario','createHistoriaMedica'),
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
	public function actionCreateDireccion($idR)
	{
		$modelDireccion=new TDatosBasicosDireccion;
		$modelCarrito=new TCarrito;
		$idPersona = empty($idR) ? Yii::app()->user->id_persona : $idR;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{
			$scenario = 'insert';
			$modelDireccion->attributes=$_POST['TDatosBasicosDireccion'];			
			$modelDireccion->id_tipo_direccion = 1;
			$modelDireccion->id_datos_basicos = $idPersona;
			$modelDireccion->indicador_envio = 1;			

			$idCarrito = $modelCarrito->find('t.id_datos_basicos = '.$idPersona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_carrito; 

			$idDireccion = isset($_POST['TDatosBasicosDireccion']['id_datos_basicos_direccion']) ? $_POST['TDatosBasicosDireccion']['id_datos_basicos_direccion'] : '';
			if (!empty($idDireccion)) {

				$scenario = 'update';
				
				$modelDireccion = TDatosBasicosDireccionController::loadModel($idDireccion);				

				if (empty($modelDireccion->direccion1) || empty($modelDireccion->ciudad) || empty($modelDireccion->estado) || empty($modelDireccion->codigo_zip) || empty($modelDireccion->telefono_fijo) ) {
					
					echo CJSON::encode(array(
						'salida' => 'IMCOMPLETO',
						'mensaje' => 'Complete los datos de la direccion seleccionada',
						'id'=>$modelDireccion->id_datos_basicos_direccion,
						'dir1'=>$modelDireccion->direccion1,
						'dir2'=>$modelDireccion->direccion2,
						'codzip'=>$modelDireccion->codigo_zip,
						'estado'=>$modelDireccion->estado,
						'id_estado'=>$modelDireccion->id_estado,
						'ciudad'=>$modelDireccion->ciudad,
						'telefono'=>$modelDireccion->telefono_fijo,
						'pais'=>$modelDireccion->id_pais
					));

					Yii::app()->end();
				}else{					

					TDatosBasicosDireccion::model()->updateAll(array('indicador_envio'=>0),'id_datos_basicos=:idp',array(':idp'=>$modelDireccion->id_datos_basicos));

					TDatosBasicosDireccion::model()->updateByPk($idDireccion, array('indicador_envio' => 1 ));

					$modelCarrito->setScenario('update'); 
					$modelCarrito = TCarritoController::loadModel($idCarrito);
					$modelCarrito->id_direccion = $modelDireccion->id_datos_basicos_direccion;
					$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2.'<br>' : '' ;
					if ($modelCarrito->save()) {
						echo CJSON::encode(array(
							'salida' => 'COMPLETO',
							'id'=>$modelDireccion->id_datos_basicos_direccion,
							'mensaje' => $modelDireccion->direccion1.'<br>'.$direccion2.'Telefono: '.$modelDireccion->telefono_fijo.'<br>'.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'<br>'.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion,
							'scenario'=>$scenario,
							'option' => $modelDireccion->ciudad.', '.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion
						));

						Yii::app()->end();
					}	


				}

			}else $modelDireccion->id_datos_basicos_direccion = NULL;

			
			TDatosBasicosDireccion::model()->updateAll(array('indicador_envio'=>0),'id_datos_basicos=:idp',array(':idp'=>$modelDireccion->id_datos_basicos));

			if($modelDireccion->save()){
				$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2.'<br>' : '' ;
				$modelCarrito->setScenario('update'); 
				$modelCarrito = TCarritoController::loadModel($idCarrito);
				$modelCarrito->id_direccion = $modelDireccion->id_datos_basicos_direccion;
				if ($modelCarrito->save()) {
					echo CJSON::encode(array(
						'salida' => 'COMPLETO',
						'id'=>$modelDireccion->id_datos_basicos_direccion,
						'mensaje' => $modelDireccion->direccion1.'<br>'.$direccion2.'Telefono: '.$modelDireccion->telefono_fijo.'<br>'.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'<br>'.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion,
						'scenario'=>$scenario,
						'option' => $modelDireccion->ciudad.', '.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion
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

	public function actionModificarDireccion($idR)
	{
		$modelDireccion=new TDatosBasicosDireccion;
		$modelCarrito=new TCarrito;
		$idPersona = empty($idR) ? Yii::app()->user->id_persona : $idR;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{			
			$modelDireccion->attributes=$_POST['TDatosBasicosDireccion'];
			$modelDireccion->id_tipo_direccion = 1;
			$modelDireccion->id_datos_basicos = $idPersona;
			$modelDireccion->indicador_envio = 1;	
			$scenario = 'insert';
			$modelDireccion->setScenario($scenario); 

			TDatosBasicosDireccion::model()->updateAll(array('indicador_envio'=>0),'id_datos_basicos=:idp',array(':idp'=>$modelDireccion->id_datos_basicos));			

			
			$modelDireccion->id_datos_basicos_direccion = $_POST['TDatosBasicosDireccion']['id_datos_basicos_direccion'];
			if ($modelDireccion->id_datos_basicos_direccion != '') {
				$scenario ='update';
				$modelDireccion->setScenario($scenario); 

				$modelDireccion = TDatosBasicosDireccionController::loadModel($modelDireccion->id_datos_basicos_direccion);
				$modelDireccion->direccion1 = $_POST['TDatosBasicosDireccion']['direccion1'];
				$modelDireccion->direccion2 = $_POST['TDatosBasicosDireccion']['direccion2'];
				$modelDireccion->codigo_zip = $_POST['TDatosBasicosDireccion']['codigo_zip'];
				$modelDireccion->estado = $_POST['TDatosBasicosDireccion']['estado'];
				$modelDireccion->ciudad = $_POST['TDatosBasicosDireccion']['ciudad'];
				$modelDireccion->telefono_fijo = $_POST['TDatosBasicosDireccion']['telefono_fijo'];
				$modelDireccion->id_pais = $_POST['TDatosBasicosDireccion']['id_pais'];
				$modelDireccion->id_tipo_direccion = 1;
				$modelDireccion->id_datos_basicos = $idPersona;
				$modelDireccion->indicador_envio = 1;		
			
			}else $modelDireccion->id_datos_basicos_direccion = NULL;


			if($modelDireccion->save()){
				
				$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2.'<br>' : '' ;

				//$modelCarrito->setScenario('update'); 
				$idCarrito = TCarrito::model()->find('t.id_datos_basicos = '.$idPersona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL')->id_carrito; 

				$modelCarrito = TCarritoController::loadModel($idCarrito);
				$modelCarrito->id_direccion = $modelDireccion->id_datos_basicos_direccion;
				if ($modelCarrito->save()) {
					echo CJSON::encode(array(
						'salida' => 'COMPLETO',
						'id'=>$modelDireccion->id_datos_basicos_direccion,
						'mensaje' => $modelDireccion->direccion1.'<br>'.$direccion2.'Telefono: '.$modelDireccion->telefono_fijo.'<br>'.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'<br>'.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion,
						'scenario'=>$scenario,
						'option' => $modelDireccion->ciudad.', '.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion
					));

					Yii::app()->end();
				}				
			}else{
				echo "entro"; var_dump($modelDireccion) ; die();
			}
		}

		echo CJSON::encode(array(
			'salida' => 'ERROR',			
			'mensaje' => 'Ocurrio un error por favor verifique'
		));
		Yii::app()->end();
		
	}

	public function actionVerificarDireccion($idR)
	{
		$modelDireccion=new TDatosBasicosDireccion;
		$modelCarrito=new TCarrito;
		$idPersona = empty($idR) ? Yii::app()->user->id_persona : $idR;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{			
			$modelDireccion->attributes=$_POST['TDatosBasicosDireccion'];
			$modelDireccion->id_tipo_direccion = 1;
			$modelDireccion->id_datos_basicos = $idPersona;
			$modelDireccion->indicador_envio = 1;
			
			$modelDireccion->id_datos_basicos_direccion = $_POST['TDatosBasicosDireccion']['id_datos_basicos_direccion'];
			if ($modelDireccion->id_datos_basicos_direccion != '') {			

				$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2 : '' ;
				
				$idCarritoDireccion = $modelCarrito->find('t.id_datos_basicos = '.$idPersona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_direccion;				
				
				if ($idCarritoDireccion != '' &&  $idCarritoDireccion != NULL ) {

					$modelDireccion = TDatosBasicosDireccionController::loadModel($idCarritoDireccion);
					
					echo CJSON::encode(array(
						'salida' => 'VERIFICADO',
						'id'=>$modelDireccion->id_datos_basicos_direccion,
						'mensaje' => '<div class="alert alert-info" role="info"><i class="rt-icon2-location-outline"></i> Su Dirección de envío es: '.$modelDireccion->direccion1.', '.$direccion2.', '.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'. '.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion.'. Telefono: '.$modelDireccion->telefono_fijo.'</div>'
					));

					Yii::app()->end();
				}				
			}else{

				echo CJSON::encode(array(
					'salida' => 'UNVERIFICADO',
					'id'=>$modelDireccion->id_datos_basicos_direccion,
					'mensaje' => '<div class="alert alert-danger" role="alert"><i class="rt-icon2-location-outline"></i> Por favor elija una direccion de envio</div>'
				));

				Yii::app()->end();
			}

		}

		echo CJSON::encode(array(
			'salida' => 'ERROR',			
			'mensaje' => 'Ocurrio un error por favor verifique'
		));
		Yii::app()->end();
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TCarritoDetalle;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TCarritoDetalle']))
		{
			$model->attributes=$_POST['TCarritoDetalle'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_carrito_detalle));
		}

		$this->render('create',array(
			'model'=>$model,
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
		$idR = Yii::app()->user->id_persona;

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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$idR = Yii::app()->user->id_persona;
		$model = new TCarritoDetalle;

		$model->id_carrito = 1;
		$idCarrito = TCarrito::model()->find('t.id_datos_basicos = '.$idR.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_carrito;
		$model->id_carrito = $idCarrito;

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
			'totalOrden' => $formTotal,
			'totalItems' => $totalProducto
		));

		Yii::app()->end();


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		// if(!isset($_GET['ajax']))
		// 	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TCarritoDetalle');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TCarritoDetalle('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TCarritoDetalle']))
			$model->attributes=$_GET['TCarritoDetalle'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionCartPrevio()
	{
		$model=new TCarritoDetalle('search');
		$modelDireccion = new TDatosBasicosDireccion;
		$modelCot=new TCotizacion;
		$modelBeneficiario=new TBeneficiario;
		
		$modelDB=new TDatosBasicos;
		$modelParentesco=new TParentesco;
		$modelMedico=new TMedico;
		$modelDBMedico=new TDatosBasicos;
		$modelDirMedico=new TDatosBasicosDireccion;
		$modelEspecialidad=new TEspecialidad;
		$modelProducto=new TProducto;

		$direccion='';
		$direccion2='';
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TCarritoDetalle']))
			$model->attributes=$_GET['TCarritoDetalle'];

		$modelCot->id_responsable=Yii::app()->user->id_persona;

		$carrito = TCarrito::model()->find('t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ');			

		$criteriaCart=new CDbCriteria; 
		
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        $criteriaCart->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND isnull(t.id_tipo_accion)';
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);
		
		$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');

      	$criteria=new CDbCriteria;
       	$criteria->addSearchCondition('t.id_carrito',$carrito->id_carrito, true, 'AND' );
        $criteria->addSearchCondition('t.id_estatus','1', true, 'AND');
    	//$criteria->addSearchCondition('t.id_tipo_accion','IS NULL', true, 'AND');        	
    	$criteria->with = array('idProducto');
    	//$criteria->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';

    	$dataProviderCart = new CActiveDataProvider( 'TCarritoDetalle', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>20) ) );

    	$carritoDetalle = TCarritoDetalle::model()->findAll($criteria);
    	$model->id_carrito = $carrito->id_carrito;
    	$criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');		        
        $criteriaTotal->condition='t.id_carrito = '.$model->id_carrito;
	    $totalItems = $model->find($criteriaTotal)->items;

	    
	    if ($carrito->id_direccion != '') {
	    	$modelDireccion = TDatosBasicosDireccionController::loadModel($carrito->id_direccion);
	    	$direccion2 = ($modelDireccion->direccion2 != '')? $modelDireccion->direccion2.'<br>' : '' ;
	    	$direccion = $modelDireccion->direccion1.'<br>'.$direccion2.'Telefono: '.$modelDireccion->telefono_fijo.'<br>'.$modelDireccion->ciudad.', '.$modelDireccion->codigo_zip.'<br>'.$modelDireccion->estado.', '.$modelDireccion->idPais->descripcion;

	    }

	    //$modelCar=new TCarritoDetalle('search');
	    $modelCar=TCarritoController::loadModel($carrito->id_carrito);

	    Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('cartPrevio',array(
			'model'=>$model,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccion,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelProducto'=>$modelProducto,'modelCar'=>$modelCar
		));
	}

	public function actionCreateBeneficiario()
	{//EVALUAR SI USO LA MISMA FUNCION DE LA COTIZACION
		$model=new TBeneficiario;		
		$modelDB=new TDatosBasicos;

		$modelResponsable= TDatosBasicosController::loadModel(Yii::app()->user->id_persona);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST))
		{			
			$modelDB->attributes=$_POST['TDatosBasicos']['beneficiario'];			
			
			$nombres=$_POST['TDatosBasicos']['beneficiario']['nombres'];
			$apellidos=$_POST['TDatosBasicos']['beneficiario']['apellidos'];
			$modelDB->sexo = $_POST['TDatosBasicos']['beneficiario']['sexo'] == 1 ? 'F' : 'M';			
			$modelDB->fecha_nacimiento = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$_POST['TDatosBasicos']['beneficiario']['fecha_nacimiento'])));
			$modelDB->email='noaplica1@bms.com';
			$modelDB->telefono_cel='0212-1234455';
			$modelDB->id_perfil = 9; //PERFIL DE BENEFICIARIO

			if($_POST['TParentesco']['id_parentesco'] == 2 || $_POST['TParentesco']['id_parentesco'] == 8  || $_POST['TParentesco']['id_parentesco'] == 10 ){
				
				$criteria=new CDbCriteria;
		        $criteria->select = array('max(t.titular) as titular','t.id_datos_basicos');
		        $criteria->condition="t.nro_identificacion = '".$modelResponsable->nro_identificacion."' AND t.titular != 0 AND upper(t.nombres) =  '".strtoupper($nombres)."' AND upper(t.apellidos) = '".strtoupper($apellidos)."'";

				$beneficiarioDB = TDatosBasicos::model()->find($criteria);
				
				if (!empty($beneficiarioDB->titular) && !empty($beneficiarioDB->id_datos_basicos)) 
				{	

					$idBeneficiario = $beneficiarioDB->id_datos_basicos;								
					$modelDBB = TDatosBasicosController::loadModel($idBeneficiario);

					$modelDBB->attributes=$_POST['TDatosBasicos']['beneficiario'];
					$nroIdentificacion= ($_POST['TDatosBasicos']['beneficiario']['nro_identificacion'] != '')? $_POST['TDatosBasicos']['beneficiario']['nro_identificacion'] : $modelResponsable->nro_identificacion ;
					$modelDBB->email='noaplica@bms.com';
					if ($modelDBB->save()) {

						$model->id_beneficiario = $modelDBB->id_datos_basicos;
						$model->id_responsable = $modelResponsable->id_datos_basicos;			
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

				$criteria2=new CDbCriteria;
		        $criteria2->select = array('max(t.titular) as titular','t.id_datos_basicos');
		        $criteria2->condition="t.nro_identificacion = '".$modelResponsable->nro_identificacion."' AND t.titular != 0";

		        $beneficiarioDBNuevo = TDatosBasicos::model()->find($criteria2);

				$modelDB->titular=$beneficiarioDBNuevo->titular + 1;		
				
			}
				
			// echo $beneficiarioDB->titular;
			// var_dump($modelDB->getErrors());
			// print_r($modelDB);
			// exit();

			if($modelDB->save()){				

				$model->id_beneficiario = $modelDB->id_datos_basicos;
				$model->id_responsable = $modelResponsable->id_datos_basicos;			
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


		// $model=new TBeneficiario;		
		// $modelDB=new TDatosBasicos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST))
		// {			
		// 	$modelDB->attributes=$_POST['TDatosBasicos']['beneficiario'];			
		// 	$modelDB->sexo = $_POST['TDatosBasicos']['beneficiario']['sexo'] == 1 ? 'F' : 'M';
		// 	$timestamp = strtotime($_POST['TDatosBasicos']['beneficiario']['fecha_nacimiento']);
		// 	$modelDB->fecha_nacimiento = date('Y-m-d H:i:s',$timestamp);
		// 	$modelDB->email = 'norequerido@bms.com';
		// 	$modelDB->telefono_cel = '00000000000';
						
		// 	if($modelDB->save()){				

		// 		$model->id_beneficiario = $modelDB->id_datos_basicos;
		// 		$model->id_responsable = Yii::app()->user->id_persona;			
		// 		$model->id_parentesco = $_POST['TParentesco']['id_parentesco'];
				
		// 		if ($model->save()) {

		// 			echo CJSON::encode(array(
		// 				'salida' => 'COMPLETO',
		// 				'id'=>$model->id_beneficiario,
		// 				'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El beneficiario fue creado exitosamente.</div>',
		// 				'option' => $model->idBeneficiarioDB->nombres.' '.$model->idBeneficiarioDB->apellidos
		// 			));

		// 			Yii::app()->end();
		// 		}				
		// 	}
			
		// }

		// echo CJSON::encode(array(
		// 	'salida' => 'ERROR',			
		// 	'mensaje' => 'Ocurrio un error por favor verifique'
		// ));
		// Yii::app()->end();
		
	}


	public function actionUpdateBeneficiario($idR)
	{

		$salida = '';
		$modelCart=new TCarrito;
		$modelCot = new TCotizacion;
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

		$carrito = TCarrito::model()->find('t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ');			

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{			
			$idBeneficiario = $_POST['idb'];

			// if ($_POST['idcot'] != '') {
			// 	$idCotizacion = $_POST['idcot'];

			// 	$modelCot=$this->loadModel($idCotizacion);

			// 	$modelCot->id_beneficiario=$idBeneficiario;						
								
			// 	if ($modelCot->save()) {
			// 		$salida = 'ACTUALIZADO';
			// 	}	
			// }

			$formHistoria = $this->renderPartial('application.modules.bms.views.tHistoriaMedica.adminFront', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMM'=>$modelHMM,'modelHMD'=>$modelHMD,'model'=>$modelCot,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'idCotizacion'=>$idCotizacion,'idBeneficiario'=>$idBeneficiario),true,false);

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

			$idHMC = TCotizacionHistoriaMedicaCaso::model()->getDocumentosCart($carrito->id_carrito);
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

					$option = $modelCot->idBeneficiario->idBeneficiarioDB->nombres.' '.$modelCot->idBeneficiario->idBeneficiarioDB->apellidos;
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
		$idHistoriasCaso = isset($_POST['idhistoria'])? $_POST['idhistoria'] : '';

		// print_r($_POST);
		// exit();
		// if(isset($_GET['ajax'])){

		// 	if ($_GET['ajax'] == 'thistoria-medica-grid') {
		// 		$idBeneficiario = $_POST['idb'];
		// 		$idCotizacion = $_POST['idcot'];

		// 		$this->renderPartial('application.modules.bms.views.tHistoriaMedica.admin', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'idDocumento'=>$idDocumento));
		// 	}
		// }		
				
		if (isset($_POST)) {
			$idBeneficiario = $_POST['idb'];
			//$idCotizacion = $_POST['idcot'];
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


				// if (!empty($idHistoriasCaso)) {
						    
				//     TCotizacionHistoriaMedicaCaso::model()->deleteAll('id_cotizacion = ' . $model->id_cotizacion);
				// }
						
				$modelCHMC = new TCotizacionHistoriaMedicaCaso;
				$modelCHMC->id_historia_medica_caso = $historia->id_historia_medica;
				$modelCHMC->id_carrito=$idCarrito;
				
				if($modelCHMC->save()) $salida= 'ok';
				else $salida= "error TCotizacionHistoriaMedicaCaso";


				
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

			$idHMC = TCotizacionHistoriaMedicaCaso::model()->getDocumentosCart($idCarrito);
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
			//'idcot'=> $idCotizacion,
			'idcar'=>$idCarrito,
			'documento'=>$idHMC,
			'idDocumento'=>$_POST['iddocumento']
		));

		Yii::app()->end();

	}



	public function actionCreateMedico()
	{
		$model=new TMedico;		
		$modelDB=new TDatosBasicos;
		$modelDireccion=new TDatosBasicosDireccion;
		$guardar = 1;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{
			$modelDB->attributes=$_POST['TDatosBasicos']['medico'];
			$modelDB->telefono_cel = empty($_POST['TDatosBasicosDireccion']['telefono_fijo']) ? '00000000000' : $_POST['TDatosBasicosDireccion']['telefono_fijo'];
			$modelDB->email= 'noaplica@bms.com';
			$modelDB->sexo = $_POST['TDatosBasicos']['medico']['sexo'] == 1 ? 'F' : 'M';

			$modelDireccion->attributes=$_POST['TDatosBasicosDireccion'];
			//$model->attributes=$_POST['TMedico'];
			$idEspecialidad = $_POST['TEspecialidad']['id_especialidad'];

			if($modelDB->save()){				
				$modelDireccion->id_datos_basicos = $modelDB->id_datos_basicos;
				$modelDireccion->id_tipo_direccion = 2;
				
				if ($modelDireccion->save()) {

					$model->id_datos_basicos = $modelDB->id_datos_basicos;
					$model->ind_no_registrado = 1;

					if ($model->save()) {

						foreach ($idEspecialidad as $key => $value) {
							if ($value != '') {								
								$modelEspecialidad=new TMedicoEspecialidad;
								$modelEspecialidad->id_medico = $model->id_medico;
								$modelEspecialidad->id_especialidad = $value;
								if ($modelEspecialidad->save()) {
									$guardar = 1;
								}else{
									$guardar = 0;
								}
							}
						}

						echo CJSON::encode(array(
							'salida' => 'COMPLETO',
							'id'=>$model->id_medico,
							'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El médico fue creado exitosamente </div>',		

							'option' => $model->idDatosBasicos->nombres.' '.$model->idDatosBasicos->apellidos
						));

						Yii::app()->end();
						
					}						
				}				
			}
		}
		

		echo CJSON::encode(array(
			'salida' => 'ERROR',			
			'mensaje' => 'Ocurrio un error por favor verifique'
		));
		Yii::app()->end();
		
	}


	public function actionCreateCotizacion()
	{
		$model=new TCotizacion;		
		$modelCarrito=new TCarrito;
		
		$guardar = 1;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{	
			$beneficiario=isset($_POST['TBeneficiario_id_beneficiario'])? $_POST['TBeneficiario_id_beneficiario'] : Yii::app()->user->id_persona;
			$idCarrito = $modelCarrito->find('t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL ')->id_carrito;
			$model->id_carrito = $idCarrito;
			$model->codigo_cotizacion = 'C-'.str_pad($idCarrito, 5, "0", STR_PAD_LEFT).'-1-'.date('mY');
			$model->id_responsable = Yii::app()->user->id_persona;
			$model->id_beneficiario=  $beneficiario;
			$model->duracion_tratamiento='POR DEFINIR';
			
			if($model->save()){

				TCarrito::model()->updateByPk($idCarrito, array('id_tipo_accion' => 1 )); //PASA A COTIZACION

				//HAY QUE GUARDAS LOS DATOS DEL MEDICO Y LA HISTORIA MEDICA
				//if ($_POST['TMedico']['id_medico'] != '')

				$modelCarrito=new TCarrito;
				$modelCarrito->id_datos_basicos = Yii::app()->user->id_persona;

				if ($modelCarrito->save()) {

					echo CJSON::encode(array(
						'salida' => 'COMPLETO',
						'id'=>$model->id_cotizacion,
						'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> La Cotización fue creada exitosamente bajo el Nro. '.$model->id_cotizacion.'</div>'	
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

	/**
	 * Manages all models.
	 */
	public function actionCheckoutCarrito($id)
	{
		$model=new TCarrito;
		$model->unsetAttributes();  // clear any default values

		// $resumenCart
		// $modelDireccion
		// $direccionEnvio

		//evaluar origen para cargar los modelos 

		$origen=isset($_GET['origen'])? $_GET['origen'] : '';
		$codigo_cotizacion=isset($_GET['codigo'])? $_GET['codigo'] : '';

		if(isset($_GET['TCarritoDetalle']))
			$model->attributes=$_GET['TCarritoDetalle'];

		$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');

		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('checkout',array(
			'model'=>$model,'categorias'=>$categorias,'origen'=>$origen,'codigo'=>$codigo_cotizacion
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionCheckoutCotizacion($id)
	{
		$model=TCotizacionController::loadModel($id);		
		$origen='cot';
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
				$this->renderPartial('_viewResumen', array('modelCar'=>$modelCartDet));
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

	    $totalCarrito=0;
	    foreach ($resumenCart as $key2 => $value2) {
            $totalCarrito+=$value2->total;
        }

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



		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('checkout',array(
			'model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCartDet,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccion,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'origen'=>$origen,'envio'=>$costoEnvio,'gastos'=>$gastosTransferencia,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura
		));
	}


	public function actionProcesarPago($id)
	{
		$model=new TOrden;
		
		$modelMedioPago=new TMedioPago;

		$modelCreditoBms=new TCreditoBms;

		$pagoBanco='';
		$pagoBms='';
		$pagoTarjeta='';
		$pagoPaypal='';
		$salida='';

		$montoPaypal=0;
		$montoBms=0;
		$montoTarjeta=0;
		$montoDeposito=0;

		if (isset($_POST)) {
						
			$model->codigo_orden='O';
			$model->id_cotizacion= $id;
			$model->id_beneficiario= $_POST['idResponsable'];
			$model->items=$_POST['items'];
			$model->monto_total=$_POST['total'];
			$model->pago_acumulado=0;

			if ($model->save()) {
				
				$model=TOrdenController::loadModel($model->id_orden);
				$model->codigo_orden = 'O-'.str_pad($model->id_orden, 5, "0", STR_PAD_LEFT).'-'.$_POST['paisAbreviatura'].'-'.date('mY');		

				
				if($model->save()){

					if ( !empty($_POST['nombreBanco']) && !empty($_POST['numeroCuentaBanco']) && !empty($_POST['numeroRutaBanco'] ) && !empty($_POST['montoDeposito'])  && $_POST['montoDeposito'] > 0 ) 
					{
						$modelOrdenPagoBanco= new TOrdenPago;
						$modelOrdenPagoBanco->id_medio_pago=4; //TRANFERENCIA O DEPOSITO
						$modelOrdenPagoBanco->nombre_banco= $_POST['nombreBanco'];
						$modelOrdenPagoBanco->numero_cuenta= $_POST['numeroCuentaBanco'];
						$modelOrdenPagoBanco->numero_ruta_bancaria= $_POST['numeroRutaBanco'];
						//$modelOrdenPagoBanco->fecha_pago= date('Y-m-d H:i:s',strtotime($_POST['fechaPago']));
						$modelOrdenPagoBanco->fecha_pago= date('Y-m-d H:i:s');
						$modelOrdenPagoBanco->monto=$_POST['montoDeposito'];
						$modelOrdenPagoBanco->id_orden=$model->id_orden;
						$modelOrdenPagoBanco->id_estatus=4; //PENDIENTE POR VERIFICAR

						if($modelOrdenPagoBanco->save())
						{							
							$pagoBanco='ok';
							$montoDeposito=$_POST['montoDeposito'];
						}
					}

					if ( !empty($_POST['nombreTarjeta']) && !empty($_POST['numeroTarjeta']) && !empty($_POST['montoCC'])  && $_POST['montoCC'] > 0 ) 
					{
						
						$modelOrdenPagoCC= new TOrdenPago;
						$modelOrdenPagoCC->id_medio_pago=2; //TARJETA DE CREDITO O DEBITO
						$modelOrdenPagoCC->nombre_tarjeta= $_POST['nombreTarjeta'];
						$modelOrdenPagoCC->numero_tarjeta= $_POST['numeroTarjeta'];
						$modelOrdenPagoCC->tipo_tarjeta= strtoupper($_POST['tipoCC']); // VISA, MASTERCARD
						//$modelOrdenPagoCC->fechaPago= date('Y-m-d H:i:s',strtotime($_POST['fechaPago']));
						$modelOrdenPagoCC->fecha_pago= date('Y-m-d H:i:s');
						$modelOrdenPagoCC->monto=$_POST['montoCC'];
						$modelOrdenPagoCC->id_orden=$model->id_orden;
						$modelOrdenPagoCC->id_estatus=4; //PENDIENTE POR VERIFICAR

						if($modelOrdenPagoCC->save())
						{
							$pagoTarjeta='ok';
							$montoTarjeta=$_POST['montoCC'];
						}

					}

					if ( !empty( $_POST['cuentaPaypal']) && !empty($_POST['montoPaypal']) && $_POST['montoPaypal'] > 0 ) 
					{
						$modelOrdenPagoPaypal= new TOrdenPago;
						$modelOrdenPagoPaypal->id_medio_pago=1; //PAYPAL
						$modelOrdenPagoPaypal->email= $_POST['cuentaPaypal'];
						$modelOrdenPagoPaypal->monto=$_POST['montoPaypal'];
						$modelOrdenPagoPaypal->fecha_pago= date('Y-m-d H:i:s');
						$modelOrdenPagoPaypal->id_orden=$model->id_orden;
						$modelOrdenPagoPaypal->id_estatus=4; //PENDIENTE POR VERIFICAR

						if($modelOrdenPagoPaypal->save())
						{								
							$pagoPaypal='ok';
							$montoPaypal=$_POST['montoPaypal'];
						}
					}

					if ( !empty($_POST['montoBms']) && $_POST['montoBms'] > 0  ) 
					{
						$modelOrdenPagoBMS= new TOrdenPago;
						$modelOrdenPagoBMS->id_medio_pago=6; //PAYPAL
						$modelOrdenPagoBMS->email= $_POST['cuentaPaypal'];
						$modelOrdenPagoBMS->monto=$_POST['montoBms'];
						$modelOrdenPagoBMS->fecha_pago= date('Y-m-d H:i:s');
						$modelOrdenPagoBMS->id_orden=$model->id_orden;
						$modelOrdenPagoBMS->id_estatus=4; //PENDIENTE POR VERIFICAR

						if($modelOrdenPagoBMS->save())
						{
							$modelCreditoBms->id_orden=$model->id_orden;						
							$modelCreditoBms->id_orden_pago=$model->id_orden_pago;	
							$modelCreditoBms->saldo= $_POST['saldoBms'] - $_POST['montoBms'] ;
							$modelCreditoBms->fecha_saldo=date('Y-m-d H:i:s');
							

							if ($modelCreditoBms->save()) {
								$pagoBms='ok';
								$montoBms=$_POST['montoBms'];
							}
						}
						// $modelCreditoBms->id_orden_pago
						// $modelCreditoBms->id_despacho
					}
					
				}
				
				$montoAprobado=$montoPaypal+$montoBms+$montoTarjeta+$montoDeposito;

				$modelOrdenNewSaldo=TOrdenController::loadModel($model->id_orden);
				if ($montoAprobado === $model->monto_total) {
					$modelOrdenNewSaldo->id_estatus=3;
				}else $modelOrdenNewSaldo->id_estatus=4;
				$modelOrdenNewSaldo->pago_acumulado=$montoPaypal+$montoBms+$montoTarjeta+$montoDeposito;


				if ($modelOrdenNewSaldo->save()) {
					$salida='ok';

					//ACTUALIZAR LAS ACCIONES DEL CARRITO Y COTIZACION					
					$modelCotizacion=TCotizacionController::loadModel($id);
					$modelCarrito= TCarritoController::loadModel($modelCotizacion->id_carrito);
					
					$modelCarrito->id_tipo_accion=2;
					if ($modelCarrito->save()) {
						$modelCotizacion->id_estatus=7; //PROCESADA
						if ($modelCotizacion->save()) {
							$salida='ok';
						}
					}
				}
				
			}

		}

		//exit();

		echo CJSON::encode(array(				
			'id' => $model->id_orden,
			'salida'=>$salida,
			'pagoBms'=>$pagoBms,
			'pagoPaypal'=>$pagoPaypal,
			'pagoTarjeta'=>$pagoTarjeta,
			'pagoBanco'=>$pagoBanco,
			'origen'=>$_POST['origen']
		));
		Yii::app()->end();

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TCarritoDetalle the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TCarritoDetalle::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TCarritoDetalle $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tcarrito-detalle-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
