<?php

/**
 * This is the model class for table "t_donacion_adjudicado".
 *
 * The followings are the available columns in table 't_donacion_adjudicado':
 * @property integer $id_donacion_adjudicado
 * @property integer $id_donacion
 * @property double $monto
 * @property integer $id_donador
 * @property integer $id_estatus
 * @property string $fecha_creacion
 * @property string $comentario
 * @property integer $publico
 */
class TDonacionAdjudicado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_donacion_adjudicado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_donacion, id_donador,monto, comentario', 'required'),
			array('id_donacion, id_donador, id_estatus, publico,id_medio_pago', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			array('monto','compare','compareValue'=>'0','operator'=>'>','message'=>'El monto no puede ser igual o menor a 0'),
			array('comentario', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_donacion_adjudicado, id_donacion, monto, id_donador, id_estatus,id_medio_pago, fecha_creacion, comentario, publico', 'safe', 'on'=>'search'),
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
			'idDonacion' => array(self::BELONGS_TO, 'TDonacion', 'id_donacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_donacion_adjudicado' => 'Id Donacion Adjudicado',
			'id_donacion' => 'Id Donacion',
			'monto' => 'Monto',
			'id_donador' => 'Nombre Donador',
			'id_estatus' => 'Id Estatus',
			'fecha_creacion' => 'Fecha Donación',
			'comentario' => 'Comentario',
			'publico' => 'Publico',
			'id_medio_pago'=>'Medios de Pago'
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

		$criteria->compare('id_donacion_adjudicado',$this->id_donacion_adjudicado);
		$criteria->compare('id_donacion',$this->id_donacion);
		//$criteria->compare('monto',$this->monto);
		$criteria->compare('id_donador',$this->id_donador);
		//$criteria->compare('id_estatus',$this->id_estatus,false);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('comentario',$this->comentario,true);
		//$criteria->compare('publico',$this->publico);
		$criteria->compare('id_medio_pago',$this->id_medio_pago);

		//print_r($criteria);
		return new CActiveDataProvider($this, array(
			'pagination'=>array('pageSize'=>10),
			'criteria'=>$criteria,
		));
	}


	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDonacionAdjudicado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
