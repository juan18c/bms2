<?php

/**
 * This is the model class for table "esculapio.t_localizacion_pais".
 *
 * The followings are the available columns in table 'esculapio.t_localizacion_pais':
 * @property integer $id_pais
 * @property string $descripcion
 * @property string $abreviatura
 * @property string $cod_area
 *
 * The followings are the available model relations:
 * @property TDatosBasicosUbicacion[] $tDatosBasicosUbicacions
 * @property TLocalizacionEstado[] $tLocalizacionEstados
 */
class TPais extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_pais';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion,abreviatura', 'required'),
			array('id_pais', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>60),
			array('abreviatura', 'length', 'max'=>3),
			array('cod_area', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pais, descripcion, abreviatura, cod_area', 'safe', 'on'=>'search'),
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
			'tDatosBasicosUbicacions' => array(self::HAS_MANY, 'TDatosBasicosUbicacion', 'id_pais'),
			'tLocalizacionEstados' => array(self::HAS_MANY, 'TLocalizacionEstado', 'id_pais'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pais' => 'Pais',
			'descripcion' => 'Descripcion Pais',
			'abreviatura' => 'Abreviatura Pais',
			'cod_area' => 'Cod Area',
		);
	}

	public function getPais($id)
	{
		$criteria= new CDbCriteria;
		$criteria->addCondition("t.id_pais = ".$id);	
		$Pais=$this->find($criteria);
		return $Pais->descripcion;
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

		$criteria->compare('id_pais',$this->id_pais);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('abreviatura',$this->abreviatura,true);
		$criteria->compare('cod_area',$this->cod_area,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TLocalizacionPais the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
