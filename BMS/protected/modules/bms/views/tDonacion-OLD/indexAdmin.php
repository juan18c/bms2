<?php
    if((Yii::app()->user->id==Yii::app()->session['_id']) && (Yii::app()->user->name!='Guest')){ 

 Yii::app()->clientScript->registerScript('pagProductos',"
        var ajaxUpdateTimeout;
        var ajaxRequest;
        $('#showcount').change(function(){
            ajaxRequest = {size:$('#showcount').val()}
            
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
    // this is the id of the CListView
                    'productos',
                    {data: ajaxRequest}
                    
                )
            },
    // this is the delay
            300);
        });


    //     $(document).on('click', '[data-toggle=\'lightbox\']', function(event) {
    //     event.preventDefault();
    //     $(this).ekkoLightbox();
    //     return false;
    // });
        "
    );




 Yii::app()->clientScript->registerScript('donacionIndex',"

    cargarModalDonar= function(parametros){  
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacionAdjudicado/createAdmin")."'+parametros,            
            dataType:'json',           
            success : function (data) {   
                $('#modalPagoDonacionAdmin .modal-body').html(data.dona);             
                 $('#modalPagoDonacionAdmin').modal('show'); 
                   $('#tdonacion-adjudicado-form').find('#TDonacionAdjudicado_publico').bootstrapToggle({
                      on: 'Publico',
                      off: 'Privado',
                      onstyle:'custom',
                      width:150
                    });

            }

      });
    } 


    cargarModalEditar= function(parametros){  
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacion/updateAdmin")."'+parametros,            
            dataType:'json',           
            success : function (data) {   
                $('#modalEditar .modal-body').html(data.dona);             
                 $('#modalEditar').modal('show'); 
                  

            }

      });
    }      



    
    $('#enviarDonarIndex').click(function(){
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacionAdjudicado/create/id")."/'+$('#TDonacionAdjudicado_id_donacion').val(),            
            dataType:'json',      
            data: $('#tdonacion-adjudicado-form').serialize(),
            success : function (data) {  
                
                if (data.salida=='completo'){
                     $('#divDonarIndexMensaje').html(data.mensaje).show();
                      $('#modalPagoDonacionIndex').modal('hide'); 
                }else{
                    $.each(data, function(key, val) { 
                        $('#tdonacion-adjudicado-form #'+key+'_em_').text(val);                                                    
                        $('#tdonacion-adjudicado-form #'+key+'_em_').show();
                        
                    });  
                }       
            }
        })
    });


");



    Yii::app()->clientScript->registerScript('searchProductos',"
        var ajaxUpdateTimeout;
        var ajaxRequest;

        buscarCat= function(cat,marca,search)
        {
           
            var size= $('#showcount').val()
            $.ajax({
                type : 'GET',
                url : '".Yii::app()->createUrl("bms/TProducto/categoria")."',
                data: {cat:cat,marca:marca,size:size,search:search},
                dataType:'json',           
                success : function (data) {
                    
                    $('#listaProdCategoria').html(data.catCount);

                    if (data.marcaCount != '') {
                        $('#listaProdCategoria').html(data.marcaCount);
                    }
                    $('#productos-div').html(data.gridProductos).show();
                    return false;
                   
                }
            });

            return false;
        }

        $('input#search').keyup(function(){
            ajaxRequest = $(this).serialize();
            //clearTimeout(ajaxUpdateTimeout);

            // ajaxUpdateTimeout = setTimeout(function () {
            //             $.fn.yiiListView.update('productos',{data: ajaxRequest})
            //         },300);

            buscarCat('','',$(this).val());

            //$.fn.yiiListView.update('productos',{data: ajaxRequest});
            return false;
            
            
        });
            


        $('#productos').find('.items').removeClass().addClass('columns-3');

        $('#toggle_shop_view').on('click', function( e ) {
            e.preventDefault();
            $(this).toggleClass('grid-view');
            $('#products').toggleClass('grid-view list-view');
        });

        verImg= function(idDonacion)
        {
            $('#modalPagoDonacionIndex').modal('show');
            var parametros='/id/'+idDonacion;
            $.ajax({
                type : 'POST',
                url : '".Yii::app()->createUrl("bms/TDonacionAdjudicado/modalDonacionAdjudicado")."'+parametros,           
                dataType:'json',           
                success : function (data) {  
                    $('#modalPagoDonacionIndex .modal-body').html(data.dona);
                    $('#tdonacion-adjudicado-form').find('#TDonacionAdjudicado_publico').bootstrapToggle({
                      on: 'Publico',
                      off: 'Privado',
                      onstyle:'custom',
                      width:150
                    });
                }

            });


        }


    abrirVentanaDonar= function(parametros){   
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TCotizacion/cargarModalDonacion")."'+parametros,            
            dataType:'json',           
            success : function (data) {   
                $('#idResponsable').val(data.idP);
                $('#TCotizacion_id_cotizacion').val(data.idCot);            
                
                $('#TDatosBasicos_nombres').val(data.nombreBeneficiario);
                $('#TDatosBasicos_apellidos').val(data.nombreResponsable);

               // $('#TDatosBasicos_email').val(data.email);
                $('#modalSolicitudDonacion .modal-body').html(data.dona); 
                //$('#modalSolicitudDonacion').modal('show'); 
                


            }

      });
    } 


    $('.progress-bar').each(function() {
        var bar_value = $(this).attr('aria-valuenow') + '%';                
        $(this).animate({ width: bar_value }, { duration: 2000, easing: 'easeOutCirc' });
    });
     

    "
    );

