<?php
/* @var $this TProductoTipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tproducto Tipos',
);

$this->menu=array(
	array('label'=>'Create TProductoTipo', 'url'=>array('create')),
	array('label'=>'Manage TProductoTipo', 'url'=>array('admin')),
);
?>

<h1>Tproducto Tipos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
