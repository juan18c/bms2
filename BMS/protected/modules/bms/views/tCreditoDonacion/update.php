<?php
/* @var $this TCreditoDonacionController */
/* @var $model TCreditoDonacion */

$this->breadcrumbs=array(
	'Tcredito Donacions'=>array('index'),
	$model->id_credito_donacion=>array('view','id'=>$model->id_credito_donacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List TCreditoDonacion', 'url'=>array('index')),
	array('label'=>'Create TCreditoDonacion', 'url'=>array('create')),
	array('label'=>'View TCreditoDonacion', 'url'=>array('view', 'id'=>$model->id_credito_donacion)),
	array('label'=>'Manage TCreditoDonacion', 'url'=>array('admin')),
);
?>

<h1>Update TCreditoDonacion <?php echo $model->id_credito_donacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>