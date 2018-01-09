<?php

/**
 * This is the model class for table "t_datos_consultorio".
 *
 * The followings are the available columns in table 't_datos_consultorio':
 * @property string $id_datos_consultorio
 * @property integer $id_medico
 * @property integer $id_medico_direccion
 * @property string $dias
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property string $nombre_consulta
 * @property integer $id_tipo_consulta
 * @property integer $id_medico_redes
 * @property string $descripcion
 */
class TDatosConsultorio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_datos_consultorio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_medico, id_medico_direccion, dias, hora_inicio, nombre_consulta, id_tipo_consulta, id_medico_redes, descripcion', 'required'),
			array('id_medico, id_medico_direccion, id_tipo_consulta, id_medico_redes', 'numerical', 'integerOnly'=>true),
			array('dias', 'length', 'max'=>15),
			array('nombre_consulta', 'length', 'max'=>50),
			array('descripcion', 'length', 'max'=>250),
			array('hora_fin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_datos_consultorio, id_medico, id_medico_direccion, dias, hora_inicio, hora_fin, nombre_consulta, id_tipo_consulta, id_medico_redes, descripcion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_datos_consultorio' => 'Id Datos Consultorio',
			'id_medico' => 'Id Medico',
			'id_medico_direccion' => 'Id Medico Direccion',
			'dias' => 'Dias',
			'hora_inicio' => 'Hora Inicio',
			'hora_fin' => 'Hora Fin',
			'nombre_consulta' => 'Nombre Consulta',
			'id_tipo_consulta' => 'Id Tipo Consulta',
			'id_medico_redes' => 'Id Medico Redes',
			'descripcion' => 'Descripcion',
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

		$criteria->compare('id_datos_consultorio',$this->id_datos_consultorio,true);
		$criteria->compare('id_medico',$this->id_medico);
		$criteria->compare('id_medico_direccion',$this->id_medico_direccion);
		$criteria->compare('dias',$this->dias,true);
		$criteria->compare('hora_inicio',$this->hora_inicio,true);
		$criteria->compare('hora_fin',$this->hora_fin,true);
		$criteria->compare('nombre_consulta',$this->nombre_consulta,true);
		$criteria->compare('id_tipo_consulta',$this->id_tipo_consulta);
		$criteria->compare('id_medico_redes',$this->id_medico_redes);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDatosConsultorio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
