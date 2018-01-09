<?php

/**
 * This is the model class for table "t_medico_redes_sociales".
 *
 * The followings are the available columns in table 't_medico_redes_sociales':
 * @property integer $id_medico_redes
 * @property integer $id_medico
 * @property integer $id_redes_sociales
 * @property integer $usuario
 *
 * The followings are the available model relations:
 * @property TMedico $idMedico
 */
class TMedicoRedesSociales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_medico_redes_sociales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_medico_redes, id_medico, id_redes_sociales, usuario', 'required'),
			array('id_medico_redes, id_medico, id_redes_sociales, usuario', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_medico_redes, id_medico, id_redes_sociales, usuario', 'safe', 'on'=>'search'),
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
			'idMedico' => array(self::BELONGS_TO, 'TMedico', 'id_medico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_medico_redes' => 'Id Medico Redes',
			'id_medico' => 'Id Medico',
			'id_redes_sociales' => 'Id Redes Sociales',
			'usuario' => 'Usuario',
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

		$criteria->compare('id_medico_redes',$this->id_medico_redes);
		$criteria->compare('id_medico',$this->id_medico);
		$criteria->compare('id_redes_sociales',$this->id_redes_sociales);
		$criteria->compare('usuario',$this->usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TMedicoRedesSociales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
