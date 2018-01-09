<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $model TImagenLoginUsuario */

$this->breadcrumbs=array(
	'Timagen Login Usuarios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TImagenLoginUsuario', 'url'=>array('index')),
	array('label'=>'Create TImagenLoginUsuario', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#timagen-login-usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Timagen Login Usuarios</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'timagen-login-usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_usuario',
		'id_imagen',
		'id_clinica',
		'fecha_creacion',
		'id_estatus',
		'id_imagen_login_usuario',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
