<?php

class TPaisController extends Controller
{
	public function init()
	{
   		
      	Yii::app()->theme = 'principal';

   		parent::init();
	}
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';


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
				'actions'=>array('index','view','updatePaisEstado','updatePaisEstadoEnvio'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','updatePaisEstado'),
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
		$model=new TPais;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TPais']))
		{
			$model->attributes=$_POST['TPais'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_pais));
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

		if(isset($_POST['TPais']))
		{
			$model->attributes=$_POST['TPais'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_pais));
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
		$dataProvider=new CActiveDataProvider('TPais');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TPais('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TPais']))
			$model->attributes=$_GET['TPais'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Modifica los municipios dependiendo del id_estado que recibe	
	 */
	public function actionUpdatePaisEstado()
	{
        $data=TEstados::model()->findAll('id_pais=:id_pais', 
   		array(':id_pais'=>(int) $_POST['id_pais']));
 
   		$data=CHtml::listData($data,'id_estado','descripcion');
 
	    echo "<option value=''>Seleccione un Estado</option>";
	    foreach($data as $value=>$nombre)
	    	echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombre),true);		
    }

	/**
	 * Modifica los estados dependiendo del id_pais que recibe	
	 */
	public function actionUpdatePaisEstadoEnvio()
	{
		$listado=array();
		$envio='';
		//EVALUAR SI EL PAIS APLICA PARA EL ENVÍO
		$paisEnvio=TEnvioPais::model()->findAll('t.id_pais='.$_POST['id_pais']);
		if ( count($paisEnvio) > 0 ) {
			$envio='APLICA';
		}

        $data=TEstados::model()->findAll('id_pais=:id_pais', 
   		array(':id_pais'=>(int) $_POST['id_pais']));
 
   		//$data=CHtml::listData($data,'id_estado','descripcion');
 
	    //$listado.="<option value=''>Seleccione un Estado<\\//option>";
	    foreach ($data as $key => $value) 	    
	    	//$listado.="<option value='".$value->id_estado."'>".$value->descripcion."</option>";	
	    	array_push($listado,array('value'=>$value->id_estado,'descripcion'=>$value->descripcion));

	    echo CJSON::encode(
	    	array(					
				'listado' => $listado,
				'envio'=>$envio
			)
		);

		Yii::app()->end(); 	
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TPais the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TPais::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TPais $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='t-pais-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
