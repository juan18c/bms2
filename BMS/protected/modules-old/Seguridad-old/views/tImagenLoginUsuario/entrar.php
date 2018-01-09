<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $model TImagenLoginUsuario */

$this->menu=TUsuario::model()->CargarMenuLateral();

?>

<div class="row-fluid" style="width:100%">
	<div class="span12">
		<h1 class="heading">Seleccione la clinica</h1>
	</div>	
</div>



<?php $this->renderPartial('_forms', array('model'=>$model)); ?>