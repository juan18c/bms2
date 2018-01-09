<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */
/* @var $form CActiveForm */
?>
<?php 

Yii::app()->clientScript->registerScript('selectDirecciones',"      

    $('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker({
      noneSelectedText: 'Añadir Dirección'  
    }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
      
      	$('#newDir').hide();
      	$('#divSolicitar').html('');
      	
  		//$('#TDatosBasicosDireccion_id_datos_basicos_direccion').val('');
		$('#TDatosBasicosDireccion_direccion1').val('');
		$('#TDatosBasicosDireccion_direccion2').val('');
		$('#TDatosBasicosDireccion_estado').val('');
		$('#TDatosBasicosDireccion_ciudad').val('');
		$('#TDatosBasicosDireccion_codigo_zip').val('');
		$('#TDatosBasicosDireccion_telefono_fijo').val('');
		//$('#TDatosBasicosDireccion_id_pais').val('');
  		//$('#newDir').show();

      	if ($(this).val() != '' ) {
	    	$.ajax({
	    		type : 'POST',
	        	url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createDireccion")."/idR/'+$('#idResponsable').val(),
	        	data : $('#tcarrito-direccion-form').serialize(),
	        	dataType: 'json',
	        	success : function (data) {	          		
	          		if (data.salida == 'IMCOMPLETO') {
	          			$('#TDatosBasicosDireccion_id_datos_basicos_direccion').val(data.id);
	          			$('#TDatosBasicosDireccion_direccion1').val(data.dir1);
	          			$('#TDatosBasicosDireccion_direccion2').val(data.dir2);
	          			$('#TDatosBasicosDireccion_estado').val(data.estado);
	          			$('#TDatosBasicosDireccion_ciudad').val(data.ciudad);
	          			$('#TDatosBasicosDireccion_codigo_zip').val(data.codzip);
	          			$('#TDatosBasicosDireccion_telefono_fijo').val(data.telefono);
	          			$('#TDatosBasicosDireccion_id_pais').val(data.pais);
	          			$('#newDir').show();
	          		}

	          		$('#direccionEnvio').html(data.mensaje).show();
	          		return false;
	        	}
	    	});      	
      	}else { $('#newDir').show(); $('#direccionEnvio').html(''); }

      	return false;
    }); "
,CClientScript::POS_READY);


Yii::app()->clientScript->registerScript('buttonCrearDireccion',"    



    jQuery('#TDatosBasicosDireccion_crear_direccion').click(function(){
      
    	$.ajax({
    		type : 'POST',
        	url : '".Yii::app()->createUrl("bms/TCarritoDetalle/modificarDireccion")."/idR/'+$('#idResponsable').val(),
        	data : $('#tcarrito-direccion-form').serialize(),
        	dataType: 'json',
        	success : function (data) {	          		
          		if (data.salida == 'COMPLETO') {
          			
          			$('#newDir').hide();
          			$('#direccionEnvio').html(data.mensaje).show();
          			if (data.scenario == 'insert' ) {          			
          				$('#TDatosBasicosDireccion_id_datos_basicos_direccion').append('<option value=\"' + data.id + '\">' + data.option + '</option>');           				
          			}

          			$('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker('refresh');
          			$('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker('val', data.id);

          		}
        	}
    	});   	
      	
    });


",CClientScript::POS_READY);



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
      <?php echo $form->dropDownList($modelDireccion,'id_datos_basicos_direccion',CHtml::listData($modelDireccion->getLista($model->id_responsable),'id_datos_basicos_direccion','nombre'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Dirección')); ?>      
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
			<input type="button" class="btn btn-primary" name="TDatosBasicosDireccion_crear_direccion" id="TDatosBasicosDireccion_crear_direccion" value="Crear">
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->