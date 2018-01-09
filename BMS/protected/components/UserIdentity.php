<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	/*public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'jesuspat'=>'*pat2015*',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}*/


	protected $_id;

	public function authenticate()
	{
		// $users=array(
		// 	// username => password
		// 	'demo'=>'demo',
		// 	'admin'=>'admin',
		// );
		// if(!isset($users[$this->username]))
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// elseif($users[$this->username]!==$this->password)
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// else
		// 	$this->errorCode=self::ERROR_NONE;
		// return !$this->errorCode;


		//Yii::import('models.*');
	    //Yii::import('controllers.*');

		try{

			//echo "entroooo".$this->username;

			$user=TUsuario::model()->findByAttributes(array('usuario'=>$this->username));

			//var_dump($user); exit();
			
			if($user===NULL){
	            $this->errorCode=self::ERROR_USERNAME_INVALID;
			}else if($user->id_estatus==2){
	        	$this->errorMessage='inactivo';
	        		//echo "inactivo";
	        }else if($user->id_estatus==3){
	        	$this->errorMessage='bloqueado';
	        		//echo "bloqueado";
	        }else if ($user->palabra_clave !== $this->password) {
	        	//echo "entroooooooo";
	        	//TAcceso::model()->verificarIntentos($user->id_usuario,'fallido');
	        	$this->errorCode=self::ERROR_PASSWORD_INVALID;
	        }else{

	        	/*$resultado=TAcceso::model()->verificarSesionMultip($user->id_usuario);
	        	
				if($resultado==1){
                    $this->errorMessage='sesiones activas';

                }else if($resultado==2){
                    $this->errorMessage='error';

                }else if($resultado==3){
                    $this->errorMessage='varios equipos';

                }else{     */             	
                    $this->_id= $user->id_usuario;
                    $this->username= $user->usuario;
                    $this->errorCode= self::ERROR_NONE;



               // }      	            
	        }

	        return !$this->errorCode;

	        
		}catch (Exception $e) { 
			$message="Error al consultar datos del usuarioooo, contactar al Administrador del Sistema.";
			throw new CHttpException(400,$message);
			echo $e->getMessage(); 
		}
        

	}
	
	public function getId(){
        return $this->_id;
    }
}