?>


<!-- page heading start-->
<div class="page-heading">
    <h3>
        Administrar Donaciones
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>        
        <li class="active"> Donaciones Postuladas </li>
    </ul>
</div>
<!-- page heading end-->



<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Donaciones
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>                      
                     </span>
                </header>
                <div class="panel-body">                    
                    

                    <div class="adv-table">
                    <!-- <div class="columns-3"> -->
                <div id="productos-div" class="adv-table">
                    
                    <?php
                        $model= new TDonacion;
                     $this->widget('booster.widgets.TbGroupGridView', array(
                        'id'=>'tcasos-grid',
                        'dataProvider'=>$dataProvider,
                        'filter'=>$model,
                        'itemsCssClass'=>'table table-bordered table-striped table-condensed',  
                        'columns'=>array(
                            'nombre_caso',
                            'fecha_creacion',
                            'monto_solicitado',
                            'monto_acumulado',
                            array(
                                    'class' => 'booster.widgets.TbEditableColumn',
                                    'name' => 'id_estatus',
                                    'value' => '$data->idEstatus->descripcion',     
                                    'sortable' => false,
                                    'editable' => array(
                                        'url' => Yii::app()->createUrl("bms/TDonacion/UpdateEstatus"),
                                        'placement' => 'left',
                                        'type' => 'select',
                                        'inputclass' => 'span4',
                                        'source' =>CHtml::listData(TEstatus::model()->findAll('t.id_estatus in (1,4,2) '),'id_estatus', 'descripcion'),
                                        'validate'   => 'js: function(value) {
                                            if($.trim(value) == "") return "valor requerido."
                                            else if (!$.isNumeric(value)) return "el valor debe ser numérico.";
                                        }',
                                        
                                    ),                                  
                                    'filter'=>false,
                                    'htmlOptions'=>array('style'=>'text-align:right;'),
                                ),
                             
                            array(
                                'class'=>'CButtonColumn',                               
                                'template'=>'{edit}&nbsp;{donacion}',
                                'htmlOptions' => array('style'=>'white-space: nowrap'),
                                'buttons'=>array(
                                    'edit' => array(
                                        'label'=>'', 
                                        'url'=>'"/id/".$data->id_donacion',      
                                        'options'=>array('class'=>'fa fa-pencil fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Editar Caso Donación'),
                                        'click'=>'function(){ cargarModalEditar($(this).attr("href")); return false; }',
                                        'live'=>false,                        
                                    ),                                    
                                    'donacion' => array(
                                        'label'=>'',
                                        'url'=>'"/id/".$data->id_donacion',
                                        'options'=>array(
                                            'class'=>'fa fa-puzzle-piece fa-lg tooltips','title'=>'Donar','role'=>'button','data-toggle'=>'modal','data-target'=>'#modalPagoDonacionAdmin','onclick'=>'js: cargarModalDonar($(this).attr("href"));  return false; '
                                        ),                                      
                                    ),         

                                ),  
                            ),
                        ),
                        ));

                    ?>  
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php

    }else{
       // throw new CHttpException(401, Yii::t('yii', 'No esta logueado.'));
       echo'<script>window.location="'.Yii::app()->homeUrl.'";</script>';
 
    }
?>

<div class="modal fade  bs-example-modal" id="modalPagoDonacionAdmin" tabindex="-1" role="dialog" aria-labelledby="modalPagoDonacionLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalPagoCotLabel">Donar al Caso</h4>
            </div>
            <div class="modal-body">              

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-defaul" id="enviarDonarIndex"><i class="fa fa-money"></i>&nbsp;Donar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  bs-example-modal" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalEditarLabel">Editar Caso Donación</h4>
            </div>
            <div class="modal-body">              

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-defaul" id="enviarDonarIndex"><i class="fa fa-money"></i>&nbsp;Guardar</button>
            </div>
        </div>
    </div>
</div>