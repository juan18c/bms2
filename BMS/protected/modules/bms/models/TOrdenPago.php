<?php

/**
 * This is the model class for table "t_orden_pago".
 *
 * The followings are the available columns in table 't_orden_pago':
 * @property integer $id_orden_pago
 * @property integer $id_orden
 * @property integer $numero
 * @property integer $tarjeta
 * @property double $monto
 * @property integer $email
 * @property integer $id_medio_pago
 * @property string $fecha_pago
 * @property integer $id_estatus
 * @property string $fecha_creacion
 */
class TOrdenPago extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_orden_pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_orden', 'required'),
			array('id_orden, numero_tarjeta, id_medio_pago, id_estatus', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			array('fecha_pago', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_orden_pago, id_orden, numero_tarjeta, nombre_tarjeta, monto, email, id_medio_pago, fecha_pago, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idOrden' => array(self::BELONGS_TO, 'TOrden', 'id_orden'),
			'idMedioPago' => array(self::BELONGS_TO, 'TMedioPago', 'id_medio_pago'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_orden_pago' => 'Id Orden Pago',
			'id_orden' => 'Id Orden',
			'numero_tarjeta' => 'Numero',
			'nombre_tarjeta' => 'Tarjeta',
			'monto' => 'Monto',
			'email' => 'Email',
			'id_medio_pago' => 'Id Medio Pago',
			'fecha_pago' => 'Fecha Pago',
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

		$criteria->compare('id_orden_pago',$this->id_orden_pago);
		$criteria->compare('id_orden',$this->id_orden);
		$criteria->compare('numero_tarjeta',$this->numero_tarjeta);
		$criteria->compare('nombre_tarjeta',$this->nombre_tarjeta);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('email',$this->email);
		$criteria->compare('id_medio_pago',$this->id_medio_pago);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);
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
	 * @return TOrdenPago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
