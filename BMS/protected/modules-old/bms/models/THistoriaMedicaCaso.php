<?php

/**
 * This is the model class for table "t_historia_medica_caso".
 *
 * The followings are the available columns in table 't_historia_medica_caso':
 * @property integer $id_historia_medica_caso
 * @property integer $id_historia_medica
 * @property integer $nombre
 * @property string $tipo_carga
 * @property string $fecha_realizacion
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property THistoriaMedica $idHistoriaMedica
 * @property TEstatus $idEstatus
 * @property TCotizacion $idCotizacion
 * @property THistoriaMedicaCasoMedico[] $tHistoriaMedicaCasoMedicos
 * @property THistoriaMedicaDocumento[] $tHistoriaMedicaDocumentos
 */
class THistoriaMedicaCaso extends CActiveRecord
{
	public $descripcionList;
	public $documento;
	public $medico;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_historia_medica_caso';
	}

	public function getId() {
	  return $this->_id;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_historia_medica', 'required'),
			array('id_historia_medica, id_estatus', 'numerical', 'integerOnly'=>true),
			array('tipo_carga', 'length', 'max'=>20),
			array('nombre', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_historia_medica_caso, id_historia_medica, nombre, tipo_carga, fecha_realizacion, id_estatus, fecha_creacion, descripcionList, documento, medico', 'safe', 'on'=>'search'),
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
			'idHistoriaMedica' => array(self::BELONGS_TO, 'THistoriaMedica', 'id_historia_medica'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),			
			'tHistoriaMedicaCasoMedicos' => array(self::HAS_MANY, 'THistoriaMedicaCasoMedico', 'id_historia_medica_caso'),
			'tHistoriaMedicaDocumentos' => array(self::HAS_MANY, 'THistoriaMedicaDocumento', 'id_historia_medica_caso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_historia_medica_caso' => 'Id Historia Medica Caso',
			'id_historia_medica' => 'Id Historia Medica',
			'nombre' => 'Nombre de Documento',
			'tipo_carga' => 'Tipo de Documento',						
			'fecha_realizacion' => 'Fecha Realización',
			'id_estatus' => 'Estatus',
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

		$criteria->compare('id_historia_medica_caso',$this->id_historia_medica_caso);
		$criteria->compare('id_historia_medica',$this->id_historia_medica);
		$criteria->compare('nombre',$this->nombre);
		$criteria->compare('tipo_carga',$this->tipo_carga,true);		
		$criteria->compare('fecha_realizacion',$this->fecha_realizacion);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchCot($idHistoriaMedica,$idResponsable,$idDocumento)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;

		//$criteria->compare('t.id_historia_medica_caso',$this->id_historia_medica_caso);
		$criteria->compare('t.id_historia_medica',$idHistoriaMedica);
		$criteria->compare('t.nombre',$this->nombre);
		$criteria->compare('t.tipo_carga',$this->tipo_carga,true);				
		$criteria->compare('t.fecha_realizacion',$this->fecha_realizacion);		
		$criteria->compare('t.fecha_creacion',$this->fecha_creacion,true);		
		$criteria->compare('t.id_estatus',$this->id_estatus);		

		$criteria->compare('`idHistoriaMedica`.`id_responsable`',$idResponsable);

		$criteria->with=array('idHistoriaMedica');

		$criteria->condition = 't.id_historia_medica_caso IN ('.$idDocumento.')';
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getLista($idPersona)
	{
		$salida[] = '' ;
		// @todo Please modify the following code to remove attributes that should not be searched.
		if (!empty($idPersona)) {			
		
			$criteria=new CDbCriteria;
			$criteria->select = array("t.id_historia_medica_caso","CONCAT( t.nombre,' ',t.tipo_carga) as descripcionList");
			$criteria->with = array('idHistoriaMedica');
			$criteria->condition = '`idHistoriaMedica`.`id_responsable` = '.$idPersona;
			$casos=THistoriaMedicaCaso::model()->findAll($criteria);

			$salida = CHtml::listData($casos,'id_historia_medica_caso','descripcionList');			
		}		
		return $salida;
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return THistoriaMedicaCaso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
