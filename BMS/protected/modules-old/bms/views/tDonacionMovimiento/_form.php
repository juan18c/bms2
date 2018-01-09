<?php
/* @var $this TDonacionMovimientoController */
/* @var $model TDonacionMovimiento */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdonacion-movimiento-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_donacion_adjudicado'); ?>
		<?php echo $form->textField($model,'id_donacion_adjudicado'); ?>
		<?php echo $form->error($model,'id_donacion_adjudicado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_credito_donacion'); ?>
		<?php echo $form->textField($model,'id_credito_donacion'); ?>
		<?php echo $form->error($model,'id_credito_donacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto_credito'); ?>
		<?php echo $form->textField($model,'monto_credito'); ?>
		<?php echo $form->error($model,'monto_credito'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto_debito'); ?>
		<?php echo $form->textField($model,'monto_debito'); ?>
		<?php echo $form->error($model,'monto_debito'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
		<?php echo $form->error($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_donacion'); ?>
		<?php echo $form->textField($model,'id_donacion'); ?>
		<?php echo $form->error($model,'id_donacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
		<?php echo $form->error($model,'id_orden'); ?>
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