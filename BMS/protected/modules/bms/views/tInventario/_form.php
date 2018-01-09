<?php
/* @var $this TInventarioController */
/* @var $model TInventario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tinventario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_producto'); ?>
		<?php echo $form->textField($model,'id_producto'); ?>
		<?php echo $form->error($model,'id_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stock_minimo'); ?>
		<?php echo $form->textField($model,'stock_minimo'); ?>
		<?php echo $form->error($model,'stock_minimo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stock_maximo'); ?>
		<?php echo $form->textField($model,'stock_maximo'); ?>
		<?php echo $form->error($model,'stock_maximo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_compra'); ?>
		<?php echo $form->textField($model,'fecha_compra'); ?>
		<?php echo $form->error($model,'fecha_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_vencimiento'); ?>
		<?php echo $form->textField($model,'fecha_vencimiento'); ?>
		<?php echo $form->error($model,'fecha_vencimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio'); ?>
		<?php echo $form->textField($model,'precio'); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_almacen'); ?>
		<?php echo $form->textField($model,'id_almacen'); ?>
		<?php echo $form->error($model,'id_almacen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_almacenamiento'); ?>
		<?php echo $form->textField($model,'tipo_almacenamiento',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tipo_almacenamiento'); ?>
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