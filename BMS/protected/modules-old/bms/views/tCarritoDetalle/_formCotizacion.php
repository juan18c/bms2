<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->clientScript->registerScript('buttonCrearCotizacion',"    

	$('#TBeneficiario_indResponsable').change(function() {
      if($(this).prop('checked')){
      	$('#divBeneficiario').hide();
      	$('#newDivFamiliar').hide();
      	$('#divCotizacionMensaje').html('');
      }else{
      	$('#divBeneficiario').show();
      	if ($('#TBeneficiario_id_beneficiario').val() == '') {
		    $('#newDivFamiliar').show(); 
		    $('#divCotizacionMensaje').html('');       
		}
      }
      return false;
    });

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
          			$('#divCotizacionMensaje').html(data.mensaje).show();
          			
          			$('#TBeneficiario_id_beneficiario').append('<option value=\"' + data.id + '\">' + data.option + '</option>');           				
          			
          			$('#TBeneficiario_id_beneficiario').selectpicker('refresh');

          			valores = $('#TBeneficiario_id_beneficiario').selectpicker('val');

          			$('#TBeneficiario_id_beneficiario').selectpicker('val',[valores+','+data.id]);
          		}
        	}
    	});  

    	return false; 	
      	
    });
    
    $('#TBeneficiario_id_beneficiario').selectpicker({
      noneSelectedText: 'Añadir Beneficiario'  
    }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
      	var idB = $(this).val();

      	$('#newDivFamiliar').hide();
      	$('#divCotizacionMensaje').html('');      	
  		
		$('#TDatosBasicos_beneficiario_nombres').val('');
		$('#TDatosBasicos_beneficiario_apellidos').val('');
		$('#TDatosBasicos_beneficiario_sexo').val('');
		$('#TDatosBasicos_beneficiario_fecha_nacimiento').val('');		
		
      	if (idB == ''){
	    	$('#newDivFamiliar').show(); 
	    	$('#divCotizacionMensaje').html(''); 
	    }else{

	    	var idCot = ''; //$('#TCotizacion_id_cotizacion').val(); aqui no aplica
                    

            $.ajax({
                type : 'POST',
                url : '".Yii::app()->createUrl("bms/TCarritoDetalle/updateBeneficiario")."/idR/'+$('#idResponsable').val(),
                data : {idb:idB,idcot:idCot},
                dataType: 'json',
                success : function (data) {                            
                    //HISTORIA MEDICA POR BENEFICIARIO
                    $('#historia-div').html(data.historia).show();
                    //$('#newDivMedico').show(); 
                    $('#divCotizacionMensaje').html(''); 

                    if (data.documento != '') {
                        $('#historia-documentos-div').html(data.documento).show();
                    }                            
                    
                    var sizeIdHistoriaMedica = $('#THistoriaMedicaCaso_id_historia_medica_caso > option').length;

                    if (sizeIdHistoriaMedica == 1 ) {
                        $('#newDivHistoriaBene').show();
                    }

                    $('#idHistoriaMedica').val(data.idhistoria);

                    $('#TDatosBasicos_medico_sexo').bootstrapToggle({
                      on: 'Femenino',
                      off: 'Masculino',
                      onstyle:'custom',
                      width:150
                    });

                    $('#TMedico_indMedico').bootstrapToggle({
                      on: 'Si',
                      off: 'No',
                      onstyle:'custom',
                      width:150
                    });


                    $('#TMedico_indMedico').change(function() {
				      if($('#TMedico_indMedico').prop('checked')){
				      	$('#divMedicoCot').show();
				      	if ($('#THistoriaMedicaCasoMedico_id_medico').val() == '') {
				      		$('#newDivMedico').show(); 
					    	$('#divCotizacionMensaje').html(''); 
						}
				      }else{
				      	$('#divMedicoCot').hide();
				      	$('#newDivMedico').hide(); 
					    $('#divCotizacionMensaje').html(''); 
				      }
				      return false;
				    });



                    $('#buttonCrearMedico').click(function(){
              
                        $.ajax({
                            type : 'POST',
                            url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createMedico")."',
                            data : $('#tcarrito-beneficiario-historia-form').serialize(),
                            dataType: 'json',
                            success : function (data) {                 
                                if (data.salida == 'COMPLETO') {
                                    
                                    $('#newDivMedico').hide();
                                    $('#divCotizacionMensaje').html(data.mensaje).show();
                                    
                                    $('#THistoriaMedicaCasoMedico_id_medico').append('<option value=\"' + data.id + '\">' + data.option + '</option>');                   

                                    $('#THistoriaMedicaCasoMedico_id_medico').selectpicker('refresh');
                                    $('#THistoriaMedicaCasoMedico_id_medico').selectpicker('val', data.id);

                                }
                            }
                        });  

                        return false;
                                
                    });
                    
                    $('#TDatosBasicosDireccion_medico_id_pais').change(function(){

                        $.ajax({          
                            type: 'POST',
                            url: '".Yii::app()->createUrl('catalogo/TPais/updatePaisEstado')."',
                            data:{id_pais:$(this).val()},                                    
                            success:function(data){

                                $('#TDatosBasicosDireccion_medico_id_estado').html(data);

                                return false;          
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError);          
                            },                                
                        })
                    });

                    $('#THistoriaMedicaCasoMedico_id_medico').selectpicker({
                      noneSelectedText: 'Añadir Médico'  
                    }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
                        var idMedico=$(this).val();                                  
                        
                        $('#TDatosBasicos_medico_nombres').val('');
                        $('#TDatosBasicos_medico_apellidos').val('');
                        $('#TDatosBasicosDireccion_direccion').val('');
                        $('#TDatosBasicosDireccion_ciudad').val('');        
                        $('#TDatosBasicosDireccion_estado').val('');                                 
                        
                        if (idMedico == ''){
                            $('#newDivMedico').show(); 
                            $('#divCotizacionMensaje').html(''); 
                        }else{
                            $('#newDivMedico').hide();
                            $('#divCotizacionMensaje').html('');
                        }

                        $(this).selectpicker('refresh');

                        return false;
                    });

                    $('#TEspecialidad_id_especialidad').selectpicker({
                      noneSelectedText: 'Seleccionar...'
                    });

                    $('#tcarrito-beneficiario-historia-form').find('#fechaRealizacionHistoria').datepicker({language:'es'});

                    
                   

                    $('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker({
                      noneSelectedText: 'Añadir récipes, resultados...'  
                    }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
                        var idHMC = $(this).val();

                        $('#newDivHistoriaBene').hide();
                        $('#divHistoriaMedicaMensaje').html('');        

                        $('#tcarrito-beneficiario-historia-form').find('#THistoriaMedicaCaso_nombre').val('');
                        $('#tcarrito-beneficiario-historia-form').find('#THistoriaMedicaCaso_tipo_carga').val('');
                        $('#tcarrito-beneficiario-historia-form').find('#THistoriaMedicaCaso_fecha_realizacion').val('');
                        $('#tcarrito-beneficiario-historia-form').find('#THistoriaMedicaCasoMedico_id_medico').val('');

                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicos_medico_nombres').val('');  
                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicos_medico_apellidos').val(''); 
                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicos_medico_sexo').val('');  

                        $('#tcarrito-beneficiario-historia-form').find('#TEspecialidad_id_especialidad').val('');  
                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_ciudad').val(''); 
                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_estado').val('');  

                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_direccion1').val('');  

                        $('#tcarrito-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_telefono_fijo').val('');  

                        if ( idHMC == '' || (clickedIndex == 0 && newValue)){
                            $('#newDivHistoriaBene').show(); 
                            $('#divCotizacionMensaje').html('');
                            return false;                                
                        }                                
                        
                        idHMC=idHMC.replace(',', '');
                        if (clickedIndex != 0) {
                           
                            $.ajax({
                                type : 'POST',
                                url : '".Yii::app()->createUrl("bms/TCotizacion/buscarDocumentoHistoria")."/idR/'+$('#idResponsable').val()+'/idHM/'+$('#idHistoriaMedica').val()+'/idHMC/'+idHMC,
                                data : data,
                                dataType: 'json',                                               
                                success : function (data) {
                                    $('#historia-documentos-div').html(data.documento).show();
                                }
                            
                            });
                        }else{
                            $('#historia-documentos-div').html('').hide();
                        }
                        $(this).selectpicker('refresh');
                        //$(this).selectpicker('toggle');

                        return false;

                    });


                    $('#THistoriaMedica_crear_historia').on('click', function(e){
                        e.preventDefault();

                        fields = $('#tcarrito-cotizacion-form').serializeArray();

                        var data = new FormData();
                        
                        data.append('THistoriaMedicaDocumento[ruta]', $('#THistoriaMedicaDocumento_ruta')[0].files[0]);
                        data.append('idb',$('#TBeneficiario_id_beneficiario').selectpicker('val'));
                        data.append('idcot',$('#TCotizacion_id_cotizacion').val());
                        data.append('idcar',$('#TCotizacion_id_carrito').val());
                        data.append('iddocumento',$('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val'));
                        

                        $.each( fields, function( i, field ) {
						    data.append(field.name, field.value);
						});
                                                                                     
                        $.ajax({
                            type : 'POST',
                            url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createHistoriaMedica")."/idR/'+$('#idResponsable').val(),
                            data : data,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success : function (data) {                 
                                if (data.salida == 'COMPLETO') {
                                    
                                    $('#idHistoriaMedica').val(data.id);
                                    $('#divHistoriaMedicaMensaje').html(data.mensaje).show();

                                    $('#THistoriaMedicaCaso_id_historia_medica_caso').append('<option value=\"' + data.idhmc + '\">' + data.option + '</option>'); 

                                    var idDoc = data.idDocumento;
                                    idDocV = idDoc.split(',');

                                    if (idDocV[0] == '') {
                                        
                                        for (var i=1; i < idDocV.length; i++) { 
                                            idDoc += idDocV[i]+',';
                                        }
                                        idDoc = '['+idDoc.substring(0, idDoc.length - 1)+']';
                                        alert(idDoc);
                                    }


                                    $('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val', JSON.parse(idDoc));
                                    
                                    //$('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('toogle');
                                    $('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('refresh');
                                    
                                    if ($('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val') != '' && $('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val') != null) {
                                        
                                    
                                        $.ajax({
                                            type : 'POST',
                                            url : '".Yii::app()->createUrl("bms/TCotizacion/buscarDocumentoHistoria")."/idR/'+$('#idResponsable').val()+'/idHM/'+$('#idHistoriaMedica').val()+'/idHMC/'+$('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val'),
                                            data : data,
                                            dataType: 'json',                                               
                                            success : function (data) {
                                                $('#historia-documentos-div').html(data.documento).show();
                                            }
                                        
                                        });

                                    }
                                    // $('#thistoria-medica-grid').yiiGridView('update', {
                                    //     data: $(this).serialize()
                                    // });

                                }

                                return false;
                            }
                        });  

                        return false;  

                    });



                }
            });





	    }
    }); 

    $('#TEspecialidad_id_especialidad').selectpicker({
      noneSelectedText: 'Seleccionar'  
    });

    // $('#buttonCrearMedico').click(function(){
      
    // 	$.ajax({
    // 		type : 'POST',
    //     	url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createMedico")."',
    //     	data : $('#tcarrito-cotizacion-form').serialize(),
    //     	dataType: 'json',
    //     	success : function (data) {	          		
    //       		if (data.salida == 'COMPLETO') {
          			
    //       			$('#newDivMedico').hide();
    //       			$('#divCotizacionMensaje').html(data.mensaje).show();
          			
    //       			$('#TMedico_id_medico').append('<option value=\"' + data.id + '\">' + data.option + '</option>');         			

    //       			$('#TMedico_id_medico').selectpicker('refresh');
    //       			$('#TMedico_id_medico').selectpicker('val', data.id);

    //       		}
    //     	}
    // 	});  

    // 	return false; 	
      	
    // });


  //   $('#TMedico_id_medico').selectpicker({
  //     noneSelectedText: 'Añadir Medico'  
  //   }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
  //     	var idM = $(this).val();

  //     	$('#newDivMedico').hide();
  //     	$('#divCotizacionMensaje').html('');      	
  		
		// $('#TDatosBasicos_medico_nombres').val('');
		// $('#TDatosBasicos_medico_apellidos').val('');
		// $('#TDatosBasicosDireccion_direccion').val('');
		// $('#TDatosBasicosDireccion_ciudad').val('');		
		// $('#TDatosBasicosDireccion_id_pais').val('');		
		// $('#TDatosBasicosDireccion_id_estado').val('');	
		// $('#TDatosBasicosDireccion_telefono_fijo').val('');	

  //     	if (idM == ''){
	 //    	$('#newDivMedico').show(); 
	 //    	$('#divCotizacionMensaje').html(''); 
	 //    }
  //   }); 

    
  


    $('#buttonSolicitarCoti').click(function(){
      
    	$.ajax({
    		type : 'POST',
        	url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createCotizacion")."',
        	data : $('#tcarrito-cotizacion-form').serialize(),
        	dataType: 'json',
        	success : function (data) {	          		
          		if (data.salida == 'COMPLETO') {          			
          			$('#divCotizacionMensaje').html(data.mensaje);
          			//window.location = '".Yii::app()->createUrl("seguridad/")."';
          		}
        	}
    	});  

    	return false; 	
      	
    });



