<?php
/* @var $this TAlmacenController */
/* @var $model TAlmacen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'talmacen-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pais'); ?>
		<?php echo $form->textField($model,'id_pais'); ?>
		<?php echo $form->error($model,'id_pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_moneda_base'); ?>
		<?php echo $form->textField($model,'id_moneda_base'); ?>
		<?php echo $form->error($model,'id_moneda_base'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_moneda_venta'); ?>
		<?php echo $form->textField($model,'id_moneda_venta'); ?>
		<?php echo $form->error($model,'id_moneda_venta'); ?>
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