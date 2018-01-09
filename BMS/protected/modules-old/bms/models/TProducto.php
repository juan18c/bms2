<?php

/**
 * This is the model class for table "t_producto".
 *
 * The followings are the available columns in table 't_producto':
 * @property integer $id_producto
 * @property string $codigo
 * @property string $descripcion
 * @property integer $id_producto_tipo
 * @property integer $id_producto_categoria
 * @property integer $id_marca
 * @property string $foto_principal
 * @property string $foto_detalle
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TInventario[] $tInventarios
 * @property TProductoTipo $idProductoTipo
 * @property TProductoCategoria $idProductoCategoria
 * @property TEstatus $idEstatus
 * @property TDatosBasicos $idMarca
 */
class TProducto extends CActiveRecord
{
	public $items;
	public $descripcionList;
	public $stockActual;
	public $stockMin;
	public $stockMax;
	public $precio;
	public $fechaVencimiento;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion, id_producto_tipo, id_producto_categoria, id_marca, precioWeb', 'required'),
			array('id_producto_tipo, id_producto_categoria, id_marca, id_estatus, precioWeb', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>50),
			array('descripcion, foto_principal, foto_detalle, foto_descripcion, foto_posologia, foto_uso, precioWeb', 'length', 'max'=>250),
			//array('foto_principal,foto_detalle', 'safe'),
			//array('foto_principal, foto_detalle', 'file', 'types'=>'jpg, png', 'allowEmpty' => true), //'allowEmpty' => true,
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_producto, codigo, descripcion, id_producto_tipo, id_producto_categoria, id_marca, foto_principal, foto_detalle, id_estatus, fecha_creacion,descripcionList', 'safe', 'on'=>'search'),
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
			// 'tInventarios' => array(self::HAS_MANY, 'TInventario', 'id_producto'),
			// 'idProductoTipo' => array(self::BELONGS_TO, 'TProductoTipo', 'id_producto_tipo'),
			// 'idProductoCategoria' => array(self::BELONGS_TO, 'TProductoCategoria', 'id_producto_categoria'),
			// 'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			// 'idMarca' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_marca'),

