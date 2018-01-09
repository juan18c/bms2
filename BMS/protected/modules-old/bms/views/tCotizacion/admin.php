<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */

Yii::app()->clientScript->registerScript('search', "

getCotizacionResponsable = function(parametros){
   
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/cargar")."'+parametros,            
        dataType:'json',           
        success : function (data) {   

            $('#idResponsable').val(data.idP);
            $('#TCotizacion_id_carrito').val(data.idCar);
            $('#TCotizacion_id_cotizacion').val(data.idCot);            
            
            $('#TDatosBasicos_nombres').val(data.nombres);
            $('#TDatosBasicos_apellidos').val(data.apellidos);
            $('#TDatosBasicos_id_tipo_identificacion').val(data.idtipoiden);
            $('#TDatosBasicos_nro_identificacion').val(data.nroiden);
            $('#TDatosBasicos_fecha_nacimiento').val(data.fechanac);
            $('#TDatosBasicos_estado_civil').val(data.edocivil);
            $('#TDatosBasicos_telefono_cel').val(data.telefonocel);
            $('#TDatosBasicos_email').val(data.email);


            $('#TDatosBasicos_empresa_nombres').val(data.nombresE);
            $('#TDatosBasicos_empresa_apellidos').val(data.apellidosE);
            $('#TDatosBasicos_empresa_id_tipo_identificacion').val(data.idtipoidenE);
            $('#TDatosBasicos_empresa_nro_identificacion').val(data.nroidenE);            
            $('#TDatosBasicos_empresa_telefono_cel').val(data.telefonocelE);
            $('#TDatosBasicos_empresa_email').val(data.emailE);
            
            if (data.indempresa == 1)
                $('#TDatosBasicos_ind_empresa').prop('checked',true).change();
            else $('#TDatosBasicos_ind_empresa').prop('checked',false).change();


            if (data.sexo == 'F')
                $('#TDatosBasicos_sexo').prop('checked',true).change();
            else $('#TDatosBasicos_sexo').prop('checked',false).change();

            $('#TCotizacion_datos_envio').val(data.datosenvio);
            $('#TCotizacion_duracion_tratamiento').val(data.duraciontratamiento);

            $('#create-cotizacion-div').show();            

            $('#resumen-carrito-div').html(data.carrito).show();

            $('#beneficiario-div').html(data.bene).show();

            if ($('#TBeneficiario_id_beneficiario').val() == '') {
                $('#newDivFamiliar').show(); 
                $('#divCotizacionMensaje').html('');       
            }

            if ($('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker('val') == ''){
                $('#newDir').show(); 
                $('#direccionEnvio').html('');
            }

            $('#TCotizacion_id_responsable').selectpicker('val',data.idP); 
            $('#TCotizacion_id_responsable').selectpicker('refresh'); 

            borrarItem = function(idCarritoDetalle){
                alert('usando este');
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
            $('#tcotizacion-beneficiario-form').find('#TDatosBasicos_beneficiario_sexo').bootstrapToggle({
              on: 'Femenino',
              off: 'Masculino',
              onstyle:'custom',
              width:150
            });


            var previousValue;
            $('#TBeneficiario_id_beneficiario').selectpicker({
              noneSelectedText: 'Añadir Beneficiario'  
            }).on('shown.bs.select', function(e) {
              previousValue = $(this).val();
            }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
                var idB = $(this).val();
                var action;

                $('#newDivFamiliar').hide();
                $('#divCotizacionMensaje').html('');

                $('#tcotizacion-beneficiario-form').find('#TDatosBasicos_nro_identificacion').val('');
                $('#tcotizacion-beneficiario-form').find('#TDatosBasicos_nombres').val('');
                $('#tcotizacion-beneficiario-form').find('#TDatosBasicos_apellidos').val('');
                $('#tcotizacion-beneficiario-form').find('#TDatosBasicos_sexo').val('');
                $('#tcotizacion-beneficiario-form').find('#TDatosBasicos_fecha_nacimiento').val('');  

                if (idB == ''){
                    $('#newDivFamiliar').show(); 
                    $('#divCotizacionMensaje').html(''); 

                }else{
                    
                    var idCot = $('#TCotizacion_id_cotizacion').val();
                    

                    $.ajax({
                        type : 'POST',
                        url : '".Yii::app()->createUrl("bms/TCotizacion/updateBeneficiario")."/idR/'+$('#idResponsable').val(),
                        data : {a:action,idb:idB,idcot:idCot},
                        dataType: 'json',
                        success : function (data) {                            
                            //HISTORIA MEDICA POR BENEFICIARIO
                            $('#historia-div').html(data.historia).show();
                            $('#newDivMedico').show(); 
                            $('#divCotizacionMensaje').html(''); 

                            if (data.documento != '') {
                                $('#historia-documentos-div').html(data.documento).show();
                            }                            
                            
                            var sizeIdHistoriaMedica = $('#THistoriaMedicaCaso_id_historia_medica_caso > option').length;

                            if (sizeIdHistoriaMedica == 1 ) {
                                $('#newDivHistoriaBene').show();
                            }

                            $('#idHistoriaMedica').val(data.idhistoria);

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



                        }
                    });
                
               
              }

                $(this).selectpicker('refresh');
                //$(this).selectpicker('toggle');

                return false;

            });

            
            jQuery('#buttonCrearBeneficiario').click(function(){
                var valores;
                $.ajax({
                    type : 'POST',
                    url : '".Yii::app()->createUrl("bms/TCotizacion/createBeneficiario")."/idR/'+$('#idResponsable').val(),
                    data : $('#tcotizacion-beneficiario-form').serialize(),
                    dataType: 'json',
                    success : function (data) {  
                        
                        if (data.salida == 'COMPLETO') {
                            
                            $('#newDivFamiliar').hide();
                            $('#divCotizacionMensaje').html(data.mensaje).show();

                            if (data.option != '') {
                                $('#TBeneficiario_id_beneficiario').append('<option value=\"' + data.id + '\">' + data.option + '</option>');                           
                            
                                $('#TBeneficiario_id_beneficiario').selectpicker('refresh');
                            }
                            

                            //valores = $('#TBeneficiario_id_beneficiario').selectpicker('val');

                            //$('#TBeneficiario_id_beneficiario').selectpicker('val',[valores+','+data.id]);
                        }

                        //$.fn.yiiGridView.update('tcarrito-cotizacion-grid');
                    }
                });  

                return false;   
                
            });                 
        
            
            
            

        }
    });
}

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



