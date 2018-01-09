<?php
/* @var $this TAlmacenController */
/* @var $model TAlmacen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_almacen'); ?>
		<?php echo $form->textField($model,'id_almacen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pais'); ?>
		<?php echo $form->textField($model,'id_pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_moneda_base'); ?>
		<?php echo $form->textField($model,'id_moneda_base'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_moneda_venta'); ?>
		<?php echo $form->textField($model,'id_moneda_venta'); ?>
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