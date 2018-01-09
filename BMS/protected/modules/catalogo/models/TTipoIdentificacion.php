<?php

/**
 * This is the model class for table "esculapio.t_tipo_identificacion".
 *
 * The followings are the available columns in table 'esculapio.t_tipo_identificacion':
 * @property integer $id_tipo_identificacion
 * @property string $descripcion
 * @property string $abreviatura
 * @property string $fecha_creacion
 * @property integer $id_estatus
 *
 * The followings are the available model relations:
 * @property TDatosBasicos[] $tDatosBasicoses
 * @property TEstatus $idEstatus
 */
class TTipoIdentificacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms_catalogo.t_tipo_identificacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tipo_identificacion, fecha_creacion', 'required'),
			array('id_tipo_identificacion, id_estatus', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>100),
			array('abreviatura', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tipo_identificacion, descripcion, abreviatura, fecha_creacion, id_estatus', 'safe', 'on'=>'search'),
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
			'tDatosBasicoses' => array(self::HAS_MANY, 'TDatosBasicos', 'id_tipo_identificacion'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_identificacion' => 'Id Tipo Identificacion',
			'descripcion' => 'Descripcion',
			'abreviatura' => 'Abreviatura',
			'fecha_creacion' => 'Fecha Creacion',
			'id_estatus' => 'Id Estatus',
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

		$criteria->compare('id_tipo_identificacion',$this->id_tipo_identificacion);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('abreviatura',$this->abreviatura,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_estatus',$this->id_estatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getDescTipoIdentificacion($id)
	{
		$criteria= new CDbCriteria;
		$criteria->select = array('initcap(descripcion) AS descripcion');
		$criteria->addCondition("t.id_tipo_identificacion = ".$id);	

		$tipo_identificacion = $this->find($criteria);
		return $tipo_identificacion->descripcion;
		
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TTipoIdentificacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