$('#TCotizacion_id_responsable').selectpicker({
      noneSelectedText: 'Seleccione...'  
}).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {

    var idResponsable = $(this).val();
    var idCot = '';
    var idCar= '';
    var url = '/idP/'+idResponsable+'/idCot/'+idCot+'/idCar/'+idCar;
    getCotizacionResponsable(url);

    return false;
});

$('#fechaNacResponsable').datepicker({language:'es'});
$('#tcotizacion-form').find('#TDatosBasicos_sexo').bootstrapToggle({
  on: 'Femenino',
  off: 'Masculino',
  onstyle:'custom',
  width:150
});

$('#tcotizacion-form').find('#TDatosBasicos_ind_empresa').bootstrapToggle({
  on: 'Si',
  off: 'No',
  onstyle:'custom'
});

$('#tcotizacion-form').find('#TDatosBasicos_ind_empresa').change(function() {
      
    if($(this).prop('checked')){
        $('#tcotizacion-form').find('#divEncargadoEmpresaCotizacion').show();
        $('#tcotizacion-form').find('#divEncargadoEmpresaCotizacion #TDatosBasicos_sexo').bootstrapToggle({
          on: 'Femenino',
          off: 'Masculino',
          onstyle:'custom',
          width:150
        });
        $('#tcotizacion-form').find('#divEncargadoEmpresaCotizacion #fechaNacResponsable').datepicker({language:'es'});
    }else 
        $('#tcotizacion-form').find('#divEncargadoEmpresaCotizacion').hide();
});


