<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		Yii::import('seguridad.models.*');
		Yii::import('seguridad.controllers.*');
		Yii::import('seguridad.views.*');
		Yii::import('catalogo.models.*');
		Yii::import('catalogo.controllers.*');
		Yii::import('catalogo.views.*');
		Yii::import('configuracion.models.*');
		Yii::import('configuracion.controllers.*');
		Yii::import('configuracion.views.*');
		Yii::import('bms.models.*');
		Yii::import('bms.controllers.*');
		Yii::import('bms.views.*');
		//Yii::import('Administrativo.models.*');
		//Yii::import('Administrativo.controllers.*');
		//Yii::import('Administrativo.views.*');
		/*Yii::import('Esculapio.models.*');
		Yii::import('Esculapio.controllers.*');*/
		
		$model= new LoginForm();
		$modelUsuario = new TUsuario;
		$modelDB  = new TDatosBasicos;
		$modelDireccion = new  TDatosBasicosDireccion;
		
		if (Yii::app()->user->isGuest){

			$this->performAjaxValidation(array($modelUsuario,$modelDB));

			if(isset($_POST['TUsuario']) && isset($_POST['TDatosBasicos'])) {

				$modelDB->attributes=$_POST['TDatosBasicos'];
				$modelDB->email = $_POST['TUsuario']['usuario'];
				//$modelDB->observacion = 'NO APLICA';
				//$modelDB->edad_posible = 0;

				$modelUsuario->attributes=$_POST['TUsuario'];
				$valid = $modelUsuario->validate();
				$valid = $modelDB->validate() && $valid;				
				if($valid){    

					if (empty($_POST['TDatosBasicos']['id_datos_basicos'])){

						$modelDB->attributes = $_POST['TDatosBasicos'];						
						
						/*if 	($_POST['TDatosBasicos']['fecha_nacimiento']==''){
							$modelDB->addError('fecha_nacimiento','Fecha de nacimiento no puede ser nulo');
						}else{*/
							$modelUsuario->attributes=$_POST['TUsuario'];
							$valid = $modelUsuario->validate();
							$valid = $modelDB->validate(); //&& $valid;
							if (($modelDB->validate()) && ($valid)){
								$modelDB->id_estatus=1;
								$modelDB->ind_medico=0;

								if(!empty($_POST['origen'])){ /*verificar si es donador*/
									$modelDB->id_perfil=8; 
								}else{
									$modelDB->id_perfil=1;	/*cliente por defecto*/			
								}
								
								$modelDB->save();
								// guardar usuario
								//$modelUsuario->attributes=$_POST['TUsuario'];
								$modelUsuario->id_persona=$modelDB->id_datos_basicos;
								if ($modelUsuario->validate()){
									$modelUsuario->save();
									//Guardar Direccion
									$modelDireccion= new TDatosBasicosDireccion; 									
									$modelDireccion->attributes = $_POST['TDatosBasicosDireccion'];
									$modelDireccion->id_datos_basicos  = $modelDB->id_datos_basicos;
									$modelDireccion->id_tipo_direccion = 1;
									if ($modelDireccion->validate())
										$modelDireccion->save();
									else{
										$error = CActiveForm::validate(array($modelDireccion));
				                    	if($error!='[]')
				                        	echo $error;

				                 		Yii::app()->end();
									}

									//Guardar Rol
									$modelSave = new AuthAssignment;
									$modelSave->userid = $modelUsuario->id_usuario;
									if (!empty($_POST['origen'])){ 
										$modelSave->itemname ="donador"; 
										Yii::app()->user->setState('idDonacion',$_POST['origen']);
									}else{
										$modelSave->itemname ="cliente"; //strtolower($valor);
									}

									$modelSave->data = 1;
									if ($modelSave->save()){
										echo CJSON::encode(array(
	                                  		'status'=>'success'
	                             		));
	                           			 Yii::app()->end();	
                           			}else{
                           			 	$error = CActiveForm::validate(array($modelUsuario));
				                    	if($error!='[]')
				                        	echo $error;				                     
				                 		Yii::app()->end();
                           			}			

								}else{
									$error = CActiveForm::validate(array($modelUsuario));
				                    if($error!='[]')
				                        echo $error;				                     
				                 	Yii::app()->end();
								}
						}

		
					} else {
						
						$buscar=TUsuario::model()->findAll('t.id_persona='.$_POST['TDatosBasicos']['id_datos_basicos']);
				
						if (count($buscar)>0){
							//$modelDB->addError('nombres','Ya existe un usuario creado para esta persona');
							 $error=CJSON::encode(array(
                                  'TUsuario_usuario'=>["ya existe un usuario creado para esta persona."]
                             ));

		                    if($error!=='[]')
		                        echo $error;
		                 	Yii::app()->end();

						}else{
				
							$modelUsuario->attributes = $_POST['TUsuario'];
							$modelUsuario->id_estatus=1;
							$modelUsuario->id_persona = $_POST['TDatosBasicos']['id_datos_basicos'];
							$idDatosBasicos = $_POST['TDatosBasicos']['id_datos_basicos'];
							if ($modelUsuario->validate()){
								$modelUsuario->save();
								$modelSave = new AuthAssignment;
								$modelSave->userid = $modelUsuario->id_usuario;
								if (!empty($_POST['origen'])) 
									$modelSave->itemname ="donador";//strtolower($valor);
								else
									$modelSave->itemname ="cliente";//strtolower($valor);
								$modelSave->data=1;
								$modelSave->save();									

								echo CJSON::encode(array(
                                	'status'=>'success'
                             	));
                           		Yii::app()->end();	
								//$this->render('index',array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB));
								
							}else{
								$error = CActiveForm::validate(array($modelUsuario));

			                    if($error!='[]')
			                        echo $error;
			                     
			                 	Yii::app()->end();

							}
						}
					}	
				 }else{
				 	$error = CActiveForm::validate(array($modelUsuario,$modelDB));

			        if($error!='[]')
			            echo $error;
			                     
			        Yii::app()->end();
				 }				
			}//end issets
			//print_r($modelUsuario);exit;
        	$this->render('index',array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB,'modelDireccion'=>$modelDireccion));

        } else {
        	//cuando esta logeado el usuario
        	$this->render('index',array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB,'modelDireccion'=>$modelDireccion));
        }

	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionRecuperar()
	{
		Yii::import('seguridad.models.*');
		Yii::import('seguridad.controllers.*');
		Yii::import('seguridad.views.*');
		Yii::import('Administrativo.models.*');
		Yii::import('Administrativo.controllers.*');
		Yii::import('Administrativo.views.*');
		Yii::import('Esculapio.models.*');
		Yii::import('Esculapio.controllers.*');
		
		
		$model = new LoginForm();
		$modelDB  = new TDatosBasicos;
		$modelUsuario= new TUsuario;

		if (Yii::app()->user->isGuest){

			$this->performAjaxValidation(array($modelUsuario));

			if(isset($_POST['TUsuario'])) {

				$modelUsuario->attributes=$_POST['TUsuario'];

				if (empty($_POST['TUsuario']['email'])){
							 $error=CJSON::encode(array(
                                  'TUsuario_email'=>["Debe ingresar su correo electronico."]
                             ));
		                    if($error!=='[]')
		                        echo $error;
		                 	Yii::app()->end();
				}else{
					$buscar=TUsuario::model()->findAll("usuario='".$_POST['TUsuario']['usuario']."'");
					
						if (count($buscar)>0){
							$modelPersona=TDatosBasicos::model()->with('tDatosBasicosUbicacions')->findByPk($buscar[0]->id_persona);
							
							$correo_registrado=$modelPersona->tDatosBasicosUbicacions[0]->email;
							//echo "--".$_POST['TUsuario']['email']."=".$correo_registrado;
							if ($correo_registrado===$_POST['TUsuario']['email']){
								/*ojo enviar correo */
								echo CJSON::encode(array(
                                	'status'=>'recuperado'
                             	));
                             	Yii::app()->end();
							}else{
								$error=CJSON::encode(array(
                                  'TUsuario_email'=>["No es el correo que se encuentra registrado en nuestro sistema. Consulte con el administrador."]
                             	));

		                    	if($error!=='[]')
		                        	echo $error;
		                 		Yii::app()->end();
							}
		                }else{
		                	$error=CJSON::encode(array(
                                  'TUsuario_usuario'=>["El usuario no existe."]
                             ));
		                    if($error!=='[]')
		                        echo $error;
		                 	Yii::app()->end();
		                }
				}
			}
			$this->render('index',array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB));
		} else {
        	//cuando esta logeado el usuario
        	$this->render('index',array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB));
        } 
	}



	public function actionBuscarUsuario()
	{
		Yii::import('bms.models.*');
		Yii::import('bms.controllers.*');

		if ($_POST['TDatosBasicos']['nro_identificacion'] == null){
			$error=CJSON::encode(array(
                  'TDatosBasicos_nro_identificacion'=>["Introduzca el número de cédula."]
            ));
		    if($error!=='[]')
		    echo $error;
		    Yii::app()->end();
		}


		$criteria = new CDbCriteria;
		$criteria->select = array('t.id_datos_basicos','t.nro_identificacion','initcap(t.nombres) AS nombres','initcap(t.apellidos) AS apellidos','t.fecha_nacimiento','t.sexo','t.id_estado_civil');	
		$criteria->condition = "t.nro_identificacion = :term and t.id_tipo_identificacion= :term2";
		$criteria->params = array(':term'=> $_POST['TDatosBasicos']['nro_identificacion'],':term2'=> $_POST['TDatosBasicos']['id_tipo_identificacion'],);
		//$criteria->limit = 30;
		$data = TDatosBasicos::model()->with('tDatosBasicosUbicacions')->findAll($criteria);
		if (count($data)>0){
			$arr = array();
			foreach ($data as $item) {
				//print_r($data);
				if ($item->tDatosBasicosUbicacions[0]->email!=null){
					$correo=$item->tDatosBasicosUbicacions[0]->email;
				}else{
					$correo="";
				}

				$arr[] = array(
					//'id' => $item->id_datos_basicos,
					'nombre' => $item->nombres,
					'apellido' => $item->apellidos,
					'fecha'=> $item->fecha_nacimiento,
					'sexo'=> $item->sexo,
					'civil'=> $item->id_estado_civil,
					'correo'=> $correo,
					'id_datos_basicos'=>$item->id_datos_basicos,
				);
			}
			//echo "bien";*/
		}else{
			$error=CJSON::encode(array(
                  'TDatosBasicos_nro_identificacion'=>["Introduzca sus datos para crear su usuario."]
            ));
		    if($error!=='[]')
		        echo $error;
		    Yii::app()->end();
		}
		
		echo CJSON::encode($arr);	    
	} 

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		Yii::app()->theme = 'principal';	
		$this->layout='column2';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContacto()
	{				
		$model=new ContactForm;

		//////////////////////////
//Specify default values//
//////////////////////////

//Your E-mail
$your_email = Yii::app()->params['adminEmail'];

//Default Subject if 'subject' field not specified
$default_subject = 'From My Contact Form';

//Message if 'name' field not specified
$name_not_specified = 'Please type a valid name';

//Message if 'message' field not specified
$message_not_specified = 'Please type a vaild message';

//Message if e-mail sent successfully
$email_was_sent = 'Thanks, your message successfully sent';

//Message if e-mail not sent (server not configured)
//$server_not_configured = 'Sorry, mail server not configured';
$server_not_configured = 'Error en la configuracion del servidor de correos. Por favor notifique al administrador de la pagina.';


///////////////////////////
//Contact Form Processing//
///////////////////////////
$errors = array();
if(isset($_POST['message']) and isset($_POST['name'])) {
	if(!empty($_POST['name']))
		$sender_name  = stripslashes(strip_tags(trim($_POST['name'])));
	
	if(!empty($_POST['message']))
		$message      = stripslashes(strip_tags(trim($_POST['message'])));
	
	if(!empty($_POST['email']))
		$sender_email = stripslashes(strip_tags(trim($_POST['email'])));
	
	if(!empty($_POST['subject']))
		$subject      = stripslashes(strip_tags(trim($_POST['subject'])));


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$errors[] = $name_not_specified;
	}

	//Message if no message was specified
	if(empty($message)) {
		$errors[] = $message_not_specified;
	}

	$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';

	$subject = (!empty($subject)) ? $subject : $default_subject;

	$message = (!empty($message)) ? wordwrap($message, 70) : '';

	//sending message if no errors
	if(empty($errors)) {
		if (mail($your_email, $subject, $message, $from)) {
			echo $email_was_sent;
		} else {
			$errors[] = $server_not_configured;
			echo implode('<br>', $errors );
		}
	} else {
		echo implode('<br>', $errors );
	}
} else {
	// if "name" or "message" vars not send ('name' attribute of contact form input fields was changed)
	echo '"name" and "message" variables were not received by server. Please check "name" attributes for your input fields';
}


		// if(isset($_POST['ContactForm']))
		// {
		// 	$model->attributes=$_POST['ContactForm'];

		// 	if($model->validate())
		// 	{	
		// 		$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
		// 		$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
		// 		$headers="From: $name <{$model->email}>\r\n".
		// 			"Reply-To: {$model->email}\r\n".
		// 			"MIME-Version: 1.0\r\n".
		// 			"Content-type: text/plain; charset=UTF-8";

		// 		mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);

		// 		echo "ok";

		// 		Yii::app()->end();
		// 	}

		// 	echo "not";
			
			Yii::app()->end();
		//}
		
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		Yii::import('seguridad.models.*');
		Yii::import('seguridad.controllers.*');
		Yii::import('bms.models.*');
		Yii::import('bms.controllers.*');
		Yii::import('catalogo.models.*');
		Yii::import('catalogo.controllers.*');
		Yii::import('configuracion.models.*');
		Yii::import('configuracion.controllers.*');
		
		$model=new LoginForm;
		$modelUsuario=new TUsuario;
		$modelDB= new TDatosBasicos;
		$activa= false;
		
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{			
			$this->render('login',array(
				'model'=>$model
			));
			//Yii::app()->end();
		}
		
		if (Yii::app()->user->isGuest){
		//	echo "is guest";
		// collect user input data
			if(isset($_POST['LoginForm']))
			{			
			//echo "---".Yii::app()->user->isGuest; exit();	
				$model->attributes= $_POST['LoginForm'];
				
				// validate user input and redirect to the previous page if valid

				if (($model->loginUser())&&($model->validate()))
				{						
					/* validar si el usuario ya tiene imagen de entrada para la clinica seleccionada sino mandarlo a crearla */
					Yii::app()->theme = 'principal';
					
					if ((Yii::app()->user->getState('id_rol') == 'admin')){ 
						/*$modelLoginUsuario = TImagenLoginUsuario::model()->find("id_usuario = ".Yii::app()->session['_id']);
						$usuario=TUsuario::model()->findByPk(Yii::app()->session['_id']);
						if (empty($modelLoginUsuario)){*/
							Yii::app()->user->setState('intentos_fallidos',0);
							//echo "rol:".Yii::app()->user->getState('id_rol');
							echo CJSON::encode(array(

									'status'=>Yii::app()->createUrl('bms')
							));
							Yii::app()->end();
							//$this->redirect(Yii::app()->createUrl('seguridad/TImagenLoginUsuario/create'));
						/*}else{
							Yii::app()->user->setState('intentos_fallidos',0);
							echo CJSON::encode(array(
									'status'=>'index.php?r=seguridad/TImagenLoginUsuario/entrar'
							));
							Yii::app()->end();
							//$this->redirect(Yii::app()->createUrl('seguridad/TImagenLoginUsuario/entrar'));
								
						}	*/
					}else if ((Yii::app()->user->getState('id_rol') == 'donador')){
						// /bms/index.php/donacion
						if (!empty(Yii::app()->user->getState('idDonacion'))){
							$id=Yii::app()->user->getState('idDonacion');
							echo CJSON::encode(array(
							'status'=>Yii::app()->createUrl('bms/TDonacion/detalleDonacion/id/'.$id),
							));
						}else{
							echo CJSON::encode(array(
							'status'=>Yii::app()->createUrl('bms/TDonacion/index'),
							//'modulo'=>'donacion'
							
						));
						}
						
						Yii::app()->end();
					}else{
					

						echo CJSON::encode(array(
								'status'=>Yii::app()->createUrl('seguridad')
						));
						Yii::app()->end();

					}			
					
					
				}else{

					$error = CActiveForm::validate($model);
					if($error!=='[]')
					 echo $error;
					
					Yii::app()->end();
				}
			}else{
								
				$this->render('login',array(
					'model'=>$model
				));
			}

		
		} else {
			$ruta="";
			
        	if (Yii::app()->user->getState('id_rol') === 'admin'){        					
        		$ruta=Yii::app()->createUrl('bms/');

        	}else if (Yii::app()->user->getState('id_rol') === 'donador'){
        		
        		$ruta=Yii::app()->createUrl('bms/TDonacion/index');
        		//exit();
        		//$this->redirect(array('seguridad/'));  
        		//
        	}else{     
        		$ruta=Yii::app()->createUrl('seguridad/');
        		//$this->redirect(array('seguridad/'));
        	}
	        echo CJSON::encode(array(
				'status'=>$ruta
			));

			Yii::app()->end();
        	
        } 

	}


	public function actionDonar($search = '', $size = 18, $tipo='', $marca = '')
		{
			Yii::import('seguridad.models.*');
			Yii::import('seguridad.controllers.*');
			Yii::import('bms.models.*');
			Yii::import('bms.controllers.*');
			Yii::import('catalogo.models.*');
			Yii::import('catalogo.controllers.*');
			Yii::import('configuracion.models.*');
			Yii::import('configuracion.controllers.*');

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


            $criteria1 = new CDbCriteria();
            $criteria1->select = array('*');
            $criteria1->with = array('idDonador'=>array('select'=>'idDonador.nombres,idDonador.apellidos'),'idDonacion.idCotizacion.idCarrito.idDatosBasicosDireccion.idPais'=>array('select'=>'idDonacion.idCotizacion.idCarrito.idDatosBasicosDireccion.idPais.descripcion'));
             if ($search!=''){
             	//CONCAT_WS(' ',name,surname) LIKE '%linus torvalds%'.
            	$criteria1->condition='t.id_estatus = 3 and t.id_donacion=1 and CONCAT_WS(" ",idDonador.nombres,idDonador.apellidos) like "%'.$search.'%" ';
            }else{
            	 $criteria1->condition='t.id_estatus = 3 and t.id_donacion=1';
            }

            $dataProvider1 = new CActiveDataProvider( 'TDonacionAdjudicado', array( 'criteria' => $criteria1, 'pagination'=>array('pageSize'=>$size,), ) );

            $criteria = new CDbCriteria();
            $criteria->select = array('*');
            $criteria->with = array('idDonacion'=>array('select'=>'idDonacion.id_cotizacion'),'idDonacion.idCotizacion.idCarrito.idDatosBasicosDireccion.idPais'=>array('select'=>'idDonacion.idCotizacion.idCarrito.idDatosBasicosDireccion.idPais.descripcion'),'idDonacion.idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'idDonacion.idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idDonacion.idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos'));  
             $criteria->condition='t.id_estatus = 3 and id_donador=17';
            if ($tipo!=''){
            	switch ($tipo) {
					case 'alta':
						$criteria->order='monto DESC';
						break;
					case 'baja':
						$criteria->order='monto ASC';
						break;
					case 'bene':
						$criteria->order='idBeneficiarioDB.nombres,idBeneficiarioDB.apellidos';
						break;
					case 'pais':
						$criteria->order='idPais.descripcion';
						break;
				}

            }
          
            $dataProvider2 = new CActiveDataProvider( 'TDonacionAdjudicado', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );


            Yii::app()->theme = 'bms';
      		$this->layout ='//layouts/portalFundacion';
            
			$this->render('donacion',array('dataProvider1' => $dataProvider1,'dataProvider2' => $dataProvider2,
				'modelCotizacion'=>$modelCotizacion,'modelBeneficiario'=>$modelBeneficiario,'modelDBD'=>$modelDBD));
			
		}

	public function actionDonarPrueba()
	{
		Yii::app()->theme = 'classic';
  		$this->layout ='//layouts/portalFacebook';
		$this->render('nuevo_prueba',array());
	}


	public function actionDetalleCaso($idDonacion,$size='')
	{
		Yii::import('seguridad.models.*');
		Yii::import('seguridad.controllers.*');
		Yii::import('bms.models.*');
		Yii::import('bms.controllers.*');
		Yii::import('catalogo.models.*');
		Yii::import('catalogo.controllers.*');
		Yii::import('configuracion.models.*');
		Yii::import('configuracion.controllers.*');	

		$criteria = new CDbCriteria();
		$criteria->select = array('*');

		$criteria->with=array('idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'idCotizacion.idBeneficiario.idBeneficiarioDB.nombres,idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos'),'idCotizacion.idResponsable'=>array('select'=>'idCotizacion.idResponsable.nombres,idCotizacion.idResponsable.apellidos'),'idCotizacion.idCarrito.idDatosBasicosDireccion.idPais'=>array('select'=>'idCotizacion.idCarrito.idDatosBasicosDireccion.idPais.descripcion'));


			$criteria->condition="id_donacion = {$idDonacion}";

	    Yii::app()->theme = 'bms';
	  	$this->layout ='//layouts/portalFundacion';
	        
		$dataProvider = new CActiveDataProvider( 'TDonacion', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );


		if (!isset($dataProvider->getData()[0])){
			
			$error='';
			$this->render('error',array('code'=>'501','message' =>$error ));
		}

		$this->render('detalleCaso',array('model' => $dataProvider->getData()[0]));
		
	}




	public function actionLoginDonar()
	{
		Yii::import('seguridad.models.*');
		Yii::import('seguridad.controllers.*');
		Yii::import('bms.models.*');
		Yii::import('bms.controllers.*');
		Yii::import('catalogo.models.*');
		Yii::import('catalogo.controllers.*');
		Yii::import('configuracion.models.*');
		Yii::import('configuracion.controllers.*');

		$model= new LoginForm();
		$modelUsuario = new TUsuario;
		$modelDB  = new TDatosBasicos;
		$modelDireccion = new  TDatosBasicosDireccion;

		$this->render('loginDonacion',
				array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB,'modelDireccion'=>$modelDireccion)
			);
	}



	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::import('seguridad.models.*');
	    Yii::import('seguridad.controllers.*');
	    Yii::import('bms.models.*');
		Yii::import('bms.controllers.*');
		Yii::import('catalogo.models.*');
		Yii::import('catalogo.controllers.*');
		Yii::import('configuracion.models.*');
		Yii::import('configuracion.controllers.*');

	    try{ 

			//if($this->guardarAuditoria()){					
						
				$result = 1;//TAcceso::model()->cerrarAcceso(Yii::app()->user->id);
				//echo $nombre_accion=Yii::app()->getController()->getAction()->controller->action->id;exit;
				if ($result != 0){
					Yii::app()->user->logout();	
					//echo "logout";		
					$this->redirect(Yii::app()->homeUrl);			
				}else{
					throw new CHttpException('501','');
				}
			 // }else{
			 	
			 // 	throw new CHttpException('','Error al almacenar informaciÃ³n en la base de datos, contactar al adminitrador del sistema');
			 // }
		} catch (Exception $e) { 

				throw new CHttpException('501','Error al cerrar la sesión. Por favor notifique este error al Administrador del Sistema por el correo soporte@esculapio.com.ve ');
		}		
	}
	

	
	protected function performAjaxValidation2($model,$modelDB)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tusuarioafuera-form')
		{
			echo CActiveForm::validate($model);
			echo CActiveForm::validate($modelDB);
			Yii::app()->end();
		}
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tusuarioafuera-form')
		{
			echo CActiveForm::validate($model);			
			Yii::app()->end();
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionSeguridad()
	{
		$this->render('seguridad');
	}
}