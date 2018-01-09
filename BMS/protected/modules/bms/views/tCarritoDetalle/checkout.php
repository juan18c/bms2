<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */

Yii::app()->clientScript->registerScript('searchCheckout', "


// montoPagado
// totalRestante

recalcular = function()
{
    var monto=0, valor=0;

    $('.monto-a-pagar').each(function(key, value){     

        if ($(this).val() == '') {
            valor = 0;
        }else valor = $(this).val(); 
        
        monto = parseFloat(monto) + parseFloat(valor);        
    });

    return monto;
}

recalcularTotal = function()
{
    var monto=0, valor=0, total=$('#total').val();

    $('.monto-a-pagar').each(function(key, value){     

        if ($(this).val() == '') {
            valor = 0;
        }else valor = $(this).val(); 
        
        monto = parseFloat(valor) + parseFloat(monto);
    });

    monto = parseFloat(total) - monto;
    return monto;
}

$('.monto-a-pagar').bind('keyup', function(e){
    //alert($(this).val());
    var valor = $(this).val();
    var monto = $('tr#montoPagado span').text();
    var montoP = 0;
    var montoR = 0;
    total=$('tr#totalRestante td span strong').text();

    
    // if (valor == ''){
        montoP = recalcular();
        montoR = recalcularTotal();
    // }else{
    //     montoP = parseFloat(monto) + parseFloat(valor);
    //     montoR = parseFloat(total) - parseFloat(valor);
    // }

    $('tr#montoPagado span#montoP').text(montoP);
    $('tr#totalRestante td span#totalR').text(montoR);

    return false;
})


$('#checkout_pagar,#checkout_pagar_1').click(function(){

    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCarritoDetalle/procesarPago")."/id/'+$('#idCotizacion').val(),
        data : $('#tcarrito-checkout-form').serialize(),
        dataType: 'json',
        success : function (data) {                 
            
            window.location= '".Yii::app()->createUrl("bms/TOrden/view")."/id/'+data.id+'/origen/'+data.origen;
        }
    });     
})


$('#numeroTarjeta').validateCreditCard(function(result) {

    if (result.length_valid && result.valid && result.luhn_valid) {

        if (result.card_type.name == 'visa') {
            $('#spanTipoCC').html('<i class=\"fa fa-cc-visa\"></i>');
            $('#tipoCC').val(result.card_type.name);
            
        }else if(result.card_type.name == 'mastercard'){
            $('#spanTipoCC').html('<i class=\"fa fa-cc-mastercard\"></i>');
            $('#tipoCC').val(result.card_type.name);

        }else if(result.card_type.name == 'maestro'){
            $('#spanTipoCC').html('<i class=\"fa fa-credit-card-alt\"></i>');
            $('#tipoCC').val(result.card_type.name);

        }else if(result.card_type.name == 'amex'){
            $('#spanTipoCC').html('<i class=\"fa fa-cc-amex\"></i>');
            $('#tipoCC').val(result.card_type.name);

        }else if(result.card_type.name == 'discover'){
            $('#spanTipoCC').html('<i class=\"fa fa-cc-discover\"></i>');
            $('#tipoCC').val(result.card_type.name);

        }else if(result.card_type.name == 'jcb'){
            $('#spanTipoCC').html('<i class=\"fa fa-cc-jcb\"></i>');
            $('#tipoCC').val(result.card_type.name);
        }


        $('#resultadoNroTarjeta').html('<i class=\"fa fa-check\"></i> <font size=\"3\">Tarjeta Válida</font>');
       
    }else{
        $('#resultadoNroTarjeta').html('<i class=\"fa fa-close\"></i> <font size=\"3\">Tarjeta Inválida</font>');
    }

        //     $('#log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
        //              + '<br>Valid: ' + result.valid
        //              + '<br>Length valid: ' + result.length_valid
        //              + '<br>Luhn valid: ' + result.luhn_valid);
});


");
?>

