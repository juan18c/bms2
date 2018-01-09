<?php

/**
 * This is the model class for table "bms.t_donacion".
 *
 * The followings are the available columns in table 'bms.t_donacion':
 * @property integer $id_donacion
 * @property string $codigo_donacion
 * @property integer $id_cotizacion
 * @property double $monto_acumulado
 * @property string $diagnostico
 * @property string $sintomas
 * @property string $resumen
 * @property string $objetivo
 * @property string $foto
 * @property string $video
 * @property integer $id_estatus
 * @property string $fecha_creacion
 */
class TDonacion extends CActiveRecord
{
	
	public $nombreBeneficiario;
	public $nombreResponsable;
	public $cuantas_donaciones;
	public $monto_conciliado;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_donacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cotizacion,nombre_caso,diagnostico, sintomas, resumen, objetivo,monto_solicitado,video', 'required'),
			array('id_cotizacion, id_estatus,id_usuario', 'numerical', 'integerOnly'=>true),
			array('monto_acumulado,monto_conciliado', 'numerical'),
			array('codigo_donacion', 'length', 'max'=>20),
			array('nombre_caso', 'length', 'max'=>50),
			array('diagnostico, sintomas, resumen, objetivo, foto, video,nombre_caso', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_donacion, codigo_donacion, id_cotizacion, monto_acumulado,monto_solicitado, diagnostico, sintomas,nombre_caso, resumen, objetivo, foto, video, id_estatus, fecha_creacion,nombreBeneficiario,nombreResponsable,cuantas_donaciones,id_usuario', 'safe', 'on'=>'search'),
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
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
			'idCotizacion' => array(self::BELONGS_TO, 'TCotizacion', 'id_cotizacion'),
			'idUsuario' => array(self::BELONGS_TO, 'TUsuario', 'id_usuario'),
			'idDonacionAdjudicada' =>array(self::HAS_MANY, 'TDonacionAdjudicado', 'id_donacion'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_donacion' => 'Id Donacion',
			'codigo_donacion' => 'Codigo Donacion',
			'id_cotizacion' => 'Id Cotizacion',
			'monto_acumulado' => 'Monto Acumulado',
			'monto_solicitado' => 'Monto Solicitado',
			'diagnostico' => 'Diagnostico',
			'sintomas' => 'Sintomas',
			'resumen' => 'Resumen',
			'objetivo' => 'Objetivo',
			'foto' => 'Foto',
			'video' => 'Video',
			'id_estatus' => 'Estatus',
			'fecha_creacion' => 'Fecha Creacion',
			'nombre_caso'=>'Nombre del Caso',
			'nombreBeneficiario'=>'Beneficiario',
			'nombreBeneficiario'=>'Responsable',
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
		$criteria->compare('id_donacion',$this->id_donacion);
		$criteria->compare('codigo_donacion',$this->codigo_donacion,true);
		$criteria->compare('id_cotizacion',$this->id_cotizacion);
		$criteria->compare('monto_acumulado',$this->monto_acumulado);
		$criteria->compare('monto_solicitado',$this->monto_solicitado);
		$criteria->compare('diagnostico',$this->diagnostico,true);
		$criteria->compare('sintomas',$this->sintomas,true);
		$criteria->compare('resumen',$this->resumen,true);
		$criteria->compare('objetivo',$this->objetivo,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('nombre_caso',$this->nombre_caso,true);
		$criteria->compare('cuantas_donaciones',$this->cuantas_donaciones,true);
		//$criteria->compare('idCotizacion.duracion_tratamiento',$this->nombreBeneficiario,true);

		$criteria->together = true;
		//$criteria->select = array('"CONCAT( `idBeneficiarioDB`.`nombres`,' ',`idBeneficiarioDB`.`apellidos`) as nombres"');
 		//$criteria->with= array('idCotizacion.idBeneficiario.idBeneficiarioDB'=>array('select'=>'*,CONCAT(idCotizacion.idBeneficiario.idBeneficiarioDB.nombres," ",idCotizacion.idBeneficiario.idBeneficiarioDB.apellidos) resultado'));
 		//array('idCotizacion','idCotizacion.idBeneficiario.idBeneficiarioDB');
 		//print_r($criteria);exit();
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}




	public function tiempoTranscurridoFechas($fechaInicio)
	{
	    $fecha1 = $fechaInicio;
	    $fecha2 = new DateTime();
	    $fecha = $fecha1->diff($fecha2);
	    $tiempo = "";
	         
	    //años
	    if($fecha->y > 0)
	    {
	        $tiempo .= $fecha->y;
	             
	        if($fecha->y == 1)
	            $tiempo .= " año, ";
	        else
	            $tiempo .= " años, ";
	    }
	         
	    //meses
	    if($fecha->m > 0)
	    {
	        $tiempo .= $fecha->m;
	             
	        if($fecha->m == 1)
	            $tiempo .= " mes, ";
	        else
	            $tiempo .= " meses, ";
	    }
	         
	    //dias
	    if($fecha->d > 0)
	    {
	        $tiempo .= $fecha->d;
	             
	        if($fecha->d == 1)
	            $tiempo .= " día ";
	        else
	            $tiempo .= " días ";
	    }
	         
	    //horas
	    if($fecha->h > 0)
	    {
	        $tiempo .= $fecha->h;
	             
	        if($fecha->h == 1)
	            $tiempo .= " hora ";
	        else
	            $tiempo .= " horas ";
	    }
	     /*    
	    //minutos
	    if($fecha->i > 0)
	    {
	        $tiempo .= $fecha->i;
	             
	        if($fecha->i == 1)
	            $tiempo .= " minuto";
	        else
	            $tiempo .= " minutos";
	    }
	    else if($fecha->i == 0) //segundos
	        $tiempo .= $fecha->s." segundos";*/
	         
	    return $tiempo;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TDonacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
