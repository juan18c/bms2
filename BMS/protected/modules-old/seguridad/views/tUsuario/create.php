<?php
/* @var $this TUsuarioController */
/* @var $model TUsuario */

$this->breadcrumbs=array(
	'Tusuarios'=>array('index'),
	'Create',
);

//$this->menu=TUsuario::model()->CargarMenuLateral();


?>
<div class="row-fluid" style="width:90%">
	<div class="span12">
		<h1 class="heading">Crear Usuario</h1>
	</div>	
</div>

<?php $this->renderPartial('_form', array('model'=>$model,'modelDB'=>$modelDatosBasicos,'modelRol'=>$modelRol)); ?>