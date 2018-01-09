<?php
/* @var $this TDespachoCabeceraController */
/* @var $model TDespachoCabecera */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_despacho'); ?>
		<?php echo $form->textField($model,'id_despacho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_despacho'); ?>
		<?php echo $form->textField($model,'codigo_despacho',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'items'); ?>
		<?php echo $form->textField($model,'items'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_total'); ?>
		<?php echo $form->textField($model,'monto_total'); ?>
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