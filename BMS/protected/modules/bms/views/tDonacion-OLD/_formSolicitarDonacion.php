<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->clientScript->registerScript('buttonCrearDonacion',"    
	//$('#TProducto_foto_detalle').fileinput();

    $('#TParentesco_id_parentesco').change(function() {
      if($(this).val() == 2 || $(this).val() == 8 ){
      	$('#TDatosBasicos_beneficiario_nro_identificacion').val('');
      	$('#mensajeNroIdentificacionMenor').show();      
      }else{
      	$('#mensajeNroIdentificacionMenor').hide();
      }
      return false;
    });


	$('#buttonCrearBeneficiario').click(function(){
      	var valores;
    	$.ajax({
    		type : 'POST',
        	url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createBeneficiario")."',
        	data : $('#tcarrito-cotizacion-form').serialize(),
        	dataType: 'json',
        	success : function (data) {	 
        		
          		if (data.salida == 'COMPLETO') {
          			
          			$('#newDivFamiliar').hide();
          			$('#divDonacionMensaje').html(data.mensaje).show();
          			
          			$('#TBeneficiario_donacion_id_beneficiario').append('<option value=\"' + data.id + '\">' + data.option + '</option>');           				
          			
          			$('#TBeneficiario_donacion_id_beneficiario').selectpicker('refresh');

          			valores = $('#TBeneficiario_donacion_id_beneficiario').selectpicker('val');

          			$('#TBeneficiario_donacion_id_beneficiario').selectpicker('val',[valores+','+data.id]);
          		}
        	}
    	});  

    	return false; 	
      	
    });
    
    $('#TBeneficiario_donacion_id_beneficiario').selectpicker({
      noneSelectedText: 'Añadir Beneficiario'  
    }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
      	var idB = $(this).val();

      	$('#newDivFamiliar').hide();
      	$('#divDonacionMensaje').html('');      	
  		
		$('#TDatosBasicos_beneficiario_nombres').val('');
		$('#TDatosBasicos_beneficiario_apellidos').val('');
		$('#TDatosBasicos_beneficiario_sexo').val('');
		$('#TDatosBasicos_beneficiario_fecha_nacimiento').val('');		
		
      	if (idB == ''){
	    	$('#newDivFamiliar').show(); 
	    	$('#divDonacionMensaje').html(''); 
	    }
    }); 




",CClientScript::POS_READY);
?>	    

<!-- Modal -->
     

 <div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'tdonacion-form',
				'enableAjaxValidation'=>false,
        'enableClientValidation' => true,
        'clientOptions'=> array('validateOnSubmit'=>true,
                            'afterValidate'=>'js:function() 
                            {
                                return false
                            }'
    ),
  //'htmlOptions'=>array('class'=>'form_validation_ttip'),

			//	'enableAjaxValidation'=>true,
				'htmlOptions' => array(
        'enctype' => 'multipart/form-data'),
			)); ?>
                  
                <div id="direccionEnvioModal"></div>
                <div id="divDonacionMensaje"></div>
                <!-- <div class="alert alert-info" role="alert"><i class="glyphicon glyphicon-info-sign"></i>Campos con <b>*</b> son obligatorios</div> -->
                <div class="form-group">
                				    
                    <div class="">                     
                      <div class="form-group">
                            <div class="">
                                <label class="control-label" for="TDonacion_foto">Foto</label>
                                

                                <input id="TDonacion_foto" type="file" class="file" name="TDonacion['foto']">

                                <?php 
                               // print_r($modelCot);
                                    $fotoDetalle= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";
                                    if((isset($modelDB->nro_identificacion))&&($modelDB->nro_identificacion!=""))
                                        $fotoDetalle=$modelDB->nro_identificacion;
                                ?>
                                <input type="hidden" id="fotoDetalle" name="fotoDetalle" value="<?php echo $fotoDetalle; ?>">

                                
                            </div> 
                      </div>
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TBeneficiario_donacion_id_beneficiario">Responsable</label>                     
                               <?php echo $form->textField($modelDB,'[donacion]nombres',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Nombre','value'=>$modelRes->nombres.' '.$modelRes->apellidos,'readOnly'=>true)); ?>

                                <?php echo $form->error($modelDB,'[donacion]nombres'); ?>
                            </div>
                      </div>
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TBeneficiario_donacion_id_beneficiario">Beneficiario</label>                          
                               <?php echo $form->textField($modelDB,'[donacion]nombres',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Nombre','value'=>$modelBene->nombres.' '.$modelBene->apellidos,'readOnly'=>true)); ?>

                                <?php echo $form->error($modelDB,'[donacion]nombres'); ?>
                            </div>
                      </div>
                      
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_monto_solicitado">Monto Solicitado</label>                          
                               <?php echo $form->textField($modelDonacion,'monto_solicitado',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'$0.00')); ?>

                                <?php echo $form->error($modelDonacion,'monto_solicitado'); ?>
                            </div>
                      </div>
                    </div>

			    	<div class="col-xs-9"> 

                        <div class="form-group">
                            <div class="col-xs-12">
                                 <?php echo $form->labelEx($modelDonacion,'nombre_caso'); ?>
                                
                  
                                <?php echo $form->textField($modelDonacion,'nombre_caso',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Ayudanos, mi hijo te necesita')); ?>

                                <?php echo $form->error($modelDonacion,'nombre_caso',array('class'=>'help-inline')); ?>
                            </div>                            
                        </div>                                             

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_resumen">Descripcion</label>                          
                               <?php echo $form->textField($modelDonacion,'diagnostico',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Diagnósticos','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->textField($modelDonacion,'sintomas',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Síntomas','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->textArea($modelDonacion,'resumen',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Resumen del Caso','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->textArea($modelDonacion,'objetivo',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Objetivo del Tratamiento','style'=>'margin-bottom:8px;')); ?>

                                <?php echo $form->error($modelDonacion,'diagnostico'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="">Cuentanos tu historia!!!</label>   

                                <ul>
                                    <li>Crea un vídeo desde de tu móvil ó cualquier dispositivo en un formato con resolución de no más de 2mb</li>
                                    <li>Súbelo a tu cuenta YouTube </li>
                                    <li>Copia el link de tu vídeo aquí <?php echo $form->textField($modelDonacion,'video',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Link del video','style'=>'margin-bottom:8px;')); ?></li>
                                    <!-- <li>Listo!!!</li> -->
                                </ul>             
                                

                                <?php echo $form->error($modelDonacion,'video'); ?>
                            </div>
                        </div>

                        
			      	</div>
			    </div>
			    
                   


  <?php $this->endWidget(); ?>
  </div>

