<?php
/* @var $this TUsuarioController */
/* @var $model TUsuario */

$this->breadcrumbs=array(
	'Tusuarios'=>array('index'),
	$model->id_usuario,
);

$this->menu=TUsuario::model()->CargarMenuLateral();

?>

<div class="row-fluid" style="width:90%">
	<div class="span12">
		<h1 class="heading">Ver Usuario:  (<?php echo $model->usuario; ?>)</h1>
	</div>	

</div>



<?php 

	$modelRoles = AuthAssignment::model()->findAll('userid='.$model->id_usuario);
	$Roles="";
	if (count($modelRoles)>0){
		foreach ($modelRoles as $key => $value){
			$Roles.=AuthItem::model()->findBypk($value->itemname)->description." ";
		}
	}
	
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_usuario',
		'usuario',
		'palabra_clave',
		'nro_intentos',
		//'cedula',
		array(
			'label' => 'Fecha de Creaci&oacute;n',
			'value' => date('d-m-Y',strtotime($model->fecha_usuario)),
		),
		array(
				'label' => 'Estatus',
				'value' => TEstatus::model()->findByPk($model->id_estatus)->descripcion,			 
		),
		array(
		'label' => 'Roles',
		'value'=>$Roles,
		),
	),
)); ?>
