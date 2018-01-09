<?php

class TImagenLoginUsuarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
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
	/*public function accessRules()
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
	}*/

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
		$model= new TImagenLoginUsuario;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['TImagenLoginUsuario']))
		{
			$model->attributes=$_POST['TImagenLoginUsuario'];
			
			//Validar si quedan clinicas por imagen
			//ReValidar la imagen seleccionada por la clinica

			if ($model->reValid == 0){				
				$model->reValid = 1;
				$this->render('create',array(
					'model'=>$model
				));
				exit;
			}else{				
				if ($model->imagenSelec == $model->id_imagen){
					if($model->save()){
						Yii::app()->user->setState('id_clinica',$_POST['TImagenLoginUsuario']['id_entidad'],true);
						$id_empleado=Yii::app()->user->getState('id_empleado');
						if (!isset($id_empleado)){						
							Yii::import('application.modules.Administrativo.models.TAgenda'); //ojoooo
							$modelAgenda=new TAgenda;
							$modelAgenda->id_medico=Yii::app()->user->getState('id_medico');
							$modelAgenda->id_entidad=$_POST['TImagenLoginUsuario']['id_entidad'];
							$modelAgenda->id_estatus=1;
							$modelAgenda->descripcion="Agenda Clinica";
							if($modelAgenda->save()){
								Yii::app()->user->setState('id_agenda',$modelAgenda->id_agenda,true);
	
							}
						}
						Yii::app()->clientScript->registerScript('testscript',"
    								$('#mobile-nav').show();
						",CClientScript::POS_READY);
						$this->redirect(Yii::app()->createUrl('Seguridad/'));
						exit;
					}else{
						$model->addError('id_imagen','<div class="alert alert-error">Error al guardar en la BD.</div>');
					}
				}else{									
					$model->addError('id_imagen','<div class="alert alert-error">Debe Seleccionar la misma imagen que la anterior. Vuelva a Intentarlo. </div>');
				}

			}			
			
		}
		//echo "entrooo";
		$model->reValid = 0;
		$model->id_usuario = Yii::app()->session['_id'];
		$this->render('create',array(
			'model'=>$model
		));
	}
	
	
	public function actionBuscarImagenClinica($id_entidad)
	{
		$existe = null;
		if ($id_entidad != ''){
			$existe=TImagenLoginUsuario::model()->findAll('t.id_usuario='.Yii::app()->session['_id'].' and id_entidad='.$id_entidad);

			if (count($existe) > 0){
				echo  1;
					
			}else{
				echo  0;
			}
		}else{
			return 0;
		}
	
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEntrar()
	{
		$model= new TImagenLoginUsuario;
		$modelUsuario = new TUsuario();
		Yii::import('application.modules.Administrativo.models.TAgenda'); //ojoooo
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['TImagenLoginUsuario']))
		{
			$model->attributes = $_POST['TImagenLoginUsuario'];
				
			//Validar si quedan clinicas por imagen
			//ReValidar la imagen seleccionada por la clinica
	
			if ($model->reValid == 0){
				$model->reValid = 1;
				if ($_POST['TImagenLoginUsuario']['existeImagenClinica'] == 1){
					$model->existeImagenClinica = $_POST['TImagenLoginUsuario']['existeImagenClinica'];
					$existe=TImagenLoginUsuario::model()->verificarImagen($model->id_imagen,$_POST['TImagenLoginUsuario']['id_entidad']);
					if ($existe == 1){
						$empleado= Yii::app()->user->getState('id_empleado');
						if (isset($empleado)){
							Yii::app()->user->setState('id_clinica',$_POST['TImagenLoginUsuario']['id_entidad'],true);
							Yii::app()->clientScript->registerScript('testscript',"
	    								$('#mobile-nav').show();
							",CClientScript::POS_READY);
							/* verificar si la enfermera esta activa para ese turno */
							$rol=Yii::app()->user->getState('id_rol');						
							if ($rol == "enfermera"){
								$idTurno =Yii::app()->user->getState('id_turno');
								$activa = $modelUsuario->verificarAccessoEnfermera($idTurno,Yii::app()->user->getState('id_persona'));
								if (!$activa){
									$model->addError('id_imagen','<div class="alert alert-error">No esta activo para este Turno, comuniquese con su Coordinador.</div>');
									$model->existeImagenClinica=1;
									$model->reValid = 0;
								}else{
									$this->redirect(Yii::app()->createUrl('Seguridad/'));
								}
							}else{
								$this->redirect(Yii::app()->createUrl('Seguridad/'));
							}
						}else{
							$modelAgenda=TAgenda::model()->find('id_medico = '.Yii::app()->user->getState('id_medico').' and id_entidad='.$_POST['TImagenLoginUsuario']['id_entidad']);
							Yii::app()->user->setState('id_clinica',$_POST['TImagenLoginUsuario']['id_entidad'],true);
							Yii::app()->user->setState('id_agenda',$modelAgenda->id_agenda,true);
							Yii::app()->clientScript->registerScript('testscript',"
	    								$('#mobile-nav').show();
							",CClientScript::POS_READY);
							$this->redirect(Yii::app()->createUrl('Seguridad/'));
						}
						//$this->redirect(Yii::app()->createUrl('Seguridad/'));
					}else{
						$intentos=Yii::app()->user->getState('intentos_fallidos');
						Yii::app()->user->setState('intentos_fallidos',$intentos+1);
						echo "".Yii::app()->user->getState('intentos_fallidos');
						if (Yii::app()->user->getState('intentos_fallidos')==3){
							$model->addError('id_imagen','<div class="alert alert-error">Supero los 3 intentos fallidos para entrar al sistema. Contacte al administrador.</div>');
							//Yii::app()->user->logout();
						}else{
							$model->addError('id_imagen','<div class="alert alert-error">La imagen seleccionada no corresponde a la imagen de seguridad de la clinica. Vuelva a seleccionar la imagen correcta </div>');
						}
						//$model->addError('id_imagen','<div class="alert alert-error">La imagen seleccionada no corresponde a la imagen de seguridad de la clinica. Vuelva a seleccionar la imagen correcta</div>');
						$model->existeImagenClinica=1;
						$model->reValid = 0;
					}

				}
				$this->render('entrar',array(
						'model'=>$model
				));
				exit;			
				
			}else{				
					if ($model->imagenSelec == $model->id_imagen){
						if ($model->validate()){
							$model->addError('id_imagen','<div class="alert alert-error">Se creó satisfactoriamente la imagen de seguridad para la clínica seleccionada.</div>');
							$model->save();
							Yii::app()->user->setState('id_clinica',$_POST['TImagenLoginUsuario']['id_entidad'],true);
							$medico=Yii::app()->user->getState('id_medico');
							if (isset($medico)){
								$modelAgenda=new TAgenda;
								$modelAgenda->id_medico=Yii::app()->user->getState('id_medico');
								$modelAgenda->id_entidad=$_POST['TImagenLoginUsuario']['id_entidad'];
								$modelAgenda->id_estatus=1;
								$modelAgenda->descripcion="Agenda Clinica";
								if($modelAgenda->save()){
									Yii::app()->user->setState('id_agenda',$modelAgenda->id_agenda,true);
									
								}
							}
							$this->redirect(Yii::app()->createUrl('Seguridad/'));							
						}else{
							$model->addError('id_imagen','<div class="alert alert-error">Ya existe una imagen creada para la clinica seleccionada. </div>');
						}
					}else{
						$model->addError('id_imagen','<div class="alert alert-error">Debe Seleccionar la misma imagen que la anterior. Vuelva a Intentarlo. </div>');
					}
				
	
			}
				
		}
	
		$model->reValid = 0;
		$model->id_usuario = Yii::app()->session['_id'];
		$this->render('entrar',array(
				'model'=>$model
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

		if(isset($_POST['TImagenLoginUsuario']))
		{
			$model->attributes=$_POST['TImagenLoginUsuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_imagen_login_usuario));
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
		$dataProvider=new CActiveDataProvider('TImagenLoginUsuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TImagenLoginUsuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TImagenLoginUsuario']))
			$model->attributes=$_GET['TImagenLoginUsuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TImagenLoginUsuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TImagenLoginUsuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TImagenLoginUsuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='timagen-login-usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
