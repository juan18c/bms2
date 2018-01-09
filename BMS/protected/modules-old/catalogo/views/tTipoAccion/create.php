<?php
/* @var $this TTipoAccionController */
/* @var $model TTipoAccion */

$this->breadcrumbs=array(
	'Ttipo Accions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TTipoAccion', 'url'=>array('index')),
	array('label'=>'Manage TTipoAccion', 'url'=>array('admin')),
);
?>

<h1>Create TTipoAccion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>