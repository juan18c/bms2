<?php

/**
 * This is the model class for table "t_donacion_movimiento".
 *
 * The followings are the available columns in table 't_donacion_movimiento':
 * @property string $id_donacion_movimiento
 * @property integer $id_donacion_adjudicado
 * @property integer $id_credito_donacion
 * @property double $monto_credito
 * @property double $monto_debito
 * @property integer $id_estatus
 * @property integer $id_donacion
 * @property integer $id_orden
 * @property string $fecha_creacion
 */
class TDonacionMovimiento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_donacion_movimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_donacion_adjudicado, monto_credito, monto_debito, id_estatus,id_usuario', 'required'),
			array('id_donacion_adjudicado, id_estatus, id_orden', 'numerical', 'integerOnly'=>true),
			array('monto_credito, monto_debito', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_donacion_movimiento, id_donacion_adjudicado, monto_credito, monto_debito, id_estatus,id_orden, fecha_creacion,id_usuario', 'safe', 'on'=>'search'),
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
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idDonacionAdjudicado' => array(self::BELONGS_TO, 'TDonacionAdjudicado', 'id_donacion_adjudicado'),
			'idUsuario' => array(self::BELONGS_TO, 'TUsuario', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_donacion_movimiento' => 'Id Donacion Movimiento',
			'id_donacion_adjudicado' => 'Id Donacion Adjudicado',
			'monto_credito' => 'Monto Credito',
			'monto_debito' => 'Monto Debito',
			'id_estatus' => 'Id Estatus',
			'id_orden' => 'Id Orden',
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

		$criteria->compare('id_donacion_movimiento',$this->id_donacion_movimiento,true);
		$criteria->compare('id_donacion_adjudicado',$this->id_donacion_adjudicado);
		$criteria->compare('monto_credito',$this->monto_credito);
		$criteria->compare('monto_debito',$this->monto_debito);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('id_orden',$this->id_orden);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDonacionMovimiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
