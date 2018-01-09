<?php
/* @var $this TDespachoEnvioController */
/* @var $model TDespachoEnvio */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_despacho_envio'); ?>
		<?php echo $form->textField($model,'id_despacho_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_despacho'); ?>
		<?php echo $form->textField($model,'id_despacho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_tracking'); ?>
		<?php echo $form->textField($model,'numero_tracking',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'courier'); ?>
		<?php echo $form->textField($model,'courier',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'items'); ?>
		<?php echo $form->textField($model,'items'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_total'); ?>
		<?php echo $form->textField($model,'monto_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_despacho'); ?>
		<?php echo $form->textField($model,'fecha_despacho'); ?>
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