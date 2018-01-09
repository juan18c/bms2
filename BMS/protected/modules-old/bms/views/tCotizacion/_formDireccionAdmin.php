<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tcarrito-direccion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($modelDireccion); ?>
	<div class="form-group"> 
      <?php //echo $form->labelEx($modelDireccion,'id_datos_basicos_direccion',array('class'=>'control-label')) ?>
      <label class="control-label" for="TDatosBasicosDireccion_id_datos_basicos_direccion">Seleccione una direcci&oacute;n</label>
      <div class="">
      <?php echo $form->dropDownList($modelDireccion,'id_datos_basicos_direccion',CHtml::listData($modelDireccion->getLista(Yii::app()->user->id_persona),'id_datos_basicos_direccion','descripcionList'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Dirección')); ?>      
      </div>
    </div>
    <div id="direccionEnvio">
    	<?php echo $direccionEnvio; ?>
    </div>
	<div id="newDir" style="display:none;">
	    <p class="note">Campos con <span class="required">*</span> son requeridos.</p>
	    
	    <div  class="form-group" >
	        <?php echo $form->labelEx($modelDireccion,'direccion1',array('class'=>'control-label')); ?>
	        <div class="">
	        <?php echo $form->textField($modelDireccion,'direccion1',array('class'=>'form-control')); ?>
	        </div>  
	    </div>
	    <div  class="form-group" >
	        <?php echo $form->labelEx($modelDireccion,'direccion2',array('class'=>'control-label')); ?>
	        <div class="">
	        <?php echo $form->textField($modelDireccion,'direccion2',array('class'=>'form-control')); ?>
	        </div>  
	    </div>

	    <div class="form-group"> 
	      <?php echo $form->labelEx($modelDireccion,'ciudad',array('class'=>'control-label')) ?>
	      <div class="">
	      <?php echo $form->textField($modelDireccion,'ciudad',array('class'=>'form-control','value'=>$modelDireccion->ciudad)); ?>   
	      </div>
	    </div> 
	    <div class="form-group"> 
	      <?php echo $form->labelEx($modelDireccion,'estado',array('class'=>'control-label')) ?>
	      <div class="">
	      <?php echo $form->textField($modelDireccion,'estado',array('class'=>'form-control','value'=>$modelDireccion->estado)); ?>   
	      </div>
	    </div> 
	    <div class="form-group"> 
	      <?php echo $form->labelEx($modelDireccion,'id_pais',array('class'=>'control-label')) ?>
	      <div class="">
	      <?php echo $form->dropDownList($modelDireccion,'id_pais',CHtml::listData(TPais::model()->findAll(),'id_pais','descripcion'),array('class'=>'form-control')); ?>    
	      </div>
	    </div>
	    
	    <div  class="form-group" >
	        <?php echo $form->labelEx($modelDireccion,'codigo_zip',array('class'=>'control-label')); ?>
	        <div class="">
	        <?php echo $form->textField($modelDireccion,'codigo_zip',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20)); ?>
	        </div>  
	    </div>
	    <div  class="form-group" >
	        <?php echo $form->labelEx($modelDireccion,'telefono_fijo',array('class'=>'control-label')); ?>
	        <div class="">
	        <?php echo $form->textField($modelDireccion,'telefono_fijo',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20)); ?>
	        </div>  
	    </div>
	    <!-- <div class="form-group">    	
	    	<label class="control-label" for="TDatosBasicosDireccion_indicador_factura">Usar para Facturación? </label>
	        <div class="">                                
	        <?php echo $form->checkBox($modelDireccion,'indicador_factura',array('class'=>'form-control',"checked"=>"checked","data-toggle"=>"toggle","data-on"=>"Si","data-off"=>"No","data-onstyle"=>"custom",'type'=>'checkbox')); ?>
	        </div>
	    </div> -->

	    <div class="crear-direccion">
			<input type="button" class="theme_button color1" name="TDatosBasicosDireccion_crear_direccion" id="TDatosBasicosDireccion_crear_direccion" value="Crear">
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->