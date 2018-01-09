<?php

  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdonacion-adjudicado-grid',
	'dataProvider'=>$model->search($idDonacion),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		array(
			'name'=>'id_donador',
			'header'=>'Donador',
			'value'=>'($data->publico==0) ? ucfirst(mb_strtolower(TDatosBasicos::model()->findByPk($data->id_donador)->nombres." ".TDatosBasicos::model()->findByPk($data->id_donador)->apellidos)):"Anónimo"',
			'htmlOptions' => array('class' =>'essential persist','style'=>'width:30%;font-size:14px'),
			'filter'=> false,
			),
		array(
			'name'=>'monto_conciliado',
			'htmlOptions' => array('class' =>'essential persist','style'=>'width:20%;font-size:14px'),
			'filter'=> false,
			),
		array(
			'name'=>'comentario',
			'htmlOptions' => array('class' =>'essential persist','style'=>'width:30%;font-size:14px'),
			'filter'=> false,
			),
		array(
			'name'=>'fecha_creacion',			
			'header'=>'Fecha',
			'value'=>'date(\'d/m/Y \',strtotime($data->fecha_creacion))',
			'htmlOptions' => array('class' =>'essential persist','style'=>'width:10%;font-size:12px'),
			'filter'=> false,
			),
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
