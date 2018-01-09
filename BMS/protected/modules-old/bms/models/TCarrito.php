<?php

/**
 * This is the model class for table "t_carrito".
 *
 * The followings are the available columns in table 't_carrito':
 * @property integer $id_carrito
 * @property integer $id_datos_basicos
 * @property integer $id_tipo_accion
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TDatosBasicos $idDatosBasicos
 * @property TTipoAccion $idTipoAccion
 * @property TEstatus $idEstatus
 * @property TCarritoDetalle[] $tCarritoDetalles
 * @property TPedido[] $tPedidos
 */
class TCarrito extends CActiveRecord
{
	public $total;
	public $items;
	//public $descripcion;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_carrito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_datos_basicos', 'required'),
			array('id_datos_basicos, id_tipo_accion, id_estatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_carrito, id_datos_basicos, id_tipo_accion, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idDatosBasicos' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_datos_basicos'),
			'idTipoAccion' => array(self::BELONGS_TO, 'TTipoAccion', 'id_tipo_accion'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'tCarritoDetalles' => array(self::HAS_MANY, 'TCarritoDetalle', 'id_carrito'),
			'tPedidos' => array(self::HAS_MANY, 'TPedido', 'id_carrito'),
			'idDatosBasicosDireccion' => array(self::BELONGS_TO, 'TDatosBasicosDireccion', 'id_direccion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_carrito' => 'Id Carrito',
			'id_datos_basicos' => 'Id Datos Basicos',
			'id_tipo_accion' => 'Id Tipo Accion',
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

		$criteria->compare('id_carrito',$this->id_carrito);
		$criteria->compare('id_datos_basicos',$this->id_datos_basicos);
		$criteria->compare('id_tipo_accion',$this->id_tipo_accion);
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
	 * @return TCarrito the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
