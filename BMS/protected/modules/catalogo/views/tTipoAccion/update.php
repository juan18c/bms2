<?php
/* @var $this TTipoAccionController */
/* @var $model TTipoAccion */

$this->breadcrumbs=array(
	'Ttipo Accions'=>array('index'),
	$model->id_tipo_accion=>array('view','id'=>$model->id_tipo_accion),
	'Update',
);

$this->menu=array(
	array('label'=>'List TTipoAccion', 'url'=>array('index')),
	array('label'=>'Create TTipoAccion', 'url'=>array('create')),
	array('label'=>'View TTipoAccion', 'url'=>array('view', 'id'=>$model->id_tipo_accion)),
	array('label'=>'Manage TTipoAccion', 'url'=>array('admin')),
);
?>

<h1>Update TTipoAccion <?php echo $model->id_tipo_accion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>