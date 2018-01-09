<?php
/* @var $this TDonacionAdjudicadoController */
/* @var $model TDonacionAdjudicado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_donacion_adjudicado'); ?>
		<?php echo $form->textField($model,'id_donacion_adjudicado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_donacion'); ?>
		<?php echo $form->textField($model,'id_donacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_donador'); ?>
		<?php echo $form->textField($model,'id_donador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publico'); ?>
		<?php echo $form->textField($model,'publico'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->