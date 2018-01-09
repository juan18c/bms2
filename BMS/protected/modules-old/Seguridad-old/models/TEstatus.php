<?php

/**
 * This is the model class for table "esculapio.t_estatus".
 *
 * The followings are the available columns in table 'esculapio.t_estatus':
 * @property integer $id_estatus
 * @property string $descripcion
 * @property string $abreviatura
 * @property string $fecha_creacion
 * @property integer $id_tipo_estatus
 *
 * The followings are the available model relations:
 * @property TAntecedenteClasificacion[] $tAntecedenteClasificacions
 * @property TAntecedenteTipo[] $tAntecedenteTipos
 * @property TAutorizacionHistoriaAntecedente[] $tAutorizacionHistoriaAntecedentes
 * @property THistoriaEventoExamenFisico[] $tHistoriaEventoExamenFisicos
 * @property THistoriaEvento[] $tHistoriaEventos
 * @property THistoriaSigno[] $tHistoriaSignos
 * @property TAutorizacionEvento[] $tAutorizacionEventos
 * @property TDatosBasicos[] $tDatosBasicoses
 * @property THistoriaMedica[] $tHistoriaMedicas
 * @property TEntidad[] $tEntidads
 * @property TEnfermedad[] $tEnfermedads
 * @property TEspecialidad[] $tEspecialidads
 * @property TEstadoCivil[] $tEstadoCivils
 * @property TEnfermedadCapitulo[] $tEnfermedadCapitulos
 * @property TFormaPago[] $tFormaPagos
 * @property TMedicamento[] $tMedicamentos
 * @property TTipoAsistencia[] $tTipoAsistencias
 * @property TPerfil[] $tPerfils
 * @property TTipoEntidad[] $tTipoEntidads
 * @property TTipoIdentificacion[] $tTipoIdentificacions
 * @property TBanco[] $tBancos
 * @property THistoriaAntecedente[] $tHistoriaAntecedentes
 * @property TSignoVital[] $tSignoVitals
 * @property TDatosBasicosUbicacion[] $tDatosBasicosUbicacions
 * @property TMedico[] $tMedicos
 * @property TEnfermedadClasificacion[] $tEnfermedadClasificacions
 * @property TTipoRespuesta[] $tTipoRespuestas
 * @property TAntecedenteRespuesta[] $tAntecedenteRespuestas
 * @property TAntecedente[] $tAntecedentes
 * @property TExamenFisico[] $tExamenFisicos
 * @property TTipoEstatus $idTipoEstatus
 */
class TEstatus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_estatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion', 'required'),
			array('id_tipo_estatus', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>100),
			array('abreviatura', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estatus, descripcion, abreviatura, fecha_creacion, id_tipo_estatus', 'safe', 'on'=>'search'),
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
			'tAntecedenteClasificacions' => array(self::HAS_MANY, 'TAntecedenteClasificacion', 'id_estatus'),
			'tAntecedenteTipos' => array(self::HAS_MANY, 'TAntecedenteTipo', 'id_estatus'),
			'tAutorizacionHistoriaAntecedentes' => array(self::HAS_MANY, 'TAutorizacionHistoriaAntecedente', 'id_estatus'),
			'tHistoriaEventoExamenFisicos' => array(self::HAS_MANY, 'THistoriaEventoExamenFisico', 'id_estatus'),
			'tHistoriaEventos' => array(self::HAS_MANY, 'THistoriaEvento', 'id_estatus'),
			'tHistoriaSignos' => array(self::HAS_MANY, 'THistoriaSigno', 'id_estatus'),
			'tAutorizacionEventos' => array(self::HAS_MANY, 'TAutorizacionEvento', 'id_estatus'),
			'tDatosBasicoses' => array(self::HAS_MANY, 'TDatosBasicos', 'id_estatus'),
			'tHistoriaMedicas' => array(self::HAS_MANY, 'THistoriaMedica', 'id_estatus'),
			'tEntidads' => array(self::HAS_MANY, 'TEntidad', 'id_estatus'),
			'tEnfermedads' => array(self::HAS_MANY, 'TEnfermedad', 'id_estatus'),
			'tEspecialidads' => array(self::HAS_MANY, 'TEspecialidad', 'id_estatus'),
			'tEstadoCivils' => array(self::HAS_MANY, 'TEstadoCivil', 'id_estatus'),
			'tEnfermedadCapitulos' => array(self::HAS_MANY, 'TEnfermedadCapitulo', 'id_estatus'),
			'tFormaPagos' => array(self::HAS_MANY, 'TFormaPago', 'id_estatus'),
			'tMedicamentos' => array(self::HAS_MANY, 'TMedicamento', 'id_estatus'),
			'tTipoAsistencias' => array(self::HAS_MANY, 'TTipoAsistencia', 'id_estatus'),
			'tPerfils' => array(self::HAS_MANY, 'TPerfil', 'id_estatus'),
			'tTipoEntidads' => array(self::HAS_MANY, 'TTipoEntidad', 'id_estatus'),
			'tTipoIdentificacions' => array(self::HAS_MANY, 'TTipoIdentificacion', 'id_estatus'),
			'tBancos' => array(self::HAS_MANY, 'TBanco', 'id_estatus'),
			'tHistoriaAntecedentes' => array(self::HAS_MANY, 'THistoriaAntecedente', 'id_estatus'),
			'tSignoVitals' => array(self::HAS_MANY, 'TSignoVital', 'id_estatus'),
			'tDatosBasicosUbicacions' => array(self::HAS_MANY, 'TDatosBasicosUbicacion', 'id_estatus'),
			'tMedicos' => array(self::HAS_MANY, 'TMedico', 'id_estatus'),
			'tEnfermedadClasificacions' => array(self::HAS_MANY, 'TEnfermedadClasificacion', 'id_estatus'),
			'tTipoRespuestas' => array(self::HAS_MANY, 'TTipoRespuesta', 'id_estatus'),
			'tAntecedenteRespuestas' => array(self::HAS_MANY, 'TAntecedenteRespuesta', 'id_estatus'),
			'tAntecedentes' => array(self::HAS_MANY, 'TAntecedente', 'id_estatus'),
			'tExamenFisicos' => array(self::HAS_MANY, 'TExamenFisico', 'id_estatus'),
			'idTipoEstatus' => array(self::BELONGS_TO, 'TTipoEstatus', 'id_tipo_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estatus' => 'Estatus',
			'descripcion' => 'Descripcion',
			'abreviatura' => 'Abreviatura',
			'fecha_creacion' => 'Fecha Creacion',
			'id_tipo_estatus' => 'Id Tipo Estatus',
		);
	}

	/**
	 * @return string customized attribute labels (name=>label)
	 */
	public function getDescEstatus($id_estatus)
	{
		$estatus = "";

		if (isset($id_estatus)){ 
			// NOTE: you may need to adjust the relation name and the related
			// class name for the relations automatically generated below.	
			$criteria= new CDbCriteria;
			$criteria->select = array('descripcion AS descripcion');
			$criteria->condition = "t.id_estatus = ".$id_estatus;	

			$estatus = $this->find($criteria)->descripcion;
		}
		return $estatus;
		
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

		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('abreviatura',$this->abreviatura,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_tipo_estatus',$this->id_tipo_estatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TEstatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
