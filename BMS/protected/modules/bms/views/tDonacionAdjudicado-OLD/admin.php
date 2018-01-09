<?php
/* @var $this TDonacionAdjudicadoController */
/* @var $model TDonacionAdjudicado */

$this->breadcrumbs=array(
	'Tdonacion Adjudicados'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TDonacionAdjudicado', 'url'=>array('index')),
	array('label'=>'Create TDonacionAdjudicado', 'url'=>array('create')),
);

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdonacion-adjudicado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id_donador',
			'value'=>'($data->publico==0) ? ucfirst(mb_strtolower(TDatosBasicos::model()->findByPk($data->id_donador)->nombres." ".TDatosBasicos::model()->findByPk($data->id_donador)->apellidos)):"Anónimo"',
			'htmlOptions' => array('class' =>'essential persist','style'=>'width:30%'),
			//'filter'=> false,
			),
		'monto',		
		'comentario',
		array(
			'name'=>'fecha_creacion',
			'value'=>'date(\'d/m/Y \',strtotime($data->fecha_creacion))',
			'htmlOptions' => array('class' =>'essential persist','style'=>'width:15%'),
			//'filter'=> false,
			),
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
