<?php

/**
 * This is the model class for table "t_historia_medica".
 *
 * The followings are the available columns in table 't_historia_medica':
 * @property integer $id_historia_medica
 * @property integer $id_responsable
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TDatosBasicos $idResponsable
 * @property TEstatus $idEstatus
 * @property THistoriaMedicaCaso[] $tHistoriaMedicaCasos
 */
class THistoriaMedica extends CActiveRecord
{	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_historia_medica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_responsable', 'required'),
			array('id_responsable, id_estatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_historia_medica, id_responsable, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idResponsable' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_responsable'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'tHistoriaMedicaCasos' => array(self::HAS_MANY, 'THistoriaMedicaCaso', 'id_historia_medica')			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_historia_medica' => 'Cód. Historia',
			'id_responsable' => 'Responsable',
			'id_estatus' => 'Estatus',
			'fecha_creacion' => 'Fecha Creación',
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

		$criteria->compare('id_historia_medica',$this->id_historia_medica);
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return THistoriaMedica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
