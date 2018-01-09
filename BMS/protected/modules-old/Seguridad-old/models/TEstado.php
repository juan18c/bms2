<?php

/**
 * This is the model class for table "esculapio.t_localizacion_estado".
 *
 * The followings are the available columns in table 'esculapio.t_localizacion_estado':
 * @property integer $id_estado
 * @property integer $id_pais
 * @property string $nombre_estado
 *
 * The followings are the available model relations:
 * @property TDatosBasicosUbicacion[] $tDatosBasicosUbicacions
 * @property TLocalizacionPais $idPais
 * @property TLocalizacionMunicipio[] $tLocalizacionMunicipios
 */
class TEstado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_estado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('id_pais', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estado, id_pais, nombre', 'safe', 'on'=>'search'),
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
			//'tDatosBasicosUbicacions' => array(self::HAS_MANY, 'TDatosBasicosUbicacion', 'id_estado'),
			'idPais' => array(self::BELONGS_TO, 'TPais', 'id_pais'),
			//'tLocalizacionMunicipios' => array(self::HAS_MANY, 'TLocalizacionMunicipio', 'id_estado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estado' => 'Estado',
			'id_pais' => 'Cod Pais',
			'nombre' => 'Estado',
		);
	}
	public function getEstado($id)
	{
		$criteria= new CDbCriteria;
		$criteria->addCondition("t.id_estado = ".$id);	
		$Estado=$this->find($criteria);
		return $Estado->nombre;
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

		$criteria->compare('id_estado',$this->id_estado);
		$criteria->compare('id_pais',$this->id_pais);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TLocalizacionEstado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
