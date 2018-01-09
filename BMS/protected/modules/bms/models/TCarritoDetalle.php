<?php

/**
 * This is the model class for table "id_carrito_detalle".
 *
 * The followings are the available columns in table 'id_carrito_detalle':
 * @property integer $id_carrito_detalle
 * @property integer $id_carrito
 * @property integer $id_producto
 * @property integer $cantidad
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TCarrito $idCarrito
 * @property TProducto $idProducto
 * @property TEstatus $idEstatus
 */
class TCarritoDetalle extends CActiveRecord
{
	public $total;
	public $items;
	public $totalItem;
	public $descripcionProducto;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_carrito_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_carrito, id_producto, cantidad', 'required'),
			array('id_carrito, id_producto, cantidad, id_estatus', 'numerical', 'integerOnly'=>true),
			array('descripcionProducto','length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_carrito_detalle, id_carrito, id_producto, cantidad, id_estatus, fecha_creacion,totalItem,descripcionProducto', 'safe', 'on'=>'search'),
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
			'idProducto' => array(self::BELONGS_TO, 'TProducto', 'id_producto'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_carrito_detalle' => 'T Carrito Detalle',
			'id_carrito' => 'Id Carrito',
			'id_producto' => 'Id Producto',
			'cantidad' => 'Cantidad',
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

		$criteria->compare('id_carrito_detalle',$this->id_carrito_detalle);
		$criteria->compare('id_carrito',$this->id_carrito);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchCot($idCarrito)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		
		$criteria=new CDbCriteria;
		$criteria->with = 'idProducto';
		$criteria->compare('id_carrito_detalle',$this->id_carrito_detalle);
		$criteria->compare('id_carrito',$idCarrito);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('t.id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('idProducto.descripcion',$this->descripcionProducto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TCarritoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
