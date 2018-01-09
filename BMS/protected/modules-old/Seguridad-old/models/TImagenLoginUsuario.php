<?php

/**
 * This is the model class for table "seguridad.t_imagen_login_usuario".
 *
 * The followings are the available columns in table 'seguridad.t_imagen_login_usuario':
 * @property integer $id_usuario
 * @property integer $id_imagen
 * @property integer $id_entidad
 * @property string $fecha_creacion
 * @property integer $id_estatus
 * @property integer $id_imagen_login_usuario
 *
 * The followings are the available model relations:
 * @property TImagenLogin $idImagen
 * @property TUsuario $idUsuario
 * @property TClinica $idClinica
 */
class TImagenLoginUsuario extends CActiveRecord
{
	public $reValid;
	public $imagenSelec;
	public $existeImagenClinica;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguridad.t_imagen_login_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, id_imagen, id_entidad', 'required'),
			array('id_usuario, id_imagen, id_entidad, id_estatus', 'numerical', 'integerOnly'=>true),
			array('reValid','length','max'=>1),
			array('imagenSelec','length','max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, id_imagen, id_entidad, fecha_creacion, id_estatus, id_imagen_login_usuario', 'safe', 'on'=>'search'),
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
			'idImagen' => array(self::BELONGS_TO, 'TImagenLogin', 'id_imagen'),
			'idUsuario' => array(self::BELONGS_TO, 'TUsuario', 'id_usuario'),
			'idClinica' => array(self::BELONGS_TO, 'TClinica', 'id_entidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_imagen_login_usuario' => 'Id Imagen Login Usuario',
			'id_usuario' => 'Usuario',
			'id_imagen' => 'Seleccione una imagen de seguridad',
			'id_entidad' => 'Cl&iacute;nica',
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

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('id_imagen',$this->id_imagen);
		$criteria->compare('id_entidad',$this->id_entidad);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('id_imagen_login_usuario',$this->id_imagen_login_usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function verificarImagen($imagenSelec,$clinica)
	{
		//echo "imagen:".$imagenSelec."clinica:".$clinica;
		$model=TImagenLoginUsuario::model()->findAll('id_usuario='.Yii::app()->session['_id'].' and id_imagen='.$imagenSelec.' and id_entidad='.$clinica);
		if (count($model)>0){
			return 1;
		}else{
			return 0;
		}
	
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TImagenLoginUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
