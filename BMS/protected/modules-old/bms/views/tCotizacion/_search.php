<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_carrito'); ?>
		<?php echo $form->textField($model,'id_carrito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_responsable'); ?>
		<?php echo $form->textField($model,'id_responsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_medico_responsable'); ?>
		<?php echo $form->textField($model,'id_medico_responsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duracion'); ?>
		<?php echo $form->textField($model,'duracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frecuencia'); ?>
		<?php echo $form->textField($model,'frecuencia',array('size'=>4,'maxlength'=>4)); ?>
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