<section class="ls ms section_padding_15">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="shop-adds text-center">
                    <?php if (!empty($origen) && $origen=='cot'){ ?>
                    <span>Cotización #<?php echo substr($model->codigo_cotizacion, 2, 5); ?></span>
                    <?php }else{ ?>
                    <span>Carrito de Compra</span>
                    <?php } ?>
                    <i class="arrow-icon-right-open-mini"></i>
                    <span class="grey">MultiPagos</span>
                    <i class="arrow-icon-right-open-mini"></i>
                    <span>Orden Completa</span>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="content" class="ls section_padding_50">
    <div class="container">
        <div class="row">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'tcarrito-checkout-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
            <input type="hidden" name="idCotizacion" id="idCotizacion" value="<?php echo $model->id_cotizacion; ?>">
            <input type="hidden" name="idCarrito" id="idCarrito" value="<?php echo $model->id_carrito; ?>">
            <input type="hidden" name="idResponsable" id="idResponsable" value="<?php echo $model->id_responsable; ?>">
            <input type="hidden" name="tipoCC" id="tipoCC" value="">
            <input type="hidden" name="origen" id="origen" value="<?php echo $origen; ?>">

            <div class="col-sm-9 col-md-9 col-lg-9">
                
                <h3 class="widget-title" id="order_review_heading">Seleccione sus métodos de pago<br><font size="3">El uso del servicio 'MultiPagos' generará las comisiones asociadas a cada método de pago </font>
                </h3>
                <br>

                <!-- <h3>Tipo de Pago&nbsp;</h3>                
                <div class="form-group clearfix">                    
                    <div class="col-lg-8">                        
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
                <hr> -->
                
                <!-- <h3><i class="fa fa-credit-card"></i> Tarjetas de Crédito ó Debito <span class="pull-right">
                        <i class="fa fa-cc-visa fa-lg"></i>
                        <i class="fa fa-cc-mastercard fa-lg"></i>
                        <i class="fa fa-cc-discover fa-lg"></i>
                        <i class="fa fa-cc-dinner-club fa-lg"></i>
                        <i class="fa fa-cc-amex fa-lg"></i>
                        <i class="fa fa-cc-jcb fa-lg"></i></span></h3>
                <div class="form-group clearfix">                    
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Nombre en la Tarjeta</label>
                        <input type="text" name="nombreTarjeta" id="nombreTarjeta" class="form-control" placeholder="PEDRO PEREZ">
                    </div>
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Número de Tarjeta <span id="spanTipoCC"></span></label>
                        <input type="text" name="numeroTarjeta" id="numeroTarjeta" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
                    </div>
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Fecha de Expiración Mes/Año</label>
                        <div class="col-lg-6" style="padding: 0 5px 0 0;">
                            
                            <select id="mesTarjeta" name="mesTarjeta" class="form-control">
                                <option value="">Mes</option>
                                <?php 
                                    for ($i=1; $i <= 12; $i++) { 
                                ?>
                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
                                <?php
                                    }
                                ?>                            
                            </select>
                        </div>
                        <div class="col-lg-6" style="padding: 0 0 0 5px;">
                            <select id="anioTarjeta" name="anioTarjeta" class="form-control">
                                <option value="">Año</option>
                                <?php 
                                    $actual = date('Y');
                                    for ($i=$actual; $i <= ($actual+20); $i++) { 
                                ?>
                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
                                <?php
                                    }
                                ?>      
                            </select>                                            
                        </div>
                    </div>

                </div>

                <div class="form-group clearfix">
                    
                    <div class="col-lg-4">
                        <br>
                        <input type="hidden" name="relleno" id="relleno">
                        <b>Comisión: $40 </b>
                    </div>
                    <div class="col-lg-4">
                        <span id="resultadoNroTarjeta"></span>
                    </div>
                    <div class="col-lg-1">
                        <br>
                        <input type="hidden" name="relleno" id="relleno">

                    </div>
                    <div class="col-lg-3 ">
                        <label>Monto a pagar</label>
                        <input type="text" name="montoCC" id="montoCC" class="form-control monto-a-pagar" placeholder="0.00">
                    </div>
                    <!-- <div class="col-lg-3">
                        <br>
                        <button class="btn theme_button pull-right" type="button" id="checkout_cc_add" name="checkout_cc_add" ><i class="fa fa-plus"></i> Agregar</button>     
                    </div> --/>
                

                </div>

                <!-- <br><br> --/>
                <hr> -->
                <hr>
                <!-- <br><br> -->
                <h3><i class="fa fa-tags"></i> Cr&eacute;dito BMS</h3>
                <div class="form-group clearfix">                    
                    <div class="col-lg-3" style="padding-right: 0px;">
                        <label>Saldo</label>
                        <input type="text" name="saldoBms" id="saldoBms" class="form-control" placeholder="0.00">
                    </div>                    
                    <div class="col-lg-6">
                        <br>
                        <input type="hidden" name="relleno" id="relleno">
                    </div>
                    <div class="col-lg-3">
                        <label>Monto a pagar</label>
                        <input type="text" name="montoBms" id="montoBms" class="form-control monto-a-pagar" placeholder="0.00">
                    </div>                   

                    <!-- <div class="col-lg-3" style="padding-right: 0px;">
                        <br>
                        <button class="btn theme_button pull-right" type="button" id="checkout_saldo" name="checkout_saldo" ><i class="fa fa-plus"></i> Agregar</button>     
                    </div> -->
                    
                </div>

                <h3><i class="fa fa-paypal"></i> PayPal</h3>
                <div class="form-group clearfix">                    
                    <div class="col-lg-6" style="padding-right: 0px;">
                        <label>Cuenta</label>
                        <input type="text" name="cuentaPaypal" id="cuentaPaypal" class="form-control" placeholder="tucuenta@servidor.com">
                    </div>
                    <div class="col-lg-3">
                        <br>
                        <input type="hidden" name="relleno" id="relleno">

                    </div>
                    <div class="col-lg-3" style="padding-right: 0px;">
                        <label>Monto a pagar</label>
                        <input type="text" name="montoPaypal" id="montoPaypal" class="form-control monto-a-pagar" placeholder="0.00">
                    </div>
                    <!-- <div class="col-lg-3" style="padding-right: 0px;">
                        <br>
                        <button class="btn theme_button pull-right" type="button" id="checkout_paypal" name="checkout_paypal" ><i class="fa fa-plus"></i> Agregar</button>     
                    </div> -->
                    
                </div>

                <!-- <br><br> -->
                <hr>
                <h3><i class="fa fa-money"></i> Depósito ó Transferencia Bancaria</h3>

                <h4>Datos del Banco Origen</h4>
                <div class="form-group clearfix">                    
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Nombre de Banco</label>
                        <input type="text" name="nombreBanco" id="nombreBanco" class="form-control" placeholder="">
                    </div>
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Número de ruta bancaria</label>
                        <input type="text" name="numeroRutaBanco" id="numeroRutaBanco" maxlength="9" class="form-control" placeholder="XXXXXXXXX">
                    </div>
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Número de cuenta</label>
                        <input type="text" name="numeroCuentaBanco" id="numeroCuentaBanco" maxlength="17" class="form-control" placeholder="XXXXXXXXXXXXXXXXX">
                    </div>
                </div>

                <div class="form-group clearfix">
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Número de Depósito/Transferencia</label>
                        <input type="text" name="numeroOperacion" id="numeroOperacion" maxlength="17" class="form-control">
                    </div>

                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Nombre del Titular de la Cuenta</label>
                        <input type="text" name="titular" id="titular" maxlength="17" class="form-control">
                    </div>
                </div>
                <h4>Datos del Banco Destino</h4>
                <div class="form-group clearfix">
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Fecha de Pago</label>
                        <input type="text" name="fechaPago" id="fechaPago" maxlength="17" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Banco Destino</label>
                        <select class="form-control">
                            <option value="1">Banesco Panama</option>
                            <option value="2">Mercantil Commerbank</option>
                            <option value="3">Bank of America</option>
                            <option value="4">Wells Fargo</option>
                        </select>                        
                    </div>

                    <div class="col-lg-1">
                        <br>
                        <input type="hidden" name="relleno" id="relleno">
                    </div>
                    <div class="col-lg-3">
                        <label>Monto a pagar</label>
                        <input type="text" name="montoDeposito" id="montoDeposito" class="form-control monto-a-pagar" placeholder="0.00">
                    </div>
                    <!-- <div class="col-lg-3">
                        <br>
                        <button class="btn theme_button pull-right" type="button" id="checkout_banco" name="checkout_banco" ><i class="fa fa-plus"></i> Agregar</button>     
                    </div>     -->               
                </div>

                

                <hr>
                <!-- <br><br> -->
                <!-- <h3><i class="fa fa-puzzle-piece"></i> Donaciones (En caso de que la cotización este postulada a donación)</h3> 
                <div class="form-group clearfix">  
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Acumulado</label>
                        <input type="text" name="acumuladoDonacion" id="acumuladoDonacion" class="form-control" placeholder="0.00">
                    </div>                  
                    <div class="col-lg-4" style="padding-right: 0px;">
                        <label>Resto</label>
                        <input type="text" name="restoDonacion" id="restoDonacion" class="form-control" placeholder="0.00">
                    </div>
                    
                </div> -->

            </div> <!--eof .col-sm-8 (main content)-->


            <!-- sidebar -->
            <div class="col-sm-3 col-md-3 col-lg-3">
            
                <h3 class="widget-title" id="order_review_heading">Orden </h3>
                <div id="order_review" class="shop-checkout-review-order">
                    <div id="shop-order-div">
                    <?php $this->renderPartial('application.modules.bms.views.tCarritoDetalle._viewTotalOrdenCheckout',array('resumenCart'=>$resumenCart,'envio'=>$envio,'gastos'=>$gastos,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura),false,false); ?>
                    </div>
                    <div class="row">
                        <button class="btn theme_button pull-right" type="button" id="checkout_pagar_1" name="checkout_pagar_1" ><i class="fa fa-dollar"></i> Pagar</button>
                    </div>

                    <div id="payment" class="shop-checkout-payment">
                        <h3 class="widget-title">Direcci&oacute;n de Env&iacute;o</h3>
                        <?php $this->renderPartial('application.modules.bms.views.tCotizacion._formDireccion',array('model'=>$model,'modelDireccion'=>$modelDireccion,'direccionEnvio'=>$direccionEnvio),false,false); ?>                           
                    </div>
                </div> 

            </div> <!-- eof aside sidebar -->

        </div>

        <div class="row">
            <button class="btn theme_button pull-right" type="button" id="checkout_pagar" name="checkout_pagar" ><i class="fa fa-dollar"></i> Pagar</button>
        </div>
<?php $this->endWidget(); ?>

    </div>
</section>


<?php 
// $this->widget('zii.widgets.grid.CGridView', array(
// 	'id'=>'tcarrito-detalle-grid',
// 	'dataProvider'=>$model->search(),
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
// )); 
?>
