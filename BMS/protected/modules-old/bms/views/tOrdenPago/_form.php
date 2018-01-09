<?php
/* @var $this TOrdenPagoController */
/* @var $model TOrdenPago */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torden-pago-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
		<?php echo $form->error($model,'id_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_banco'); ?>
		<?php echo $form->textField($model,'nombre_banco',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'nombre_banco'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_cuenta'); ?>
		<?php echo $form->textField($model,'numero_cuenta',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'numero_cuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_ruta_bancaria'); ?>
		<?php echo $form->textField($model,'numero_ruta_bancaria',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'numero_ruta_bancaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_tarjeta'); ?>
		<?php echo $form->textField($model,'nombre_tarjeta',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'nombre_tarjeta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_tarjeta'); ?>
		<?php echo $form->textField($model,'numero_tarjeta'); ?>
		<?php echo $form->error($model,'numero_tarjeta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_tarjeta'); ?>
		<?php echo $form->textField($model,'tipo_tarjeta',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'tipo_tarjeta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comision'); ?>
		<?php echo $form->textField($model,'comision'); ?>
		<?php echo $form->error($model,'comision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_medio_pago'); ?>
		<?php echo $form->textField($model,'id_medio_pago'); ?>
		<?php echo $form->error($model,'id_medio_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_pago'); ?>
		<?php echo $form->textField($model,'fecha_pago'); ?>
		<?php echo $form->error($model,'fecha_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comisionPorcentaje'); ?>
		<?php echo $form->textField($model,'comisionPorcentaje'); ?>
		<?php echo $form->error($model,'comisionPorcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comisionValorFijo'); ?>
		<?php echo $form->textField($model,'comisionValorFijo'); ?>
		<?php echo $form->error($model,'comisionValorFijo'); ?>
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