<?php

/**
 * This is the model class for table "t_cotizacion_historia_medica_caso".
 *
 * The followings are the available columns in table 't_cotizacion_historia_medica_caso':
 * @property integer $id_cotizacion_historia_caso
 * @property integer $id_cotizacion
 * @property integer $id_historia_medica_caso
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property TCotizacion $idCotizacion
 * @property THistoriaMedicaCaso $idHistoriaMedicaCaso
 * @property TEstatus $idEstatus
 */
class TCotizacionHistoriaMedicaCaso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_cotizacion_historia_medica_caso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cotizacion, id_historia_medica_caso', 'required'),
			array('id_cotizacion, id_historia_medica_caso, id_estatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cotizacion_historia_caso, id_cotizacion, id_historia_medica_caso, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idCotizacion' => array(self::BELONGS_TO, 'TCotizacion', 'id_cotizacion'),
			'idHistoriaMedicaCaso' => array(self::BELONGS_TO, 'THistoriaMedicaCaso', 'id_historia_medica_caso'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cotizacion_historia_caso' => 'Id Cotizacion Historia Caso',
			'id_cotizacion' => 'Id Cotizacion',
			'id_historia_medica_caso' => 'Id Historia Medica Caso',
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

		$criteria->compare('id_cotizacion_historia_caso',$this->id_cotizacion_historia_caso);
		$criteria->compare('id_cotizacion',$this->id_cotizacion);
		$criteria->compare('id_historia_medica_caso',$this->id_historia_medica_caso);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getDocumentos($idCotizacion)
	{
		$salida = '' ;
		// @todo Please modify the following code to remove attributes that should not be searched.
		if (!empty($idCotizacion)) {			
		
			$criteria=new CDbCriteria;
			$criteria->select = array("t.id_historia_medica_caso");			
			$criteria->condition = 'id_cotizacion = '.$idCotizacion;
			$documento=$this->findAll($criteria);

			foreach ($documento as $key => $value) {
				$salida.=$value->id_historia_medica_caso.',';
			}		

			$salida = substr($salida, 0, strlen($salida) - 1);
		}		
		
		return $salida;
	}


	public function getDocumentosCart($idCarrito)
	{
		$salida = '' ;
		// @todo Please modify the following code to remove attributes that should not be searched.
		if (!empty($idCarrito)) {			
		
			$criteria=new CDbCriteria;
			$criteria->select = array("t.id_historia_medica_caso");			
			$criteria->condition = 'id_carrito = '.$idCarrito;
			$documento=$this->findAll($criteria);

			foreach ($documento as $key => $value) {
				$salida.=$value->id_historia_medica_caso.',';
			}		

			$salida = substr($salida, 0, strlen($salida) - 1);
		}		
		
		return $salida;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TCotizacionHistoriaMedicaCaso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
