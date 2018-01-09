<?php
/* @var $this TImagenLoginController */
/* @var $model TImagenLogin */
/* @var $form CActiveForm */
?>

<div class="formSep">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'timagen-login-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
    /*'clientOptions'=> array('validateOnSubmit'=>true,
                            'afterValidate'=>'js:function() 
                            {     
                                return false
                            }'
    ),*/
)); ?>

	<div class="alert alert-error">Campos con <strong>*</strong> son obligatorios.</div>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<div class="control-group">
			<?php
				
				$this->widget('bootstrap.widgets.TbSelect2',array(
					'model'=>$model,
					'attribute'=>'nombre',													      	
			       	//'data' => ,			
			       	'asDropDownList' => false,	       	
			       	'htmlOptions'=>array(					       			
			       			//'multiple'=>true,
			       			'placeholder'=>'Escriba todas las imagenes a Agregar...',				       					                        	                        	
                        	),
                    'options'=>array(	
                    		'tags'=>array(),	                    		
                    		'width' => '100%',
                    		'tokenSeparators' => array(',', ' ')
                    	)			       	
			       )
				);

				
			?>		
			<?php //echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'nombre',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'grupo'); ?>
		<div class="control-group">
            <?php 
                $criteria= new CDbCriteria;
                $criteria->select = array('max(t.grupo) as grupo'); 

                $model->grupo = TImagenLogin::model()->find($criteria)->grupo;
                $model->grupo = $model->grupo == null ? 1 : $model->grupo;

            ?>
			<?php echo $form->textField($model,'grupo',array('readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'grupo',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'dias_vigentes'); ?>
		<div class="control-group">
            <?php echo $form->dropDownList($model,'dias_vigentes',
                    array('180'=>'180','90'=>'90','30'=>'30')
                );
            ?>   

			<?php //echo $form->textField($model,'dias_vigentes'); ?>
			<?php echo $form->error($model,'dias_vigentes',array('class'=>'help-block')); ?>
		</div>
	</div>


	<div class="form-actions buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-inverse')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->




