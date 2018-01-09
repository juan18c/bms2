<?php

/**
 * This is the model class for table "t_inventario".
 *
 * The followings are the available columns in table 't_inventario':
 * @property integer $id_inventario
 * @property integer $id_producto
 * @property integer $cantidad
 * @property integer $stock_minimo
 * @property integer $stock_maximo
 * @property string $fecha_compra
 * @property string $fecha_vencimiento
 * @property double $precio
 * @property integer $id_almacen
 * @property string $tipo_almacenamiento
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TProducto $idProducto
 * @property TAlmacen $idAlmacen
 * @property TEstatus $idEstatus
 */
class TInventario extends CActiveRecord
{	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_inventario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_producto, cantidad, stock_minimo, stock_maximo, precio, id_almacen, tipo_almacenamiento', 'required'),
			array('id_producto, cantidad, stock_minimo, stock_maximo, id_almacen, id_estatus', 'numerical', 'integerOnly'=>true),
			array('precio', 'numerical'),
			array('tipo_almacenamiento', 'length', 'max'=>20),
			array('fecha_compra, fecha_vencimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_inventario, id_producto, cantidad, stock_minimo, stock_maximo, fecha_compra, fecha_vencimiento, precio, id_almacen, tipo_almacenamiento, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idProducto' => array(self::BELONGS_TO, 'TProducto', 'id_producto'),
			'idAlmacen' => array(self::BELONGS_TO, 'TAlmacen', 'id_almacen'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_inventario' => 'Id Inventario',
			'id_producto' => 'Id Producto',
			'cantidad' => 'Stock',
			'stock_minimo' => 'Stock Mínimo',
			'stock_maximo' => 'Stock Máximo',
			'fecha_compra' => 'Fecha Compra',
			'fecha_vencimiento' => 'Fecha Vencimiento',
			'precio' => 'Precio',
			'id_almacen' => 'Almacén',
			'tipo_almacenamiento' => 'Tipo Almacenamiento',
			'id_estatus' => 'Estatus',
			'fecha_creacion' => 'Fecha Creación',
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

		$criteria->compare('id_inventario',$this->id_inventario);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('stock_minimo',$this->stock_minimo);
		$criteria->compare('stock_maximo',$this->stock_maximo);
		$criteria->compare('fecha_compra',$this->fecha_compra,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('id_almacen',$this->id_almacen);
		$criteria->compare('tipo_almacenamiento',$this->tipo_almacenamiento,true);
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
	 * @return TInventario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
