<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('search', "


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
        url : '".Yii::app()->createUrl("bms/TOrden/updateItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val()+'/ido/'+$('#idOrden').val(),
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
        url : '".Yii::app()->createUrl("bms/TOrden/deleteItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val()+'/idCar/'+ $('#TCotizacion_id_carrito').val()+'/ido/'+$('#idOrden').val(),
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



",CClientScript::POS_READY);


?>

	
<div class="row">
	<div class="col-md-12">
        <input type="hidden" name="TCotizacion[id_cotizacion]" id="TCotizacion_id_cotizacion" value="<?php echo $model->id_cotizacion; ?>">
        <input type="hidden" name="TCotizacion[id_carrito]" id="TCotizacion_id_carrito" value="<?php echo $model->id_carrito; ?>">
        <input type="hidden" name="idResponsable" id="idResponsable" value="<?php echo $model->id_responsable; ?>">
        <input type="hidden" name="idOrden" id="idOrden" value="<?php echo $modelOrden->id_orden; ?>">
                
    	<ul class="nav nav-tabs" role="tablist">             
            <li class="active">
                <a href="#carrito" role="tab" data-toggle="tab">Detalle</a>
            </li>                  
        </ul>

        <ul class="nav nav-tabs pull-right">
            <li>
               <button class="btn theme_button" type="submit" id="TCotizacion_pagar_orden" name="buttonPagarOrden" style="margin-top:-80px;margin-right:0px;"><i class="fa fa-money"></i> Solicitar Despacho</button>
            </li>
        </ul>

        

        <div class="tab-content top-color-border bottommargin_30">        	    		

            <div class="tab-pane fade in active" id="carrito">
                
                <h3>Seleccione un producto para añadir a la orden</h3>
                <?php
					$this->renderPartial('resumen',array(
						'model'=>$model,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccionEnvio,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelProducto'=>$modelProducto,'modelOrden'=>$modelOrden,'envio'=>$envio,'gastos'=>$gastos,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura,'modelCartDet'=>$modelCartDet
					));

            	?>
                 
    		</div>			

        </div>           

    	<br>
		<hr>		
		
		<button class="btn theme_button pull-right" type="submit" id="TSolicitarDespacho" name="buttonSolicitarDespacho" data-toggle="modal" data-target="#modalResumenDespacho"><i class="fa fa-money"></i> Solicitar Despacho</button>




	</div>
</div>