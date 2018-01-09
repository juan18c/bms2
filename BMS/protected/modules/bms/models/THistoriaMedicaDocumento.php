<?php

/**
 * This is the model class for table "t_historia_medica_documento".
 *
 * The followings are the available columns in table 't_historia_medica_documento':
 * @property integer $id_historia_medica_documento
 * @property integer $id_historia_medica_caso
 * @property string $ruta
 * @property integer $tamanio
 * @property string $tipo
 * @property integer $id_estatus
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property THistoriaMedicaCaso $idHistoriaMedicaCaso
 * @property TEstatus $idEstatus
 */
class THistoriaMedicaDocumento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_historia_medica_documento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_historia_medica_caso,ruta', 'required'),
			array('id_historia_medica_caso, tamanio, id_estatus', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>50),
			array('ruta', 'file', 'types'=>'jpg, png, pdf', 'safe' => false), //'allowEmpty' => true,
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_historia_medica_documento, id_historia_medica_caso, ruta, tamanio, tipo, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'id_historia_medica_documento' => 'Id Historia Medica Documento',
			'id_historia_medica_caso' => 'Id Historia Medica Caso',
			'ruta' => 'Seleccione un archivo .jpg, .png ó .pdf',
			'tamanio' => 'Tamanio',
			'tipo' => 'Tipo',
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

		$criteria->compare('id_historia_medica_documento',$this->id_historia_medica_documento);
		$criteria->compare('id_historia_medica_caso',$this->id_historia_medica_caso);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('tamanio',$this->tamanio);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function getDocumentos($idCaso)
	{
		$salida = '' ;
		// @todo Please modify the following code to remove attributes that should not be searched.
		if (!empty($idCaso)) {			
		
			$criteria=new CDbCriteria;
			$criteria->select = array("t.id_historia_medica_documento","t.ruta");
			$criteria->with = array('idHistoriaMedicaCaso');
			$criteria->condition = '`idHistoriaMedicaCaso`.`id_historia_medica_caso` = '.$idCaso;
			$documento=$this->findAll($criteria);

			foreach ($documento as $key => $value) {
				$salida.='<a href="'.Yii::app()->request->baseUrl.'/'.$value->ruta.'" target="_blank"><i class="fa fa-file-pdf-o"></i></a>&nbsp;';
			}		
		}		
		
		return $salida;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return THistoriaMedicaDocumento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
