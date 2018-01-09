<?php
/* @var $this TCarritoController */
/* @var $model TCarrito */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_carrito'); ?>
		<?php echo $form->textField($model,'id_carrito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_datos_basicos'); ?>
		<?php echo $form->textField($model,'id_datos_basicos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_accion'); ?>
		<?php echo $form->textField($model,'id_tipo_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->