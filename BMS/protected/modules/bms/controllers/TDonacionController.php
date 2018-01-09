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
			'actions'=>array('create','update','admin','delete','detalleDonacion','indexAdmin','UpdateEstatus','updateAdmin','conciliar','pagosCerrados','ordenarPor'),
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




	public function actionCreate()
	{
		$model=new TDonacion;
		// $modelInventario=new TInventario;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['TDonacion']))
		{
			// $model->dbConnection->setActive(true);
			$ret=false;
			$transaction = $model->dbConnection->beginTransaction();
			


			$id = isset($_GET['id']) ? $_GET['id']: '';
			//$idInventario = isset($_POST['idInventario']) ? $_POST['idInventario'] : '';


			if (!empty($id)) {
				$model = $this->loadModel($id);
				$_POST['TDonacion']['foto'] = $model->foto;
				$model->setScenario('update');				
			}

			$model->attributes=$_POST['TDonacion'];

			if (!isset($_GET['id'])){
				$model->id_cotizacion=$_POST['idCotizacion'];
				$model->id_estatus=4;
				$model->id_usuario=Yii::app()->user->id;
				
			}

			$pos = strpos($_POST['TDonacion']['video'],"watch?v=");
			if ($pos!== false){
				$cad=substr($_POST['TDonacion']['video'], $pos+strlen("watch?v="), strlen($_POST['TDonacion']['video'])); 
				$model->video="http://www.youtube.com/embed/".$cad."?autoplay=1";
			}

			if (isset($_FILES)) {				
				
				if ($_FILES['TDonacion']['error']['foto'] === 0) {
					$imagen=CUploadedFile::getInstance($model,'foto');
					$ext = pathinfo($imagen, PATHINFO_EXTENSION);					
				}else{
					if (($_FILES['TDonacion']['name']['foto'] === '') && (empty($id))){
						echo CJSON::encode(array(
						'salida' => 'error',
						'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Seleccione una imagen para su caso.</div>',
						'option' => ''
						));
						Yii::app()->end();
					}		
				}			
	
			}			

			if ($model->save(true)) {
				$idCreditoDona=TCreditoDonacion::model()->find('id_usuario='.Yii::app()->user->id);
				if (!$idCreditoDona){
					$modelCreditoDonacion = new TCreditoDonacion;
					$modelCreditoDonacion->monto_disponible=0;
					$modelCreditoDonacion->id_usuario=Yii::app()->user->id;
					$modelCreditoDonacion->id_estatus=1;
					$modelCreditoDonacion->save();
				}			

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

					}
					if ($_FILES['TDonacion']['error']['foto']===1){
						echo CJSON::encode(array(
								'salida' => 'error',
								'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Verifique el tamaño de la foto, supera el tamaño requerido 2mb.</div>',
								'option' => ''
								));

						
						$transaction->rollback();
						Yii::app()->end();
					}

				}
				$modelCoti=TCotizacionController::loadModel($model->id_cotizacion);
				$modelCoti->id_estatus=7;
				$modelCoti->save();	
				$transaction->commit();
				echo CJSON::encode(array(
					'salida' => 'COMPLETO',
					'id'=>$model->id_donacion,
					//'idi'=>$modelInventario->id_inventario,
					'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El Caso fue creado exitosamente.</div>'
				));

				Yii::app()->end();


			}

		}

				echo CJSON::encode(array(
					'salida' => 'error',
					'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-remove-circle"></i> Todos los campos son obligatorios verifique que contengan información .</div>'
				));
			//	$transaction->rollback();

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
			$model->setScenario('update');
			$model->attributes=$_POST['TDonacion'];

			if (isset($_FILES)) {
				
				if ($_FILES['TDonacion']['error']["'foto'"] === 0) {
			     $imagen=CUploadedFile::getInstance($model,'foto');
			     $ext = pathinfo($imagen, PATHINFO_EXTENSION);     
			    }
			   
				
			}
			if ($model->validate()){

					if (isset($_FILES)) {

						if ($_FILES['TDonacion']['error']["'foto'"] === 0) {
							$model->save();
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

						if ($_FILES['TDonacion']['error']["'foto'"]===1){
							$model->addError('nombre_caso','Verifique el tamaño de la foto, supera el tamaño requerido 2mb');
						}

						
					
					}
					

				//}
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
		$modelDBBeneficiario= TDatosBasicosController::loadModel($modelCoti->id_beneficiario);
		

		$criteriaCart=new CDbCriteria;
		$criteriaCart->select=array('count(*) as items','sum(t.precio * t.cantidad) as total','t.id_producto_tipo','t.descripcion');
        $criteriaCart->condition='t.id_carrito = '.$modelCoti->id_carrito.' AND t.id_estatus = 1 AND (isnull(t.id_tipo_accion) or t.id_tipo_accion = 1)';
        $criteriaCart->group = 't.id_producto_tipo,t.descripcion';
		$resumenCart = VCarritoResumen::model()->findAll($criteriaCart);


		$formCot = $this->renderPartial('application.modules.bms.views.tCarritoDetalle._formSolicitarDonacion',array('modelCot'=>$modelCoti,'modelBene'=>$modelB,'modelRes'=>$modelResponsable,'modelDB'=>$modelDB,'modelDonacion'=>$model,'modelDBBeneficiario'=>$modelDBBeneficiario,'resumenCart'=>$resumenCart),true,false); 


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
	public function actionIndex($search = '', $size = 18, $tipo='', $marca = '')
	{
		/*$dataProvider=new CActiveDataProvider('TDonacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

		Yii::app()->theme = 'bms';
		$this->layout ='//layouts/portalCliente';

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

		if (isset($tipo)){

			$criteria->with=array('idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos'),'idCotizacion.idResponsable'=>array('select'=>'idCotizacion.idResponsable.nombres,idCotizacion.idResponsable.apellidos'),'idCotizacion.idCarrito.idDatosBasicosDireccion.idPais'=>array('select'=>'idCotizacion.idCarrito.idDatosBasicosDireccion.idPais.descripcion'));

			switch ($tipo) {
				case 'responsable':
					$criteria->order='idResponsable.nombres,idResponsable.apellidos Desc';
					break;
				case 'beneficiario':
					$criteria->order='idBeneficiarioDB.nombres,idBeneficiarioDB.apellidos';
					break;
				case 'pais':
					$criteria->order='idPais.descripcion';
					break;
			}
		}


		
		if( strlen( $search ) > 0 ){
	        	$criteria->condition="t.id_estatus <> 7 and id_donacion <> 1 AND (CONCAT_WS(' ',idBeneficiarioDB.nombres,idBeneficiarioDB.apellidos) like '%$search%' OR CONCAT_WS(' ',idResponsable.nombres,idResponsable.apellidos) like '%$search%' OR idPais.descripcion like '%$search%')";
       	}else{
       		$criteria->condition='t.id_estatus <> 7 and id_donacion <> 1 ';
       	}
       	
 

		$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );
//print_r($criteria); exit;
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
		$criteria->with=array('idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos'),'idCotizacion.idResponsable'=>array('select'=>'idCotizacion.idResponsable.nombres,idCotizacion.idResponsable.apellidos'),'idDonacionAdjudicada'=>array('select'=>'idDonacionAdjudicada.id_donacion_adjudicado','condition'=>'idDonacionAdjudicada.id_estatus = 4'));    
		//$criteria->condition='t.id_estatus <> 7 ';

		

		$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

		$this->render('indexAdmin',array('dataProvider' => $dataProvider,
			'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD));
		
	}

	public function actionConciliar($id)
	{
		
      	$model=$this->loadModel($id);
      	$criteria = new CDbCriteria();
		$size=10;
		$criteria->select = array('*');
		//$criteria->with=array('idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos'),'idCotizacion.idResponsable'=>array('select'=>'idCotizacion.idResponsable.nombres,idCotizacion.idResponsable.apellidos'));    
		$criteria->condition='t.id_estatus = 4 and t.id_donacion='.$id;

		

		$dataProvider = new CActiveDataProvider( 'TDonacionAdjudicado', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

      	$formConciliar = $this->renderPartial('conciliar', array('model'=>$model,'dataProvider'=>$dataProvider),true,false);

		echo CJSON::encode(array(				
			'pagos'=> $formConciliar,			
		));

		Yii::app()->end();
	}

	public function actionPagosCerrados($id)
	{
		
      	$model=$this->loadModel($id);
      	$criteria = new CDbCriteria();
		$size=10;
		$criteria->select = array('t.*',
        '(CASE
            WHEN t.id_estatus = 4 THEN 000
            WHEN (t.id_estatus = 3 AND monto_conciliado = 0) THEN monto
            WHEN (t.id_estatus = 3 AND monto_conciliado > 0) THEN monto_conciliado
            END) AS monto_conciliado',           
    ); 
		$criteria->condition='t.id_donacion='.$id;

		

		$dataProvider = new CActiveDataProvider( 'TDonacionAdjudicado', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

      	$formConciliar = $this->renderPartial('pagosCerrados', array('model'=>$model,'dataProvider'=>$dataProvider),true,false);

		echo CJSON::encode(array(				
			'pagos'=> $formConciliar,			
		));

		Yii::app()->end();
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
		Yii::app()->theme = 'bms';
	    $this->layout ='//layouts/portalCliente';

		if ($model->id_estatus == 1){
			$model->foto = !empty($model->foto) ? Yii::app()->request->baseUrl.'/'.$model->foto : $model->foto;

			$modelCoti= TCotizacionController::loadModel($model->id_cotizacion);
			$modelDB=new TDatosBasicos;
			$modelResponsable=new TDatosBasicos;		
			$modelResponsable=TDatosBasicosController::loadModel($modelCoti->id_responsable);
			$modelB=new TBeneficiario;
			$idBeneficiario = TBeneficiario::model()->find('t.id_beneficiario='.$modelCoti->id_beneficiario)->id;
			$modelB=TBeneficiarioController::loadModel($idBeneficiario);


			$this->render('_detalle',array(
				'model'=>$model,'modelCot'=>$modelCoti,'modelResp'=>$modelResponsable,'modelB'=>$modelB
			));
		}else{


			$modelBeneficiario=new TBeneficiario('search');

			$modelCotizacion=new TCotizacion('search');

			$modelDBD=new TDatosBasicosDireccion('search');

			$criteria = new CDbCriteria();
			$criteria->select = array('*');
	       	$criteria->condition='t.id_estatus <> 7 and id_donacion <> 1 ';      	
 

			$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>10,), ) );
			$this->render('index',array('dataProvider' => $dataProvider,
				'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD));
		}
	}

	public function actionOrdenarPor($search='')
	{
		// $dataProvider=new CActiveDataProvider('TProducto');

		$criteria = new CDbCriteria();
		$criteriaCat = new CDbCriteria();
		$criteriaMarca = new CDbCriteria();
		$catCount=[];
		$marcaCount=[];
		//$search=$_GET['search'];
		$tipo=isset($_GET['tipo']) ? $_GET['tipo'] : '';
		$marca=isset($_GET['marca']) ? $_GET['marca'] : '';
		$size=isset($_GET['size']) ? $_GET['size'] : 18;


		$criteria = new CDbCriteria();
		$criteria->select = array('*');

		if ($tipo!==''){

			$criteria->with=array('idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos'),'idCotizacion.idResponsable'=>array('select'=>'idCotizacion.idResponsable.nombres,idCotizacion.idResponsable.apellidos'),'idCotizacion.idCarrito.idDatosBasicosDireccion.idPais'=>array('select'=>'idCotizacion.idCarrito.idDatosBasicosDireccion.idPais.descripcion'));

			switch ($tipo) {
				case 'responsable':
					$criteria->order='idResponsable.nombres,idResponsable.apellidos Desc';
					break;
				case 'beneficiario':
					$criteria->order='idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos';
					break;
				case 'pais':
					$criteria->order='idPais.descripcion';
					break;
			}
		}


		$criteria->condition='t.id_estatus <> 7';

		$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

	
        $gridProductos = $this->renderPartial('admin', array( 'dataProvider' => $dataProvider),true,false);

        $salidaCat='';
        $salidaMarca='';

	      
			echo CJSON::encode(array(	
				'salida' => "OK",			
				'catCount' => $salidaCat,
				'marcaCount' => $salidaMarca,
				'gridProductos'=>$gridProductos
			));
			Yii::app()->end();
		//}
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
