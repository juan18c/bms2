<?php

class TDonacionAdjudicadoController extends Controller
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
				'actions'=>array('create','update','modalDonacionAdjudicado','createAdmin','updateEstatus'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','updateEstatus'),
				'users'=>array('*'),
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
		$model=new TDonacionAdjudicado;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TDonacionAdjudicado']))
		{
			//if ((Yii::app()->user->getState('id_rol') == 'admin')){
			$transaction = $model->dbConnection->beginTransaction();

			$model->attributes=$_POST['TDonacionAdjudicado'];
			//$model->id_donador=Yii::app()->user->id_persona;
			if ($model->validate()){
				$model->id_estatus=4; // estatus para conciliar
				$model->save(true);
				//Buscar si este usuario tiene un pote en Credito Donacion para hacer el debito de lo que esta donando
				if ($model->id_medio_pago==6){
					$modelCreditoDonacion=TCreditoDonacion::model()->find('id_usuario='.Yii::app()->user->id);

					if(is_null($modelCreditoDonacion)){

						$modelCreditoDonacion = new TCreditoDonacion;
						$modelCreditoDonacion->monto_disponible=0;
						$modelCreditoDonacion->id_usuario=Yii::app()->user->id;
						$modelCreditoDonacion->id_estatus=1;
						$modelCreditoDonacion->save();
						//$model->addError('monto','No tiene suficiente Credito para su Donación, verifique sus montos');
						$error ='{"TDonacionAdjudicado_monto":["No tiene suficiente Credito para su Donación, verifique su monto disponible"]}';//CActiveForm::validate(array($model));
						//print_r($error);
		            	if($error!='[]')
		                echo $error;
		                $transaction->rollback();
		         		Yii::app()->end();
					}else{
						if ($modelCreditoDonacion->monto_disponible < $model->monto){
							$error = '{"TDonacionAdjudicado_monto":["No tiene suficiente Credito para su Donación, verifique su monto disponible"]}';
			            	if($error!='[]')
			                	echo $error;
			         		Yii::app()->end();
						}else{							
							$modelCreditoDonacion->monto_disponible=$modelCreditoDonacion->monto_disponible-$model->monto;
							$modelCreditoDonacion->save();
						}
					}
				}elseif ($model->id_medio_pago==1 && $_POST['TDonacionAdjudicado']['email']=='') {
					$error = '{"TDonacionAdjudicado_email":["Este Campo Email no puede ser nulo."]}';
			            	if($error!='[]')
			                	echo $error;
			         		Yii::app()->end();
				}elseif ($model->id_medio_pago==4) {
					if ($_POST['TDonacionAdjudicado']['nombre_banco']==''){
						$error = '{"TDonacionAdjudicado_nombre_banco":["Este Campo no puede ser nulo."]}';
					}elseif ($_POST['TDonacionAdjudicado']['numero_cuenta']=='') {
						$error = '{"TDonacionAdjudicado_numero_cuenta":["Este Campo no puede ser nulo."]}';
					}elseif ($_POST['TDonacionAdjudicado']['numero_ruta_bancaria']=='') {
						$error = '{"TDonacionAdjudicado_numero_ruta_bancaria":["Este campo no puede ser nulo."]}';
					}
	            	if($error!='[]')
	                	echo $error;
	         		Yii::app()->end();
				}
				
				$modelDonacionMov=new TDonacionMovimiento();
				$modelDonacionMov->id_donacion_adjudicado=$model->id_donacion_adjudicado;
				$modelDonacionMov->monto_debito = $model->monto; /* Cuando esta donando */
				$modelDonacionMov->monto_credito =0;
				$modelDonacionMov->id_estatus = 1;
				$modelDonacionMov->id_usuario = Yii::app()->user->id; // cuando le donas a un caso 
				$modelDonacionMov->id_orden =null; // cuando se compra
				$modelDonacionMov->save();

				$transaction->commit();
				/***/
				echo CJSON::encode(array(
					'salida' => 'completo',
					'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> Gracias por su donación.</div>',
					'option' => ''
				));
				Yii::app()->end();
			}else{
				$error = CActiveForm::validate(array($model));
            	if($error!='[]')
                	echo $error;
         		Yii::app()->end();
			}

		}

		$this->render('create',array(
			'model'=>$model,'modelCaso'=>$_GET['id']
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */	
	public function actionCreateAdmin($id)
	{
		$model=new TDonacionAdjudicado;


 		$formCot =	$this->renderPartial('_form', array('model'=>$model,'modelCaso'=>$_GET['id']),true,false); 

		echo CJSON::encode(array(	
			'dona' => $formCot,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TDonacionAdjudicado']))
		{
			$model->attributes=$_POST['TDonacionAdjudicado'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_donacion_adjudicado));
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
		$dataProvider=new CActiveDataProvider('TDonacionAdjudicado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//echo "entro";
		$model=new TDonacionAdjudicado('search');
		//print_r($model);
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['TDonacionAdjudicado']))
			$model->attributes=$_GET['TDonacionAdjudicado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionModalDonacionAdjudicado($id)
	{
		if (empty($id)) {
			$modelCaso=new TDonacion;
		}else $modelCaso=TDonacionController::loadModel($id);

		$model= new tDonacionAdjudicado;
		$formCot = $this->renderPartial('application.modules.bms.views.tDonacionAdjudicado._form',array('model'=>$model,'modelCaso'=>$modelCaso),true,false); 


		echo CJSON::encode(array(	
			'dona' => $formCot,
		));

		Yii::app()->end();

	}

	public function actionUpdateEstatus()
	{

		foreach ($_POST['autoId'] as $key => $value) {
			$id = explode("-", $value);
			$model=$this->loadModel($id[1]);
			$this->performAjaxValidation($model);
			$model->id_estatus=3;			
			$id_caso=$model->id_donacion;
			$id_usuario= TDonacion::model()->findByPk($id_caso)->id_usuario;

			if (array_key_exists('monto-'.$id[1], $_POST)) {
			    $monto_fin=$_POST['monto-'.$id[1]];
			}else{
				$monto_fin=$model->monto;
			}
			$model->monto_conciliado=$monto_fin;
			$model->save();	
			$modelDonacionMov=new TDonacionMovimiento();
			$modelDonacionMov->id_donacion_adjudicado=$model->id_donacion_adjudicado;
			$modelDonacionMov->monto_debito = 0; /* Cuando esta donando */
			$modelDonacionMov->monto_credito =$monto_fin;
			$modelDonacionMov->id_estatus = 1;
			$modelDonacionMov->id_usuario =$id_usuario; // cuando le donas a un caso 
			$modelDonacionMov->id_orden =null; // cuando se compra
			$modelDonacionMov->save();
		}

		$modelCaso=TDonacionController::loadModel($id_caso);	
		$modelCaso->monto_acumulado=$_POST['TDonacion']['monto_conciliado'];
		if ($modelCaso->monto_acumulado >= $modelCaso->monto_solicitado)
			$modelCaso->id_estatus=7;
		$modelCaso->save();
		
		$CreditoDona=TCreditoDonacion::model()->findAll('id_usuario='.$id_usuario);
		if (count($CreditoDona) > 0){
			$modelCreditoDonacion=TCreditoDonacionController::loadModel($CreditoDona[0]->id_credito_donacion);
			$modelCreditoDonacion->monto_disponible=$modelCreditoDonacion->monto_disponible + $_POST['TDonacion']['monto_conciliado'];
			$modelCreditoDonacion->save();			
		}else{
			$modelCreditoDonacion = new TCreditoDonacion;
			$modelCreditoDonacion->monto_disponible=$_POST['TDonacion']['monto_conciliado'];
			$modelCreditoDonacion->id_usuario=$id_usuario;
			$modelCreditoDonacion->id_estatus=1;
			if ($modelCreditoDonacion->validate()){
				$modelCreditoDonacion->save();
			}			
		}

		echo CJSON::encode(array(
			'salida' => 'COMPLETO',					
		));
		Yii::app()->end();
			
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TDonacionAdjudicado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TDonacionAdjudicado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TDonacionAdjudicado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tdonacion-adjudicado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
