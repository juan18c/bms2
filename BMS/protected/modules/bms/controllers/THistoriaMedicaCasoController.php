<?php

class THistoriaMedicaCasoController extends Controller
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
				'actions'=>array('create','update','delete','deleteCaso'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','deleteCaso'),
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
		$model=new THistoriaMedicaCaso;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['THistoriaMedicaCaso']))
		{
			$model->attributes=$_POST['THistoriaMedicaCaso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_historia_medica_caso));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['THistoriaMedicaCaso']))
		{
			$model->attributes=$_POST['THistoriaMedicaCaso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_historia_medica_caso));
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteCaso($id)
	{		
		//BORRA EL DOCUMENTO
		$idDocumento=THistoriaMedicaDocumento::model()->find('t.id_historia_medica_caso='.$id);
		if (count($idDocumento)>0) {			
			
			unlink(Yii::app()->basePath.'/../'.$idDocumento->ruta);

			THistoriaMedicaDocumentoController::loadModel($idDocumento->id_historia_medica_documento)->delete();
		}		
		
		// BORRA EL MEDICO
		$idMedico=THistoriaMedicaCasoMedico::model()->find('t.id_historia_medica_caso='.$id);
		if (count($idMedico)>0) {
			THistoriaMedicaCasoMedicoController::loadModel($idMedico->id_historia_medica_medico)->delete();
		}

		//BORRA LA HISTORIA CASO		
		$model = $this->loadModel($id);		
		$model->delete();

		echo CJSON::encode(array(	
			'salida' => "ok",			
			'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El documento fue eliminado exitosamente.</div>',				
			'id' => $id		
			//'documento'=>$gridHistoria
		));

		Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('THistoriaMedicaCaso');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new THistoriaMedicaCaso('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['THistoriaMedicaCaso']))
			$model->attributes=$_GET['THistoriaMedicaCaso'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return THistoriaMedicaCaso the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=THistoriaMedicaCaso::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param THistoriaMedicaCaso $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='thistoria-medica-caso-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
