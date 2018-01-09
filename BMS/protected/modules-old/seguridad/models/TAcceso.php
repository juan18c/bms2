<?php

/**
 * This is the model class for table "bms_seguridad.t_acceso".
 *
 * The followings are the available columns in table 'bms_seguridad.t_acceso':
 * @property integer $id_usuario
 * @property string $acceso
 * @property string $ip_address
 * @property integer $nro_sesion
 * @property string $fecha_ingreso
 *
 * The followings are the available model relations:
 * @property TUsuario $idUsuario
 */
class TAcceso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms_seguridad.t_acceso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, acceso, ip_address', 'required'),
			array('id_usuario, nro_sesion', 'numerical', 'integerOnly'=>true),
			array('acceso', 'length', 'max'=>250),
			array('ip_address', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, acceso, ip_address, nro_sesion, fecha_ingreso', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idUsuario' => array(self::BELONGS_TO, 'TUsuario', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'acceso' => 'Acceso',
			'ip_address' => 'Ip Address',
			'nro_sesion' => 'Nro Sesion',
			'fecha_ingreso' => 'Fecha Ingreso',
		);
	}

	public function verificarIntentos($id,$acceso)	
	{
		//echo "entrooo verificar";
		$model=new TAcceso;
		$intento=0;
		$valor=3;//usuario bloqueado 
		$access=TUsuario::model()->findByAttributes(array('id_usuario'=>$id));

		if(!empty($access)){
			$intento=$access->nro_intentos;
			//echo "intento:".$intento;
			$idUsuario = $access->id_usuario;
			$val= $intento+1;
			
			if (($intento==3)||($val==3)){
				
				$sql = "UPDATE bms_seguridad.t_usuario SET id_estatus=:valor, nro_intentos=:intentos  WHERE id_usuario =:id";
				$comando = Yii::app() -> db -> createCommand($sql); 
				$comando -> bindParam(":id",$idUsuario, PDO::PARAM_INT); 
				$comando -> bindParam(":intentos",$valor, PDO::PARAM_INT);
				$comando -> bindParam(":valor",$valor, PDO::PARAM_INT);  
				$control = $comando -> execute(); 
			}else{

				$intento=$access->nro_intentos;
				$val= $intento+1;
				$sql = "UPDATE bms_seguridad.t_usuario SET nro_intentos=:valor  WHERE id_usuario =:id";
				$comando = Yii::app() -> db -> createCommand($sql);
				$comando -> bindParam(":id",$idUsuario, PDO::PARAM_INT); 
				$comando -> bindParam(":valor",$val, PDO::PARAM_INT);  
				$control = $comando -> execute();	
			}
		}

	}
	
	public function verificarSesionMultip($id)
	{

		$criteria = new CDbCriteria();
		$criteria->condition = "t.id_usuario = ".$id." and importancia = (Select max(importancia) from bms_seguridad.t_usuario_rol)";
		$rol_usuario=TUsuario::model()->with('usuario_rol')->findAll($criteria);

        $result=0;

        if(!empty($rol_usuario)){
			 			       
			$boolSesion=$rol_usuario[0]->usuario_rol[0]->multi_sesion;
			$boolIp=$rol_usuario[0]->usuario_rol[0]->multi_ip;
			$ip=CHttpRequest::getUserHostAddress();
			       	
			$acceso_anterior=TAcceso::model()->findByAttributes(array('id_usuario'=>$id));

			if(!empty($acceso_anterior)){ // 2 acceso con la misma ip
				if ($acceso_anterior->nro_sesion==0){
				    $v=1;
				    $acceso="exitoso";
				    $sql = "UPDATE bms_seguridad.t_acceso SET nro_sesion=:intentos, fecha_ingreso_usuario=now(), acceso=:access  WHERE id_usuario =:id and ip_address=:ips";
					$comando = Yii::app() -> db -> createCommand($sql);
					$comando -> bindParam(":id",$id, PDO::PARAM_INT);
				   // $comando -> bindParam(":now",now(), PDO::PARAM_TIME);
					$comando -> bindParam(":intentos",$v, PDO::PARAM_INT);
				    $comando -> bindParam(":ips",$ip, PDO::PARAM_STR);
				    $comando -> bindParam(":access",$acceso, PDO::PARAM_STR);
				   	$control = $comando -> execute();
					$intentos_access=TUsuario::model()->findByAttributes(array('id_usuario'=>$id));
						if($intentos_access->nro_intentos!=0){
				      		    $intent=0;
				      			$sql = "UPDATE bms_seguridad.t_usuario SET nro_intentos=:intentos WHERE id_usuario =:id";
				    			$comando = Yii::app() -> db -> createCommand($sql);
				        		$comando -> bindParam(":id",$id, PDO::PARAM_INT);
				            	$comando-> bindParam(":intentos",$intent, PDO::PARAM_INT);
				            	$control = $comando -> execute();		

				     }
				   	
				    $result=0;
				    
				}else{
					
				    if($boolSesion==1){
				    	       
				                $v=$acceso_anterior->nro_sesion + 1;
				                $sql = "UPDATE bms_seguridad.t_acceso SET nro_sesion=:intentos, fecha_ingreso= now()  WHERE id_usuario =:id and ip_address=:ips";
								$comando = Yii::app() -> db -> createCommand($sql);
								$comando -> bindParam(":id",$id, PDO::PARAM_INT);
				                //$comando -> bindParam(":now",now(), PDO::PARAM_TIME);
								$comando -> bindParam(":intentos",$v, PDO::PARAM_INT);
				                $comando -> bindParam(":ips",$ip, PDO::PARAM_STR);
							   	$control = $comando-> execute();
							   	
							    $intentos_access=TUsuario::model()->findByAttributes(array('id_usuario'=>$id));
							   
							   	if($intentos_access->nro_intentos!=0){
							   		    $intent=0;
							   			$sql = "UPDATE bms_seguridad.t_usuario SET nro_intentos=:intentos WHERE id_usuario =:id";
										$comando = Yii::app() -> db -> createCommand($sql);
										$comando -> bindParam(":id",$id, PDO::PARAM_INT);
										$comando-> bindParam(":intentos",$intent, PDO::PARAM_INT);
				                		$control = $comando -> execute();		
							   	
							   	}
				              
				                $result=0;//"acceso exitoso";

				    }else{			    	
				          $result=1; //"No tiene suficientes privilegios para tener varias sesiones activas";
				    }				  
				}

              }else{

				$acceso_x_ip=TAcceso::model()->findByAttributes(array('id_usuario'=>$id));

				if(!empty($acceso_x_ip)){
				    if($boolIp==1){

				        $model=new TAcceso;
				        $model->id_usuario=$id;
				        $model->acceso="exitoso";
				        $model->ip_address=$ip;
				        $model->nro_sesion=1;
				       
				        if ($model->save())
				            $result=0;//"acceso exitoso";
				        else
				            $result=2;//"error";
				    }else{
				        $result=3;//"No tiene suficientes privilegios para tener acceso de varios equipos";
				    }
				}else{
					
				    $modelAcceso=new TAcceso;
				    $modelAcceso->id_usuario=$id;
				    $modelAcceso->acceso="exitoso";
				    $modelAcceso->ip_address=$ip;
				    $modelAcceso->nro_sesion=1;                        
				   
				    if ($modelAcceso->save())
				            $result=0;//"acceso exitoso";
				    else
				            $result=2;//"error";
				}
			}
        }
    	
        return $result;

	}
	
	

	
	public function cerrarAcceso($id){
			
		 $ip=CHttpRequest::getUserHostAddress();
		//echo "id".$id."ip".$ip;

         $eliminarAcceso=TAcceso::model()->findByAttributes(array('id_usuario'=>$id,'ip_address'=>$ip));

		 if(!empty($eliminarAcceso)){
		 	 $n_sesion=$eliminarAcceso->nro_sesion;
		 	 if($n_sesion>1){
		 	    $n_sesion=$n_sesion - 1;
		 	   
                $sql = "UPDATE bms_seguridad.t_acceso SET nro_sesion=:intentos, fecha_ingreso= now()  WHERE id_usuario =:id and ip_address=:ip";
                $comando = Yii::app() -> db -> createCommand($sql);
                $comando -> bindParam(":id",$id, PDO::PARAM_INT);               
                $comando -> bindParam(":intentos",$n_sesion, PDO::PARAM_INT);
                $comando -> bindParam(":ip",$ip, PDO::PARAM_STR);
                $control = $comando -> execute();

                if( $control){
                	 $result=1;//" exitoso";                	 
                }else
                	$result=0;//" denegado";
                			 	 	
		 	 }else if($n_sesion==1){
		 	 	 
		 	 	$sql = "DELETE from bms_seguridad.t_acceso WHERE id_usuario =:id and ip_address=:ip";
                $comando = Yii::app() -> db -> createCommand($sql);
                $comando -> bindParam(":id",$id, PDO::PARAM_INT);
                $comando -> bindParam(":ip",$ip, PDO::PARAM_STR);
                $control = $comando -> execute();
                if( $control)
                	 $result=1;//" exitoso";
                else
                	$result=0;//" denegado";
		 	 }
		 	
		 }else{
		 	$result=0;//" denegado";
		 }
		 
		 return $result;
		 	 
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('acceso',$this->acceso,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('nro_sesion',$this->nro_sesion);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TAcceso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
