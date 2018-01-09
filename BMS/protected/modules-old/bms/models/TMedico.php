<?php

/**
 * This is the model class for table "t_medico".
 *
 * The followings are the available columns in table 't_medico':
 * @property integer $id_medico
 * @property integer $id_datos_basicos
 * @property string $cod_matricula
 * @property integer $id_estatus
 * @property string $fecha_creacion
 * @property string $rif
 * @property string $logo_recipe
 * @property integer $ind_modulo_cita
 * @property string $dias_consulta
 * @property integer $tipo_atencion
 * @property string $datos_contacto
 * @property integer $ind_aprobado
 *
 * The followings are the available model relations:
 * @property TDatosBasicos $idDatosBasicos
 * @property TEstatus $idEstatus
 */
class TMedico extends CActiveRecord
{
	public $descripcionList;
	public $indMedico;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_medico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_datos_basicos', 'required'),
			array('id_medico,id_datos_basicos, id_estatus, ind_modulo_cita, tipo_atencion, ind_aprobado,indMedico', 'numerical', 'integerOnly'=>true),
			array('cod_matricula', 'length', 'max'=>150),
			array('rif', 'length', 'max'=>16),
			array('logo_recipe, datos_contacto', 'length', 'max'=>250),
			array('dias_consulta', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_medico, id_datos_basicos, cod_matricula, id_estatus, fecha_creacion, rif, logo_recipe, ind_modulo_cita, dias_consulta, tipo_atencion, datos_contacto, ind_aprobado,indMedico', 'safe', 'on'=>'search'),
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
			'tDatosBasicoses' => array(self::MANY_MANY, 'TDatosBasicos', 't_cliente_medico(id_medico, id_cliente)'),
			'tHistoriaMedicaCasoMedicos' => array(self::HAS_MANY, 'THistoriaMedicaCasoMedico', 'id_medico'),
			'idDatosBasicos' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_datos_basicos'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'tEspecialidads' => array(self::MANY_MANY, 'TEspecialidad', 't_medico_especialidad(id_medico, id_especialidad)'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_medico' => 'Id Medico',
			'id_datos_basicos' => 'Id Datos Basicos',
			'cod_matricula' => 'Código de Matricula',
			'id_estatus' => 'Estatus',
			'fecha_creacion' => 'Fecha',
			'rif' => 'Rif',
			'logo_recipe' => 'Logo Recipe',
			'ind_modulo_cita' => 'Activar Módulo de Citas',
			'dias_consulta' => 'Días de Consulta',
			'tipo_atencion' => 'Tipo de Atención',
			'datos_contacto' => 'Datos de Contacto',
			'ind_aprobado' => 'Ind Aprobado',
			'indMedico' => 'Hay un médico a cargo? '
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

		$criteria->compare('id_medico',$this->id_medico);
		$criteria->compare('id_datos_basicos',$this->id_datos_basicos);
		$criteria->compare('cod_matricula',$this->cod_matricula,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('rif',$this->rif,true);
		$criteria->compare('logo_recipe',$this->logo_recipe,true);
		$criteria->compare('ind_modulo_cita',$this->ind_modulo_cita);
		$criteria->compare('dias_consulta',$this->dias_consulta,true);
		$criteria->compare('tipo_atencion',$this->tipo_atencion);
		$criteria->compare('datos_contacto',$this->datos_contacto,true);
		$criteria->compare('ind_aprobado',$this->ind_aprobado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getLista()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = array('t.id_medico',"CONCAT( `idDatosBasicos`.`nombres`,' ',`idDatosBasicos`.`apellidos`) as descripcionList");
		$criteria->with = array('idDatosBasicos');
		$criteria->condition = 't.id_estatus = 1 ';
		return $this->findAll($criteria);

	}

	public function getMedico($idMedico)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = array('t.id_medico',"CONCAT( `idDatosBasicos`.`nombres`,' ',`idDatosBasicos`.`apellidos`) as descripcionList","`idDatosBasicos`.`sexo`");
		$criteria->with = array('idDatosBasicos');
		$criteria->condition = 't.id_estatus = 1 AND t.id_medico = '.$idMedico;
		return $this->findAll($criteria);

	}

	public function getMedicoEspecialidad($idMedico)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;		
		$criteria->with = array('tEspecialidads.tMedicos');
		$criteria->condition = 't.id_estatus = 1 AND t.id_medico = '.$idMedico;
		return $this->findAll($criteria);

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TMedico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
