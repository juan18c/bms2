
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
                    'productos',
                    {data: ajaxRequest}
                    
                )
            },
            300);
        });



        "
    );




 Yii::app()->clientScript->registerScript('donacionIndex',"
   
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

        OrdenarPor= function()
        {
           

           ajaxRequest = {tipo:$('#orderby').val(),size:$('#showcount').val()}
            
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
                    'productos',
                    {data: ajaxRequest}
                    
                )
            },
            300);

           
          
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
            $('#productos').find('.items').removeClass().addClass('columns-3');
            $('#products').toggleClass('grid-view list-view');
        });

        verImg= function(idDonacion)
        {
            $('#modalPagoDonacionIndex').modal('show');
            var parametros='/id/'+idDonacion;
            $.ajax({
                type : 'POST',
                url : '".Yii::app()->createUrl("bms/tDonacionAdjudicado/modalDonacionAdjudicado")."'+parametros,           
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

<section id="content" class="ls section_padding_top_40 section_padding_bottom_75">
    <div class="container">
        <div class="row">
        <div id="divDonarIndexMensaje"></div>
            <div class="col-md-3">

                <h2 class="entry-title">Bienvenido a tu portal</h2>
                
               <!--  <div class="entry-thumbnail divider_40">
                    <img src="images/gallery/06.jpg" alt="">
                </div> -->

                <div class="entry-excerpt">
                    <p>
                    Aqui encontrar&aacute;s todo lo que necesitas para la sanaci&oacute;n de tu cuerpo a trav&eacute;s de las vitaminas, minerales y dem&aacute;s productos que te ayudaran a fortalecer tu sistema inmune. Acompa&ntilde;ados de los mejores especialistas segun tus necesidades y contando con nuestro apoyo en toda las fases de tu tratamiento.
                    </p>

                    <p>
                    Gracias por formar parte de nuestra familia.
                    </p>
                </div>                

                <ul class="list1 darklinks">
                    <li>
                        <a href="services.html">Examenes</a>
                    </li>
                    <li>
                        <a href="services.html">Suplementos</a>
                    </li>
                    <li>
                        <a href="services.html">Equipos</a>
                    </li>
                    <li>
                        <a href="services.html">Medicos</a>
                    </li>
                    <li>
                        <a href="services.html">Tratamientos</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-8 col-md-offset-1">
                
                <div class="storefront-sorting" style="margin-bottom:40px;">
                    
                    <form class="form-inline">
                        
                        <div class="form-group">
                            <label class="grey" for="orderby">Ordena por:</label>
                            <select class="form-control orderby" name="orderby" id="orderby">
                                <option value="responsable" selected>Responsable</option>
                                <option value="beneficiario">Beneficiario</option>
                                <option value="pais">País</option>                               
                            </select>
                        </div>

                        <a href="#" id="ordenarCasos" name="ordenarCasos" onclick="OrdenarPor()">
                            <i class="arrow-icon-up-small"></i>
                        </a>
                        
                        <a href="#" id="toggle_shop_view" class=""></a>

                        <div class="form-group pull-right">
                            <label class="grey" for="showcount">Mostrar:</label>
                            <select class="form-control showcount" name="showcount" id="showcount">
                                <option value="18" selected>18</option>
                                <option value="27">27</option>
                                <option value="36">36</option>                                
                            </select>
                        </div>

                    </form>

                </div>


                <!-- <div class="columns-3"> -->
                <div id="productos-div" class="adv-table">
                    
                    <?php 
//var_dump($dataProvider->getData());
                    $this->widget('zii.widgets.CListView', array(
                        'id'=>'productos',
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'application.modules.bms.views.tDonacion._view',    
                        'summaryText'=>'Mostrando {start} - {end} de {count} Casos',
                        //'ajaxUpdate' => false,
                        'htmlOptions'=>array('class' => 'lista-productos','live'=>false),
                        'pager' => array(
                                //'cssFile' => Yii::app()->theme->baseUrl."/css/main2.css",
                                'htmlOptions'=>array('class'=>'pagination'),
                                'header' => '',
                                'firstPageLabel' => '<b><<</b>',
                                'lastPageLabel' => '<b>>></b>',
                                'prevPageLabel' => '<b><</b>',
                                'nextPageLabel' => '<b>></b>',
                                'selectedPageCssClass'=>'active',//default "selected"
                            ),
                        'pagerCssClass' => 'row',
                    )); ?>                    
                        
                 </div>   
                
            <!-- </div> --> <!-- eof .columns-* -->

                
                
           <!--eof  </div> .col-sm-8 (main content)-->
                            

            </div>
        </div>
    </div>
</section>

<?php

    }else{
       // throw new CHttpException(401, Yii::t('yii', 'No esta logueado.'));
       echo'<script>window.location="'.Yii::app()->homeUrl.'";</script>';
 
    }
?>


<div class="modal fade  bs-example-modal" id="modalPagoDonacionIndex" tabindex="-1" role="dialog" aria-labelledby="modalPagoDonacionLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalPagoCotLabel">Donar al Caso</h4>
                </div>
                <div class="modal-body">              

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn theme_button pull-right" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn theme_button color1 pull-right" id="enviarDonarIndex"><i class="fa fa-money"></i>&nbsp;Donar</button>
                </div>
            </div>
        </div>
    </div>


