<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			//array('username', 'email','message'=>"El formato de correo no es correcto"),
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate', 'skipOnError'=>true),
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Recordarme para la pr&oacute;xima vez',
			'username'=>'Email',
			'password'=>'Contrase&ntilde;a'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		/*if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Usuario o Contrasea incorrecta.');
		}*/
		$this->_identity=new UserIdentity($this->username,$this->password);


		if(!$this->_identity->authenticate()){

			switch ($this->_identity->errorCode) {
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('username','Usuario no valido. Por favor verifique');
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$user=TUsuario::model()->findByAttributes(array('usuario'=>$this->username));
					//TAcceso::model()->verificarIntentos($user->id_usuario,'fallido');
					$this->addError('password','Contraseña incorrecta. Recuerde que solo cuenta con tres(3) intentos.');
					break;

				default:
					switch ($this->_identity->errorMessage) {
						case 'bloqueado':
							$this->addError('username','Usuario bloqueado, contacte el administrador del sistema. ');
							break;
						case 'inactivo':
							$this->addError('username','Usuario inactivo, contacte el administrador del sistema ');
							break;
						case 'sesiones activas':
							$this->addError('username','Error, no tiene suficientes privilegios para tener varias sesiones activas');
							break;
						case 'error':
							$this->addError('username','Error al almacenar los datos');
							break;
						case 'varios equipos':
							$this->addError('username','Error no tiene  suficientes privilegios para acceder de varios equipos');
							break;
						default:
							$this->addError('username','no se');
							break;
					}

					break;
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function loginUser()
	{
		//echo "loginUser";

		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}

		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{


			Yii::app()->session['_id']=$this->_identity->getId();
			Yii::app()->user->name=$this->username;
        	Yii::app()->user->setState('count',0,true);
        	$criteria = new CDbCriteria();
			$criteria->condition = "t.id_usuario = ".$this->_identity->getId();
			$rol_usuario=TUsuario::model()->with('rolUsuario','idPersona')->findAll($criteria);
			$nombreUsuario= $rol_usuario[0]['idPersona']->nombres." ".$rol_usuario[0]['idPersona']->apellidos;
			Yii::app()->user->setState('nombreUsuario',$nombreUsuario,true);


			if (count($rol_usuario)>0){


				foreach ($rol_usuario as $key => $value){
					//ojo cuando data = 1 es que es el rol predominante
					foreach ($value->rolUsuario as $key1 => $value1){
						//if ($value1->data==1){
							$id_rol=$value1->itemname;
						//}
					}

				}

	        	Yii::app()->user->setState('id_rol',$id_rol,true);
	        	if (!isset($id_rol)){
	        		throw new CHttpException('501','Error el usuario no tiene rol asignado ');
	        	}


	        	/*if ($id_rol=='admin'){


	        		//Yii::import('application.modules.Esculapio.models.TMedico');

	        		/*try {
	        		$medico=TMedico::model()->find('id_datos_basicos='.$rol_usuario[0]->id_persona);*/
	        		//Yii::app()->user->setState('id_medico',$medico->id_medico,true);
	        		/*}catch (Exception $e) {
						$message=$e."Error: No se encuentra registrado como Médico, contactar al adminitsrador del sistema.";
						throw new CHttpException('',$message);

					}*/
	        	/*}elseif ($id_rol=='participante'){
	        		Yii::import('application.modules.Esculapio.models.TEntidad');
	        		$clinica=TEntidad::model()->find('id_datos_basicos='.$rol_usuario[0]->id_persona);
	        		Yii::app()->user->setState('id_clinica',$clinica->id_entidad,true);
	        	}*/



	        	Yii::app()->user->setState('id_persona',$rol_usuario[0]->id_persona,true);


	        	//Yii::app()->user->setState('img_perfil',$img_perfil,true);  // Eliminacion de este campo


				$duration=$this->rememberMe ? 5 : 0; // 30 days
				Yii::app()->user->login($this->_identity,$duration);


				return true;
			}else {
				return false;
			}
		}

			return false;
	}


	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	/*public function login()
	{

		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}*/


}
