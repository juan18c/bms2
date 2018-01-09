<?php

/**
 * This is the model class for table "seguridad.t_auditoria".
 *
 * The followings are the available columns in table 'seguridad.t_auditoria':
 * @property integer $id_auditoria
 * @property integer $id_usuario
 * @property string $ip_address
 * @property integer $id_dominio
 * @property integer $id_objeto
 * @property integer $id_accion
 * @property string $tabla_accedida
 * @property string $time_stamp
 *
 * The followings are the available model relations:
 * @property TUsuario $idUsuario
 */
class TAuditoria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguridad.t_auditoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, id_dominio, id_objeto, id_accion, tabla_accedida, time_stamp', 'required'),
			array('id_usuario, id_dominio, id_objeto, id_accion', 'numerical', 'integerOnly'=>true),
			array('ip_address', 'length', 'max'=>30),
			array('tabla_accedida', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_auditoria, id_usuario, ip_address, id_dominio, id_objeto, id_accion, tabla_accedida, time_stamp', 'safe', 'on'=>'search'),
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
			'idUsuario' => array(self::BELONGS_TO, 'TUsuario', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_auditoria' => 'Id Auditoria',
			'id_usuario' => 'Id Usuario',
			'ip_address' => 'Ip Address',
			'id_dominio' => 'Id Dominio',
			'id_objeto' => 'Id Objeto',
			'id_accion' => 'Id Accion',
			'tabla_accedida' => 'Tabla Accedida',
			'time_stamp' => 'Time Stamp',
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

		$criteria->compare('id_auditoria',$this->id_auditoria);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('id_dominio',$this->id_dominio);
		$criteria->compare('id_objeto',$this->id_objeto);
		$criteria->compare('id_accion',$this->id_accion);
		$criteria->compare('tabla_accedida',$this->tabla_accedida,true);
		$criteria->compare('time_stamp',$this->time_stamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TAuditoria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
