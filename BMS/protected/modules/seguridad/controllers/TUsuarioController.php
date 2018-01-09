<?php

class TUsuarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function init()
    {
       
        Yii::app()->theme = 'admin'; // You can set it there or in config or somewhere else before calling render() method.
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
		$model= new TUsuario;
		$modelRol = new AuthItem;
		$modelDatosBasicos= new TDatosBasicos();
		                    
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
			
		
		if(isset($_POST['TUsuario']))
		{
			

			if (count($_POST['AuthItem']['name'])==0){
				$model->addError('name','Rol no puede ser nulo');
			}else{
							

			$model->attributes=$_POST['TUsuario'];			

			$model->id_persona =$_POST['TDatosBasicos']['id_datos_basicos']; 
		

			if($model->save()){

				$arrayPost = $_POST['AuthItem']['name'];
				foreach ($arrayPost as $clave => $valor) {
					$modelSave = new AuthAssignment;
					$modelSave->userid = $model->id_usuario;
					$modelSave->itemname = $valor;
					$modelSave->data = 1;//strtolower($valor);				
					$modelSave->save();				
				}
				
				$this->redirect(array('view','id'=>$model->id_usuario));
			}else{
				echo "no valido";
			}

		  }
				
		}

		$this->render('create',array(
			'model'=>$model,'modelDatosBasicos'=>$modelDatosBasicos,'modelRol'=>$modelRol
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateNuevo()
	{
		$model=new TUsuario;
		$modelDB= new TDatosBasicos;
		$modelRol = new AuthItem;
		
		/*if(isset($_POST['ajax']) && $_POST['ajax']==='tusuario-form')
		{		
			Yii::app()->end();
		}*/
		
		$this->performAjaxValidation2($model,$modelDB);
		
		
		//echo "entrooooo";
		if((isset($_POST['TUsuario'])) && (isset($_POST['TDatosBasicos'])))
		{
			
			if (empty($_POST['TDatosBasicos']['id_datos_basicos'])){				
				$modelDB->attributes = $_POST['TDatosBasicos'];	
				if 	($_POST['TDatosBasicos']['fecha_nacimiento']==''){
					$modelDB->addError('fecha_nacimiento','Fecha de nacimiento no puede ser nulo');
				}else{
					if ($modelDB->validate()){
						$modelDB->save();
						// Guardar Perfil
						/*$modelPerfil=new TDatosBasicosPerfil();
						$modelPerfil->id_datos_basicos=$modelDB->id_datos_basicos;
						$modelPerfil->id_perfil=1;
						$modelPerfil->id_estatus=1;
						$modelPerfil->save();
						// Guardar Datos Ubicacion
						$modelUbicacion= new TDatosBasicosUbicacion();
						$modelUbicacion->id_datos_basicos=$modelDB->id_datos_basicos;
						$modelUbicacion->id_pais=1;
						$modelUbicacion->id_ciudad=1;
						$modelUbicacion->id_estado=1;
						$modelUbicacion->id_municipio=1;
						$modelUbicacion->id_parroquia=1;
						$modelUbicacion->id_estatus=1;
						$modelUbicacion->email=$_POST['TUsuario']['email'];
						
						if ($modelUbicacion->validate())
							$modelUbicacion->save();*/
						
						// Guardar Usuario
						$model->attributes=$_POST['TUsuario'];
						$model->id_persona=$modelDB->id_datos_basicos;
						$model->save();
						//Guardar Rol
						$modelSave = new AuthAssignment;
						$modelSave->userid = $model->id_usuario;
						$modelSave->itemname ="paciente";//strtolower($valor);
						$modelSave->save();
						
						//echo "save";
						$this->redirect(array('index'));
						Yii::app()->end();
					}
			  }

			}else{
				
				$buscar=TUsuario::model()->findAll('id_persona='.$_POST['TDatosBasicos']['id_datos_basicos']);
				
				if (count($buscar)>0){
					$modelDB->addError('nombres','Ya existe un usuario creado para esta persona');
					//echo "Ya existe un usuario creado para esta persona. Contacte al administrador del sistema o en la opción recuperar clave";
					//echo "existe";
					Yii::app()->end();
					
					//$this->render('createNuevo',array('model'=>$model,'modelDB'=>$modelDB));
				}else{
					
					$model->attributes = $_POST['TUsuario'];					
					$model->id_persona = $_POST['TDatosBasicos']['id_datos_basicos'];
					$idDatosBasicos = $_POST['TDatosBasicos']['id_datos_basicos'];
					//print_r($model);
				}
			}
			//var_dump($model);
			
			if ($model->save()){
				//echo "save";
					//$model->save();
					$modelSave = new AuthAssignment;
					$modelSave->userid = $model->id_usuario;
					$modelSave->itemname ="paciente";//strtolower($valor);
					$modelSave->save();
					//echo "save";
					$this->redirect(array('index'));
					Yii::app()->end();
			}else{
				//echo "error";
				$this->redirect(array('index'));
				//Yii::app()->end();
			}
	
		}
					
		$this->render('createNuevo',array('model'=>$model,'modelDB'=>$modelDB));
	
	}
	
	/**
	 * Realiza la bÃºsqueda de pacientes
	 */
	public function actionBuscarUsuario()
	{
		$criteria = new CDbCriteria;
		$criteria->select = array('id_datos_basicos','nro_identificacion','nombres||\' \'||apellidos AS nombres');
		$criteria->condition = "nombres||' '||apellidos) like :term and titular=0 ";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 30;
		$data = TDatosBasicos::model()->findAll($criteria);
		$perfil=TDatosBasicosPerfil::model()->findAll('id_datos_basicos='.$data[0]->id_datos_basicos);
		if (count($perfil)==0){
			$perfil=null;
		}
		//print_r($perfil);
		$arr = array();
		foreach ($data as $item) {
			
			$arr[] = array(
					'id' => $item->id_datos_basicos,
					'value' => $item->nombres,
					'label' => $item->nombres,
					'perfil'=>$perfil,
			);
		}
		echo CJSON::encode($arr);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$model->confirmar_clave=$model->palabra_clave;
		$modelRol = new AuthItem;
		$modelDatosBasicos= new TDatosBasicos();
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['TUsuario']))
		{
			$model->attributes=$_POST['TUsuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}
	
		$this->render('update',array(
			'model'=>$model,'modelDatosBasicos'=>$modelDatosBasicos,'modelRol'=>$modelRol
		));
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model1=$this->loadModel($id);
		$model1->id_estatus = 2;
		$model1->update();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TUsuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TUsuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TUsuario']))
			$model->attributes = $_GET['TUsuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionExisteEmail($email)
	{
		$model=new TUsuario;
		$resultado= 0;
		$existeUsuario = $model->findAll("t.usuario='$email'");

		if (count($existeUsuario) > 0) {
			$resultado= 1;
		}	

		echo CJSON::encode(array(			
			'status' => $resultado
		));
		Yii::app()->end();	
	}

	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TUsuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TUsuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TUsuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tusuario-form')
		{
			echo CActiveForm::validate(array($model));
			Yii::app()->end();
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param TUsuario $model the model to be validated
	 */
	protected function performAjaxValidation2($model,$modelDB)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tusuario-form')
		{
			echo CActiveForm::validate(array($model,$modelDB));
			Yii::app()->end();
		}
	}
}
