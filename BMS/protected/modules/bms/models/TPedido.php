<?php

/**
 * This is the model class for table "t_pedido".
 *
 * The followings are the available columns in table 't_pedido':
 * @property integer $id_pedido
 * @property integer $id_carrito
 * @property integer $id_medio_pago
 * @property double $monto_total
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TCarrito $idCarrito
 * @property TMedioPago $idMedioPago
 * @property TEstatus $idEstatus
 */
class TPedido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_pedido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_carrito, id_medio_pago, monto_total, fecha_creacion', 'required'),
			array('id_carrito, id_medio_pago, id_estatus', 'numerical', 'integerOnly'=>true),
			array('monto_total', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pedido, id_carrito, id_medio_pago, monto_total, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idCarrito' => array(self::BELONGS_TO, 'TCarrito', 'id_carrito'),
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
			'id_pedido' => 'Id Pedido',
			'id_carrito' => 'Id Carrito',
			'id_medio_pago' => 'Id Medio Pago',
			'monto_total' => 'Monto Total',
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

		$criteria->compare('id_pedido',$this->id_pedido);
		$criteria->compare('id_carrito',$this->id_carrito);
		$criteria->compare('id_medio_pago',$this->id_medio_pago);
		$criteria->compare('monto_total',$this->monto_total);
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
	 * @return TPedido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
