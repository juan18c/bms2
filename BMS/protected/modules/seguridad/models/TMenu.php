<?php

/**
 * This is the model class for table "bms_seguridad.t_menu".
 *
 * The followings are the available columns in table 'bms_seguridad.t_menu':
 * @property integer $id_menu
 * @property integer $id_objeto
 * @property string $nombre_menu
 * @property integer $id_padre
 * @property integer $nivel
 */
class TMenu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms_seguridad.t_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_menu, id_objeto, nivel', 'required'),
			array('id_menu, id_objeto, id_padre, nivel', 'numerical', 'integerOnly'=>true),
			array('nombre_menu', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_menu, id_objeto, nombre_menu, id_padre, nivel', 'safe', 'on'=>'search'),
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
			'id_menu' => 'Id Menu',
			'id_objeto' => 'Id Objeto',
			'nombre_menu' => 'Nombre Menu',
			'id_padre' => 'Id Padre',
			'nivel' => 'Nivel',
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

		$criteria->compare('id_menu',$this->id_menu);
		$criteria->compare('id_objeto',$this->id_objeto);
		$criteria->compare('nombre_menu',$this->nombre_menu,true);
		$criteria->compare('id_padre',$this->id_padre);
		$criteria->compare('nivel',$this->nivel);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
