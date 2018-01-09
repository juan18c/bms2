<?php
/* @var $this TBeneficiarioController */
/* @var $model TBeneficiario */

$this->breadcrumbs=array(
	'Tbeneficiarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TBeneficiario', 'url'=>array('index')),
	array('label'=>'Manage TBeneficiario', 'url'=>array('admin')),
);
?>

<h1>Create TBeneficiario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>