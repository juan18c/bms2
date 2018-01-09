<?php
/* @var $this TDonacionMovimientoController */
/* @var $model TDonacionMovimiento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_donacion_movimiento'); ?>
		<?php echo $form->textField($model,'id_donacion_movimiento',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_donacion_adjudicado'); ?>
		<?php echo $form->textField($model,'id_donacion_adjudicado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_credito_donacion'); ?>
		<?php echo $form->textField($model,'id_credito_donacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_credito'); ?>
		<?php echo $form->textField($model,'monto_credito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_debito'); ?>
		<?php echo $form->textField($model,'monto_debito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_donacion'); ?>
		<?php echo $form->textField($model,'id_donacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
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