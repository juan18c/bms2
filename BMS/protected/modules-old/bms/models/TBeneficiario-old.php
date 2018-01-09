<?php

/**
 * This is the model class for table "t_beneficiario".
 *
 * The followings are the available columns in table 't_beneficiario':
 * @property integer $id_beneficiario
 * @property integer $id_responsable
 * @property integer $id_parentesco
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TDatosBasicos $idBeneficiario
 * @property TDatosBasicos $idResponsable
 * @property TEstatus $idEstatus
 * @property TParentesco $idParentesco
 * @property TCotizacion[] $tCotizacions
 */
class TBeneficiario extends CActiveRecord
{
	public $descripcionList;
	public $indResponsable;
	public $beneficiario;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_beneficiario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_responsable, id_parentesco', 'required'),
			array('id_beneficiario, id_responsable, id_parentesco, id_estatus, beneficiario', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario, id_responsable, id_parentesco, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idBeneficiario' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_beneficiario'),
			'idResponsable' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_responsable'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idParentesco' => array(self::BELONGS_TO, 'TParentesco', 'id_parentesco'),
			// 'tCotizacions' => array(self::MANY_MANY, 'TCotizacion', 't_cotizacion_beneficiario(id_beneficiario, id_cotizacion)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario' => 'Id Beneficiario',
			'id_responsable' => 'Id Responsable',
			'id_parentesco' => 'Id Parentesco',
			'id_estatus' => 'Id Estatus',
			'fecha_creacion' => 'Fecha Creacion',
			'indResponsable' => 'La cotización es?'
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

		$criteria->compare('id_beneficiario',$this->id_beneficiario);
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('id_parentesco',$this->id_parentesco);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchCot($idResponsable)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_beneficiario',$this->id_beneficiario);
		$criteria->compare('id_responsable',$idResponsable);
		$criteria->compare('id_parentesco',$this->id_parentesco);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('idBeneficiario.nombres',$this->beneficiario);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getLista($idPersona)
	{
		$salida[] = '' ;
		// @todo Please modify the following code to remove attributes that should not be searched.
		if (!empty($idPersona)) {			
		
			$criteria=new CDbCriteria;
			$criteria->select = array('t.id_beneficiario',"CONCAT( `idBeneficiario`.`nombres`,' ',`idBeneficiario`.`apellidos`) as descripcionList");
			$criteria->with = array('idBeneficiario');
			$criteria->condition = 't.id_responsable = '.$idPersona;

			$salida = CHtml::listData($this->findAll($criteria),'id_beneficiario','descripcionList');
		}
		return $salida;

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TBeneficiario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
