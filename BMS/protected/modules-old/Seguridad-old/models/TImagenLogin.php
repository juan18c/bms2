<?php

/**
 * This is the model class for table "seguridad.t_imagen_login".
 *
 * The followings are the available columns in table 'seguridad.t_imagen_login':
 * @property integer $id_imagen
 * @property string $nombre
 * @property integer $grupo
 * @property integer $dias_vigentes
 * @property string $fecha_creacion
 * @property integer $id_estatus
 */
class TImagenLogin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguridad.t_imagen_login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, grupo', 'required'),
			array('orden, grupo, dias_vigentes, id_estatus', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_imagen, nombre, grupo, dias_vigentes, fecha_creacion, id_estatus', 'safe', 'on'=>'search'),
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
			'id_imagen' => 'Código de Imagen',
			'nombre' => 'Nombre de Imagen',
			'orden' => 'Orden',
			'grupo' => 'Grupo de Imagen',
			'dias_vigentes' => 'Dias de Vigencia',
			'fecha_creacion' => 'Fecha Creacion',
			'id_estatus' => 'Id Estatus',
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

		$criteria->compare('id_imagen',$this->id_imagen);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('orden',$this->orden);
		$criteria->compare('grupo',$this->grupo);
		$criteria->compare('dias_vigentes',$this->dias_vigentes);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_estatus',$this->id_estatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TImagenLogin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
