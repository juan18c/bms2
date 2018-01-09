<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $model THistoriaMedicaCaso */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_historia_medica_caso'); ?>
		<?php echo $form->textField($model,'id_historia_medica_caso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_historia_medica'); ?>
		<?php echo $form->textField($model,'id_historia_medica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_carga'); ?>
		<?php echo $form->textField($model,'tipo_carga',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duracion'); ?>
		<?php echo $form->textField($model,'duracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frecuencia'); ?>
		<?php echo $form->textField($model,'frecuencia',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_realizacion'); ?>
		<?php echo $form->textField($model,'fecha_realizacion'); ?>
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