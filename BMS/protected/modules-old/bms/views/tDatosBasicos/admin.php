<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */
?>

<div class="panel-body">
    <section id="unseen">

	<?php 
		$criteria= new CDbCriteria;
 		$criteria->condition="t.id_estatus=1 ";
 		$criteria->order = "t.descripcion";

		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'tdatos-basicos-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'itemsCssClass'=>'table table-bordered table-striped table-condensed',
		'pager' => array(
	        //'cssFile' => Yii::app()->theme->baseUrl."/css/main2.css",
	        'htmlOptions'=>array('class'=>'dataTables_paginate paging_bootstrap pagination'),
	        'header' => '',
	        'firstPageLabel' => '<b><<</b>',
	        'lastPageLabel' => '<b>>></b>',
	        'prevPageLabel' => '<b><</b>',
	        'nextPageLabel' => '<b>></b>',
	        'selectedPageCssClass'=>'active',
	        //'default' => 'selected',
	        //'nextPageCssClass' => 'ClassName',
	        //'previousPageCssClass' => 'ClassName',
	        //'selectedPageCssClass' => 'ClassName',
	        //'internalPageCssClass' => 'ClassName',
	    ),
	    'pagerCssClass' => 'col-sm-12',
		'columns'=>array(			
			
			// array(
			// 	'name' => 'nro_identificacion',
			// 	'header' =>'Nro Identificaci&oacute;n',
			// 	//'htmlOptions' => array('style'=>'width:10%'),
			// 	'filter'=> CHtml::listData(TDatosBasicos::model()->findAll('t.id_perfil=4'), 'id_datos_basicos', 'nro_identificacion')
			// ),
			
			array(
				'name' => 'nombres',
				'header' =>'Nombres', 
				//'htmlOptions' => array('class' =>'essential persist','style'=>'width:20%')
			),
			
			array(
				'name' => 'id_estatus',
				'header' =>'Estatus', 
				'value'=>'TEstatus::model()->getDescEstatus($data->id_estatus)',
				//'htmlOptions' => array('class' =>'essential persist','style'=>'width:20%'),
				'filter'=> CHtml::listData(TEstatus::model()->findAll($criteria), 'id_estatus', 'descripcion')
			),
			//array('name' => 'id_datosBasicosPerfilOrig.id_perfil','header' =>'prueba', 'htmlOptions' => array('class' =>'essential persist','style'=>'width:20%')),
			array('header' =>'Opciones', 'class'=>'CButtonColumn',
				'template'=>'{view}&nbsp;{update}&nbsp;{delete}',
			    'buttons'=>array
			    (
			        'view' => array
			        (
			            'label'=>'',
			            'imageUrl'=>'',
			            'options'=>array('class'=>'fa fa-eye'),
     
			        ),
			         'update' => array
			        (
			            'label'=>'',
			            'imageUrl'=>'',
			            'options'=>array('class'=>'fa fa-pencil'),
			        ),
			         'delete' => array
			        (
			            'label'=>'',
			            'imageUrl'=>'',
			           
			            'options'=>array('class'=>'fa fa-trash'),
			            
			        ),
			    ),
			),

		),
	)); ?>

	</section>
</div>