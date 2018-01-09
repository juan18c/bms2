<?php
/* @var $this TMedicoController */
/* @var $model TMedico */
/* @var $form CActiveForm */
?>

<div class="form">



	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_datos_basicos'); ?>
		<?php echo $form->textField($model,'id_datos_basicos'); ?>
		<?php echo $form->error($model,'id_datos_basicos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cod_matricula'); ?>
		<?php echo $form->textField($model,'cod_matricula',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'cod_matricula'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'rif'); ?>
		<?php echo $form->textField($model,'rif',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'rif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo_recipe'); ?>
		<?php echo $form->textField($model,'logo_recipe',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'logo_recipe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ind_modulo_cita'); ?>
		<?php echo $form->textField($model,'ind_modulo_cita'); ?>
		<?php echo $form->error($model,'ind_modulo_cita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dias_consulta'); ?>
		<?php echo $form->textField($model,'dias_consulta',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dias_consulta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_atencion'); ?>
		<?php echo $form->textField($model,'tipo_atencion'); ?>
		<?php echo $form->error($model,'tipo_atencion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datos_contacto'); ?>
		<?php echo $form->textField($model,'datos_contacto',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'datos_contacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ind_aprobado'); ?>
		<?php echo $form->textField($model,'ind_aprobado'); ?>
		<?php echo $form->error($model,'ind_aprobado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>



</div><!-- form -->