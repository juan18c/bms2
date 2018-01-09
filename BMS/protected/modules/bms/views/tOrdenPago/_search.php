<?php
/* @var $this TOrdenPagoController */
/* @var $model TOrdenPago */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_orden_pago'); ?>
		<?php echo $form->textField($model,'id_orden_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_banco'); ?>
		<?php echo $form->textField($model,'nombre_banco',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_cuenta'); ?>
		<?php echo $form->textField($model,'numero_cuenta',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_ruta_bancaria'); ?>
		<?php echo $form->textField($model,'numero_ruta_bancaria',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_tarjeta'); ?>
		<?php echo $form->textField($model,'nombre_tarjeta',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_tarjeta'); ?>
		<?php echo $form->textField($model,'numero_tarjeta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_tarjeta'); ?>
		<?php echo $form->textField($model,'tipo_tarjeta',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comision'); ?>
		<?php echo $form->textField($model,'comision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_medio_pago'); ?>
		<?php echo $form->textField($model,'id_medio_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_pago'); ?>
		<?php echo $form->textField($model,'fecha_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comisionPorcentaje'); ?>
		<?php echo $form->textField($model,'comisionPorcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comisionValorFijo'); ?>
		<?php echo $form->textField($model,'comisionValorFijo'); ?>
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