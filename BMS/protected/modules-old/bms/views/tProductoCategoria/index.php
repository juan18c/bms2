<?php
/* @var $this TProductoCategoriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tproducto Categorias',
);

$this->menu=array(
	array('label'=>'Create TProductoCategoria', 'url'=>array('create')),
	array('label'=>'Manage TProductoCategoria', 'url'=>array('admin')),
);
?>

<h1>Tproducto Categorias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
