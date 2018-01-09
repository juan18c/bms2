<?php
/* @var $this TBeneficiarioController */
/* @var $modelBeneficiario TBeneficiario */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbeneficiario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<a href="<?php echo Yii::app()->createUrl('bms/TBeneficiario/adminCliente'); ?>" target="_blank" class="btn btn-default">Ver Todos</a>
<div class="adv-table table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tbeneficiario-grid',
	'dataProvider'=>$modelBeneficiario->searchFront($idResponsable),
	'filter'=>$modelBeneficiario,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		array(	
			'name'=>'nombreBeneficiario',
			'header' =>'Nombres', 
			//'headerHtmlOptions' => array('style' => 'width: 15%'),
			'value'=>'$data->idBeneficiarioDB->nombres." ".$data->idBeneficiarioDB->apellidos'
			//'filter'=>CHtml::activeTextField($modelBeneficiario,'nombreBeneficiario')
		),	
		array(	
			'name'=>'id_parentesco',
			'header' =>'Parentesco', 
			//'headerHtmlOptions' => array('style' => 'width: 15%'),
			'value'=>'$data->idParentesco->descripcion',
			'filter'=> CHtml::listData(TParentesco::model()->findAll(),'id_parentesco','descripcion')
		),		
		array(	
			'name'=>'id_estatus',
			'header' =>'Estatus', 
			//'headerHtmlOptions' => array('style' => 'width: 10%'),
			'value'=>'TEstatus::model()->findByPk($data->id_estatus)->descripcion',
			'filter'=> CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion')
		),
		array(	
			'name'=>'fecha_creacion',
			'header' =>'Creación', 
			//'headerHtmlOptions' => array('style' => 'width: 18%'),
			'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
			'filter'=> true						
		),
		array(
			'class'=>'CButtonColumn',								
			'template'=>'{ver}&nbsp;{editar}&nbsp;{borrar}',
			'htmlOptions' => array('style'=>'white-space: nowrap'),
			'buttons'=>array(
			    
                'ver' => array(
                    'label'=>'', 
                    'url'=>'$data->id_beneficiario',     
                    'options'=>array('class'=>'fa fa-eye fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Datos'),
                    'click'=>'function(){ return false; }',
                    'live'=>false                         
                ),

                'editar' => array(
			        'label'=>'', 
			        'url'=>'"/idP/".$data->id_beneficiario',		
			        'options'=>array('class'=>'fa fa-pencil fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Editar Datos'),
			        'click'=>'function(){ getCotizacionResponsable($(this).attr("href")); return false; }',
			    	'live'=>false,				          
			    ),

                'borrar' => array(
                    'label'=>'', 
                    'url'=>'$data->id_beneficiario',     
                    'options'=>array('class'=>'fa fa-trash fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Eliminar Beneficiario'),
                    'click'=>'function(){ return false; }',
                    'live'=>false         
                ),

			),	
		),
	),
)); ?>
</div>