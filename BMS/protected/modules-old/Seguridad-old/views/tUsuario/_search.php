<?php
/* @var $this TUsuarioController */
/* @var $model TUsuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_usuario'); ?>
		<?php echo $form->textField($model,'id_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'palabra_clave'); ?>
		<?php echo $form->textField($model,'palabra_clave',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nro_intentos'); ?>
		<?php echo $form->textField($model,'nro_intentos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_persona'); ?>
		<?php echo $form->textField($model,'id_persona'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_usuario'); ?>
		<?php echo $form->textField($model,'fecha_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->