<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('search', "
    abrir = function(){
        $('#myModal').modal('show');

       $('#myModal .modal-body').find('#TDonacion_foto').fileinput('destroy');
        var fotoDe=$('#myModal .modal-body').find('#foto').val();

        $('#TDonacion_foto').fileinput({
            initialPreview: [fotoDe],
            initialPreviewAsData: true,
            // initialPreviewConfig: [
            //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
            // ],
            overwriteInitial: true,
            language:'es',
            browseLabel:'Seleccionar',
            browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
            showUpload: false,
            showCaption: false,
            showClose:false,
            browseClass: 'btn btn-primary',
            fileType: 'any',
            previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
        });

        $('.file-preview ').attr('style','border:0px;');
    }

    $('#buttonSolicitarDonacionCot').click(function(e){
        e.preventDefault();

        form=$('#modalSolicitudDonacion').find('form');

        var formData = new FormData(document.getElementById('tdonacion-form'));

        $.ajax({
            type : 'POST',
            dataType: 'json',
            url : '".Yii::app()->createUrl("bms/TDonacion/create")."',
            data : formData,            
            cache: false,
            contentType: false,
            processData: false,
            success : function (data) {                 
                if (data.salida == 'COMPLETO') {                    
                    $('#divDonacionMensaje').html(data.mensaje);
                    $('#modalSolicitudDonacion').modal('hide');
                    $('#tcotizacion-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });

                    return false;
                }else{
                    $('#divDonacionMensaje').html(data.mensaje);

                }
            }
        });  

        return false;   
        
    });

        

$('#buttonCrearMedico').click(function(){
                      
                                $.ajax({
                                    type : 'POST',
                                    url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createMedico")."',
                                    data : $('#tcotizacion-beneficiario-historia-form').serialize(),
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


                            $('#THistoriaMedicaCasoMedico_id_medico').selectpicker({
                              noneSelectedText: 'Añadir Médico'  
                            }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
                                
                                $('#newDivMedico').hide();
                                $('#divCotizacionMensaje').html('');        
                                
                                $('#TDatosBasicos_medico_nombres').val('');
                                $('#TDatosBasicos_medico_apellidos').val('');
                                $('#TDatosBasicosDireccion_direccion').val('');
                                $('#TDatosBasicosDireccion_ciudad').val('');        
                                $('#TDatosBasicosDireccion_estado').val('');                                 
                                
                                if ($(this).val() == '' || $(this).val() == null ){
                                    $('#newDivMedico').show(); 
                                    $('#divCotizacionMensaje').html(''); 
                                }

                                $(this).selectpicker('refresh');

                                return false;
                            });

                            $('#TEspecialidad_id_especialidad').selectpicker({
                              noneSelectedText: 'Seleccionar...'
                            });

                            $('#tcotizacion-beneficiario-historia-form').find('#fechaRealizacionHistoria').datepicker({language:'es'});

                            $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicos_medico_sexo').bootstrapToggle({
                              on: 'Femenino',
                              off: 'Masculino',
                              onstyle:'custom',
                              width:150
                            });
                           

                            $('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker({
                              noneSelectedText: 'Añadir récipes, resultados...'  
                            }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
                                var idHMC = $(this).val();

                                $('#newDivHistoriaBene').hide();
                                $('#divHistoriaMedicaMensaje').html('');        

                                $('#tcotizacion-beneficiario-historia-form').find('#THistoriaMedicaCaso_nombre').val('');
                                $('#tcotizacion-beneficiario-historia-form').find('#THistoriaMedicaCaso_tipo_carga').val('');
                                $('#tcotizacion-beneficiario-historia-form').find('#THistoriaMedicaCaso_fecha_realizacion').val('');
                                $('#tcotizacion-beneficiario-historia-form').find('#THistoriaMedicaCasoMedico_id_medico').val('');

                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicos_medico_nombres').val('');  
                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicos_medico_apellidos').val(''); 
                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicos_medico_sexo').val('');  

                                $('#tcotizacion-beneficiario-historia-form').find('#TEspecialidad_id_especialidad').val('');  
                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_ciudad').val(''); 
                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_estado').val('');  

                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_direccion1').val('');  

                                $('#tcotizacion-beneficiario-historia-form').find('#TDatosBasicosDireccion_medico_telefono_fijo').val('');  

                                if ( idHMC == '' || (clickedIndex == 0 && newValue)){
                                    $('#newDivHistoriaBene').show(); 
                                    $('#divCotizacionMensaje').html('');     
                                    return false;                                
                                }

                              
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

                            $('#tcotizacion-beneficiario-historia-form').on('submit', function(e){
                                e.preventDefault();

                                var data = new FormData($('#tcotizacion-beneficiario-historia-form')[0]);
                                
                                data.append('THistoriaMedicaDocumento[ruta]', $('#THistoriaMedicaDocumento_ruta')[0].files[0]);
                                data.append('idb',$('#TBeneficiario_id_beneficiario').selectpicker('val'));
                                data.append('idcot',$('#TCotizacion_id_cotizacion').val());
                                data.append('idcar',$('#TCotizacion_id_carrito').val());
                                data.append('iddocumento',$('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val'));
                                                                                             
                                $.ajax({
                                    type : 'POST',
                                    url : '".Yii::app()->createUrl("bms/TCotizacion/createHistoriaMedica")."/idR/'+$('#idResponsable').val(),
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



recalcularCarrito = function(idCarritoDetalle,cant,sign,e){

    if (sign === '-') {
        if (cant > 1) {          
            $('#cantidadDet'+idCarritoDetalle).val(parseFloat(cant) - 1);
        }
    } else {
        $('#cantidadDet'+idCarritoDetalle).val(parseFloat(cant) + 1);
    }

    var cantidad = $('#cantidadDet'+idCarritoDetalle).val();

    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/updateItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val(),
        data : {c:cantidad}, 
        dataType:'json',            
        success : function (data,e) {              

            $('#shop-order-div').html(data.totalOrden);  		

  			$.fn.yiiGridView.update('tcarrito-cotizacion-grid',{data: {idcarr:$('#TCotizacion_id_carrito').val() }});
            
            return false;               
        }
    });

    return false;
}



borrarItem = function(idCarritoDetalle){
                
                $.ajax({
                    type : 'POST',
                    url : '".Yii::app()->createUrl("bms/TCotizacion/deleteItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val()+'/idCar/'+ $('#TCotizacion_id_carrito').val(),
                    //data : {}, 
                    dataType:'json',            
                    success : function (data) {
                                      
                        $('#shop-order-div').html(data.totalOrden);
                        $('#tcarrito-cotizacion-grid').yiiGridView('update',{data: {idcarr:$('#TCotizacion_id_carrito').val() }});

                        return false;               
                    }

                });

                return false;
            }        


$('#buttonPagarCotizacion').click(function(){      
                $.ajax({
                    type : 'POST',
                    url : '".Yii::app()->createUrl("Paypal/buy")."',
                    data : $('#tcarrito-direccion-form').serialize(),
                    dataType: 'json',
                    success : function (data) {                 
                        
                    	alert(data);
                    }
                });                     
            });


$('#TProducto_id_producto').selectpicker({
              noneSelectedText: 'Agregar Producto'  
            }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {      
                
                $.ajax({
                    type : 'POST',
                    url : '".Yii::app()->createUrl("bms/TCotizacion/createCart/idR")."/'+$('#idResponsable').val(),
                    data : {idP:$(this).val(),c:1}, 
                    dataType:'json',           
                    success : function (data) {
                        
                        $('#shop-order-div').html(data.totalOrden);
                        $.fn.yiiGridView.update('tcarrito-cotizacion-grid',{data: {idcarr:$('#TCotizacion_id_carrito').val() }});
                        return false;                        
                    }
                });
                return false;

            });

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
                        }
                    });         
                }else { $('#newDir').show(); $('#direccionEnvio').html(''); }
            }); 

            $('#TDatosBasicosDireccion_crear_direccion').click(function(){      
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

$('#tcotizacion-beneficiario-form').find('#fechaNacBeneficiario').datepicker({language:'es'});
$('#tcotizacion-beneficiario-form').find('#TDatosBasicos_sexo').bootstrapToggle({
  on: 'Femenino',
  off: 'Masculino',
  onstyle:'custom',
  offstyle:'custom1',
  width:150
});

",CClientScript::POS_READY);


?>

	
<div class="row">
	<div class="col-md-12">
    	<ul class="nav nav-tabs" role="tablist">                    
            <li class="active">
                <a href="#beneficiario" role="tab" data-toggle="tab">Beneficiario</a>
            </li>
            <li class="">
                <a href="#historia" role="tab" data-toggle="tab">Historia Médica</a>
            </li>
            <li class="">
                <a href="#carrito" role="tab" data-toggle="tab">Carrito</a>
            </li>                    
        </ul>
          
        <div class="tab-content top-color-border bottommargin_30">
        	
    		<div class="tab-pane fade in active" id="beneficiario">
                
            
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'tcotizacion-beneficiario-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>true,
					'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data')
				)); ?>  
                   

				<!-- <p class="note">Campos con <span class="required">*</span> con obligatorios.</p> -->

				<?php //echo $form->errorSummary($model); ?>
				<input type="hidden" name="TCotizacion[id_cotizacion]" id="TCotizacion_id_cotizacion" value="<?php echo $model->id_cotizacion; ?>">
				<input type="hidden" name="TCotizacion[id_carrito]" id="TCotizacion_id_carrito" value="<?php echo $model->id_carrito; ?>">
				<input type="hidden" name="idResponsable" id="idResponsable" value="<?php echo $model->id_responsable; ?>">

				<div class="row">
					<div class="col-md-8"  style="border-right: 1px solid #eff2f7;">
						

					    <div class="form-group">
							<div class="col-lg-4" style="padding-left: 0; margin-bottom:15px;">
								<?php echo $form->labelEx($modelDBBeneficiario,'id_tipo_identificacion'); ?>						
								<?php echo $form->dropDownList($modelDBBeneficiario,'id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
								<?php echo $form->error($modelDBBeneficiario,'id_tipo_identificacion'); ?>
							</div>

							<div class="col-lg-8" style="padding-right: 0; margin-bottom:15px;">
								<?php echo $form->labelEx($modelDBBeneficiario,'nro_identificacion'); ?>
								<?php echo $form->textField($modelDBBeneficiario,'nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
								<?php echo $form->error($modelDBBeneficiario,'nro_identificacion'); ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
								<?php echo $form->labelEx($modelDBBeneficiario,'nombres'); ?>
								<?php echo $form->textField($modelDBBeneficiario,'nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
								<?php echo $form->error($modelDBBeneficiario,'nombres'); ?>
							</div>
							<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
								<?php echo $form->labelEx($modelDBBeneficiario,'apellidos'); ?>
								<?php echo $form->textField($modelDBBeneficiario,'apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
								<?php echo $form->error($modelDBBeneficiario,'apellidos'); ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
								<?php echo $form->labelEx($modelDBBeneficiario,'sexo'); ?><br>
								<?php echo $form->checkBox($modelDBBeneficiario,'sexo',array('checked'=>'checked','class'=>'form-control' )); ?>				
								<!-- <input checked type="checkbox" id="TDatosBasicos_sexo" name="TDatosBasicos[sexo]" >	 -->
								<?php echo $form->error($modelDBBeneficiario,'sexo'); ?>
							</div>
							<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;" >
								<label class="control-label">Fecha de Nacimiento</label>	
								<!--  data-provide="datepicker" -->
								<div id="fechaNacBeneficiario" class="input-group date">    
								    <?php echo $form->textField($modelDBBeneficiario,'fecha_nacimiento',array('class'=>'form-control','value'=>'','placeholder'=>date('d/m/Y'))); ?>
								    <div class="input-group-addon">
								        <span class="fa fa-calendar"></span>
								    </div>
								</div>							
							</div>
						</div>


					    <div class="form-group" style="border-bottom: 1px solid #eff2f7;margin-bottom: 15px; padding-bottom: 15px;">
					    	<div class="col-lg-12" style="padding-left: 0; padding-right: 0; margin-bottom:15px;">
								<?php //echo $form->labelEx($modelParentesco,'id_parentesco',array('class'=>'control-label')); ?>
								<label for="TParentesco_id_parentesco" class="grey">Parentesco</label>			
								<?php echo $form->dropDownList($modelBeneficiario,'id_parentesco',CHtml::listData(TParentesco::model()->findAll(),'id_parentesco','descripcion'),array('class'=>'form-control ','empty'=>'Seleccione')); ?>
					        </div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">					
							<?php echo $form->labelEx($model,'duracion_tratamiento'); ?>						
							<?php echo $form->textArea($model,'duracion_tratamiento',array('class'=>'form-control','value'=>$model->duracion_tratamiento)); ?>
							<?php echo $form->error($model,'duracion_tratamiento'); ?>
						</div>

						<div class="form-group">					
							<?php echo $form->labelEx($model,'datos_envio'); ?>						
							<?php echo $form->textArea($model,'datos_envio',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'datos_envio'); ?>
						</div>

					</div>

				</div>


				<?php $this->endWidget(); ?>

                
            </div>

            <div class="tab-pane fade" id="historia">          

            <?php
            						
				$this->renderPartial('application.modules.bms.views.tHistoriaMedica.adminCot', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMM'=>$modelHMM,'modelHMD'=>$modelHMD,'model'=>$model,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'idCotizacion'=>$model->id_cotizacion,'idBeneficiario'=>$model->id_beneficiario));

			//BUSCAR LOS DOCUMENTOS ASOCIADOS A LA COTIZACION POR LA TABLA T_COTIZACION_HISTORIA_MEDICA_CASO
			//VERIFICAR SI TIENES HISTORIA SINO CREARSELA
			$historiaMedica = THistoriaMedica::model()->find('t.id_responsable = '.$model->id_beneficiario);
			if (count($historiaMedica)>0) {
				$idHM = $historiaMedica->id_historia_medica;
			}else{
				$modelHM_new = new THistoriaMedica;
				$modelHM_new->id_responsable = $model->id_beneficiario;
				if ($modelHM_new->save()) {
					$idHM = $modelHM_new->id_historia_medica;
				}
			}

			$idHMC = TCotizacionHistoriaMedicaCaso::model()->getDocumentos($model->id_cotizacion);
			$gridHistoria='';
			if (!empty($idHMC)) {
							
				$this->renderPartial('application.modules.bms.views.tHistoriaMedica.admin', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'idDocumento'=>$idHMC,'idR'=>$model->id_beneficiario,'idHM'=>$idHM));
			}


            ?>

            </div>

            <div class="tab-pane fade" id="carrito">
                
                <h3>Datos del Carrito #<?php echo $model->id_carrito; ?></h3>
                <?php
					$this->renderPartial('application.modules.bms.views.tCotizacion.resumenCarrito',array(
						'model'=>$model,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccionEnvio,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelProducto'=>$modelProducto,'modelCartDet'=>$modelCartDet
					));

            	?>
                
    
    		</div>

        </div>
           

    	<br>
		<hr>
		<button class="btn theme_button color2 pull-right" type="submit" id="TCotizacion_crear_cotizacion" name="TCotizacion_crear_cotizacion" ><i class="fa fa-trash"></i> Borrar</button>
		<button class="btn theme_button color1 pull-right" type="submit" id="TCotizacion_crear_cotizacion" name="TCotizacion_crear_cotizacion" style="background-color:#820906"><i class="fa fa-save"></i> Modificar Cotización</button>
		<a class="btn theme_button pull-right" href="<?php echo Yii::app()->createUrl('bms/TCarritoDetalle/checkoutCotizacion',array('id'=>$model->id_cotizacion)); ?>"><i class="fa fa-money"></i> Pagar Cotización</a>
        <a href="#" role="button" data-toggle="modal"  onclick ="abrir()" class="theme_button color2"><i class="fa fa-puzzle-piece"></i> Solicitar Donaci&oacute;n</a>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalSolicitudDonacionLabel" >
            <div class="modal-dialog modal-lg role='document'">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalSolicitudDonacionLabel">Arma tu caso!</h4>
                    </div>
                    <!-- Popup Content -->
                    <div class="modal-body">
                         <?php
                         //var_dump($modelRes);
                          $this->renderPartial('application.modules.bms.views.tCarritoDetalle._formSolicitarDonacion',array('modelCot'=>$modelCot,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelDonacion'=>$modelDonacion,'modelRes'=>$modelRes,'modelDBBeneficiario'=>$modelDBBeneficiario,'resumenCart'=>$resumenCart),false,false); ?>
                    </div>
                    <!-- Popup Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default theme_button color1 pull-right" id="buttonSolicitarDonacionCot">Postular</button> 
                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  

                    </div>
                </div>
            </div>
        </div>

      



        <div class="modal fade  bs-example-modal" id="modalPagoCot" tabindex="-1" role="dialog" aria-labelledby="modalPagoCotLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalPagoCotLabel">Formas de Pago</h4>
                    </div>
                    <div class="modal-body">
                    
                        <input type="hidden" id="idCotizacion" name="idCotizacion" value="">
                        <span> Monto Total a pagar: <?php echo $totalItems; ?></span>
                        <div class="form-group">

                            <label class="control-label">Tipo de Pago&nbsp;</label><br>
                            <div class="col-lg-8" style="padding-left: 0; margin-bottom:15px;text-align:right;">
                                
                                <div class="btn-group">                      
                                    <button type="button" class="btn theme_button" onclick="js: $('#div-monto-parcial').hide(); ">Completo</button>    
                                    <button type="button" class="btn theme_button" onclick="js: $('#div-monto-parcial').show(); ">Parcial</button>                                     
                                </div>
                                                
                            </div>

                            <div class="col-lg-4">
                                <span id="div-monto-parcial" style="display: none;">
                                    <input id="montoParcial" class="form-control" type="text" name="montoParcial" placeholder="0.00" />
                                </span>
                            </div>

                        </div>

                        <div class="form-group">
                            
                            <label class="control-label">Formas de Pago:&nbsp; </label><br>
                            <div class="col-lg-12" style="padding-right: 0; margin-bottom:15px;text-align:right;">
                                <input id="ind_cuenta" class="form-control" type="checkbox" value="1" name="ind_cuenta" checked="checked"> 
                            </div>

                        </div>

                    

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-default" id="buttonPagarCotizacion" onclick="js: imprimir();"><i class="fa fa-file"></i>&nbsp;Procesar Pago</button>
                    </div>
                </div>
            </div>
        </div>



	</div>
</div>

