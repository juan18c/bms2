<?php
/* @var $this TProveedorController */
/* @var $model TProveedor */

$this->breadcrumbs=array(
	'Tproveedors'=>array('index'),
	$model->id_proveedor=>array('view','id'=>$model->id_proveedor),
	'Update',
);

$this->menu=array(
	array('label'=>'List TProveedor', 'url'=>array('index')),
	array('label'=>'Create TProveedor', 'url'=>array('create')),
	array('label'=>'View TProveedor', 'url'=>array('view', 'id'=>$model->id_proveedor)),
	array('label'=>'Manage TProveedor', 'url'=>array('admin')),
);
?>

<h1>Update TProveedor <?php echo $model->id_proveedor; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>