<?php
/* @var $this TMedicoController */
/* @var $model TMedico */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_medico'); ?>
		<?php echo $form->textField($model,'id_medico'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_datos_basicos'); ?>
		<?php echo $form->textField($model,'id_datos_basicos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_matricula'); ?>
		<?php echo $form->textField($model,'cod_matricula',array('size'=>60,'maxlength'=>150)); ?>
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
		<?php echo $form->label($model,'rif'); ?>
		<?php echo $form->textField($model,'rif',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'logo_recipe'); ?>
		<?php echo $form->textField($model,'logo_recipe',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ind_modulo_cita'); ?>
		<?php echo $form->textField($model,'ind_modulo_cita'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dias_consulta'); ?>
		<?php echo $form->textField($model,'dias_consulta',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_atencion'); ?>
		<?php echo $form->textField($model,'tipo_atencion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datos_contacto'); ?>
		<?php echo $form->textField($model,'datos_contacto',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ind_aprobado'); ?>
		<?php echo $form->textField($model,'ind_aprobado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->