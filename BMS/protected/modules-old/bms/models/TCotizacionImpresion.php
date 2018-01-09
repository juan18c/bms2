<?php

/**
 * This is the model class for table "t_cotizacion_impresion".
 *
 * The followings are the available columns in table 't_cotizacion_impresion':
 * @property integer $id_impresion
 * @property integer $id_cotizacion
 * @property integer $id_laboratorio
 * @property integer $ind_membrete
 * @property integer $ind_cuenta
 * @property string $fecha_creacion
 */
class TCotizacionImpresion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_cotizacion_impresion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cotizacion, id_laboratorio, fecha_creacion', 'required'),
			array('id_cotizacion, id_laboratorio, ind_membrete, ind_cuenta', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_impresion, id_cotizacion, id_laboratorio, ind_membrete, ind_cuenta, fecha_creacion', 'safe', 'on'=>'search'),
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
			'id_impresion' => 'Id Impresion',
			'id_cotizacion' => 'Id Cotizacion',
			'id_laboratorio' => 'Id Laboratorio',
			'ind_membrete' => 'Ind Membrete',
			'ind_cuenta' => 'Ind Cuenta',
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

		$criteria->compare('id_impresion',$this->id_impresion);
		$criteria->compare('id_cotizacion',$this->id_cotizacion);
		$criteria->compare('id_laboratorio',$this->id_laboratorio);
		$criteria->compare('ind_membrete',$this->ind_membrete);
		$criteria->compare('ind_cuenta',$this->ind_cuenta);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TCotizacionImpresion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
