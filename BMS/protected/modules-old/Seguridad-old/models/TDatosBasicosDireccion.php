<?php

/**
 * This is the model class for table "t_datos_basicos_direccion".
 *
 * The followings are the available columns in table 't_datos_basicos_direccion':
 * @property integer $id_datos_basicos_direccion
 * @property integer $id_datos_basicos
 * @property string $direccion1
 * @property string $direccion2
 * @property integer $codigo_zip
 * @property integer $id_tipo_direccion
 * @property integer $id_pais
 * @property string $ciudad
 * @property string $estado
 * @property string $telefono_fijo
 * @property integer $indicador_factura
 * @property integer $indicador_envio
 * @property string $fecha_creacion
 * @property integer $id_estatus
 *
 * The followings are the available model relations:
 * @property TDatosBasicos[] $tDatosBasicoses
 * @property TDatosBasicos $idDatosBasicos
 * @property TPais $idPais
 * @property TEstatus $idEstatus
 * @property TTipoDireccion $idTipoDireccion
 */
class TDatosBasicosDireccion extends CActiveRecord
{
	public $descripcionList;	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_datos_basicos_direccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_datos_basicos,id_tipo_direccion, id_pais', 'required'),
			array('id_datos_basicos_direccion, id_datos_basicos, codigo_zip, id_tipo_direccion, id_pais, indicador_factura, indicador_envio, id_estatus', 'numerical', 'integerOnly'=>true),
			array('direccion1, direccion2, ciudad, estado', 'length', 'max'=>250),
			array('telefono_fijo', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_datos_basicos_direccion, id_datos_basicos, direccion1, direccion2, codigo_zip, id_tipo_direccion, id_pais, ciudad, estado, telefono_fijo, indicador_factura, indicador_envio, fecha_creacion, id_estatus', 'safe', 'on'=>'search'),
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
			'tDatosBasicoses' => array(self::HAS_MANY, 'TDatosBasicos', 'id_direccion'),
			'idDatosBasicos' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_datos_basicos'),
			'idPais' => array(self::BELONGS_TO, 'TPais', 'id_pais'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idTipoDireccion' => array(self::BELONGS_TO, 'TTipoDireccion', 'id_tipo_direccion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_datos_basicos_direccion' => 'Id Datos Basicos Direccion',
			'id_datos_basicos' => 'Id Datos Basicos',
			'direccion1' => 'Direccion1',
			'direccion2' => 'Direccion2',
			'codigo_zip' => 'Codigo Zip',
			'id_tipo_direccion' => 'Tipo Direccion',
			'id_pais' => 'Pais',
			'ciudad' => 'Ciudad',
			'estado' => 'Estado',
			'telefono_fijo' => 'Telefono Fijo',
			'indicador_factura' => 'Indicador Factura',
			'indicador_envio' => 'Indicador Envio',
			'fecha_creacion' => 'Fecha Creacion',
			'id_estatus' => 'Estatus',
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

		$criteria->compare('id_datos_basicos_direccion',$this->id_datos_basicos_direccion);
		$criteria->compare('id_datos_basicos',$this->id_datos_basicos);
		$criteria->compare('direccion1',$this->direccion1,true);
		$criteria->compare('direccion2',$this->direccion2,true);
		$criteria->compare('codigo_zip',$this->codigo_zip);
		$criteria->compare('id_tipo_direccion',$this->id_tipo_direccion);
		$criteria->compare('id_pais',$this->id_pais);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('telefono_fijo',$this->telefono_fijo,true);
		$criteria->compare('indicador_factura',$this->indicador_factura);
		$criteria->compare('indicador_envio',$this->indicador_envio);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_estatus',$this->id_estatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchFront($idPersona)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_datos_basicos_direccion',$this->id_datos_basicos_direccion);
		$criteria->compare('id_datos_basicos',$idPersona);
		$criteria->compare('direccion1',$this->direccion1,true);
		$criteria->compare('direccion2',$this->direccion2,true);
		$criteria->compare('codigo_zip',$this->codigo_zip);
		$criteria->compare('id_tipo_direccion',$this->id_tipo_direccion);
		$criteria->compare('id_pais',$this->id_pais);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('telefono_fijo',$this->telefono_fijo,true);
		$criteria->compare('indicador_factura',$this->indicador_factura);
		$criteria->compare('indicador_envio',$this->indicador_envio);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_estatus',$this->id_estatus);

		// $criteria->together = true;
		// $criteria->with = array('idPais','idTipoDireccion');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getLista($idPersona)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		// $criteria->select = array('t.id_datos_basicos_direccion','t.id_datos_basicos','t.id_pais','t.estado','t.ciudad',"CONCAT( t.ciudad,', ',t.estado,', ',`idPais`.`descripcion`) as descripcionList");
		$criteria->select = array('t.id_datos_basicos_direccion','t.id_datos_basicos','t.id_pais','t.estado','t.ciudad','t.nombre');
		//$criteria->with = array('idPais');
		$criteria->condition = 't.id_datos_basicos = '.$idPersona;
		return $this->findAll($criteria);

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDatosBasicosDireccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
