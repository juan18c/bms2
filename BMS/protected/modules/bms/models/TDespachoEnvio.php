<?php

/**
 * This is the model class for table "t_despacho_envio".
 *
 * The followings are the available columns in table 't_despacho_envio':
 * @property integer $id_despacho_envio
 * @property integer $id_despacho
 * @property integer $id_orden
 * @property string $numero_tracking
 * @property string $courier
 * @property integer $items
 * @property double $monto_total
 * @property string $fecha_despacho
 * @property integer $id_estatus
 * @property string $fecha_creacion
 */
class TDespachoEnvio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_despacho_envio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_despacho, id_orden, numero_tracking, courier, items, monto_total', 'required'),
			array('id_despacho, id_orden, items, id_estatus', 'numerical', 'integerOnly'=>true),
			array('monto_total', 'numerical'),
			array('numero_tracking', 'length', 'max'=>100),
			array('courier', 'length', 'max'=>500),
			array('fecha_despacho', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_despacho_envio, id_despacho, id_orden, numero_tracking, courier, items, monto_total, fecha_despacho, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_despacho_envio' => 'Id Despacho Envio',
			'id_despacho' => 'Id Despacho',
			'id_orden' => 'Id Orden',
			'numero_tracking' => 'Numero Tracking',
			'courier' => 'Courier',
			'items' => 'Items',
			'monto_total' => 'Monto Total',
			'fecha_despacho' => 'Fecha Despacho',
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

		$criteria->compare('id_despacho_envio',$this->id_despacho_envio);
		$criteria->compare('id_despacho',$this->id_despacho);
		$criteria->compare('id_orden',$this->id_orden);
		$criteria->compare('numero_tracking',$this->numero_tracking,true);
		$criteria->compare('courier',$this->courier,true);
		$criteria->compare('items',$this->items);
		$criteria->compare('monto_total',$this->monto_total);
		$criteria->compare('fecha_despacho',$this->fecha_despacho,true);
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
	 * @return TDespachoEnvio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
