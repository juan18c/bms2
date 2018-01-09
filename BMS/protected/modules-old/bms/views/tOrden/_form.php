<?php
/* @var $this TOrdenController */
/* @var $model TOrden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torden-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_orden'); ?>
		<?php echo $form->textField($model,'codigo_orden',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'codigo_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
		<?php echo $form->error($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_beneficiario'); ?>
		<?php echo $form->textField($model,'id_beneficiario'); ?>
		<?php echo $form->error($model,'id_beneficiario'); ?>
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
		<?php echo $form->labelEx($model,'saldo'); ?>
		<?php echo $form->textField($model,'saldo'); ?>
		<?php echo $form->error($model,'saldo'); ?>
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