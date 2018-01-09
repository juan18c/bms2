<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $model TImagenLoginUsuario */

$this->breadcrumbs=array(
	'Timagen Login Usuarios'=>array('index'),
	'Create',
);

$this->menu=TUsuario::model()->CargarMenuLateral();
?>

<div class="row-fluid" style="width:100%">
	<div class="span12">
		<h1 class="heading">Configuraci&oacute;n de Imagen de Usuario</h1>
	</div>	
</div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>