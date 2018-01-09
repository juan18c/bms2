<?php

/**
 * This is the model class for table "t_moneda".
 *
 * The followings are the available columns in table 't_moneda':
 * @property integer $id_moneda
 * @property string $descripcion
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TAlmacen[] $tAlmacens
 * @property TAlmacen[] $tAlmacens1
 */
class TMoneda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_moneda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, fecha_creacion', 'required'),
			array('id_estatus', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_moneda, descripcion, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'tAlmacens' => array(self::HAS_MANY, 'TAlmacen', 'id_moneda_base'),
			'tAlmacens1' => array(self::HAS_MANY, 'TAlmacen', 'id_moneda_venta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_moneda' => 'Id Moneda',
			'descripcion' => 'Descripcion',
			'id_estatus' => 'Id Estatus',
			'fecha_creacion' => 'Fecha Creacion',
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

		$criteria->compare('id_moneda',$this->id_moneda);
		$criteria->compare('descripcion',$this->descripcion,true);
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
	 * @return TMoneda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