$('#TCotizacion_crear_cotizacion').click(function(){
    var idResp = $('#idResponsable').val();
    var idCot = $('#TCotizacion_id_cotizacion').val();
    var idCar = $('#TCotizacion_id_carrito').val();
    var info = '&idbene='+$('#TBeneficiario_id_beneficiario').selectpicker('val')+'&idhistoria='+$('#THistoriaMedicaCaso_id_historia_medica_caso').selectpicker('val');

    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/createCotizacion/idR")."/'+idResp+'/idCot/'+idCot+'/idCar/'+idCar,            
        dataType:'json',      
        data: $('#tcotizacion-form').serialize()+info,
        success : function (data) {         
            alert(data);            

            $('#tcotizacion-grid').yiiGridView('update', {
                data: $(this).serialize()
            });
        }
    })
});

borrarItem = function(idCarritoDetalle){
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/deleteItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val(),
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



imprimir = function(e){

    var ind_membrete = $('#ind_membrete').prop('checked');
    var ind_cuenta = $('#ind_cuenta').prop('checked');
    var ind_laboratorio = $('#ind_laboratorio').prop('checked');

    var url = $('#urlImpresion').val()+'/indM/'+ind_membrete+'/indC/'+ind_cuenta+'/indL/'+ind_laboratorio;

    window.open(url,'_blank'); 
}


$('#modalImpresionCot').find('#ind_laboratorio').change(function() {
      
    if($(this).prop('checked')){
        $('#modalImpresionCot').find('#div-laboratorio').show();
    }else 
        $('#modalImpresionCot').find('#div-laboratorio').hide();
});


",CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('searchCartDet',"
        var ajaxUpdateTimeout;
        var ajaxRequest;
        $('input#searchCart').keyup(function(){
            ajaxRequest = $(this).serialize();
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
    // this is the id of the CListView
                    'carrito-compra-list',
                    {data: ajaxRequest}
                )
            },
    // this is the delay
            300);
        });  "
    );
?>


<!-- page heading start-->
<div class="page-heading">
    <h3>
        Administrar Cotizaciones
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>        
        <li class="active"> Cotizaciones </li>
    </ul>
</div>
<!-- page heading end-->


<div class="wrapper">
	<div class="row">
        <div class="col-sm-12">
	        <section class="panel">
		        <header class="panel-heading">
		            Crear Cotizaci&oacute;n
		        </header>
		        <div class="panel-body">

		        	<div class="form-group">					

						<div class="col-lg-12" style="padding-left: 0; margin-bottom:15px;">
							<label class="control-label" for="TCotizacion_id_responsable">Seleccione un Cliente</label>
		      
			            	<select class="selectpicker form-control" data-live-search="true" id="TCotizacion_id_responsable" name="TCotizacion[id_responsable]" data-style="btn-custom">
                                <option value="">Buscar...</option>
			            		<?php echo $model->getListaClientes(); ?>
		            		</select>
						</div>						

					</div>			
		        </div>
	        </section>
    	</div>
	</div>


    <div id="create-cotizacion-div" style="display:none;">
    	<?php $this->renderPartial('application.modules.bms.views.tCotizacion._form', array('model'=>$model)); ?>
    </div>

