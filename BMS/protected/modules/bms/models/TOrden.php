<?php

/**
 * This is the model class for table "t_orden".
 *
 * The followings are the available columns in table 't_orden':
 * @property integer $id_orden
 * @property string $codigo_orden
 * @property integer $id_cotizacion
 * @property integer $id_beneficiario
 * @property integer $items
 * @property double $monto_total
 * @property double $pago_acumulado
 * @property integer $id_estatus
 * @property string $fecha_creacion
 */
class TOrden extends CActiveRecord
{
	public $nombreBeneficiario;
	public $pagos;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bms.t_orden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_orden, id_cotizacion, id_beneficiario, items, monto_total, pago_acumulado', 'required'),
			array('id_cotizacion, id_beneficiario, items, id_estatus', 'numerical', 'integerOnly'=>true),
			array('monto_total, pago_acumulado', 'numerical'),
			array('codigo_orden', 'length', 'max'=>20),
			array('nombreBeneficiario,pagos', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_orden, codigo_orden, id_cotizacion, id_beneficiario, items, monto_total, pago_acumulado, id_estatus, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idCotizacion' => array(self::BELONGS_TO, 'TCotizacion', 'id_cotizacion'),
			'idBeneficiario' => array(self::BELONGS_TO, 'TBeneficiario', 'id_beneficiario'),
			'idEstatus' => array(self::BELONGS_TO, 'TEstatus', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_orden' => 'Id Orden',
			'codigo_orden' => 'Codigo Orden',
			'id_cotizacion' => 'Id Cotizacion',
			'id_beneficiario' => 'Id Beneficiario',
			'items' => 'Items',
			'monto_total' => 'Monto Total',
			'pago_acumulado' => 'pago_acumulado',
			'id_estatus' => 'Id Estatus',
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

		$criteria->compare('id_orden',$this->id_orden);
		$criteria->compare('codigo_orden',$this->codigo_orden,true);
		$criteria->compare('id_cotizacion',$this->id_cotizacion);
		$criteria->compare('id_beneficiario',$this->id_beneficiario);
		$criteria->compare('items',$this->items);
		$criteria->compare('monto_total',$this->monto_total);
		$criteria->compare('pago_acumulado',$this->pago_acumulado);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getPagosPendientes($idOden)
	{
		$salida='<table>
					<tr>
						<td>
							Enviado
						</td>
						<td>
							Recibido
						</td>
						<td>
							Medio
						</td>
						<td>
							Fecha
						</td>
						<td>
							&nbsp;
						</td>
					</tr>';

		$criteria=new CDbCriteria;		
		$criteria->with = array('idMedioPago');
		$criteria->condition = 't.id_orden='.$idOden.'';//PENDIENTE POR VERIFICAR PAGO	

		$pagos=TOrdenPago::model()->findAll($criteria);

		foreach ($pagos as $key => $value) {
			$salida.= '				
				<tr>
					<td>
						'.$value->monto.'
					</td>
					<td>
						<input type="text" id="montoRecibido_'.$value->id_orden_pago.'" name="montoRecibido_'.$value->id_orden_pago.'" value="'.$value->monto.'" class="form-control">
					</td>
					<td>
						 '.$value->idMedioPago->descripcion.'&nbsp; '.$value->numero_tarjeta.'
					</td>
					<td>
						'.$value->fecha_creacion.'
					</td>
					<td>
						<button class="btn btn-primary pull-right" type="button" id="TOrdenPago_aprobar_pago_'.$value->id_orden_pago.'" name="TOrdenPago_aprobar_pago_'.$value->id_orden_pago.'" style="background-color:#820906"><i class="fa fa-check" onclick="js: aprobarPago('.$value->id_orden.','.$value->id_orden_pago.',$(\'#montoRecibido_'.$value->id_orden_pago.'\')); return false; "></i></button>
					</td>
				</tr>				
			';
		}

		$salida.='</table>';

		return $salida;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TOrden the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
