<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $model THistoriaMedicaCaso */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'thistoria-medica-caso-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_historia_medica'); ?>
		<?php echo $form->textField($model,'id_historia_medica'); ?>
		<?php echo $form->error($model,'id_historia_medica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_carga'); ?>
		<?php echo $form->textField($model,'tipo_carga',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tipo_carga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duracion'); ?>
		<?php echo $form->textField($model,'duracion'); ?>
		<?php echo $form->error($model,'duracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'frecuencia'); ?>
		<?php echo $form->textField($model,'frecuencia',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'frecuencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
		<?php echo $form->error($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_realizacion'); ?>
		<?php echo $form->textField($model,'fecha_realizacion'); ?>
		<?php echo $form->error($model,'fecha_realizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
		<?php echo $form->error($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->