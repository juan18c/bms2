<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */
?>
<?php 

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

<?php
Yii::app()->clientScript->registerScript('modalCotizacion',"    

    

    jQuery('#solicitarCot').click(function(){

        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TCarritoDetalle/verificarDireccion")."/idR/".Yii::app()->user->id_persona."',
            data : $('#tcarrito-direccion-form').serialize(),
            dataType: 'json',
            success : function (data) {                 
                if (data.salida == 'VERIFICADO') {
                    $('#modalCotizar').modal('show');                    
                    $('#direccionEnvioModal').html(data.mensaje).show().fadeIn(2000);
                    $('#divSolicitar').html('');
                }else{
                    $('#direccionEnvio').html(data.mensaje).show().fadeIn(2000);
                    $('#divSolicitar').html(data.mensaje).show().fadeIn(2000);
                }
            }
        });
       
        

        return false;
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

            // $('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker({
            //       noneSelectedText: 'Añadir Dirección'  
            // }).on('changed.bs.select', function ( event, clickedIndex, newValue, oldValue) {
              
            //     $('#newDir').hide();
            //     $('#divSolicitar').html('');
                
            //     //$('#TDatosBasicosDireccion_id_datos_basicos_direccion').val('');
            //     $('#TDatosBasicosDireccion_direccion1').val('');
            //     $('#TDatosBasicosDireccion_direccion2').val('');
            //     $('#TDatosBasicosDireccion_estado').val('');
            //     $('#TDatosBasicosDireccion_ciudad').val('');
            //     $('#TDatosBasicosDireccion_codigo_zip').val('');
            //     $('#TDatosBasicosDireccion_telefono_fijo').val('');
            //     //$('#TDatosBasicosDireccion_id_pais').val('');
            //     //$('#newDir').show();

            //     if ($(this).val() != '' ) {
            //         $.ajax({
            //             type : 'POST',
            //             url : '".Yii::app()->createUrl("bms/TCarritoDetalle/createDireccion")."/idR/'+$('#idResponsable').val(),
            //             data : $('#tcarrito-direccion-form').serialize(),
            //             dataType: 'json',
            //             success : function (data) {                 
            //                 if (data.salida == 'IMCOMPLETO') {
            //                     $('#TDatosBasicosDireccion_id_datos_basicos_direccion').val(data.id);
            //                     $('#TDatosBasicosDireccion_direccion1').val(data.dir1);
            //                     $('#TDatosBasicosDireccion_direccion2').val(data.dir2);
            //                     $('#TDatosBasicosDireccion_estado').val(data.estado);
            //                     $('#TDatosBasicosDireccion_ciudad').val(data.ciudad);
            //                     $('#TDatosBasicosDireccion_codigo_zip').val(data.codzip);
            //                     $('#TDatosBasicosDireccion_telefono_fijo').val(data.telefono);
            //                     $('#TDatosBasicosDireccion_id_pais').val(data.pais);
            //                     $('#newDir').show();
            //                 }

            //                 $('#direccionEnvio').html(data.mensaje).show();

            //                 return false;
            //             }
            //         });         
            //     }else { $('#newDir').show(); $('#direccionEnvio').html(''); }

            //     return false;
            // }); 

            // $('#TDatosBasicosDireccion_crear_direccion').click(function(){      
            //     $.ajax({
            //         type : 'POST',
            //         url : '".Yii::app()->createUrl("bms/TCarritoDetalle/modificarDireccion")."/idR/'+$('#idResponsable').val(),
            //         data : $('#tcarrito-direccion-form').serialize(),
            //         dataType: 'json',
            //         success : function (data) {                 
            //             if (data.salida == 'COMPLETO') {
                            
            //                 $('#newDir').hide();
            //                 $('#direccionEnvio').html(data.mensaje).show();
            //                 if (data.scenario == 'insert' ) {                   
            //                     $('#TDatosBasicosDireccion_id_datos_basicos_direccion').append('<option value=\"' + data.id + '\">' + data.option + '</option>');                           
            //                 }

            //                 $('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker('refresh');
            //                 $('#TDatosBasicosDireccion_id_datos_basicos_direccion').selectpicker('val', data.id);

            //             }
            //         }
            //     });                     
            // });

            $('#tcarrito-cotizacion-form').find('#fechaNacBeneficiario').datepicker({language:'es'});
            $('#tcarrito-cotizacion-form').find('#TDatosBasicos_beneficiario_sexo').bootstrapToggle({
              on: 'Femenino',
              off: 'Masculino',
              onstyle:'custom',
              width:150
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
                
            $('#cart').html('<i class=\"rt-icon2-cart highlight\"></i><span class=\"grey\">Carrito:</span><span class=\"count\">'+data.totalProducto+' items, $'+data.totalCarrito+'</span>');

            $('.widget_shopping_cart_content.total.amount').html('$'+data.totalCarrito);

            $.fn.yiiListView.update('carrito-compra-list');           

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

$('#tcotizacion-form').find('#TDatosBasicos_ind_empresa').change(function() 
{
      
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

// borrarItem = function(idCarritoDetalle){
//     $.ajax({
//         type : 'POST',
//         url : '".Yii::app()->createUrl("bms/TCotizacion/deleteItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val(),
//         //data : {}, 
//         dataType:'json',            
//         success : function (data) {
                          
//             $('#shop-order-div').html(data.totalOrden);
//             $('#tcarrito-cotizacion-grid').yiiGridView('update',{data: {idcarr:$('#TCotizacion_id_carrito').val() }});

//             return false;               
//         }

//     });

//     return false;
// }


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




",CClientScript::POS_READY);

?>

<style>
  /*.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }*/
  
.btn-custom {
    background-color: #820906;
    border: 1px solid #820906 !important;
    color: #fff;
}

.btn-custom1 {
    background-color: #ff792b;
    border: 1px solid #ff792b !important;
    color: #000;
}
 
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }

</style>
<section class="ls ms section_padding_15">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="shop-adds text-center">
                    <span class="grey">Carrito de Compra</span>                    
                    <i class="arrow-icon-right-open-mini"></i>
                    <span>Checkout</span>
                    <i class="arrow-icon-right-open-mini"></i>
                    <span>Orden Completada</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="content" class="ls section_padding_50">
    <div class="container">
    <input type="hidden" name="idResponsable" id="idResponsable" value="<?php echo Yii::app()->user->id_persona; ?>">
    <input type="hidden" name="TCotizacion_id_carrito" id="TCotizacion_id_carrito" value="<?php echo $modelCar->id_carrito; ?>">
        <!-- <div class="row">

            <div class="col-sm-8 col-md-8 col-lg-8"> -->
            <?php


                $this->renderPartial('application.modules.bms.views.tCotizacion.resumenCarrito',array(
                'model'=>$modelCot,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'direccionEnvio'=>$direccionEnvio,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelProducto'=>$modelProducto,'modelCartDet'=>$model
            ),false,false);
            ?>

                <!-- <div class="widget widget_search"> -->
    <!-- <h3 class="widget-title">Site Search</h3> -->
    <!-- <form role="search" method="get" class="searchform form-inline" action="/">
        <div class="form-group">
            <label class="screen-reader-text" for="search">Buscar por:</label>
            <input type="text" value="" name="searchCart" class="form-control" placeholder="Buscar...">
        </div>
        <button type="submit" class="theme_button">Buscar</button>
    </form>
</div><br> -->


<!-- <div class="table-responsive">
    <table class="table cart-table">
        <thead>
            <tr>
                <td class="product-info">Producto</td>
                <td class="product-price-td">Precio</td>
                <td class="product-quantity">Cantidad</td>
                <td class="product-subtotal">Subtotal</td>
                <td class="product-remove">&nbsp;</td>
            </tr>
        </thead> -->
            <?php //$this->renderPartial('application.modules.bms.views.tCarritoDetalle._viewResumen',array('data'=>$carritoDetalle),false,false); ?>

                <?php 
                    // $this->widget('zii.widgets.CListView', array(
                    //     'id'=>'resumen-cart-list',
                    //     'dataProvider'=>$dataProviderCart,
                    //     'itemView'=>'application.modules.bms.views.tCarritoDetalle._viewResumen',    
                    //     'summaryText'=>'Mostrando {start} - {end} de {count} productos',
                    //     'itemsTagName'=>'tbody',
                    //     //'itemsCssClass'=>'items table cart-table',
                    //     //'viewData' => array( 'totalItems' => $totalItems),
                    //     //'ajaxUpdate' => false,
                    //     //'enableSorting'=> true,
                    //     //'ajaxType'=>'POST',
                    //     //'ajaxUrl'=>Yii::app()->createUrl("bms/TCarritoDetalle/cartPrevio"),
                    //     'pager' => array(      
                    //         //'cssFile' => false,                         
                    //         'htmlOptions'=>array('class'=>'pagination'),
                    //         'header' => '',
                    //         'firstPageLabel' => '<b><<</b>',
                    //         'lastPageLabel' => '<b>>></b>',
                    //         'prevPageLabel' => '<b><</b>',
                    //         'nextPageLabel' => '<b>></b>',
                    //         'selectedPageCssClass'=>'active'//default "selected"                               
                    //         ),
                    //     //'pagerCssClass' => 'col-sm-8',
                    // )); 
                ?>  <!-- 
</table>   --> 
                   
    
                    <!-- </div> -->
        

                

            <!-- </div>  --><!--eof .col-sm-8 (main content)-->


            <!-- sidebar -->
            <!-- <aside class="col-sm-4 col-md-4 col-lg-3 col-lg-push-1">
                
                
                <h3 class="widget-title" id="order_review_heading">T&uacute; Orden</h3>
                <div id="order_review" class="shop-checkout-review-order">
                    <div id="shop-order-div">
                    <?php //$this->renderPartial('application.modules.bms.views.tCarritoDetalle._viewTotalOrden',array('resumenCart'=>$resumenCart),false,false); ?>
                    </div>

                    <div id="payment" class="shop-checkout-payment">
                        <h3 class="widget-title">Direcci&oacute;n de Env&iacute;o</h3>
                                                  
                    </div>
                </div>
                
               

            </aside> --> <!-- eof aside sidebar -->


        <!-- </div> -->

        <div class="cart-buttons">
                    <!-- Button trigger modal -->
                    <a class="theme_button" href="#" role="button" id="solicitarCot">Solicitar Cotizacion</a>

                    <input type="button" class="theme_button color1" name="update_cart" value="Comprar"> 

                    
                </div>
                <div id="divSolicitar"></div>
    </div>
</section>

<?php $this->renderPartial('application.modules.bms.views.tCarritoDetalle._formCotizacion',array('modelCot'=>$modelCot,'modelBeneficiario'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad),false,false); ?>




<?php 
//$this->widget('zii.widgets.grid.CGridView', array(
// 	'id'=>'tcarrito-detalle-grid',
// 	'dataProvider'=>$model->search(),
// 	'itemsCssClass'=>'table cart-table',
// 	'filter'=>$model,
// 	'columns'=>array(
// 		'id_carrito_detalle',
// 		'id_carrito',
// 		'id_producto',
// 		'cantidad',
// 		'id_estatus',
// 		'fecha_creacion',
// 		array(
// 			'class'=>'CButtonColumn',
// 		),
// 	),
// )); ?>
