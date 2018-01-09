<?php
/* @var $this TUsuarioController */
/* @var $model TUsuario */
/* @var $form CActiveForm */
?>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.plugins.min.js"></script>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tusuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'enableClientValidation' => true,
	/*'clientOptions'=> array('validateOnSubmit'=>true,
                            'afterValidate'=>'js:function() 
                            {     
                               	return false
                            }'
    ),*/
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>


		
<div class="alert alert-error">Campos con <strong>*</strong> son obligatorios.</div>
	
	
	

<div class="form">
 		<?php 
 		
 		if (strtoupper($model->getScenario())=='INSERT'){ echo "<div id='buscar' style='display:block' class='row-fluid'>";} 
 	  			else   {echo "<div id='buscar' style='display:none' class='row-fluid'>";}  
 		?>
		<div class="span12">
			<?php $this->renderPartial('application.modules.Seguridad.views.tUsuario._buscarUsuario', array('model'=>$modelDB,'form'=>$form)); ?>	
			<br>
		</div>
	</div>

<div class="alert" id="existe" style="display:none">Existe un usuario asignado para esta persona.</div>

 <?php if (strtoupper($model->getScenario())=='INSERT'){ echo "<div id='mostrarDatos' style='display:none' >";} 
 	  else   {echo "<div id='mostrarDatos' style='display:block' >";}  
 ?>
	<div class="row-fluid" >	
	
		<div class="span12">
			<?php echo $form->labelEx($model,'usuario'); ?>
			<?php echo $form->textField($model,'usuario',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'usuario',array('class'=>'help-inline')); ?>	
		</div>
	</div>
	
	<div class="row-fluid" >	
	
		<div class="span12">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'email',array('class'=>'help-inline')); ?>	
		</div>
	</div>	
	
	<div class="row-fluid">
		<div class="span12">
			<?php echo $form->labelEx($model,'palabra_clave'); ?>
			
			<?php echo $form->textField($model,'palabra_clave',array('size'=>40,'maxlength'=>40));?>
			
			<?php echo $form->error($model,'palabra_clave',array('class'=>'help-inline'))?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<?php echo $form->labelEx($model,'confirmar_clave'); ?>
			<?php echo $form->textField($model,'confirmar_clave',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'confirmar_clave',array('class'=>'help-inline'))?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<?php echo $form->labelEx($modelRol,'name'); ?>
		    <?php
				$criteria= new CDbCriteria;
				$criteria->select = array('description','name');
                $criteria->condition = "t.type = 2";	
				
                if  (strtoupper($model->getScenario())=='UPDATE'){
                	$modelRoles = AuthAssignment::model()->findAll('userid='.$model->id_usuario);

                	$data1=array();
                	foreach ($modelRoles as $key => $value){
						$data=array();
						$valor = array('selected' => 'true');
						$data=array($value->itemname => $valor);
						$data1[$value->itemname]=$valor;
					}
			
             	}
             	
				$this->widget('bootstrap.widgets.TbSelect2',array(
					'model'=>$modelRol,					
					'attribute'=>'name',													      	
			       	'data' =>  CHtml::listData(AuthItem::model()->findAll($criteria),'name','description'),	
		
			       	//'asDropDownList' => false,	       	
			       	'htmlOptions'=>array(					       			
			       			'multiple'=>true,
			       			'placeholder'=>'Seleccione uno o varios Roles...',	
							'options' => (strtoupper($model->getScenario())=='UPDATE')? $data1 :array(''=>'')
  					                        	                        	
                        	),

                    'options'=>array(	
                    		//'tags'=>array('1','hola','2','no se'),	                    		
                    		'width' => '100%',
                    		'tokenSeparators' => array(',', ' '),
							
	
                    	)			       	
			       )
				);

				
			?>		

		</div>
	</div>	
	
	<div class="form-actions buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar',array('class'=>'btn btn-info')); ?>
	</div>


 </div>		


<?php $this->endWidget(); ?>

</div><!-- form -->

