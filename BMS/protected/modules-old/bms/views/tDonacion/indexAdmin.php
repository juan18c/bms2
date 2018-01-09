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
                
                 $('#modalEditar #TDonacion_foto').fileinput('destroy');
                  var fotoDe=$('#foto').val();
                  $('#modalEditar #TDonacion_foto').fileinput({
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
                    browseClass: 'btn btn-primary',
                    fileType: 'any',
                    previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
                  });

                    
                    $('.file-preview-image').attr('style','width:100%');
                    $('.file-preview ').attr('style','border:0px;width:100%');
                   $('#modalEditar').modal('show'); 
                return false;
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
                      $('#modalPagoDonacionAdmin').modal('hide'); 
                       $('#tcasos-grid').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                      
                }else{
                    $.each(data, function(key, val) { 
                        $('#tdonacion-adjudicado-form #'+key+'_em_').text(val);                                                    
                        $('#tdonacion-adjudicado-form #'+key+'_em_').show();
                        
                    });  
                }       
            }
        })
    });


    $('#enviarUpdate').click(function(){

        var formData = new FormData(document.getElementById('tdonacion-form'));

        $.ajax({
            type : 'POST',
            dataType: 'json',
            url : '".Yii::app()->createUrl("bms/TDonacion/create/id")."/'+$('#idDonacion').val(),
            data : formData,            
            cache: false,
            contentType: false,
            processData: false,
            success : function (data) {                 
                if (data.salida == 'COMPLETO') {                    
                   // $('#divDonacionMensaje').html(data.mensaje);
                    $('#modalEditar').modal('hide');
                    $('#tcasos-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });

                    return false;
                }else{
                    $('#tdonacion-form #divDonacionMensaje').html(data.mensaje);

                }
            }
        });  

        return false;    
     
    });

    getPagos = function(parametros){
       
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacion/conciliar")."'+parametros,            
            dataType:'json',           
            success : function (data) {   

                $('#pagos-div').html(data.pagos).show();
                window.scrollTo(0, 0);
                return false;
            }
        });
    }


     getPagosCerrados = function(parametros){
       
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacion/pagosCerrados")."'+parametros,            
            dataType:'json',           
            success : function (data) {   

                $('#pagos-div').html(data.pagos).show();            
                window.scrollTo(0, 0);
                return false;
            }
        });
    }

    getDetallePagos = function(parametros){
       
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TOrden/detallePagoConciliado")."'+parametros,            
            dataType:'json',           
            success : function (data) {   

                $('#pagos-div').html(data.pagos).show();


                return false;
            }
        });
    }