",CClientScript::POS_READY);
?>	    
<!-- Modal -->
<div class="modal fade  bs-example-modal-lg" id="modalCotizar" tabindex="-1" role="dialog" aria-labelledby="modalCotizarLabel">
	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="modalCotizarLabel">Completar Solicitud</h4>
      		</div>
      		<div class="modal-body">       

            <div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'tcarrito-cotizacion-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array("class"=>"form-horizontal",'enctype' => 'multipart/form-data')
			)); ?>
                
                    
                <div id="direccionEnvioModal"></div>
                <div id="divCotizacionMensaje"></div>
                <!-- <div class="alert alert-info" role="alert"><i class="glyphicon glyphicon-info-sign"></i>Campos con <b>*</b> son obligatorios</div> -->
                <div class="form-group">
                	<div class="col-xs-3">
                		<?php echo $form->labelEx($modelBeneficiario,'indResponsable',array('class'=>'control-label')); ?>
						<?php echo $form->checkBox($modelBeneficiario,'indResponsable',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Para Mi",'data-off'=>"Otros", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-height'=>"58",'data-size'=>"normal")); ?>
						
						<?php echo $form->error($modelBeneficiario,'indResponsable'); ?>
			        
			        </div>				    

			    	<div class="col-xs-9" id="divBeneficiario" style="display:none;"> 			      	
			      		<label class="control-label" for="TBeneficiario_id_beneficiario">Seleccione un beneficiario</label>
			      
			      		<?php 
			      			// echo $form->dropDownList($modelBeneficiario,'id_beneficiario',CHtml::listData($modelBeneficiario->getLista(Yii::app()->user->id_persona),'id_beneficiario','descripcionList'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Beneficiario','multiple'=>'multiple')); 

			      			echo $form->dropDownList($modelBeneficiario,'id_beneficiario',$modelBeneficiario->getLista(Yii::app()->user->id_persona),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Añadir Beneficiario'));

			      		?>
			      	</div>
			    </div>
			    
			    <div style="display:none" id="newDivFamiliar" class="well">
                   	<h4>Crear Beneficiario</h4>
                   	<div class="form-group">
						<div class="col-xs-6">
							<?php echo $form->labelEx($modelDB,'[beneficiario]id_tipo_identificacion',array('class'=>'control-label')); ?>
							<?php echo $form->dropDownList($modelDB,'[beneficiario]id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]id_tipo_identificacion'); ?>
						</div>

						<div class="col-xs-6">
							<?php echo $form->labelEx($modelDB,'[beneficiario]nro_identificacion',array('class'=>'control-label')); ?>
							<?php echo $form->textField($modelDB,'[beneficiario]nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]nro_identificacion'); ?>
							<div id="mensajeNroIdentificacionMenor" style="display: none; font-size: 10px;padding: 8px;" class="alert alert-warning alert-dismissible" role="alert"><i class="fa fa-exclamation-circle fa-lg"></i> Si es menor de edad y no posee número de identificación dejelo en blanco</div>
						</div>
					</div>
			    	<div class="form-group">
						<div class="col-xs-6">
							<?php echo $form->labelEx($modelDB,'[beneficiario]nombres',array('class'=>'control-label')); ?>
							<?php echo $form->textField($modelDB,'[beneficiario]nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]nombres'); ?>
						</div>

						<div class="col-xs-6">
							<?php echo $form->labelEx($modelDB,'[beneficiario]apellidos',array('class'=>'control-label')); ?>
							<?php echo $form->textField($modelDB,'[beneficiario]apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]apellidos'); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-3 col-md-3">
				        	<?php echo $form->labelEx($modelDB,'[beneficiario]sexo',array('class'=>'control-label')); ?>
							<?php 

								echo $form->checkBox($modelDB,'[beneficiario]sexo',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Femenino",'data-off'=>"Masculino", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-height'=>"58",'data-size'=>"normal"));
							?>							
							<?php echo $form->error($modelDB,'[beneficiario]sexo'); ?>
						</div>
					
						<div class="col-xs-3 col-md-3">
							<?php echo $form->labelEx($modelDB,'[beneficiario]fecha_nacimiento',array('class'=>'control-label')); ?>
							<div id="fechaNacBeneficiario" class="input-group date">    
							    <?php echo $form->textField($modelDB,'[beneficiario]fecha_nacimiento',array('class'=>'form-control','value'=>'','placeholder'=>date('d/m/Y'))); ?>
							    <div class="input-group-addon">
							        <span class="fa fa-calendar"></span>
							    </div>
							</div>	
							
							<?php echo $form->error($modelDB,'[beneficiario]fecha_nacimiento'); ?>
						</div>

						<div class="col-xs-6">
							<?php //echo $form->labelEx($modelParentesco,'id_parentesco',array('class'=>'control-label')); ?>
							<label class="control-label" for="TParentesco_id_parentesco">Parentesco</label>
							<?php echo $form->dropDownList($modelParentesco,'id_parentesco',CHtml::listData(TParentesco::model()->findAll(),'id_parentesco','descripcion'),array('class'=>'form-control','empty'=>'Seleccione')); ?>                        
                        </div>
                    </div>
                    <div class="form-group">										
						<div class="col-xs-offset-3 col-xs-9">
							  <button type="button" class="btn btn-default theme_button color1 pull-right" id="buttonCrearBeneficiario">Crear Beneficiario</button>
						</div>
					</div>
                </div>                    


                <div class="row" id="historia-div"></div>


                <!-- <div class="form-group">
                	<div class="col-xs-3">
                		<?php echo $form->labelEx($modelMedico,'indMedico',array('class'=>'control-label')); ?>
						<?php echo $form->checkBox($modelMedico,'indMedico',array('class'=>'form-control','data-toggle'=>"toggle",'data-on'=>"Si",'data-off'=>"No", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-height'=>"58",'data-size'=>"normal")); ?>
						
						<?php echo $form->error($modelMedico,'indMedico'); ?>
			        
			        </div>	

                	<div class="col-xs-9" id="divMedicoCot" style="display:none;">
                		<?php //echo $form->labelEx($modelMedico,'id_medico',array('class'=>'control-label')); ?>
						<label class="control-label" for="TMedico_id_medico">Seleccione un médico o cree uno nuevo</label>
						<?php echo $form->dropDownList($modelMedico,'id_medico',CHtml::listData($modelMedico->getLista(),'id_medico','descripcionList'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Medico')); ?>
						<?php echo $form->error($modelMedico,'id_medico'); ?>
			        
			        </div>                    
                </div> -->
                
                <!-- <div style="display:none" id="newDivMedico" class="well">
                   	<h4>Crear M&eacute;dico</h4>
			    	<div class="form-group">
						<div class="col-xs-4">
							<?php echo $form->labelEx($modelDBMedico,'[medico]nombres',array('class'=>'control-label')); ?>
							<?php echo $form->textField($modelDBMedico,'[medico]nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDBMedico,'[medico]nombres'); ?>
						</div>

						<div class="col-xs-4">
							<?php echo $form->labelEx($modelDBMedico,'[medico]apellidos',array('class'=>'control-label')); ?>
							<?php echo $form->textField($modelDBMedico,'[medico]apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDBMedico,'[medico]apellidos'); ?>
						</div>
						
						<div class="col-xs-4">
							<?php //echo $form->labelEx($modelEspecialidad,'id_especialidad',array('class'=>'control-label')); ?>
							<label class="control-label" for="TEspecialidad_id_especialidad">Especialidad</label>
							<?php echo $form->dropDownList($modelEspecialidad,'id_especialidad',CHtml::listData(TEspecialidad::model()->findAll(),'id_especialidad','descripcion'),array('class'=>'selectpicker form-control','data-noneSelectedText'=>'Seleccione','multiple'=>'multiple')); ?>    
							<?php echo $form->error($modelEspecialidad,'id_especialidad'); ?>                    
                        </div>

					</div>

					<div class="form-group">
						<div class="col-xs-4">
				        	<?php echo $form->labelEx($modelDBMedico,'[medico]sexo',array('class'=>'control-label')); ?><br>
							<?php echo $form->checkBox($modelDBMedico,'[medico]sexo',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Femenino",'data-off'=>"Masculino", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-size'=>"normal")); ?>							
							<?php echo $form->error($modelDBMedico,'[medico]sexo'); ?>
						</div>
						
						
						<div class="col-xs-4">
							<?php //echo $form->labelEx($modelEspecialidad,'id_especialidad',array('class'=>'control-label')); ?>
							<label class="control-label" for="TDatosBasicosDireccion_id_pais">Pais</label>
							<?php echo $form->dropDownList($modelDirMedico,'id_pais',CHtml::listData(TEnvioPais::model()->with('idPais')->findAll(),'id_pais','idPais.descripcion'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Seleccione...','data-live-search'=>true,'style'=>'margin-bottom:15px;','ajax'=>array(
			                      'type'=>'POST', 
			                      'url'=>Yii::app()->createUrl('catalogo/TPais/updatePaisEstado'),
			                      'update'=>'#TDatosBasicosDireccion_id_estado', 
			                      'data'=>array('id_pais'=>'js:this.value'),                       
			                    )
			                )); ?> 
							<?php echo $form->error($modelDirMedico,'id_pais'); ?>                    
                        </div>

						<div class="col-xs-4">
							<?php echo $form->labelEx($modelDirMedico,'id_estado',array('class'=>'control-label')); ?>
							<?php echo $form->dropDownList($modelDirMedico,'id_estado',array(),array('class'=>'form-control','style'=>'margin-bottom:15px;'));?>
							<?php echo $form->error($modelDirMedico,'id_estado'); ?>
						</div>
						
					</div>

					<div class="form-group">

						

						<div class="col-xs-4">
							<?php echo $form->labelEx($modelDirMedico,'ciudad',array('class'=>'control-label')); ?>
							<?php echo $form->textField($modelDirMedico,'ciudad',array('class'=>'form-control')); ?>
							<?php echo $form->error($modelDirMedico,'ciudad'); ?>
						</div>

						
						<div class="col-xs-4">
				        	<?php echo $form->labelEx($modelDirMedico,'direccion1',array('class'=>'control-label')); ?>
							<?php echo $form->textarea($modelDirMedico,'direccion1',array('class'=>'form-control','rows'=>'2')); ?>							
							<?php echo $form->error($modelDirMedico,'direccion1'); ?>
						</div>
                        

                        <div class="col-xs-4">
							<?php //echo $form->labelEx($modelDirMedico,'telefono_fijo',array('class'=>'control-label')); ?>
							<label class="control-label" for="TDatosBasicosDireccion_telefono_fijo">Tel&eacute;fono (opcional)</label>
							<?php echo $form->textField($modelDirMedico,'telefono_fijo',array('class'=>'form-control')); ?>
							<?php echo $form->error($modelDirMedico,'telefono_fijo'); ?>                    
                        </div>
                        
                    </div>
                    <div class="form-group">										
						<div class="col-xs-offset-3 col-xs-9">
							  <button type="button" class="btn btn-default theme_button color1 pull-right" id="buttonCrearMedico">Crear Medico</button>
						</div>
					</div>
                </div> -->

                <!-- <div class="form-group">		
                	<div class="col-xs-4">
							<?php //echo $form->labelEx($modelDirMedico,'telefono_fijo',array('class'=>'control-label')); ?>
							<label class="control-label" for="TCotizacion_duracion">Duración del Tratamiento</label>
							<?php //echo $form->textField($modelCot,'duracion',array('class'=>'form-control')); ?>
							<?php //echo $form->error($modelCot,'duracion'); ?>                    
                    </div>
                    <div class="col-xs-4">
					<?php //echo $form->labelEx($modelEspecialidad,'id_especialidad',array('class'=>'control-label')); ?>
							<label class="control-label" for="TCotizacion_frecuencia"></label>
							<?php //echo $form->dropDownList($modelCot,'frecuencia',array('dia'=>'dia(s)','mes'=>'mes(es)'),array('class'=>'form-control','empty'=>'Seleccione')); ?>    
							<?php //echo $form->error($modelCot,'frecuencia'); ?> 
					</div>
				</div>  -->    

                <!-- <div class="form-group">										
					<div class="col-xs-offset-3 col-xs-9">                    
                		<button type="button" class="btn btn-default theme_button color1 pull-right" id="buttonSolicitarCoti">Solicitar</button>     
                	</div>
				</div>           -->                    
                    

            <?php $this->endWidget(); ?>
            </div>

      		</div>
      		<div class="modal-footer">
      			<button type="button" class="btn btn-default theme_button color1 pull-right" id="buttonSolicitarCoti">Solicitar</button>  
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>        
      		</div>
    	</div>
	</div>
</div>