<?php

class TDatosBasicosController extends Controller
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
		$modelRepresentante_inic=new TDatosBasicos;
		$modelBeneficiario_inic=new TDatosBasicos;
		$modelUbicacion_inic = new TDatosBasicosUbicacion;
		$modelUbicacionRepresentante_inic = new TDatosBasicosUbicacion;
		$modelDBSeguro_inic= new TDatosBasicosSeguro;
		$modelPerfil_inic = new TDatosBasicosPerfil;
		//$modelPerfilRepresentante_inic = new TDatosBasicosPerfil;
		$modelEducacion_inic = new TEducacion;
		$modelExperienciaLaboral_inic= new TExperienciaLaboral;
		$modelSeguro= new TSeguroEntidad;
		$modelMedico_inic= new TMedico;
		$modelMedicoEspecialidad_inic= new TMedicoEspecialidad;
		$modelEmpleado_inic= new TEmpleado;
		$modelPostulante_inic= new TPostulante;
		$modelProveedor_inic= new TProveedor;
		$modelEntidad_inic= new TEntidad;
		$arreglo_seguro_cargado = array();
		$arreglo_beneficiario_cargado = array();
		$arreglo_educacion= array();
		$arreglo_explaboral= array();
		$dpBeneficiario='';
		$dpespecialidad='';
		$dpexplaboral='';
		$dpeducacion='';
		$beneficiario=0;

		$id_datos_basicos=$id;

		$model=$this->loadModel($id);

		if((isset($model->titular))&&($model->titular!=0)){
			$modelRepresentante=TDatosBasicos::model()->find('t.nro_identificacion='. $model->nro_identificacion); 

			if(!isset($modelRepresentante)){
				$modelRepresentante=$modelRepresentante_inic;
			}else{
				$model->id_datos_basicos_representante= $modelRepresentante->id_datos_basicos;
				$model->nombres_representante= $modelRepresentante->nombres;
				$model->apellidos_representante= $modelRepresentante->apellidos;
				$model->sexo_representante= $modelRepresentante->sexo;
				$model->id_estado_civil_representante= $modelRepresentante->id_estado_civil;
				$model->fecha_nacimiento_representante= $modelRepresentante->fecha_nacimiento;
			}
		}else{
			$modelRepresentante=$modelRepresentante_inic;
			$beneficiario= 1;
		}

		
		$modelBeneficiario=TDatosBasicos::model()->findAll('t.nro_identificacion='. $model->nro_identificacion. " and t.titular!=0");  
		if(isset($modelBeneficiario)){
			foreach ($modelBeneficiario as $key => $value) {
				 array_push($arreglo_beneficiario_cargado, array('id_datos_basicos'=>$value['id_datos_basicos'],'nombres'=>$value['nombres'],'apellidos'=> $value['apellidos'],'sexo' =>$value['sexo'],'fecha_nacimiento' => $value['fecha_nacimiento']));
          	}
          	
      	  	$dpBeneficiario=new CArrayDataProvider($arreglo_beneficiario_cargado , array( 'keyField' => 'id_datos_basicos',
                'id'=>'tdatosbasicosbeneficiario-dp',
                'sort'=>array(
                    'attributes'=>array(
                         'id_datos_basicos','nombres', 'apellidos', 'sexo','fecha_nacimiento'),
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
		}
	
		
		$modelUbicacion=TDatosBasicosUbicacion::model()->find('id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelUbicacion)){
			$modelUbicacion=$modelUbicacion_inic;
		}else{
			if( $modelUbicacion->telefono_fijo!=""){
				list($cod, $telf) = split('[-]', $modelUbicacion->telefono_fijo);
				$modelUbicacion->telefono_fijo=  $telf;
				$modelUbicacion->codtelefono_movil=$cod;
			}
			if( $modelUbicacion->telefono_movil!=""){
				list($cod, $telf) = split('[-]', $modelUbicacion->telefono_movil);
				$modelUbicacion->telefono_movil=  $telf;
				$modelUbicacion->codtelefono_movil=$cod;
			}
		}
		// $modelUsuario=TUsuario::model()->find('t.id_persona='. $id_datos_basicos); 
		// if(!isset($modelUsuario))
		// 	$modelUsuario=$modelUsuario_inic;
		$modelPerfil=TDatosBasicosPerfil::model()->find('t.id_datos_basicos='. $id_datos_basicos);  
		if(!isset($modelPerfil))
			$modelPerfil=$modelPerfil_inic;

		$modelDBSeguro=TDatosBasicosSeguro::model()->findAll('t.id_datos_basicos='. $id_datos_basicos);  
		if(isset($modelDBSeguro)){
			foreach ($modelDBSeguro as $key => $value) {
				 array_push($arreglo_seguro_cargado, array('id_datos_basicos_seguro'=>$value['id_datos_basicos_seguro'],'id_seguro'=> TSeguro::model()->getSeguro_DatosBasicos($value['id_seguro']),'tipo_poliza'=> TDatosBasicos::model()->getPoliza($value['tipo_poliza']),'numero_poliza' =>$value['numero_poliza'],'cobertura' => $value['cobertura']));
          	}
      	  	$dp=new CArrayDataProvider($arreglo_seguro_cargado , array( 'keyField' => 'id_datos_basicos_seguro',
                'id'=>'tdatosbasicosseguro-dp',
                'sort'=>array(
                    'attributes'=>array(
                         'id_datos_basicos_seguro','id_seguro', 'tipo_poliza', 'numero_poliza'),
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
			$modelDBSeguro=$modelDBSeguro_inic;
		}



		$modelEducacion=TEducacion::model()->findAll('t.id_datos_basicos='. $id_datos_basicos); 

		if(!isset($modelEducacion)){
		 	$modelEducacion=$modelEducacion_inic;
		}else{
			foreach ($modelEducacion as $key => $value) {
				 array_push($arreglo_educacion, array('id_educacion'=>$value->id_educacion,'id_nivel_educativo'=>TNivelEducativo::model()->findByPk($value->id_nivel_educativo)->descripcion,'id_mencion'=>TMencion::model()->findByPk($value->id_mencion)->descripcion,'id_pais'=>TLocalizacionPais::model()->findByPk($value->id_pais)->descripcion_pais,'institucion' =>$value->institucion,'fecha_desde' => $value->fecha_desde,'fecha_hasta' => $value->fecha_hasta,'ultimo_anio_aprobado' => $value->ultimo_anio_aprobado,'graduado' => $value->graduado));
          	}
      	  	$dpeducacion=new CArrayDataProvider($arreglo_educacion , array( 'keyField' => 'id_educacion',
                'id'=>'teducacion-dp',
                'sort'=>array(
                    'attributes'=>array(
                         'id_educacion','id_nivel_educativo','id_mencion','id_pais','institucion','fecha_desde','fecha_hasta','ultimo_anio_aprobado','graduado'),
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
			$modelEducacion=$modelEducacion_inic;
		}
		$modelExperienciaLaboral=TExperienciaLaboral::model()->findAll('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelExperienciaLaboral)){
			$modelExperienciaLaboral=$modelExperienciaLaboral_inic;
		}else{
			foreach ($modelExperienciaLaboral as $key => $experiencias) {
				array_push($arreglo_explaboral, array('id_experiencia_laboral'=>$experiencias->id_experiencia_laboral,'nombre_empresa'=>$experiencias->nombre_empresa,'id_pais'=>TLocalizacionPais::model()->findByPk($experiencias->id_pais)->descripcion_pais,'cargo_ocupado' =>$experiencias->cargo_ocupado,'condicion_cargo' =>$experiencias->condicion_cargo,'fecha_desde' => $experiencias->fecha_desde,'fecha_hasta' => $experiencias->fecha_hasta,'ultimo_sueldo' => $experiencias->ultimo_sueldo,'telefono_empresa' => $experiencias->telefono_empresa, 'motivo_retiro'=>$experiencias->motivo_retiro));
          	}
      	  	$dpexplaboral=new CArrayDataProvider($arreglo_explaboral , array( 'keyField' => 'id_experiencia_laboral',
                'id'=>'texplaboral-dp',
                'sort'=>array(
                    'attributes'=>array(
                         'id_experiencia_laboral','nombre_empresa','id_pais','cargo_ocupado',	'condicion_cargo','fecha_desde','fecha_hasta','ultimo_sueldo','telefono_empresa','motivo_retiro',),
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
			$modelExperienciaLaboral=$modelExperienciaLaboral_inic;
		}
			
		$modelEmpleado=TEmpleado::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelEmpleado)){
			$modelEmpleado=$modelEmpleado_inic;
		}
		$modelPostulante=TPostulante::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelPostulante)){
			$modelPostulante=$modelPostulante_inic;
		}
		$modelProveedor=TProveedor::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelProveedor))
			$modelProveedor=$modelProveedor_inic;
		$modelEntidad=TEntidad::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelEntidad))
			$modelEntidad=$modelEntidad_inic;
		$modelMedico=TMedico::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelMedico)){
			$modelMedico=$modelMedico_inic;
		}
	 	if(isset($modelMedico->id_medico)){
	 		$cont=0;
			$modelMedicoEspecialidad=TMedicoEspecialidad::model()->findAll('t.id_medico='. $modelMedico->id_medico); 
			foreach ($modelMedicoEspecialidad as $key => $especialidadind) {
				if($cont==0){
			 		$dpespecialidad=TEspecialidad::model()->findByPk($especialidadind['id_especialidad'])->descripcion;	 
			 	}else{
			 		$dpespecialidad.=', '.TEspecialidad::model()->findByPk($especialidadind['id_especialidad'])->descripcion;	 
			 	}
			 	$cont++;
			}
		}
		$modelMedicoEspecialidad=$modelMedicoEspecialidad_inic;



		$this->render('view',array(
			'model'=>$model, 'modelRepresentante'=>$modelRepresentante, 'dpBeneficiario'=>$dpBeneficiario, 'beneficiario'=>$beneficiario,
			'modelUbicacion'=>$modelUbicacion ,'modelPerfil'=>$modelPerfil, 
			'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			'modelEducacion'=>$modelEducacion, 'modelExperienciaLaboral'=>$modelExperienciaLaboral, 
			'modelEmpleado'=>$modelEmpleado, 'modelPostulante'=>$modelPostulante, 'modelProveedor'=>$modelProveedor,
			'modelEntidad'=>$modelEntidad,'dp'=>$dp, 'dpespecialidad'=>$dpespecialidad, 'dpeducacion'=>$dpeducacion, 'dpexplaboral'=>$dpexplaboral,
		));
	}


	public function actionMostrarAdmin()
	{
		$model=new TDatosBasicos('search');
		$model->unsetAttributes(); 
		
		if(isset($_GET['TDatosBasicos']))
			$model->attributes=$_GET['TDatosBasicos'];

		
		$this->renderPartial('admin',array(
			'model'=>$model),false,true);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateIntegrado($id_perfil)
	{
		$model=new TDatosBasicos;
		$modelDireccion = new TDatosBasicosDireccion;
		$modelMedico= new TMedico;
		$modelUsuario = new TUsuario;
		$modelEmpresa= new TEmpresa;
		$guardo=false;
		$model->id_perfil=$id_perfil;
		
		$this->performAjaxValidation($model);
		//$this->performAjaxValidation($modelDireccion);
		// if ($id_perfil==2){
		// 	$this->performAjaxValidation($modelMedico);
		// }
		
		/*if( isset($_POST['TDatosBasicosDireccion']))
		 	$modelDireccion->attributes=$_POST['TDatosBasicosDireccion'];
		 	//$modelPerfil->id_perfil=$id_perfil;*/
		if(isset($_GET['ajax']))
		{			
			if ($_GET['ajax'] == 'tdatos-basicos-grid') 
			{							
				$this->actionAdmin();
				Yii::app()->end();
				exit();
			}
		}

		if(isset($_POST['TDatosBasicos'])) 
		{			
		 	$model->attributes=$_POST['TDatosBasicos'];
		 	$model->id_perfil=$id_perfil;

		 	if ($model->id_perfil == 1 || $model->id_perfil == 2 || $model->id_perfil == 5) {
			 	$existeUsuario = TUsuario::model()->findAll("t.usuario='$model->email'");

				if (count($existeUsuario) > 0) {				
					echo CJSON::encode(array(					
						'salida' => "ERROR",
						'sms'=>"El email $model->email ya se encuentra registrado. Por favor verifique o intente con otro correo"
					));

					Yii::app()->end();
				}else{
					$titular = empty($this->titular) ? 0 : $this->titular;
			    
			        $check=TDatosBasicos::model()->findAll('id_tipo_identificacion='.$model->id_tipo_identificacion.' AND nro_identificacion='.$model->nro_identificacion.' AND titular= '.$titular.' AND id_perfil NOT IN (3,4)'); //or $this->new_email_confirm
			        if( count($check) > 0){
			        	echo CJSON::encode(array(					
							'salida' => "ERROR",
							'sms'=>"El número de identificacion $model->nro_identificacion ya se encuentra asignado a una persona. Por favor verifique"
						));

						Yii::app()->end();
			        }
				}
		 	}

        	$valid=$model->validate();
     	
            if($valid)
            {
            	
            	try {
            		
	        		if ($model->save()){
	        			
	        			//USUARIO
	        			//SE CREAN LOS USUARIO CUANDO SEAN CLIENTES=1 MEDICOS=2 EMPLEADOS=5
	        			if ($model->id_perfil == 1 || $model->id_perfil == 2 || $model->id_perfil == 5) {

		        			$modelUsuario->usuario=$model->email;
		        			$modelUsuario->palabra_clave='123456';
		        			$modelUsuario->confirmar_clave='123456';
		        			$modelUsuario->perfil=$model->id_perfil;
		        			$modelUsuario->cedula=$model->nro_identificacion;
		        			$modelUsuario->id_persona=$model->id_datos_basicos;
		        			$modelUsuario->nro_intentos=0;

		        			if ($modelUsuario->save()) {
		        				$guardo=true;
		        			}
		        			
	        			}
	    				
	        			//DIRECCION PRINCIPAL
	    				$modelDireccion->attributes=$_POST['TDatosBasicosDireccion'];
	    				$modelDireccion->id_datos_basicos=$model->id_datos_basicos;
	    				$modelDireccion->id_tipo_direccion=1; // 1:PRINCIPAL   2:CONSULTORIO
	    				$modelDireccion->descripcionList='';
	    				$modelDireccion->indicador_envio=isset($_POST['TDatosBasicosDireccion']['indicador_envio']) ? $_POST['TDatosBasicosDireccion']['indicador_envio'] : 0;
	    				$validDireccion=$modelDireccion->validate();
	    					    				    				
	    				if ($validDireccion){
	    					$modelDireccion->save();
	    					$guardo=true;
	    				}else{
	    					$guardo=false;
	    					$model->addError('nombre','error al guardar la direccion principal');
	    					$sms="Creación de Dirección Principal";
	    				}

		    			//DIRECCION DE ENVIO
		    			if (isset($_POST['TDatosBasicosDireccion'][1])) 
		    			{
		    				if (!empty($_POST['TDatosBasicosDireccion'][1]['id_pais']) && !empty($_POST['TDatosBasicosDireccion'][1]['id_estado']) && !empty($_POST['TDatosBasicosDireccion'][1]['ciudad'])  && !empty($_POST['TDatosBasicosDireccion'][1]['direccion1'])   ) 
		    				{
		    					
		    					$modelDireccionEnvio=new TDatosBasicosDireccion;
				    			$modelDireccionEnvio->attributes=$_POST['TDatosBasicosDireccion'][1];
			    				$modelDireccionEnvio->id_datos_basicos=$model->id_datos_basicos;
			    				$modelDireccionEnvio->id_tipo_direccion=1; // 1:PRINCIPAL   2:CONSULTORIO
			    				$modelDireccionEnvio->descripcionList='';
			    				$validDireccion=$modelDireccionEnvio->validate();
			    					    				    				
			    				if ($validDireccion){
			    					$modelDireccionEnvio->save();
			    					$guardo=true;
			    				}else{
			    					$guardo=false;
			    					$model->addError('nombre','error al guardar la direccion de envio');
			    					$sms="Creación de Dirección de Envío";
			    				}

		    				}
		    			}
		    			

		    			//MEDICO
		    			if($model->id_perfil==2){
							$modelMedico->attributes=$_POST['TMedico'];
							$modelMedico->id_datos_basicos=$model->id_datos_basicos;
							if ($modelMedico->save())
								$guardo=true;
							else{
								$model->addError('nombres','error al guardar medico');
								$sms="Creación de Médico";
							}
						}

					}else{
						$guardo=false;
						$model->addError('nro_identificacion',$e->getMessage());
						$sms="Creación de Usuario.";
					}
					
					if ($guardo){

						echo CJSON::encode(array(					
							'salida' => "OK"
						));

						Yii::app()->end(); 
					}else{
						echo CJSON::encode(array(					
							'salida' => "ERROR",
							'sms'=>$sms.' Contacte al departamento de soporte técnico: '.var_dump($model->getErrors())
						));

						Yii::app()->end(); 
					}

			 	} catch (Exception $e) {
            		$model->addError('nombres',$e->getMessage());
            		
            		echo CJSON::encode(array(					
							'salida' => "ERROR",
							'sms'=>$e->getMessage()." Contacte al departamento de soporte técnico."
						));

						Yii::app()->end(); 
            		//$model->addError('nro_identificacion',$e->getCode());
            	}
			}
			
			$model->addError('nombres',$valid);

		}

		
		//CHtml::$errorContainerTag = 'span';
		$this->render('createIntegrado',array(
			'model'=>$model,'modelUsuario'=>$modelUsuario,'modelDireccion'=>$modelDireccion,'modelMedico'=>$modelMedico,'modelEmpresa'=>$modelEmpresa));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TDatosBasicos;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		

		
		if(isset($_POST['TDatosBasicos']))
		{			
			$model->attributes=$_POST['TDatosBasicos'];
			//echo $_POST['TDatosBasicos']['sexo'];
			/*$this->renderPartial('admin',array(
			'model'=>$model));*/

			/*if($model->save())
				$this->redirect(array('view','id'=>$model->id_datos_basicos));*/
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
	/*public function actionUpdate($id)
	{
		$modelRepresentante_inic=new TDatosBasicos;
		$modelUbicacion_inic = new TDatosBasicosUbicacion;
		$modelUbicacionRepresentante_inic = new TDatosBasicosUbicacion;
		$modelDBSeguro_inic= new TDatosBasicosSeguro;
		$modelPerfil_inic = new TDatosBasicosPerfil;
		//$modelPerfilRepresentante_inic = new TDatosBasicosPerfil;
		$modelEducacion_inic = new TEducacion;
		$modelEducacion_varias = new TEducacion;
		$modelEducacion_2 = new TEducacion;
		$modelEducacion_3= new TEducacion;
		$modelExperienciaLaboral_inic= new TExperienciaLaboral;
		$modelExperienciaLaboral_varias= new TExperienciaLaboral;
		$modelExperienciaLaboral_2= new TExperienciaLaboral;
		$modelExperienciaLaboral_3= new TExperienciaLaboral;
		$modelSeguro= new TSeguroEntidad;
		$modelMedico_inic= new TMedico;
		$modelMedicoEspecialidad_inic= new TMedicoEspecialidad;
		$modelEmpleado_inic= new TEmpleado;
		$modelPostulante_inic= new TPostulante;
		$modelProveedor_inic= new TProveedor;
		$modelEntidad_inic= new TEntidad;
		$cadena_seguro = "";
		$arreglo_seguro = array();
		$arreglo_seguro_cargado = array();
		$arreglo_especialidad = array();

		$pase= false;

		$model=$this->loadModel($id);


		//$id_datos_basicos=$model->id_datos_basicos;
		$id_datos_basicos=$model['id_datos_basicos'];
		
		$modelUbicacion=TDatosBasicosUbicacion::model()->find('id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelUbicacion)){
			$modelUbicacion=$modelUbicacion_inic;
		}else{
			if( $modelUbicacion->telefono_fijo!=""){
				list($cod, $telf) = split('[-]', $modelUbicacion->telefono_fijo);
				$modelUbicacion->telefono_fijo=  $telf;
				$modelUbicacion->codtelefono_movil=$cod;
			}
			if( $modelUbicacion->telefono_movil!=""){
				list($cod, $telf) = split('[-]', $modelUbicacion->telefono_movil);
				$modelUbicacion->telefono_movil=  $telf;
				$modelUbicacion->codtelefono_movil=$cod;
			}
		}
		// $modelUsuario=TUsuario::model()->find('t.id_persona='. $id_datos_basicos); 
		// if(!isset($modelUsuario))
		// 	$modelUsuario=$modelUsuario_inic;
		if((isset($model->titular))&&($model->titular!=0)){
			$modelRepresentante=TDatosBasicos::model()->find('t.nro_identificacion='. $model->nro_identificacion);  
			if(!isset($modelRepresentante)){
				$modelRepresentante=$modelRepresentante_inic;
			}else{
				$model->id_datos_basicos_representante= $modelRepresentante->id_datos_basicos;
				$model->nombres_representante= $modelRepresentante->nombres;
				$model->apellidos_representante= $modelRepresentante->apellidos;
				$model->sexo_representante= $modelRepresentante->sexo;
				$model->id_estado_civil_representante= $modelRepresentante->id_estado_civil;
				$model->fecha_nacimiento_representante= $modelRepresentante->fecha_nacimiento;
			}
		}else{
			$modelRepresentante=$modelRepresentante_inic;
		}


		$modelPerfil=TDatosBasicosPerfil::model()->find('t.id_datos_basicos='. $id_datos_basicos);  
		if(!isset($modelPerfil))
			$modelPerfil=$modelPerfil_inic;

 		if($modelPerfil->id_perfil == "7" ){
 			$model->observacion="No Aplica";
 		}
		$modelDBSeguro=TDatosBasicosSeguro::model()->findAll('t.id_datos_basicos='. $id_datos_basicos);
		if(isset($modelDBSeguro)){
			foreach ($modelDBSeguro as $key => $value) {
				array_push($arreglo_seguro_cargado, array('id_datos_basicos_seguro'=>$value['id_datos_basicos_seguro'],'id_seguro'=> TSeguro::model()->getSeguro_DatosBasicos($value['id_seguro']),'tipo_poliza'=> TDatosBasicos::model()->getPoliza($value['tipo_poliza']),'id_tipo_beneficiario' =>TTipoBeneficiario::model()->findByPk($value['id_tipo_beneficiario'])->descripcion,'contratante' => $value['contratante']));
				//array_push($arreglo_seguro_cargado, array('id_datos_basicos_seguro'=>$value['id_datos_basicos_seguro']));//'tipo_poliza'=> TDatosBasicos::model()->getPoliza($value['tipo_poliza']),'id_tipo_beneficiario' =>TDatosBasicos::model()->getBeneficiario($value['id_tipo_beneficiario']),'contratante' => $value['contratante']));
				//$cadena_seguro.=  $value['id_datos_basicos_seguro'] . '|' . $value['id_seguro'] . '|' . $value['tipo_poliza'] . '|' . $value['id_tipo_beneficiario'] . '|'; 
			}
			$modelDBSeguro=$modelDBSeguro_inic;
		}
		$modelEducacion=TEducacion::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelEducacion)){
			$modelEducacion=$modelEducacion_inic;
			$modelEducacion_2=$modelEducacion_inic;
			 $modelEducacion_3=$modelEducacion_inic;
		}else{

			$modelEducacion_varias=TEducacion::model()->findAll('t.id_datos_basicos='. $id_datos_basicos); 
			$cont=0;
			foreach ($modelEducacion_varias as $key => $especialidadind) {
				if ($cont==0){
			 		$modelEducacion= $especialidadind;
				 }
			 	if ($cont==1){
			 		$modelEducacion_2= $especialidadind;
				 }
			 	if ($cont==2){
			 		$modelEducacion_3= $especialidadind;
			 	}
		 		$cont++;
			}
		}
		$modelExperienciaLaboral=TExperienciaLaboral::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelExperienciaLaboral)){
			$modelExperienciaLaboral=$modelExperienciaLaboral_inic;
		    $modelExperienciaLaboral_2=$modelExperienciaLaboral_inic;
			$modelExperienciaLaboral_3=$modelExperienciaLaboral_inic;
		}else{
			$modelExperienciaLaboral_varias=TExperienciaLaboral::model()->findAll('t.id_datos_basicos='. $id_datos_basicos); 
			$cont=0;
			foreach ($modelExperienciaLaboral_varias as $key => $experiencias) {
				if ($cont==0){
			 		$modelExperienciaLaboral= $experiencias;
					if( $modelExperienciaLaboral->telefono_empresa!=""){
						list($cod, $telf) = split('[-]', $modelExperienciaLaboral->telefono_empresa);
						$modelExperienciaLaboral->telefono_empresa=  $telf;
						$modelExperienciaLaboral->codArea_telefono_empresa1= $cod;
					}
				 }
			 	if ($cont==1){
			 		$modelExperienciaLaboral_2= $experiencias;
			 		if( $modelExperienciaLaboral_2->telefono_empresa!=""){
						list($cod, $telf) = split('[-]', $modelExperienciaLaboral_2->telefono_empresa);
						$modelExperienciaLaboral_2->telefono_empresa=  $telf;
						$modelExperienciaLaboral_2->codArea_telefono_empresa2= $cod;
					}
				 }
			 	if ($cont==2){
			 		$modelExperienciaLaboral_3= $experiencias;
			 		if( $modelExperienciaLaboral_2->telefono_empresa!=""){
						list($cod, $telf) = split('[-]', $modelExperienciaLaboral_3->telefono_empresa);
						$modelExperienciaLaboral_3->telefono_empresa=  $telf;
						$modelExperienciaLaboral_3->codArea_telefono_empresa3= $cod;
					}
			 	}
		 		$cont++;

			}
			


		}
		$modelEmpleado=TEmpleado::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelEmpleado)){
			$modelEmpleado=$modelEmpleado_inic;
		}else{
			if( $modelEmpleado->tlf_persona!=""){
				list($cod, $telf) = split('[-]', $modelEmpleado->tlf_persona);
				$modelEmpleado->tlf_persona=  $telf;
				$modelEmpleado->codAreaMEmp= $cod;
			}
			if( $modelEmpleado->tlf_ofic!=""){
				list($cod, $telf) = split('[-]', $modelEmpleado->tlf_ofic);
				$modelEmpleado->tlf_ofic=  $telf;
				$modelEmpleado->codAreaMEmp_ofic= $cod;
			}
		}
		$modelPostulante=TPostulante::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelPostulante)){
			$modelPostulante=$modelPostulante_inic;
		}else{
			if( $modelPostulante->tlf_persona!=""){
				list($cod, $telf) = split('[-]', $modelPostulante->tlf_persona);
				$modelPostulante->tlf_persona=  $telf;
				$modelPostulante->codAreaMPost= $cod;
			}
		}
		$modelProveedor=TProveedor::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelProveedor))
			$modelProveedor=$modelProveedor_inic;
		$modelEntidad=TEntidad::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelEntidad))
			$modelEntidad=$modelEntidad_inic;
		$modelMedico=TMedico::model()->find('t.id_datos_basicos='. $id_datos_basicos); 
		if(!isset($modelMedico)){
			$modelMedico=$modelMedico_inic;
		}
	 	if(isset($modelMedico->id_medico)){
			$modelMedicoEspecialidad=TMedicoEspecialidad::model()->findAll('t.id_medico='. $modelMedico->id_medico); 
			foreach ($modelMedicoEspecialidad as $key => $especialidadind) {
			 	array_push($arreglo_especialidad, $especialidadind['id_especialidad']);	 
			}
		}
		$modelMedicoEspecialidad=$modelMedicoEspecialidad_inic;
		$pase= false;

		$this->performAjaxValidation($model,$modelUbicacion,$modelPerfil,$modelEducacion, $modelEducacion_2, $modelEducacion_3, $modelExperienciaLaboral, $modelExperienciaLaboral_2, $modelExperienciaLaboral_3,$modelEmpleado);
		// $this->performAjaxValidation($modelEducacion,$model);
		// $this->performAjaxValidation($modelProveedor);

		if( isset($_POST['TDatosBasicos'])&&  isset($_POST['TDatosBasicosUbicacion']))
		{	

		 	$model->attributes=$_POST['TDatosBasicos'];
		 	
			$modelUbicacion->attributes=$_POST['TDatosBasicosUbicacion'];
			//$modelUsuario->attributes=$_POST['TUsuario'];
			 // validate BOTH $a and $b
	 		if($modelPerfil->id_perfil == "2" ){
				$model->id_tipo_identificacion= $_POST['identificacion'];
				//$model->nro_identificacion= $_POST['nro_identificacion_p'];
				$model->nombres=$_POST['nombres_p'];
				$model->sexo='M';
				$model->id_estado_civil=1;
        	}
        	if($modelPerfil->id_perfil == "7" ){
				$model->id_tipo_identificacion= $_POST['identificacion_c'];
				$model->nro_identificacion= $_POST['nro_identificacion_c'];
				$model->nombres=trim($_POST['nombres_c']);
				$model->sexo='M';
				$model->id_estado_civil=1;
        	}
        	$valid=$model->validate();

       		$validD=$modelUbicacion->validate();

        	//$validU=$modelUsuario->validate();

        	if($modelPerfil->id_perfil == "2" ){
				$modelProveedor->attributes=$_POST['TProveedor'];
				$validProv=$modelProveedor->validate();
        	}

 			if($modelPerfil->id_perfil == "7" ){
				$modelEntidad->attributes=$_POST['TEntidad'];
				$validEntidad=$modelEntidad->validate();
        	}

        	if($modelPerfil->id_perfil == "3" || $modelPerfil->id_perfil == "4"){


        		$modelEducacion->attributes=$_POST['TEducacion'][1];
				$validEd1=$modelEducacion->validate();
				
				//Asignacion y Validacion de Educacion

				$modelEducacion_2->attributes=$_POST['TEducacion'][2];
				if(isset($_POST['TEducacion'][2]['fecha_desde_edu2']))
					$modelEducacion_2->fecha_desde=$_POST['TEducacion'][2]['fecha_desde_edu2'];
				if(isset($_POST['TEducacion'][2]['fecha_hasta_edu2']))
			 		$modelEducacion_2->fecha_hasta=$_POST['TEducacion'][2]['fecha_hasta_edu2'];
			 	$validEd2=$modelEducacion_2->validate();
				$modelEducacion_3->attributes=$_POST['TEducacion'][3];
				if(isset($_POST['TEducacion'][3]['fecha_desde_edu3']))
					$modelEducacion_3->fecha_desde=$_POST['TEducacion'][3]['fecha_desde_edu3'];
				if(isset($_POST['TEducacion'][3]['fecha_hasta_edu3']))
			 		$modelEducacion_3->fecha_hasta=$_POST['TEducacion'][3]['fecha_hasta_edu3'];
			 	$validEd3=$modelEducacion_3->validate();

				//Asignacion y Validacion de Experiencia Laboral
				$modelExperienciaLaboral->attributes=$_POST['TExperienciaLaboral'][1];
				if(isset($_POST['TExperienciaLaboral'][1]['fecha_desde_ex1']))
					$modelExperienciaLaboral->fecha_desde=$_POST['TExperienciaLaboral'][1]['fecha_desde_ex1'];
				if(isset($_POST['TExperienciaLaboral'][1]['fecha_hasta_ex2']))
			 		$modelExperienciaLaboral->fecha_hasta=$_POST['TExperienciaLaboral'][1]['fecha_hasta_ex2'];
			 	$validEx1=$modelExperienciaLaboral->validate();

				$modelExperienciaLaboral_2->attributes=$_POST['TExperienciaLaboral'][2];   
				if(isset($_POST['TExperienciaLaboral'][2]['fecha_desde_model2']))
					$modelExperienciaLaboral_2->fecha_desde=$_POST['TExperienciaLaboral'][2]['fecha_desde_model2'];
				if(isset($_POST['TExperienciaLaboral'][2]['fecha_hasta_model2']))
			 		$modelExperienciaLaboral_2->fecha_hasta=$_POST['TExperienciaLaboral'][2]['fecha_hasta_model2'];          
				$validEx2=$modelExperienciaLaboral_2->validate();


				$modelExperienciaLaboral_3->attributes=$_POST['TExperienciaLaboral'][3];
				if(isset($_POST['TExperienciaLaboral'][3]['fecha_desde_model3']))
					$modelExperienciaLaboral_3->fecha_desde=$_POST['TExperienciaLaboral'][3]['fecha_desde_model3'];
				if(isset($_POST['TExperienciaLaboral'][3]['fecha_hasta_model3']))
			 		$modelExperienciaLaboral_3->fecha_hasta=$_POST['TExperienciaLaboral'][3]['fecha_hasta_model3'];          
				$validEx3=$modelExperienciaLaboral_3->validate();



				if($modelPerfil->id_perfil == "3" ){
					$modelEmpleado->attributes=$_POST['TEmpleado'];
					$validEmpl=$modelEmpleado->validate();
				}else{
					$modelPostulante->attributes=$_POST['TPostulante'];
					$validPost=$modelPostulante->validate();
				}
        	}
        	

        	if($modelPerfil->id_perfil == "5" ){
				$modelMedico->attributes=$_POST['TMedico'];
				$validMed=$modelMedico->validate();
				if(isset($_POST['TMedicoEspecialidad'])){
					$modelMedicoEspecialidad->attributes=$_POST['TMedicoEspecialidad'];
					$validMedEsp=$modelMedicoEspecialidad->validate();
				}else{
					$validMedEsp=false;
				}
        	}

			if($modelPerfil->id_perfil == "1" && $valid  &&  $validD){ 
				$pase= true;
			}else{
				if ($modelPerfil->id_perfil == "2" && $valid && $validProv){ 
					$pase= true;
				}else{ 
					if ($modelPerfil->id_perfil == "3" && $valid  && $validEmpl && ($validEd1 || $validEd2 || $validEd3)  && ($validEx1 || $validEx2 ||$validEx3)){ //if($valid && $validD && $validP)
						$pase= true;
					}else{ 
						if ($modelPerfil->id_perfil == "4" && $valid  && $validPost && ($validEd1 || $validEd2 || $validEd3)  && ($validEx1 || $validEx2 ||$validEx3)){ //if($valid && $validD && $validP)
							$pase= true;
						}else{ 
							if ($modelPerfil->id_perfil == "5" && $valid  && $validMed && $validMedEsp) {
								$pase= true;
							}else{ 
								if ($modelPerfil->id_perfil == "7" && $valid && $validEntidad ) 
									$pase= true;
							}
						}
					}
				}
			}
		

            if($pase)
        	{
	        	if($model->id_datos_basicos_representante!=""){
        			$criteria_ejemplares= new CDbCriteria; 
					$criteria_ejemplares->select = array('count(*) AS ejemplares');	
					$criteria_ejemplares->compare('t.nro_identificacion',$model->nro_identificacion);
					$busquedaEjemplares = TDatosBasicos::model()->find($criteria_ejemplares);
          			$model->titular=$busquedaEjemplares->ejemplares;        			
        		}else{
					$model->titular=0;        			
        		}

				$uploadedFile=CUploadedFile::getInstance($model,'img_perfil');

				if( $uploadedFile != null  and !$uploadedFile->getHasError())
				{	            
					$imagen = "images/profile/".$model->nro_identificacion."-".$model->titular.".".$uploadedFile->extensionName;
		            $uploadedFile->saveAs($imagen);
		            $model->img_perfil= $imagen;	            
	            }  

        		$model->save();
    			$id_datos_basicos= $model->id_datos_basicos;
    			if($model->titular!=0){
	        		if($model->id_datos_basicos_representante==""){
	        			$modelRepresentante->id_tipo_identificacion=$model->id_tipo_identificacion;
		        		$modelRepresentante->nro_identificacion=$model->nro_identificacion;
						$modelRepresentante->id_estado_civil=$model->id_estado_civil_representante;
						$modelRepresentante->nombres=$model->nombres_representante;
						$modelRepresentante->apellidos=$model->apellidos_representante;
						$modelRepresentante->sexo=$model->sexo_representante;
						$modelRepresentante->fecha_nacimiento=$model->fecha_nacimiento_representante;
						$modelRepresentante->save();
						$id_datos_basicos_representante= $modelRepresentante->id_datos_basicos;
					}
				}


	 	  		$modelUbicacion->id_datos_basicos=$id_datos_basicos;
	 	  		$modelUbicacion->telefono_fijo=$_POST['codAreaFijo'].'-'.$modelUbicacion->telefono_fijo;
				$modelUbicacion->telefono_movil=$_POST['codAreaMovil'].'-'.$modelUbicacion->telefono_movil;
 	  			$modelUbicacion->save();
				if($model->id_datos_basicos_representante=="" && $model->titular!=0){
					$modelUbicacionRepresentante->attributes=$_POST['TDatosBasicosUbicacion'];
	 	  			$modelUbicacionRepresentante->id_datos_basicos=$id_datos_basicos_representante;
	 	  			$modelUbicacionRepresentante->telefono_fijo=$modelUbicacion->telefono_fijo;
					$modelUbicacionRepresentante->telefono_movil=$modelUbicacion->telefono_movil;
	 	  			$modelUbicacionRepresentante->save();
	 	  		}
 	  			
	 	  		//$modelUsuario->id_persona=$id_datos_basicos;
		 	  	if(isset($_POST['TDatosBasicosPerfil']))
				{
			
				  	$modelPerfil->id_datos_basicos=$id_datos_basicos;
				 	// $modelPerfil->save();
					if($model->id_datos_basicos_representante=="" && $model->titular!=0){
						$modelPerfilRepresentante->id_datos_basicos=$id_datos_basicos_representante;
		 	  			$modelPerfilRepresentante->id_perfil=1;
						$modelPerfilRepresentante->save();
		 	  		}

				}
				if(isset($_POST['TDatosBasicosSeguro']))
				{
				     if($modelPerfil->id_perfil != "2" && $modelPerfil->id_perfil != "7" ){
						$modelDBSeguro->attributes=$_POST['TDatosBasicosSeguro'];        
					 	if($modelDBSeguro->id_seguro!=''){
					 		$modelDBSeguro->id_datos_basicos=$id_datos_basicos;
					 		$modelDBSeguro->save();
					 	}
					 		
						if(isset($_POST['cadena_seguro'])){
							//$arreglo_seguro=$modelDBSeguro->armar_arreglo($_POST['cadena_seguro']);
							$arreglo_seguro= Controller::construirArreglo($_POST['cadena_seguro'],11);
							for ($i=0; $i <= (count($arreglo_seguro)-1); $i++) {
								$modelDBSeguroArr= new TDatosBasicosSeguro;
								$modelDBSeguroArr->id_datos_basicos=$id_datos_basicos;
								$modelDBSeguroArr->id_seguro=$arreglo_seguro[$i][0]; 
								$modelDBSeguroArr->numero_poliza=$arreglo_seguro[$i][1]; 
								$modelDBSeguroArr->cobertura=$arreglo_seguro[$i][2]; 
								$modelDBSeguroArr->tipo_poliza=$arreglo_seguro[$i][3]; 
								$modelDBSeguroArr->contratante=$arreglo_seguro[$i][4]; 
								$modelDBSeguroArr->id_tipo_beneficiario=$arreglo_seguro[$i][5]; 
								$modelDBSeguroArr->id_datos_basicos_titular=$arreglo_seguro[$i][6]; 
								$modelDBSeguroArr->nro_identificacion_titular=$arreglo_seguro[$i][7]; 
								$modelDBSeguroArr->nombre_apellido_titular=$arreglo_seguro[$i][8]; 
								$modelDBSeguroArr->telefono_titular=$arreglo_seguro[$i][9].'-'.$arreglo_seguro[$i][10]; 
								if($modelDBSeguroArr->id_seguro!='' && $modelDBSeguroArr->tipo_poliza!='' && $modelDBSeguroArr->id_tipo_beneficiario!='')
									$modelDBSeguroArr->save(); 
							}

						}
					}
				}
				
				
				if($modelPerfil->id_perfil == "1"){
					$this->redirect(array('view','id'=>$model->id_datos_basicos));
				}else{
					if($modelPerfil->id_perfil == "2"){
						$modelProveedor->id_datos_basicos=$id_datos_basicos;
						$modelProveedor->tipo=$_POST['tipo'];
						$modelProveedor->save();
						$this->redirect(array('view','id'=>$model->id_datos_basicos));
					}
					if($modelPerfil->id_perfil == "3" || $modelPerfil->id_perfil == "4"){
	 	 	     		if($validEd1){
						 	$modelEducacion->id_datos_basicos=$id_datos_basicos;
						 	$modelEducacion->save();
						}
						if($validEd2){
							$modelEducacion_2->id_datos_basicos=$id_datos_basicos;
							$modelEducacion_2->save();
						}
						if($validEd3){
							$modelEducacion_3->id_datos_basicos=$id_datos_basicos;
							$modelEducacion_3->save();
						}
						if($validEx1){
		 	 	    		$modelExperienciaLaboral->id_datos_basicos=$id_datos_basicos;
		 	 	    		$modelExperienciaLaboral->telefono_empresa=$_POST['codAreaMovilEmp1'].'-'.$modelExperienciaLaboral->telefono_empresa;
							$modelExperienciaLaboral->save();
						}
						if($validEx2){
							$modelExperienciaLaboral_2->id_datos_basicos=$id_datos_basicos;
							$modelExperienciaLaboral_2->telefono_empresa=$_POST['codAreaMovilEmp2'].'-'.$modelExperienciaLaboral_2->telefono_empresa;
							$modelExperienciaLaboral_2->save();
						}
						if($validEx3){
							$modelExperienciaLaboral_3->id_datos_basicos=$id_datos_basicos;
							$modelExperienciaLaboral_3->telefono_empresa=$_POST['codAreaMovilEmp3'].'-'.$modelExperienciaLaboral_3->telefono_empresa;
							$modelExperienciaLaboral_3->save();
						}
						if($modelPerfil->id_perfil == "3"){
							if($validEmpl){
								$modelEmpleado->id_datos_basicos=$id_datos_basicos;
								$modelEmpleado->tlf_ofic=$_POST['codAreaFijoEmp'].'-'.$modelEmpleado->tlf_ofic;
								$modelEmpleado->tlf_persona=$_POST['codAreaMovilEmp'].'-'.$modelEmpleado->tlf_persona;
								if($modelEmpleado->save()){
									$criteria_clasificacion= new CDbCriteria; 
									$criteria_clasificacion->compare('t.id_cargo',$modelEmpleado->id_cargo);
									$criteria_clasificacion->with = array('idDepartamento'=>array()); 
									$categoria= TCargo::model()->find($criteria_clasificacion)->idDepartamento->id_clasificacion_departamento;
          							// if($categoria==4){
          							// 	//Guardar en la tabla creada para enfermeras
          							// }
								}
							}
						}
						if($modelPerfil->id_perfil == "4"){
							if($validPost){
								$modelPostulante->id_datos_basicos=$id_datos_basicos;
								$modelPostulante->tlf_persona=$_POST['codAreaMovilPost'].'-'.$modelPostulante->tlf_persona;
								$modelPostulante->save();
							}
						}
						$this->redirect(array('view','id'=>$model->id_datos_basicos));
				 	}
			 		if($modelPerfil->id_perfil == "5"){
						if($validMed){
							$modelMedico->id_datos_basicos=$id_datos_basicos;
							$modelMedico->save();
							$id_medico= $modelMedico->id_medico;
				 			$criteria_especialidades= new CDbCriteria;
					 		$modelMedicoEspecialidadBorrar = new TMedicoEspecialidad;
					 		$criteria_especialidades->compare('t.id_medico', $id_medico);
							$modelMedicoEspecialidadBorrar = TMedicoEspecialidad::model()->findAll($criteria_especialidades);
							foreach ($modelMedicoEspecialidadBorrar as $key => $valor) {
								$criteria= new CDbCriteria;
								$criteria->compare('t.id_medico',$valor['id_medico']);
								$criteria->compare('t.id_especialidad',$valor['id_especialidad']);
								$modelmedicoEspBorrar=TMedicoEspecialidad::model()->find($criteria)->delete();
							}	
				 		 	$arrayEspecialidad= $_POST['TMedicoEspecialidad']['id_especialidad'];
					 		foreach ($arrayEspecialidad as $especialidad => $valor) {
					 			$modelMedicoEspecialidadSave = new TMedicoEspecialidad;
					 			$modelMedicoEspecialidadSave->id_medico=$id_medico;
					 			$modelMedicoEspecialidadSave->id_especialidad = $valor;		
								$modelMedicoEspecialidadSave->save();	
					 		}
						}
						$this->redirect(array('view','id'=>$model->id_datos_basicos));
					}
					if($modelPerfil->id_perfil == "7"){
						$modelEntidad->id_datos_basicos=$id_datos_basicos;
						$modelEntidad->nombre_esquema=strtolower(trim($model->nombres));
						$modelEntidad->save();
						$this->redirect(array('view','id'=>$model->id_datos_basicos));
					}
					
				} 	 	
		 	}
	 	
		}



		$this->render('updateIntegrado',array(
			'model'=>$model,'modelUbicacion'=>$modelUbicacion , 'modelPerfil'=>$modelPerfil, 
			'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			'modelEducacion'=>$modelEducacion, 'modelEducacion_2'=>$modelEducacion_2, 'modelEducacion_3'=>$modelEducacion_3,
			'modelExperienciaLaboral'=>$modelExperienciaLaboral, 'modelExperienciaLaboral_2'=>$modelExperienciaLaboral_2, 'modelExperienciaLaboral_3'=>$modelExperienciaLaboral_3,
			'modelEmpleado'=>$modelEmpleado, 'modelPostulante'=>$modelPostulante, 'modelProveedor'=>$modelProveedor, 
			'modelEntidad'=>$modelEntidad,'cadena_seguro'=>$cadena_seguro,'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 'arreglo_especialidad'=>$arreglo_especialidad,
		));
	}*/

	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 **/
	public function actionDelete($id)
	{
  		try {
			$model=$this->loadModel($id);
			$model->id_estatus='2';
			if($model->save()){
  				$this->redirect(array('index'));
  			}
		} catch (Exception $e) {
			$message="Error al modificar datos, contactar al Administradro del Sistema";
			throw new CHttpException (400, $message);
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new TDatosBasicos('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TDatosBasicos']))
			$model->attributes=$_GET['TDatosBasicos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TDatosBasicos('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TDatosBasicos']))
			$model->attributes=$_GET['TDatosBasicos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	
	/**
	 * Manages all models.
	 */
	/*public function actionAdminPaciente()
	{
		$model=new VPacientes('search');
		$model->unsetAttributes();  // clear any default values
	
		if(isset($_GET['VPacientes']))
			$model->attributes=$_GET['VPacientes'];
	
		$this->render('adminPaciente',array(
				'model'=>$model,'idClinica'=>Yii::app()->user->getState('id_clinica'),'idMedico'=>Yii::app()->user->getState('id_medico')
		));
	}*/
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TDatosBasicos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TDatosBasicos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TDatosBasicos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{		
		if(isset($_POST['ajax']) && $_POST['ajax']==='tdatos-basicos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
