<?php
/* @var $this TDonacionAdjudicadoController */
/* @var $model TDonacionAdjudicado */

$this->breadcrumbs=array(
	'Tdonacion Adjudicados'=>array('index'),
	$model->id_donacion_adjudicado=>array('view','id'=>$model->id_donacion_adjudicado),
	'Update',
);

$this->menu=array(
	array('label'=>'List TDonacionAdjudicado', 'url'=>array('index')),
	array('label'=>'Create TDonacionAdjudicado', 'url'=>array('create')),
	array('label'=>'View TDonacionAdjudicado', 'url'=>array('view', 'id'=>$model->id_donacion_adjudicado)),
	array('label'=>'Manage TDonacionAdjudicado', 'url'=>array('admin')),
);
?>

<h1>Update TDonacionAdjudicado <?php echo $model->id_donacion_adjudicado; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>