			'tCarritoDetalles' => array(self::HAS_MANY, 'TCarritoDetalle', 'id_producto'),
			'tInventarios' => array(self::HAS_MANY, 'TInventario', 'id_producto'),
			'idProductoTipo' => array(self::BELONGS_TO, 'TProductoTipo', 'id_producto_tipo'),
			'idProductoCategoria' => array(self::BELONGS_TO, 'TProductoCategoria', 'id_producto_categoria'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idMarca' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_marca'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_producto' => 'Id Producto',
			'codigo' => 'Código',
			'descripcion' => 'Descripción',
			'id_producto_tipo' => 'Tipo',
			'id_producto_categoria' => 'Categoria',
			'id_marca' => 'Marca',
			'precioWeb'=>'Precio',
			'foto_principal' => 'Imagen Principal',
			'foto_detalle' => 'Imagen Ingredientes',
			'foto_descripcion' => 'Imagen Descripción',
			'foto_posologia' => 'Imagen Libre de',
			'foto_uso' => 'Imagen Advertencias',
			'id_estatus' => 'Estatus',
			'fecha_creacion' => 'Fecha Creación',
			'fechaVencimiento'=>'Vencido'
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
		$sort = new CSort;
		$criteria=new CDbCriteria;

		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('id_producto_tipo',$this->id_producto_tipo);
		$criteria->compare('id_producto_categoria',$this->id_producto_categoria);
		$criteria->compare('id_marca',$this->id_marca);
		$criteria->compare('precioWeb',$this->precioWeb);
		$criteria->compare('foto_principal',$this->foto_principal,true);
		$criteria->compare('foto_detalle',$this->foto_detalle,true);
		$criteria->compare('foto_descripcion',$this->foto_descripcion,true);
		$criteria->compare('foto_posologia',$this->foto_posologia,true);
		$criteria->compare('foto_uso',$this->foto_uso,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);


		$sort->attributes = array(
	        'descripcion'=>array(
	            'asc'=>"id_producto_categoria,descripcion asc",
	            'desc'=>"id_producto_categoria,descripcion desc",
	        ),
	        '*',
	    );

	    /* Default Sort Order*/
	    $sort->defaultOrder= array(
	        'id_producto_categoria'=>CSort::SORT_ASC,
	        'descripcion'=>CSort::SORT_ASC,
	    );


		return new CActiveDataProvider($this, array(
			'pagination'=>array('pageSize'=>20),
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TProducto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string customized attribute labels (name=>label)
	 */
	public function getPrecio($id_producto)
	{
		$precio = 0;

		if (isset($id_producto)){ 
			// NOTE: you may need to adjust the relation name and the related
			// class name for the relations automatically generated below.	
			$criteria= new CDbCriteria;
			//$criteria->select = array('initcap(descripcion) AS descripcion');
			$criteria->condition = "t.id_producto = ".$id_producto;	
			$criteria->with = array("tInventarios");

			$precio = $this->find($criteria)->tInventarios[0]->precio;

		}
		return $precio;
		
	}

	public function getLista()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$select='';
		$criteriaTipo=new CDbCriteria;
		$criteriaTipo->select = array('t.id_producto_categoria','idProductoCategoria.descripcion as descripcion');
		$criteriaTipo->with = array('idProductoCategoria');
		$criteriaTipo->condition = 't.id_estatus = 1';
		$criteriaTipo->group = 't.id_producto_categoria,idProductoCategoria.descripcion';
		$productoCategoria = $this->findAll($criteriaTipo);

		foreach ($productoCategoria as $key => $value) {
			$select .= '<optgroup label="'.$value->descripcion.'">';
			$criteria=new CDbCriteria;
			$criteria->select = array('t.id_producto',"CONCAT( `t`.`descripcion`,' ',' / Precio: $',`t`.`precioWeb`) as descripcionList");
			
			$criteria->condition = 't.id_producto_categoria = '.$value->id_producto_categoria.' AND t.id_estatus = 1';

			$productos = $this->findAll($criteria);
			foreach ($productos as $key1 => $value1) {
				# code...
				$select .= '<option data-tokens="'.$value1->descripcionList.'" value="'.$value1->id_producto.'">'.$value1->descripcionList.'</option>';
			}
			$select .= '</optgroup >';
		}

		return $select;

	}

	public function getEstatusFechaVencimiento($fechaVencimiento)
	{
		$fechaActual=date('Y-m-d H:i:s');
		//$meses=$fechaVencimiento-$fechaActual;

		$datetime1=new DateTime($fechaActual);
		$datetime2=new DateTime($fechaVencimiento); 

		# obtenemos la diferencia entre las dos fechas
		$interval=$datetime2->diff($datetime1);		 

		# obtenemos la diferencia en meses
		$intervalMeses=$interval->format("%m");

		# obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
		$intervalAnos = $interval->format("%y")*12;

		$mesesFaltantes= $intervalMeses+$intervalAnos;

		if ($intervalMeses > 0 ) {
			
			if ($mesesFaltantes<=8) {
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/pills-sola-yellow.png',
      'Medicamento Por Vencer - Vence el '.date('d/m/Y',strtotime($fechaVencimiento)),array('class'=>'tooltips','data-toggle'=>'tooltip','data-original-title'=>'Medicamento por Vencer - Vence el '.date('d/m/Y',strtotime($fechaVencimiento)).' faltan '.$mesesFaltantes.' meses'));
			}else{
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/pills-sola-green.png',
      'Medicamento Activo - Vence el '.date('d/m/Y',strtotime($fechaVencimiento)),array('class'=>'tooltips','data-toggle'=>'tooltip','data-original-title'=>'Medicamento Activo - Vence el '.date('d/m/Y',strtotime($fechaVencimiento)).' faltan '.$mesesFaltantes.' meses'));
			}
		}else{
			echo CHtml::image(Yii::app()->request->baseUrl.'/images/pills-sola-red.png',
      'Medicamento Vencido - Vence el '.date('d/m/Y',strtotime($fechaVencimiento)),array('class'=>'tooltips','data-toggle'=>'tooltip','data-original-title'=>'Medicamento Vencido - Vence el '.date('d/m/Y',strtotime($fechaVencimiento)).' faltan '.$mesesFaltantes.' meses'));
		}		
	}
}
