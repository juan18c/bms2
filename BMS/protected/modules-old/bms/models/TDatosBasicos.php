<?php

/**
 * This is the model class for table "t_datos_basicos".
 *
 * The followings are the available columns in table 't_datos_basicos':
 * @property integer $id_datos_basicos
 * @property integer $id_tipo_identificacion
 * @property integer $nro_identificacion
 * @property integer $titular
 * @property string $nombres
 * @property string $apellidos
 * @property string $sexo
 * @property string $fecha_nacimiento
 * @property string $estado_civil
 * @property string $telefono_cel
 * @property integer $id_perfil
 * @property string $imagen_perfil
 * @property integer $ind_contacto
 * @property string $nota_interes
 * @property integer $ind_proveedor
 * @property string $fecha_contacto
 * @property integer $ind_medico
 * @property integer $ind_empresa
 * @property string $email
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TBeneficiario[] $tBeneficiarios
 * @property TBeneficiario[] $tBeneficiarios1
 * @property TCarrito[] $tCarritos
 * @property TMedico[] $tMedicos
 * @property TCotizacion[] $tCotizacions
 * @property TEstatus $idEstatus
 * @property TPerfil $idPerfil
 * @property TTipoIdentificacion $idTipoIdentificacion
 * @property TDatosBasicosDireccion[] $tDatosBasicosDireccions
 * @property THistoriaMedica[] $tHistoriaMedicas
 * @property TMedico[] $tMedicos1
 * @property TProducto[] $tProductos
 */
class TDatosBasicos extends CActiveRecord
{		
	public $descripcionList;	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_datos_basicos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nro_identificacion, nombres, apellidos, email, telefono_cel', 'required'),
			array('id_tipo_identificacion, nro_identificacion, titular, id_perfil, ind_contacto, ind_proveedor, ind_medico, ind_empresa, id_estatus', 'numerical', 'integerOnly'=>true),
			array('nro_identificacion','verificarIdentificacion'),
			array('nombres, apellidos', 'length', 'max'=>60),
			array('sexo', 'length', 'max'=>1),
			array('estado_civil, telefono_cel', 'length', 'max'=>20),
			array('imagen_perfil', 'length', 'max'=>500),
			array('nota_interes, email', 'length', 'max'=>250),
			array('fecha_nacimiento', 'safe'),
			array('email','verificarEmail'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_datos_basicos, id_tipo_identificacion, nro_identificacion, titular, nombres, apellidos, sexo, fecha_nacimiento, estado_civil, telefono_cel, id_perfil, imagen_perfil, ind_contacto, nota_interes, ind_proveedor, fecha_contacto, ind_medico, ind_empresa, email, id_estatus, fecha_creacion, descripcionList', 'safe', 'on'=>'search'),
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
			'tBeneficiarios' => array(self::HAS_MANY, 'TBeneficiario', 'id_responsable'),
			'tBeneficiarios1' => array(self::HAS_MANY, 'TBeneficiario', 'id_beneficiario'),
			'tCarritos' => array(self::HAS_MANY, 'TCarrito', 'id_datos_basicos'),
			'tMedicos' => array(self::MANY_MANY, 'TMedico', 't_cliente_medico(id_cliente, id_medico)'),
			'tCotizacions' => array(self::HAS_MANY, 'TCotizacion', 'id_responsable'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idPerfil' => array(self::BELONGS_TO, 'TPerfil', 'id_perfil'),
			'idTipoIdentificacion' => array(self::BELONGS_TO, 'TTipoIdentificacion', 'id_tipo_identificacion'),
			'tDatosBasicosDireccions' => array(self::HAS_MANY, 'TDatosBasicosDireccion', 'id_datos_basicos'),
			'tHistoriaMedicas' => array(self::HAS_MANY, 'THistoriaMedica', 'id_responsable'),
			'tMedicos1' => array(self::HAS_MANY, 'TMedico', 'id_datos_basicos'),
			'tProductos' => array(self::HAS_MANY, 'TProducto', 'id_marca'),		
			'idUsuario' => array(self::HAS_MANY, 'TUsuario', 'id_usuario'),
		);
	}
	


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_datos_basicos' => 'Id Datos Basicos',
			'id_tipo_identificacion' => 'Tipo Identificación',
			'nro_identificacion' => 'Nro Identificación',
			'titular' => 'Titular',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'sexo' => 'Sexo',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'estado_civil' => 'Estado Civil',
			'telefono_cel' => 'Teléfono Celular',
			'id_perfil' => 'Id Perfil',
			'imagen_perfil' => 'Imagen Perfil',
			'ind_contacto' => 'Ind Contacto',
			'nota_interes' => 'Nota de Acceso al Sistema',
			'ind_proveedor' => 'Proveedor',
			'fecha_contacto' => 'Fecha Contacto',
			'ind_medico' => 'Médico',
			'ind_empresa' => 'Empresa',
			'email' => 'Email',
			'id_estatus' => 'Estatus',
			'fecha_creacion' => 'Fecha Creacion'
		);
	}


	public function verificarEmail(){
	    //after all validation rules
	    // if(!$this->hasErrors()){
	        $check=TUsuario::model()->findByAttributes(array('usuario'=>$this->email)); //or $this->new_email_confirm
	        if(!is_null($check) || !empty($check)){
	            $this->addError('email','Este email ya se encuentra registrado.');
	            Yii::app()->user->setFlash('error', "Data2 failed!");
	        }
	    // }
	} 

	public function verificarIdentificacion(){
		$titular = empty($this->titular) ? 0 : $this->titular;
		
        $check=TDatosBasicos::model()->findAll('id_tipo_identificacion='.$this->id_tipo_identificacion.' AND nro_identificacion='.$this->nro_identificacion.' AND titular= '.$titular.' AND id_perfil NOT IN (3,4) '); //or $this->new_email_confir
        if(count($check) > 0){
            $this->addError('nro_identificacion','Esta persona ya se encuentra registrada.');
        }
	   
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

		$criteria->compare('id_datos_basicos',$this->id_datos_basicos);
		$criteria->compare('id_tipo_identificacion',$this->id_tipo_identificacion);
		$criteria->compare('nro_identificacion',$this->nro_identificacion);
		$criteria->compare('titular',$this->titular);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('estado_civil',$this->estado_civil,true);
		$criteria->compare('telefono_cel',$this->telefono_cel,true);
		$criteria->compare('id_perfil',$this->id_perfil);
		$criteria->compare('imagen_perfil',$this->imagen_perfil,true);
		$criteria->compare('ind_contacto',$this->ind_contacto);
		$criteria->compare('nota_interes',$this->nota_interes,true);
		$criteria->compare('ind_proveedor',$this->ind_proveedor);
		$criteria->compare('fecha_contacto',$this->fecha_contacto,true);
		$criteria->compare('ind_medico',$this->ind_medico);
		$criteria->compare('ind_empresa',$this->ind_empresa);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->order = 'nombres ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDatosBasicos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