");



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
<div id="pagos-div"></div>
    <div class="row">
    <div id="divDonacionMensaje"></div>
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
                        $model= new TDonacion; //var_dump($dataProvider->getData());
                       // var_dump($dataProvider->getData()[0]->idDonacionAdjudicada);// exit();
                     $this->widget('booster.widgets.TbGroupGridView', array(
                        'id'=>'tcasos-grid',
                        'dataProvider'=>$dataProvider,
                        'filter'=>$model,
                        'itemsCssClass'=>'table table-bordered table-striped table-condensed',  
                        'columns'=>array(
                            array(  
                                'name'=>'nombre_caso',
                                'header' =>'Nombre Caso', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),  
                                'filter'=>false,                         
                                //'value'=>'"$".number_format($data->monto_acumulado,2,",",".")'
                            ),
                            array(  
                                'name'=>'fecha_creacion',
                               // 'header' =>'Fecha Creación', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                                'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
                                'filter'=>false,   
                            ),
                            //'fecha_creacion',
                            array(   
                                'name'=>'monto_solicitado',
                                'header' =>'Solicitado', 
                                'headerHtmlOptions' => array('style' => 'width: 10%'),                            
                                'value'=>'"$".number_format($data->monto_solicitado,2,",",".")',
                                'filter'=>false,   
                            ), 
                            array(    
                                'name'=>'monto_acumulado',
                                'header' =>'Acumulado', 
                                'headerHtmlOptions' => array('style' => 'width: 12%'),                            
                                'value'=>'"$".number_format($data->monto_acumulado,2,",",".")',
                                'filter'=>false,   
                            ), 
                            array(    
                                'name'=>'idCotizacion.idBeneficiario.idBeneficiarioDB.nombres',
                                'header' =>'Beneficiario', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),  
                                'type' => 'raw',                         
                                'value'=>'((isset($data->idCotizacion->idBeneficiario->idBeneficiarioDB->nombres)) && (isset($data->idCotizacion->idBeneficiario->idBeneficiarioDB->apellidos)))? $data->idCotizacion->idBeneficiario->idBeneficiarioDB->nombres." ".$data->idCotizacion->idBeneficiario->idBeneficiarioDB->apellidos:"NO DEFINIDO"',
                                'filter'=>false,   
                            ),
                            array(    
                                'name'=>'idCotizacion.idResponsable.nombres',
                                'header' =>'Responsable', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),  
                                'type' => 'raw',                         
                                'value'=>'((isset($data->idCotizacion->idResponsable->nombres)) && (isset($data->idCotizacion->idResponsable->apellidos)))? $data->idCotizacion->idResponsable->nombres." ".$data->idCotizacion->idResponsable->apellidos:"NO DEFINIDO"',
                                'filter'=>false,   
                            ),                            
                            array(
                                    'class' => 'booster.widgets.TbEditableColumn',
                                    'name' => 'id_estatus',
                                    'headerHtmlOptions' => array('style' => 'width: 10%'), 
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
                                'template'=>'{edit}&nbsp;{donacion}&nbsp;{conciliar}&nbsp;{pagos}',
                                'htmlOptions' => array('style'=>'white-space: nowrap'),
                                'buttons'=>array(
                                    'edit' => array(
                                        'label'=>'', 
                                        'url'=>'"/id/".$data->id_donacion',      
                                        'options'=>array('class'=>'fa fa-pencil fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Editar Caso Donación'),
                                        'click'=>'function(){ cargarModalEditar($(this).attr("href")); return false; }',
                                        'live'=>false, 
                                        'visible'=>'(($data->id_estatus!=2)&&($data->id_estatus!= 7))'                    
                                    ),                                    
                                    'donacion' => array(
                                        'label'=>'',
                                        'url'=>'"/id/".$data->id_donacion',
                                        'options'=>array(
                                            'class'=>'fa fa-puzzle-piece fa-lg tooltips','title'=>'Donar','role'=>'button','data-toggle'=>'modal','data-target'=>'#modalPagoDonacionAdmin','onclick'=>'js: cargarModalDonar($(this).attr("href"));  return false; '
                                        ), 
                                        'visible'=>'$data->id_estatus==1'                                     
                                    ), 
                                    'conciliar' => array(
                                        'label'=>'', 
                                        'url'=>'"/id/".$data->id_donacion',        
                                        //'options'=>array('class'=>'fa fa-handshake-o fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Conciliar Pagos'),
                                        'options'=>array('class'=>'fa fa-plus fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Conciliar Donaciones'),
                                        'click'=>'function(){ getPagos($(this).attr("href")); return false; }',
                                        'live'=>false,
                                        'visible'=>'((count($data->idDonacionAdjudicada) > 0 )&&($data->id_estatus==1)) ? true:false',
                                    ), 
                                    'pagos' => array(
                                        'label'=>'', 
                                        'url'=>'"/id/".$data->id_donacion',        
                                        //'options'=>array('class'=>'fa fa-handshake-o fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Conciliar Pagos'),
                                        'options'=>array('class'=>'fa fa-check fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Donaciones pagadas'),
                                        'click'=>'function(){ getPagosCerrados($(this).attr("href")); return false; }',
                                        'live'=>false,
                                        'visible'=>'$data->id_estatus==7',
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalEditarLabel">Editar Caso Donación</h4>
            </div>
            <div class="modal-body">              

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-defaul" id="enviarUpdate"><i class="fa fa-money"></i>&nbsp;Guardar</button>
            </div>
        </div>
    </div>
</div>