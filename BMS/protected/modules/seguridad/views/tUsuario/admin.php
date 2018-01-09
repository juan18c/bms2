<div class="panel-body">
    <section id="unseen">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tusuario-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'filter'=>$model,
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
		//array('name' => 'idPersona.nro_identificacion','header' =>'C&eacute;dula','filter'=>CHtml::activeTextField($model,'nro_identificacion')),
		array('name' => 'usuario','header' =>'Usuario'),
		'palabra_clave',
		'nro_intentos',
		'fecha_creacion',		
		array('name' => 'id_estatus','header' =>'Estatus','value'=>'TEstatus::model()->getDescEstatus($data->id_estatus)','filter'=> CHtml::listData(TEstatus::model()->findAll(), 'id_estatus', 'descripcion')),
			
		array('header' =>'Opciones', 'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array
			(
				'view' => array
				(
						'label'=>'',
						'imageUrl'=>'',
						'options'=>array('class'=>'icon-eye-open'),

				),
				'update' => array
				(
						'label'=>'',
						'imageUrl'=>'',
						'options'=>array('class'=>'icon-pencil'),
				),
				'delete' => array
				(
						'label'=>'',
						'imageUrl'=>'',
						//'url'=> 'Yii::app()->createUrl("seguridad/TUsuario/update",array("id"=>$data->id_usuario,"delete"=>true))',
						'options'=>array('class'=>'icon-trash'),

				),
			),
		),
	),
)); ?>
	</section>
</div>