<?php

/**
 * This is the model class for table "t_despacho_detalle".
 *
 * The followings are the available columns in table 't_despacho_detalle':
 * @property integer $id_despacho_detalle
 * @property integer $id_despacho
 * @property integer $id_producto
 * @property integer $cantidad_solicitada
 * @property double $precio
 * @property integer $cantidad_despachada
 * @property string $fecha_despacho
 * @property integer $id_estatus
 * @property string $fecha_creacion
 */
class TDespachoDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_despacho_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_despacho, id_producto, cantidad_solicitada, precio, cantidad_despachada', 'required'),
			array('id_despacho, id_producto, cantidad_solicitada, cantidad_despachada, id_estatus', 'numerical', 'integerOnly'=>true),
			array('precio', 'numerical'),
			array('fecha_despacho', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_despacho_detalle, id_despacho, id_producto, cantidad_solicitada, precio, cantidad_despachada, fecha_despacho, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'id_despacho_detalle' => 'Id Despacho Detalle',
			'id_despacho' => 'Id Despacho',
			'id_producto' => 'Id Producto',
			'cantidad_solicitada' => 'Cantidad Solicitada',
			'precio' => 'Precio',
			'cantidad_despachada' => 'Cantidad Despachada',
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

		$criteria->compare('id_despacho_detalle',$this->id_despacho_detalle);
		$criteria->compare('id_despacho',$this->id_despacho);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('cantidad_solicitada',$this->cantidad_solicitada);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('cantidad_despachada',$this->cantidad_despachada);
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
	 * @return TDespachoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
