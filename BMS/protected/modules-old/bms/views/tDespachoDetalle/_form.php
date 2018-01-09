<?php
/* @var $this TDespachoDetalleController */
/* @var $model TDespachoDetalle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdespacho-detalle-form',
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
		<?php echo $form->labelEx($model,'id_producto'); ?>
		<?php echo $form->textField($model,'id_producto'); ?>
		<?php echo $form->error($model,'id_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_solicitada'); ?>
		<?php echo $form->textField($model,'cantidad_solicitada'); ?>
		<?php echo $form->error($model,'cantidad_solicitada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio'); ?>
		<?php echo $form->textField($model,'precio'); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_despachada'); ?>
		<?php echo $form->textField($model,'cantidad_despachada'); ?>
		<?php echo $form->error($model,'cantidad_despachada'); ?>
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