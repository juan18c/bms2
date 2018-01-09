
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
        if (confirm('Confirma que desea realizar la donación?')){
             $(this).attr('disabled','disabled');
            $.ajax({
                type : 'POST',
                url : '".Yii::app()->createUrl("bms/TDonacionAdjudicado/create/id")."/'+$('#TDonacionAdjudicado_id_donacion').val(),            
                dataType:'json',      
                data: $('#tdonacion-adjudicado-form').serialize(),
                success : function (data) {  
                    $('#enviarDonarIndex').removeAttr('disabled');   
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
        }
    });


");



    Yii::app()->clientScript->registerScript('searchProductos',"
        var ajaxUpdateTimeout;
        var ajaxRequest;

        OrdenarPor= function(search)
        {
           

           ajaxRequest = {search: search,tipo:$('#orderby').val(),size:$('#showcount').val()}
            
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

            OrdenarPor($(this).val());

            //$.fn.yiiListView.update('productos',{data: ajaxRequest});
            return false;
            
            
        });
            


        $('#productos').find('.items').removeClass().addClass('columns-3');
        $('#products1').toggleClass('grid-view list-view');

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

    $datos=TDonacion::model()->find('id_donacion=1');

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

                 <!-- <div class="entry-excerpt">
                    <p>
                    Aqui encontrar&aacute;s todo lo que necesitas para la sanaci&oacute;n de tu cuerpo a trav&eacute;s de las vitaminas, minerales y dem&aacute;s productos que te ayudaran a fortalecer tu sistema inmune. Acompa&ntilde;ados de los mejores especialistas segun tus necesidades y contando con nuestro apoyo en toda las fases de tu tratamiento.
                    </p>

                    <p>
                    Gracias por formar parte de nuestra familia.
                    </p>
                </div>                

                 <!--<ul class="list1 darklinks">
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
                </ul>-->


    <ul id="products1" class="products list-unstyled list-view"> 

    <li class="product type-product">
    <div class="side-item">
    
        <div class="row">
            <div class="col-md-4">                

                <div id="myCarousel<?php echo $datos->id_donacion; ?>" class="carousel slide" data-ride="carousel" data-interval="false">

                <img  src="<?php echo Yii::app()->request->baseUrl.'/'.$datos->foto; ?>" alt="<?php echo $datos->codigo_donacion; ?>" onclick="js:window.location='<?php echo Yii::app()->createUrl("bms/TDonacion/detalleDonacion",array('id'=>$datos->id_donacion))?>'">                    
                </div>       
            </div>
            <div class="col-md-8" style="padding: 8px 20px 8px 20px;"> <!-- style="padding: 5px;" -->
                <h2><?php $esp=utf8_encode(" "); echo str_pad($datos->nombre_caso, 50,$esp); ?></h2>
                <label class="cause-days-togo label label-default"><?php echo date( 'd-m-y',strtotime($datos->fecha_creacion)) ?></label>  
                <div class="progress-label" style="font-size: 16px">
                   <?php
                   $porc=intval(floatval($datos->monto_acumulado)*100/floatval($datos->monto_solicitado));
                    echo $porc; ?>% donado de <span>$<?php echo $datos->monto_solicitado ?></span>                            
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $porc;?>" aria-valuemin="0" aria-valuemax="100" ></div>
                </div>
                 <p class="product-description">
                    <?php
                        //echo "<label style='font-weight: bold;'>Beneficiario:&nbsp;&nbsp;&nbsp;</label>".$beneficiario."<br>"."<label style='font-weight: bold;'>Responsable:&nbsp;&nbsp;&nbsp;</label>".$responsable."<br>";
                        echo "<label style='font-weight: bold;'>País:&nbsp;&nbsp;&nbsp;</label>".TDatosBasicosDireccion::model()->findByPk($datos->idCotizacion->idCarrito->id_direccion)->idPais->descripcion; 
                    ?>
                </p>
                 
                <?php if ($datos->id_estatus==1){ ?>                         
                <button type="button" class="theme_button inverse add_to_cart_button_<?php echo $datos->id_donacion; ?>" onclick=" verImg(<?php echo $datos->id_donacion; ?>); return false;" >
                    <i class="fa fa-money"></i>
                    Donar
                </button>

                 <?php } ?> 
                <!-- <div class="star-rating star-right" title="Rated 4.50 out of 5">
                    <span style="width:40%">
                        <strong class="rating">4.50</strong> out of 5
                    </span>
                </div> EVALUAR MAS ADELANTE CON LOS INDICADORES DE INTERES PARA REINALDO -->
            </div>
        </div>
    </div>
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
                    <br>
            <aside class="">

                <div class="widget widget_search">
                <!-- <h3 class="widget-title">Site Search</h3> -->
                    <form role="search" method="get" class="searchform form-inline" action="">
                        <div class="form-group">
                            <label class="screen-reader-text" for="search">Buscar por: </label>
                            <input type="text" value="" id="search" name="search" class="form-control" placeholder="Buscar por Beneficiario, Responsable, País... " style="padding-left:10px !important;">
                        </div>
                        <!-- <button type="submit" class="theme_button" readonly>Buscar</button> -->
                        <a href="#" class="theme_button">Buscar</a>
                    </form>
                </div>               
 
            </aside> <!-- eof aside sidebar -->

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
                    <button type="button" onclick="js:$('#tdonacion-adjudicado-form')[0].reset();" class="btn theme_button pull-right" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn theme_button color1 pull-right" id="enviarDonarIndex"><i class="fa fa-money"></i>&nbsp;Donar</button>
                </div>
            </div>
        </div>
    </div>


