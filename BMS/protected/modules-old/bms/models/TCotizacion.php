<?php

/**
 * This is the model class for table "t_cotizacion".
 *
 * The followings are the available columns in table 't_cotizacion':
 * @property integer $id_cotizacion
 * @property string $codigo_cotizacion
 * @property integer $id_carrito
 * @property integer $id_responsable
 * @property integer $id_beneficiario
 * @property string $duracion_tratamiento
 * @property string $datos_envio
 * @property string $fecha_envio
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TCarrito $idCarrito
 * @property TDatosBasicos $idResponsable
 * @property TEstatus $idEstatus
 * @property TBeneficiario $idBeneficiario
 * @property TCotizacionHistoriaMedicaCaso[] $tCotizacionHistoriaMedicaCasos
 */
class TCotizacion extends CActiveRecord
{
	public $descripcionList;
	public $nombreBeneficiario;
	public $nombreResponsable;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_cotizacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_cotizacion, id_carrito, id_responsable, id_beneficiario, duracion_tratamiento', 'required'),
			array('id_carrito, id_responsable, id_beneficiario, id_estatus', 'numerical', 'integerOnly'=>true),
			array('codigo_cotizacion', 'length', 'max'=>20),
			array('duracion_tratamiento', 'length', 'max'=>500),
			array('fecha_envio', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cotizacion, codigo_cotizacion, id_carrito, id_responsable, id_beneficiario, duracion_tratamiento, datos_envio, fecha_envio, id_estatus, fecha_creacion, descripcionList, nombreBeneficiario, nombreResponsable', 'safe', 'on'=>'search'),
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
			'idResponsable' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_responsable'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idBeneficiario' => array(self::BELONGS_TO, 'TBeneficiario', 'id_beneficiario'),
			'tCotizacionHistoriaMedicaCasos' => array(self::HAS_MANY, 'TCotizacionHistoriaMedicaCaso', 'id_cotizacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cotizacion' => 'Id Cotizacion',
			'codigo_cotizacion' => 'Codigo Cotizacion',
			'id_carrito' => 'Id Carrito',
			'id_responsable' => 'Id Responsable',
			'id_beneficiario' => 'Id Beneficiario',
			'duracion_tratamiento' => 'Duracion Tratamiento',
			'datos_envio' => 'Datos Envio',
			'fecha_envio' => 'Envio',
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
		$sort = new CSort;
		$criteria=new CDbCriteria;

		$criteria->compare('id_cotizacion',$this->id_cotizacion);
		$criteria->compare('codigo_cotizacion',$this->codigo_cotizacion,true);
		$criteria->compare('id_carrito',$this->id_carrito);
		$criteria->compare('id_responsable',$this->id_responsable);
		$criteria->compare('id_beneficiario',$this->id_beneficiario);
		$criteria->compare('duracion_tratamiento',$this->duracion_tratamiento,true);
		$criteria->compare('datos_envio',$this->datos_envio,true);
		$criteria->compare('fecha_envio',$this->fecha_envio,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('idBeneficiarioDB.nombres',$this->nombreResponsable,true);

		$criteria->together = true;
 		$criteria->with= array('idBeneficiario','idBeneficiario.idBeneficiarioDB');

 		/* Sort criteria */
	    $sort->attributes = array(
	        'nombreResponsable'=>array(
	            'asc'=>"idBeneficiarioDB.nombres asc",
	            'desc'=>"idBeneficiarioDB.nombres desc",
	        ),
	        '*',
	    );

	    /* Default Sort Order*/
	    $sort->defaultOrder= array(
	        'codigo_cotizacion'=>CSort::SORT_ASC,
	        'id_estatus'=>CSort::SORT_ASC,
	    );

		return new CActiveDataProvider($this, array(
			'pagination'=>array('pageSize'=>10),
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}

	public function searchFront($idPersona)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$sort = new CSort;
		$criteria=new CDbCriteria;

		$criteria->compare('t.id_cotizacion',$this->id_cotizacion);
		$criteria->compare('t.codigo_cotizacion',$this->codigo_cotizacion,true);
		$criteria->compare('t.id_carrito',$this->id_carrito);
		$criteria->compare('t.id_responsable',$idPersona);
		$criteria->compare('t.id_beneficiario',$this->id_beneficiario);
		$criteria->compare('t.duracion_tratamiento',$this->duracion_tratamiento,true);
		$criteria->compare('t.datos_envio',$this->datos_envio,true);
		$criteria->compare('t.fecha_envio',$this->fecha_envio,true);
		$criteria->compare('t.id_estatus',$this->id_estatus); //TODOS LOS ACTIVOS
		$criteria->compare('t.fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('idBeneficiarioDB.nombres',$this->nombreBeneficiario,true);

		$criteria->together = true;
 		$criteria->with= array('idBeneficiario','idBeneficiario.idBeneficiarioDB');

 		/* Sort criteria */
	    $sort->attributes = array(
	        'nombreBeneficiario'=>array(
	            'asc'=>"idBeneficiarioDB.nombres asc",
	            'desc'=>"idBeneficiarioDB.nombres desc",
	        ),
	        '*',
	    );

	    /* Default Sort Order*/
	    $sort->defaultOrder= array(
	        'codigo_cotizacion'=>CSort::SORT_ASC,
	        'id_estatus'=>CSort::SORT_ASC,
	    );

		return new CActiveDataProvider($this, array(
			'pagination'=>array('pageSize'=>10),
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}

	public function getListaClientes()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$select='';
		$criteria=new CDbCriteria;
		$criteria->select = array('t.id_datos_basicos',"CONCAT( `idTipoIdentificacion`.`abreviatura`,'-',`t`.`nro_identificacion`,' / ', `t`.`nombres`,' ',`t`.`apellidos`, CASE WHEN t.id_perfil=2 THEN CONCAT(' - ',idPerfil.descripcion) ELSE CASE WHEN t.id_perfil=5 THEN CONCAT(' - ',idPerfil.descripcion) ELSE '' END END ) as descripcionList");
		$criteria->with = array('idTipoIdentificacion','idPerfil');
		$criteria->condition = 't.id_estatus = 1 AND t.titular=0 AND t.id_perfil NOT IN (3,4) AND t.email IN (SELECT usuario FROM bms_seguridad.t_usuario) ';		
		
		$clientes = TDatosBasicos::model()->findAll($criteria);
		foreach ($clientes as $key => $value) {
			# code...
			$select .= '<option data-tokens="'.$value->descripcionList.'" value="'.$value->id_datos_basicos.'">'.$value->descripcionList.'</option>';
		}	

		return $select;

	}


	public function getListaLaboratorio()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$select='';
		$criteria=new CDbCriteria;
		$criteria->select = array('t.id_datos_basicos',"CONCAT(`t`.`nombres`,' ',`t`.`apellidos`) as descripcionList");		
		$criteria->condition = 't.id_estatus = 1 AND t.id_perfil = 3';		
		
		$laboratorio = TDatosBasicos::model()->findAll($criteria);
		foreach ($laboratorio as $key => $value) {
			# code...
			$select .= '<option data-tokens="'.$value->descripcionList.'" value="'.$value->id_datos_basicos.'">'.$value->descripcionList.'</option>';
		}	

		return $select;

	}

	public function getDatosEnvio($fecha_envio,$datos_envio)
	{
		$title= $fecha_envio != "" ? "Enviado el: ".date('d/m/Y H:i A',strtotime($fecha_envio))." a la dirección: ".$datos_envio : "Pendiente por enviar";
		//style="color:#FFA500"
		if (empty($datos_envio)) 
			return '<i class="fa fa-paper-plane-o fa-2x tooltips" data-toggle="tooltip" data-original-title="'.$title.'"></i>';
		else
			return '<i class="fa fa-paper-plane fa-2x tooltips" data-toggle="tooltip" data-original-title="'.$title.'" style="color:#3E991C"></i>';		
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TCotizacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}