</div>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
        <div class="col-sm-12">
	        <section class="panel">
		        <header class="panel-heading">
		            Cotizaciones
		            <span class="tools pull-right">
		                <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		             </span>
		        </header>
		        <div class="panel-body">		        	
					

			        <div class="adv-table">
			        <?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'tcotizacion-grid',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'itemsCssClass'=>'table table-bordered table-striped table-condensed',
						'columns'=>array(
							array(
								'name'=>'codigo_cotizacion',
								'header' =>'Código'
							),
							// array(
							// 	'name'=>'id_carrito',
							// 	'header' =>'Cód. Carrito'
							// ),
							array(	'name'=>'nombreResponsable',
									'header' =>'Responsable', 								
									'value'=>'$data->idResponsable->nombres'
							),							
							
							array(	'name'=>'id_estatus',
									'header' =>'Estatus',
									'value'=>'TEstatus::model()->findByPk($data->id_estatus)->descripcion',
									'filter'=> CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion')
							),
							array(	'name'=>'fecha_creacion',
									'header' =>'Fecha Creación',								
									'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
									'filter'=> true						
							),
                            array(  'name'=>'fecha_envio',
                                    'header' =>'Envío',                                
                                    'value'=>'TCotizacion::model()->getDatosEnvio($data->fecha_envio,$data->datos_envio)',
                                    'filter'=> false,
                                    'htmlOptions'=>array('style' => 'text-align:center; ', ),
                                    'type'=>'raw'
                            ),							
							array(
								'class'=>'CButtonColumn',								
								'template'=>'{edit}&nbsp;{reporte}',
                                'htmlOptions' => array('style'=>'white-space: nowrap'),
								'buttons'=>array(
								    'edit' => array(
								        'label'=>'', 
								        'url'=>'"/idP/".$data->id_responsable."/idCot/".$data->id_cotizacion."/idCar/".$data->id_carrito',		
								        'options'=>array('class'=>'fa fa-pencil fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Editar Cotización'),
								        'click'=>'function(){ getCotizacionResponsable($(this).attr("href")); return false; }',
								    	'live'=>false,				          
								    ),
								    'reporte' => array(
								        	'label'=>'',
								            'url'=>'Yii::app()->createUrl("bms/TCotizacion/cotizacion", array("idCotizacion"=>$data["id_cotizacion"]))',
											'options'=>array(
								            	'class'=>'fa fa-file-pdf-o fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Cotización',
												//'id'=>'$data["id_cotizacion"]',
												'target'=>'_blank'          						
													
								            ),
								            'click'=>'js: function(e){                                                
                                               
                                                e.preventDefault();
                                                $("#modalImpresionCot").modal("show");
                                                $("#modalImpresionCot").find("#urlImpresion").val($(this).attr("href"));

                                                $("#modalImpresionCot").find("#ind_membrete").bootstrapToggle({
                                                  on: "Si",
                                                  off: "No",
                                                  onstyle:"custom"
                                                });

                                                $("#modalImpresionCot").find("#ind_cuenta").bootstrapToggle({
                                                  on: "Si",
                                                  off: "No",
                                                  onstyle:"custom"
                                                });

                                                $("#modalImpresionCot").find("#ind_laboratorio").bootstrapToggle({
                                                  on: "Si",
                                                  off: "No",
                                                  onstyle:"custom"
                                                }); 



                                                return false;

                                            }',
								        	'live'=>false
								        	
								        ),		        

								),	
							),
						),
					)); ?>
			        </div>
		        </div>
	        </section>
    	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade  bs-example-modal" id="modalImpresionCot" tabindex="-1" role="dialog" aria-labelledby="modalImpresionCotLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalImpresionCotLabel">Impresión</h4>
      </div>
      <div class="modal-body">

        <div class="panel-body">
            <input type="hidden" id="urlImpresion" name="urlImpresion" value="">
            
            <div class="form-group">                    

                <div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;text-align:right;">
                    Membrete:&nbsp;
                    <input id="ind_membrete" class="form-control" type="checkbox" value="1" name="ind_membrete"  checked="checked">                   
                </div>

                <div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;text-align:right;">
                    Cuentas Bancarias:&nbsp; 
                    <input id="ind_cuenta" class="form-control" type="checkbox" value="1" name="ind_cuenta" checked="checked"> 
                </div>

            </div>

            <div class="form-group"> 
                <div class="col-lg-12" style="padding-left: 0; margin-bottom:15px;text-align:left;">
                    Por Laboratorio:&nbsp;                                         
                    <select class="selectpicker form-control" data-live-search="true" id="TLaboratorio_id_laboratorio" name="TLaboratorio[id_laboratorio]" data-style="btn-custom">
                        <option value="">Seleccione...</option>
                        <?php echo $model->getListaLaboratorio(); ?>
                    </select>
                </div>

            </div>

            <!-- <div class="form-group">
                <div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
                    Incluir Médico Tratante:&nbsp; 
                    <input id="ind_medico" class="form-control" type="checkbox" value="1" name="ind_medico" checked="checked"> 
                </div>
            </div> -->
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-default" id="buttonImprimirCotizacion" onclick="js: imprimir();"><i class="fa fa-file"></i>&nbsp;Imprimir</button>
        
      </div>
    </div>
  </div>
</div>