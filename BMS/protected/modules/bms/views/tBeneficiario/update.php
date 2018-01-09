<?php
/* @var $this TBeneficiarioController */
/* @var $model TBeneficiario */

$this->breadcrumbs=array(
	'Tbeneficiarios'=>array('index'),
	$model->id_beneficiario=>array('view','id'=>$model->id_beneficiario),
	'Update',
);

$this->menu=array(
	array('label'=>'List TBeneficiario', 'url'=>array('index')),
	array('label'=>'Create TBeneficiario', 'url'=>array('create')),
	array('label'=>'View TBeneficiario', 'url'=>array('view', 'id'=>$model->id_beneficiario)),
	array('label'=>'Manage TBeneficiario', 'url'=>array('admin')),
);
?>

<h1>Update TBeneficiario <?php echo $model->id_beneficiario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>