<?php
/* @var $this TDespachoEnvioController */
/* @var $model TDespachoEnvio */

$this->breadcrumbs=array(
	'Tdespacho Envios'=>array('index'),
	$model->id_despacho_envio=>array('view','id'=>$model->id_despacho_envio),
	'Update',
);

$this->menu=array(
	array('label'=>'List TDespachoEnvio', 'url'=>array('index')),
	array('label'=>'Create TDespachoEnvio', 'url'=>array('create')),
	array('label'=>'View TDespachoEnvio', 'url'=>array('view', 'id'=>$model->id_despacho_envio)),
	array('label'=>'Manage TDespachoEnvio', 'url'=>array('admin')),
);
?>

<h1>Update TDespachoEnvio <?php echo $model->id_despacho_envio; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>