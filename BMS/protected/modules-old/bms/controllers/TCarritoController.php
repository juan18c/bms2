<?php

class TCarritoController extends Controller
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
				'actions'=>array('create','update'),
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
		$model=new TCarrito;
		$modelCartDet = new TCarritoDetalle;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{
			$idProd = $_POST['idP'];
			$cantidad = $_POST['c'];
			$precio = $_POST['p'];

			$carrito = $model->find('t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL '); //VALIDAR CONTRA VARIABLE DE SESION
			if (count($carrito) > 0) {
				$modelCartDet->id_carrito = $carrito->id_carrito;
				$modelCartDet->id_producto = $idProd;
				$modelCartDet->cantidad = $cantidad;
				$modelCartDet->precio = $precio;

				$carritoDet = $modelCartDet->find('t.id_producto = '.$idProd.' AND t.id_carrito = '.$carrito->id_carrito.' AND t.id_estatus = 1');
				if (count($carritoDet) > 0) {
					$modelCartDet->setScenario('update'); 
					$modelCartDetUpdate = TCarritoDetalleController::loadModel($carritoDet->id_carrito_detalle);
					$modelCartDetUpdate->cantidad = $modelCartDetUpdate->cantidad + $modelCartDet->cantidad;

					$modelCartDetUpdate->precio = $precio;
					
					if ($modelCartDetUpdate->save()) {
						$guardarDet = 1;
					}
				}else{					
					$modelCartDet->setScenario('insert'); 
					if ($modelCartDet->save()) {
						$guardarDet = 1;
					}
				}
			}else{

				$model->id_datos_basicos = Yii::app()->user->id_persona; //VALIDAR CONTRA VARIABLE DE SESION
				if ($model->save()) {
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
		        $criteriaTotal->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';

			    $totalProducto = TCarrito::model()->find($criteriaTotal)->items;

				$criteria=new CDbCriteria;
                $criteria->select = array('sum((`tInventarios`.`precio`) * `tCarritoDetalles`.`cantidad` ) as total');
                $criteria->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
                $criteria->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';
				$totalCarrito = $model->find($criteria)->total;

				
				echo CJSON::encode(array(
					'totalProducto' => $totalProducto,
					'totalCarrito' => $totalCarrito					
				));
			}
			
			//$model->attributes=$_POST['TCarrito'];
			//if($model->save())
				//$this->redirect(array('view','id'=>$model->id_carrito));

		}

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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TCarrito']))
		{
			$model->attributes=$_POST['TCarrito'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_carrito));
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
		$dataProvider=new CActiveDataProvider('TCarrito');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TCarrito('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TCarrito']))
			$model->attributes=$_GET['TCarrito'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TCarrito the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TCarrito::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TCarrito $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tcarrito-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
