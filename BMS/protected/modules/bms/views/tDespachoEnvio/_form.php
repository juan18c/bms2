<?php
/* @var $this TDespachoEnvioController */
/* @var $model TDespachoEnvio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdespacho-envio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_despacho'); ?>
		<?php echo $form->textField($model,'id_despacho'); ?>
		<?php echo $form->error($model,'id_despacho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
		<?php echo $form->error($model,'id_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_tracking'); ?>
		<?php echo $form->textField($model,'numero_tracking',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'numero_tracking'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'courier'); ?>
		<?php echo $form->textField($model,'courier',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'courier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'items'); ?>
		<?php echo $form->textField($model,'items'); ?>
		<?php echo $form->error($model,'items'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto_total'); ?>
		<?php echo $form->textField($model,'monto_total'); ?>
		<?php echo $form->error($model,'monto_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_despacho'); ?>
		<?php echo $form->textField($model,'fecha_despacho'); ?>
		<?php echo $form->error($model,'fecha_despacho'); ?>
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