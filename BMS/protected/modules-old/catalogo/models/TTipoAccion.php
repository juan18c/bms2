<?php

/**
 * This is the model class for table "t_tipo_accion".
 *
 * The followings are the available columns in table 't_tipo_accion':
 * @property integer $id_tipo_accion
 * @property string $descripcion
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TCarrito[] $tCarritos
 * @property TEstatus $idEstatus
 */
class TTipoAccion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms_catalogo.t_tipo_accion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tipo_accion, descripcion, fecha_creacion', 'required'),
			array('id_tipo_accion, id_estatus', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tipo_accion, descripcion, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'tCarritos' => array(self::HAS_MANY, 'TCarrito', 'id_tipo_accion'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_accion' => 'Id Tipo Accion',
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

		$criteria->compare('id_tipo_accion',$this->id_tipo_accion);
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
	 * @return TTipoAccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
