<?php

/**
 * This is the model class for table "bms_seguridad.t_usuario".
 *
 * The followings are the available columns in table 'bms_seguridad.t_usuario':
 * @property integer $id_usuario
 * @property string $usuario
 * @property string $palabra_clave
 * @property integer $nro_intentos
 * @property integer $id_persona
 * @property string $fecha_creacion
 * @property integer $id_estatus
 *
 * The followings are the available model relations:
 * @property TDatosBasicos $idPersona
 * @property TAuditoria[] $tAuditorias
 * @property TAcceso[] $tAccesos
 * @property TImagenLoginUsuario[] $tImagenLoginUsuarios
 * @property AuthItem[] $bms_seguridad.AuthItems
 */
class TUsuario extends CActiveRecord
{
	public $confirmar_clave;
	public $cedula;
	public $perfil;
	//public $existeEmail;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms_seguridad.t_usuario';
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario, palabra_clave,confirmar_clave', 'required'),
			array('usuario', 'email','message'=>"El formato de correo no es correcto."),
			//array('usuario', 'required','message'=>"Ingrese su usuario."),
			array('usuario', 'required','message'=>"Ingrese su usuario"),
			array('palabra_clave', 'required','message'=>"Ingrese su clave"),
			array('confirmar_clave', 'required','message'=>"Ingrese su confirmar clave"),
			array('usuario', 'unique','message'=>"Este email ya se encuentra registrado."),
			array('nro_intentos, id_persona, id_estatus,cedula,perfil', 'numerical', 'integerOnly'=>true),
			//array('palabra_clave', 'length', 'max'=>40),	
			array('palabra_clave','length','max'=>40, 'min'=>6),
			array('confirmar_clave','length','max'=>40, 'min'=>6),
			array('palabra_clave', 'compare', 'compareAttribute'=>'confirmar_clave'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario,usuario,cedula,confirmar_clave, nro_intentos, id_persona, fecha_creacion, id_estatus,perfil', 'safe', 'on'=>'search'),
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
			'idPersona' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_persona'),
			//'tAuditorias' => array(self::HAS_MANY, 'TAuditoria', 'id_usuario'),
			//'tAccesos' => array(self::HAS_MANY, 'TAcceso', 'id_usuario'),
			//'tImagenLoginUsuarios' => array(self::HAS_MANY, 'TImagenLoginUsuario', 'id_usuario'),
			'rolUsuario' => array(self::HAS_MANY, 'AuthAssignment', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			//'usuario' => 'Usuario',
			'palabra_clave' => 'Palabra Clave',
			'nro_intentos' => 'Nro Intentos',
			'id_persona' => 'Id Persona',
			'fecha_creacion' => 'Fecha Usuario',
			'id_estatus' => 'Id Estatus',
			'confirmar_clave'=>'Confirmar clave',
			'usuario'=>'Usuario',			
		);
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
		
		
		//$criteria->select = array('','','','','');
		$criteria->with = array(
				'idPersona'=>array('select'=>'nro_identificacion,id_perfil'),					
		);
		

		//$criteria->compare('id_usuario',$this->id_usuario);
		//$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('t.palabra_clave',$this->palabra_clave,true);
		$criteria->compare('t.usuario',$this->usuario,true);
		$criteria->compare('t.nro_intentos',$this->nro_intentos);
		
		$criteria->compare('`idPersona`.`nro_identificacion`::text',$this->cedula,true);
		$criteria->compare('`idPersona`.`id_perfil`',$this->perfil);
		
		$criteria->compare('t.fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('t.id_estatus',$this->id_estatus);		
		
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
		$position = array();
		$newRow = array();
		foreach ($toOrderArray as $key => $row) {
			$position[$key]  = $row[$field];
			$newRow[$key] = $row;
		}
		if ($inverse) {
			arsort($position);
		}
		else {
			asort($position);
		}
		$returnArray = array();
		foreach ($position as $key => $pos) {
			$returnArray[] = $newRow[$key];
		}
		return $returnArray;
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function CargarMenu()
	{
		
		yii::import('application.modules.auth.controllers.*');	

		
		$am = Yii::app()->authManager;
				
		$assignments = $am->getAuthAssignments(Yii::app()->session['_id']);
		$assignedItems = array_keys($assignments);
		
		$menu="";
		foreach ($assignedItems as $key => $rol){
			$item = $am->getAuthItem($rol);
			
			$opcion=$item->getChildren();

			$menu1=array();
			foreach ($opcion as $itemName => $val) {
				if ($val->type == 1){	
					$reg=AuthItem::model()->findByPk($val->name);
					array_push($menu1, $reg);
					
				}	
			}
			$menu1=$this->orderMultiDimensionalArray($menu1,"orden");

		foreach ($menu1 as $i => $op) {
			foreach ($opcion as $itemName => $item) {
				if ($op->name==$item->name){
					if ($item->type == 1){
							
						$menu.= '<li class="dropdown">
		               		     <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-list-alt icon-white"></i>'.$item->description.'<b class="caret"></b></a>';
						$hijoMenu="";
						$tieneHijo=0;
						if (count($item->children)>0){
							$hijoMenu.=	'<ul class="dropdown-menu">';
							$arreglo=array();
							$ordenado=array();
							foreach ($item->children as $itemChild => $child) {	//	$child->namea				
								$modelHijo=AuthItem::model()->findAll(array("condition" => "name = '".$child->name."'","order" => "orden"))[0];							
								if 	($modelHijo->menu==1){
									array_push($ordenado, $modelHijo);
									$ordenado=$this->orderMultiDimensionalArray($ordenado,"orden");
								}else{
									
								}
							}
							foreach ($ordenado as $itemChild => $child) {
								$hijoMenu.= '<li><a href="?r='.$child->name.'">'.$child->description.'</a></li>';
								$tieneHijo = 1;
								
							}
							$hijoMenu.=	'</ul>';
						}
						
						
						
						if ($tieneHijo==0)
							$hijoMenu="";
							
						$menu.=$hijoMenu;
						$menu.= '</li>';
					}
				
				}
			
			}
			
		}
	}	
		
	echo $menu;		

	}
	

	

	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function CargarMenuLateral()
	{

		yii::import('application.modules.auth.controllers.*');	
	
		$am = Yii::app()->authManager;
		$menu= array();
		$padre=explode('=', strtoupper(Yii::app()->request->getUrl()));
		$assignments = $am->getAuthAssignments(Yii::app()->session['_id']);
		$assignedItems = array_keys($assignments);
		$padreMenu=explode('/', $padre[1]);
		//print_r($padreMenu);
		foreach ($assignedItems as $key => $rol){

			$item = $am->getAuthItem($rol);
			if ($item->getChildren()){
				$opcion=$item->getChildren();
				
				foreach ($opcion as $itemName => $item) {
					$modelHijo=AuthItem::model()->findByPk($item->name);
					if 	(($modelHijo->menu==2)&&(strtoupper($modelHijo->padre) == $padreMenu[1])){
						$url=explode('/', $modelHijo->name);
						$agregar=array('label'=>$modelHijo->description, 'url'=>array($url[1].'/'.$url[2]));
						array_push($menu,$agregar);				
						//echo $modelHijo->name;
					}
						
				}
			}else{
				
				$modelHijo=AuthItem::model()->findByPk($item->name);
				if 	($modelHijo->menu==2){
					$agregar=array('label'=>$modelHijo->description, 'url'=>array($modelHijo->name));
					array_push($menu,$agregar);
				
					//echo $modelHijo->name;
				}
			}
		}
		//print_r($menu);
		return $menu;
	
	}
	
	public function verificarAccessoEnfermera($idTurno,$id_datos_basicos){
		
		$modelControl=TControlEnfermeria::model()->findAll('id_datos_basicos='.$id_datos_basicos." and  id_empleado_turno=".$idTurno." and to_char(fecha_control,'dd-mm-yyyy') = to_char(current_date,'dd-mm-yyyy')");
		if (count($modelControl)>0)
			return true;
		else
			return false;
	}
	
	public function obtenerLogo($id_clinica)
	{
		$datos=TEntidad::model()->findByPk($id_clinica);
		//print_r($datos);
		echo "<br><br><br><img align='center' src='".$datos->entidad_datos_basicos->img_perfil."' alt='Clinica'  >";
	}

	
	public function existeEmail($email)
	{
		$datos=TUsuario::model()->findByAll('usuario="'.$email.'"');
		if (count($datos)>0){
			return 1;
		}else{
			return 0;
		}
		//print_r($datos);
		//echo "<br><br><br><img align='center' src='".$datos->entidad_datos_basicos->img_perfil."' alt='Clinica'  >";
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}