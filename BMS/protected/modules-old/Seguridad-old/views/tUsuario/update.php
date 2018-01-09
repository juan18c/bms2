<?php
/* @var $this TUsuarioController */
/* @var $model TUsuario */

$this->breadcrumbs=array(
	'Tusuarios'=>array('index'),
	$model->id_usuario=>array('view','id'=>$model->id_usuario),
	'Update',
);

$this->menu=TUsuario::model()->CargarMenuLateral();
?>

<div class="row-fluid" style="width:90%">
	<div class="span12">
		<h1 class="heading">Modificar Usuario</h1>
	</div>	
</div>

<?php $this->renderPartial('_form', array('model'=>$model,'modelDB'=>$modelDatosBasicos,'modelRol'=>$modelRol));?>