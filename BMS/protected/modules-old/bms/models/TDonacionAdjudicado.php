<?php

/**
 * This is the model class for table "t_donacion_adjudicado".
 *
 * The followings are the available columns in table 't_donacion_adjudicado':
 * @property integer $id_donacion_adjudicado
 * @property integer $id_donacion
 * @property double $monto
 * @property integer $id_donador
 * @property integer $id_medio_pago
 * @property integer $id_estatus
 * @property string $fecha_creacion
 * @property string $comentario
 * @property integer $publico
 * @property string $nombre_banco
 * @property string $numero_cuenta
 * @property string $numero_ruta_bancaria
 * @property string $fecha_pago
 * @property string $email
 *
 * The followings are the available model relations:
 * @property TDonacionMovimiento[] $tDonacionMovimientos
 */
class TDonacionAdjudicado extends CActiveRecord
{
	
	public $monto_conciliar;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_donacion_adjudicado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_donacion, id_donador, id_medio_pago,monto, comentario', 'required'),
			array('id_donacion, id_donador, id_medio_pago, id_estatus, publico', 'numerical', 'integerOnly'=>true),
			array('monto,monto_conciliar,monto_conciliado', 'numerical'),
			array('monto','compare','compareValue'=>'0','operator'=>'>','message'=>'El monto no puede ser igual o menor a 0'),
			array('comentario, nombre_banco', 'length', 'max'=>500),
			array('numero_cuenta', 'length', 'max'=>11),
			array('numero_ruta_bancaria', 'length', 'max'=>9),
			array('email,monto_conciliar,monto', 'length', 'max'=>250),
			array('fecha_pago', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_donacion_adjudicado, id_donacion, monto, id_donador, id_medio_pago, id_estatus, fecha_creacion, comentario, publico, nombre_banco, numero_cuenta, numero_ruta_bancaria, fecha_pago, email,monto_conciliado', 'safe', 'on'=>'search'),
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
			'tDonacionMovimientos' => array(self::HAS_MANY, 'TDonacionMovimiento', 'id_donacion_adjudicado'),
			'idDonacion' => array(self::BELONGS_TO, 'TDonacion', 'id_donacion'),
			'idDonacionAdjudicada' => array(self::HAS_MANY, 'TDonacion', 'id_donacion'),
			'idDonador' => array(self::BELONGS_TO, 'TDatosBasicos', 'id_donador'),
			'idMedioPago' => array(self::BELONGS_TO, 'TMedioPago', 'id_medio_pago'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			//'idDonacionAdjudicada' =>array(self::HAS_MANY, 'TDonacionAdjudicada', 'id_donacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_donacion_adjudicado' => 'Id Donacion Adjudicado',
			'id_donacion' => 'Id Donacion',
			'monto' => 'Monto',
			'id_donador' => 'Id Donador',
			'id_medio_pago' => 'Medio Pago',
			'id_estatus' => 'Id Estatus',
			'fecha_creacion' => 'Fecha Creacion',
			'comentario' => 'Comentario',
			'publico' => 'Publico',
			'nombre_banco' => 'Nombre Banco',
			'numero_cuenta' => 'Numero Cuenta',
			'numero_ruta_bancaria' => 'Numero Ruta Bancaria',
			'fecha_pago' => 'Fecha Pago',
			'email' => 'Email',
			'monto_conciliar'=>'Monto a conciliar'
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
	public function search($idDonacion)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('id_donacion_adjudicado',$this->id_donacion_adjudicado);
		//$criteria->compare('id_donacion',$idDonacion);
		$criteria->compare('monto',$this->monto,true);
		$criteria->compare('id_donador',$this->id_donador);
		$criteria->compare('id_medio_pago',$this->id_medio_pago);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('publico',$this->publico);
		$criteria->compare('nombre_banco',$this->nombre_banco,true);
		$criteria->compare('numero_cuenta',$this->numero_cuenta,true);
		$criteria->compare('numero_ruta_bancaria',$this->numero_ruta_bancaria,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);
		$criteria->compare('email',$this->email,true);

		$criteria->condition='id_estatus=3 and id_donacion='.$idDonacion;


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDonacionAdjudicado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
