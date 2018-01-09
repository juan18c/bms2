<?php

/**
 * This is the model class for table "t_credito_bms".
 *
 * The followings are the available columns in table 't_credito_bms':
 * @property integer $id_credito
 * @property integer $id_orden
 * @property double $saldo
 * @property string $fecha_saldo
 * @property integer $id_orden_pago
 * @property integer $id_despacho
 * @property integer $id_estatus
 * @property string $fecha_creacion
 */
class TCreditoBms extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_credito_bms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_orden, saldo', 'required'),
			array('id_orden, id_orden_pago, id_despacho, id_estatus', 'numerical', 'integerOnly'=>true),
			array('saldo', 'numerical'),
			array('fecha_saldo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_credito, id_orden, saldo, fecha_saldo, id_orden_pago, id_despacho, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'id_credito' => 'Id Credito',
			'id_orden' => 'Id Orden',
			'saldo' => 'Saldo',
			'fecha_saldo' => 'Fecha Saldo',
			'id_orden_pago' => 'Id Orden Pago',
			'id_despacho' => 'Id Despacho',
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

		$criteria->compare('id_credito',$this->id_credito);
		$criteria->compare('id_orden',$this->id_orden);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('fecha_saldo',$this->fecha_saldo,true);
		$criteria->compare('id_orden_pago',$this->id_orden_pago);
		$criteria->compare('id_despacho',$this->id_despacho);
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
	 * @return TCreditoBms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
