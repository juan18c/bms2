<?php

class TDonacionController extends Controller
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
			'actions'=>array('create','update','admin','delete','detalleDonacion','indexAdmin','UpdateEstatus','updateAdmin'),
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
	public function actionCreate()
	{
		$model=new TDonacion;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);


		if(isset($_POST['TDonacion']))
		{
			
			$model->attributes=$_POST['TDonacion'];
			$model->id_cotizacion=$_POST['idCotizacion'];
			$model->id_estatus=4;
			//print_r($_FILES);
			if (isset($_FILES)) {
				if ($_FILES['TDonacion']['name']['foto'] === ''){
					echo CJSON::encode(array(
					'salida' => 'error',
					'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Seleccione una imagen para su caso.</div>',
					'option' => ''
					));
					Yii::app()->end();
				}				
				if ($_FILES['TDonacion']['error']['foto'] === 0) {
					$imagen=CUploadedFile::getInstance($model,'foto');
					$ext = pathinfo($imagen, PATHINFO_EXTENSION);					
				}else{
					echo CJSON::encode(array(
							'salida' => 'error',
							'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Verifique el tamaño de la foto, supera el tamaño requerido 2mb.</div>',
							'option' => ''
							));
					Yii::app()->end();
				}
				
			}	
			//print_r($model);
			if($model->validate()){

				if ($model->monto_solicitado==='0'){
					echo CJSON::encode(array(
					'salida' => 'error',
					'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> El monto solicitado debe ser mayor a 0.</div>',
					'option' => ''
					));
					
				}else{
					$model->monto_acumulado=floatval($model->monto_acumulado) + floatval($model->monto_solicitado);
					$model->save();

					if (isset($_FILES)) {
						if ($_FILES['TDonacion']['error']['foto'] === 0) {
							
							$modelUpdateImage = $this::loadModel($model->id_donacion);
							$modelUpdateImage->foto='images/FotoCasos/'.$model->id_donacion.'-caso.'.$ext;
							
							$modelUpdateImage->codigo_donacion='D-'.$model->id_donacion;
							if ($modelUpdateImage->save()) {
								if (!empty($model->foto)) 
									unlink(Yii::app()->basePath.'/../'.$model->foto);		
								
								$imagen->saveAs($modelUpdateImage->foto);					
							}
						}else{
							echo CJSON::encode(array(
							'salida' => 'error',
							'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Verifique el tamaño de la foto, supera el tamaño requerido 2mb.</div>',
							'option' => ''
							));
						}

					}

					$modelCoti=TCotizacionController::loadModel($model->id_cotizacion);
					$modelCoti->id_estatus=7;
					$modelCoti->save();
					echo CJSON::encode(array(
										'salida' => 'COMPLETO',
										'id'=>$model->id_donacion,
										'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> Se agrego el caso satisfactoriamente.</div>',
										'option' => ''
									));
				}
				Yii::app()->end();
			}
		}

		echo CJSON::encode(array(
			'salida' => 'error',
			'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Todos los campos son obligatorios verifique que contengan información .</div>',
			'option' => ''
		));
		Yii::app()->end();
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		//$model->foto = !empty($model->foto) ? Yii::app()->request->baseUrl.'/'.$model->foto : $model->foto;

		$modelCoti= TCotizacionController::loadModel($model->id_cotizacion);
		$modelDB=new TDatosBasicos;
		$modelResponsable=new TDatosBasicos;		
		$modelResponsable=TDatosBasicosController::loadModel($modelCoti->id_responsable);
		$modelB=new TDatosBasicos;
		$modelB=TDatosBasicosController::loadModel($modelCoti->id_beneficiario);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		//$_POST['TDonacion']['foto'] = $model->foto;
		//echo $id; exit();
		if(isset($_POST['TDonacion']))
		{
			$_POST['TDonacion']['foto'] = $model->foto;
			//$model->setScenario('update');
			$model->attributes=$_POST['TDonacion'];

			if (isset($_FILES)) {
				//print_r($_FILES['TDonacion']['error']["'foto'"]);exit();
				if ($_FILES['TDonacion']['error']["'foto'"] === 0) {
			     $imagen=CUploadedFile::getInstance($model,'foto');
			     $ext = pathinfo($imagen, PATHINFO_EXTENSION);     
			    }else{
					$model->addError('nombre_caso','Verifique el tamaño de la foto, supera el tamaño requerido 2mb');
				}
				
			}
			if ($model->validate(null, false)){
				if($model->save()){
					if (isset($_FILES)) {
						if ($_FILES['TDonacion']['error']["'foto'"] === 0) {
						
							$modelUpdateImage = $this::loadModel($model->id_donacion);
							$modelUpdateImage->foto='images/FotoCasos/'.$model->id_donacion.'-caso.'.$ext;											
							$modelUpdateImage->codigo_donacion='D-'.$model->id_donacion;
							if ($modelUpdateImage->save()){
								if (!empty($model->foto)) 
									unlink(Yii::app()->basePath.'/../'.$model->foto);									
								$imagen->saveAs($modelUpdateImage->foto);
								$this->redirect(array('/seguridad'));							
							}
						}
					
					}
					

				}
			}
		}

		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('update',array(
			'modelDonacion'=>$model,'modelDB'=>$modelDB,'modelCot'=>$modelCoti,'modelRes'=>$modelResponsable,'modelB'=>$modelB
		));
	}


	public function actionUpdateAdmin($id)
	{
		$model=$this->loadModel($_GET['id']);
		$modelCoti= TCotizacionController::loadModel($model->id_cotizacion);
		$modelDB=new TDatosBasicos;
		$modelResponsable=new TDatosBasicos;		
		$modelResponsable=TDatosBasicosController::loadModel($modelCoti->id_responsable);
		$modelB=new TDatosBasicos;
		$modelB=TDatosBasicosController::loadModel($modelCoti->id_beneficiario);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$formCot =	$this->renderPartial('_form', array('modelDonacion'=>$model,'modelDB'=>$modelDB,'modelRes'=>$modelResponsable,'modelBene'=>$modelB),true,false); 

		echo CJSON::encode(array(	
			'dona' => $formCot,
		));

		Yii::app()->end();
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		$model->id_estatus=2;
		if ($model->save()){
			echo CJSON::encode(array(
			'mensaje' => 'COMPLETO'	));
			Yii::app()->end();

	    }else{
			echo CJSON::encode(array(
			'mensaje' => 'error'	));
			Yii::app()->end();

	    }
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($search = '', $size = 18, $cat='', $marca = '')
	{
		/*$dataProvider=new CActiveDataProvider('TDonacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

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


		$criteria = new CDbCriteria();
		$criteria->select = array('*');
		$criteria->condition='t.id_estatus <> 7';


		$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

		$this->render('index',array('dataProvider' => $dataProvider,
			'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD));
		
	}


	/**
	 * Guarda el comentario del Signo Vital
	 * 
	 */
	public function actionUpdateEstatus()
	{
		$model=$this->loadModel($_POST['pk']);
		$this->performAjaxValidation($model);
		if(isset($_POST['value']))
		{
			$model->id_estatus=$_POST['value'];
			$model->save();
		}
	}


	/**
	 * Lists all models.
	 */
	public function actionIndexAdmin($search = '', $size = 18, $cat='', $marca = '')
	{
		/*$dataProvider=new CActiveDataProvider('TDonacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

		/*Yii::app()->theme = 'bms';
		$this->layout ='//layouts/portalDonador';*/

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


		$criteria = new CDbCriteria();
		$criteria->select = array('*');
		$criteria->condition='t.id_estatus <> 7';


		$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

		$this->render('indexAdmin',array('dataProvider' => $dataProvider,
			'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TDonacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TDonacion']))
			$model->attributes=$_GET['TDonacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionDetalleDonacion($id)
	{
		//$model=new TDonacion('search');
		$model=$this->loadModel($id);
		$model->foto = !empty($model->foto) ? Yii::app()->request->baseUrl.'/'.$model->foto : $model->foto;

		$modelCoti= TCotizacionController::loadModel($model->id_cotizacion);
		$modelDB=new TDatosBasicos;
		$modelResponsable=new TDatosBasicos;		
		$modelResponsable=TDatosBasicosController::loadModel($modelCoti->id_responsable);
		$modelB=new TDatosBasicos;
		$modelB=TDatosBasicosController::loadModel($modelCoti->id_beneficiario);
		/*$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TDonacion']))
			$model->attributes=$_GET['TDonacion'];*/
		Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';

		$this->render('_detalle',array(
			'model'=>$model,'modelCot'=>$modelCoti,'modelResp'=>$modelResponsable,'modelB'=>$modelB
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TDonacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TDonacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TDonacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tdonacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}