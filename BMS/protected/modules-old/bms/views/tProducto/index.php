<?php 

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


?>

<?php 

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

        //zoom image
        // if (jQuery().elevateZoom) {
        //     jQuery('#product-image').elevateZoom({
        //         gallery: 'product-image-gallery',
        //         cursor: 'pointer', 
        //         galleryActiveClass: 'active', 
        //         responsive:true, 
        //         loadingIcon: 'img/AjaxLoader.gif'
        //     });
        // }




        function doModal(heading, formContent, valor, idModal) {
        html =  '<div id=\"'+idModal+'\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"'+idModal+'Label\">';
        html += '   <div class=\"modal-dialog\" role=\"document\">';
        html += '       <div class=\"modal-content\">';
        html += '           <div class=\"modal-header\">';
        html += '               <a class=\"close\" data-dismiss=\"modal\">×</a>';
        html += '               <h4 class=\"modal-title\" id=\"'+idModal+'Label\">'+heading+'</h4>'
        html += '           </div>';
        html += '           <div class=\"modal-body\">';
        html +=                 formContent;
        html += '               <input type=\"hidden\" name=\"idProducto\" id=\"idProducto\" value=\"'+valor+'\">';
        html += '          </div>';                
        html += '          <div class=\"modal-footer\">';
        if (valor != 0 )
            html += '               <span class=\"btn btn-primary\" id=\"delete\" name=\"delete\" data-id=\"'+valor+'\"><i class=\"fa fa-trash\"></i> Eliminar</span>';
        html += '               <span class=\"btn btn-default\" data-dismiss=\"modal\">Cerrar</span>';
        html += '           </div>';
        html += '       </div>';  // content
        html += '   </div>';  // dialog
        html += '</div>';  // modalWindow
        $('body').append(html);
        $(\"#\"+idModal).modal();
        $(\"#\"+idModal).modal('show');

        $('#'+idModal).on('hidden.bs.modal', function (e) {
            $(this).remove();
            $('.modal-backdrop').remove();
            $('body').removeAttr('class').removeAttr('style');
        });
    }


    verImg= function(idImg,idProducto,codigo,imgSrc1,imgSrc2,imgSrc3)
    {
    // $(document).on('click', '.lightbox', function(e) {
    //     e.preventDefault();

        var img1='';
        var img2='';
        var img3='';
        var img4='';
        var img5='';        

        switch(idImg) {
            case 1:
                img1='active';
                break;
            case 2:
                img2='active';
                break;
            case 3:
                img3='active';
                break;
            case 4:
                img4='active';
                break;
            case 5:
                img5='active';
                break;
            default:
                img1='active';                
            break;
        }        

        var formContent='<div id=\"myCarouselModal'+idProducto+'\" class=\"carousel slide\" data-ride=\"carousel\" data-interval=\"false\"><ol class=\"carousel-indicators\"><li data-target=\"#myCarouselModal'+idProducto+'\" data-slide-to=\"0\" class=\"'+img1+'\"></li><li data-target=\"#myCarouselModal'+idProducto+'\" data-slide-to=\"1\" class=\"'+img2+'\"></li><li data-target=\"#myCarouselModal'+idProducto+'\" data-slide-to=\"2\" class=\"'+img3+'\"></li></ol><div class=\"carousel-inner\"><div class=\"item '+img1+'\"><img src=\"'+imgSrc1+'\" alt=\"'+codigo+'\"></div><div class=\"item '+img2+'\"><img src=\"'+imgSrc2+'\" alt=\"'+codigo+'\"></div><div class=\"item '+img3+'\"><img src=\"'+imgSrc3+'\" alt=\"'+codigo+'\"></div></div></div>';
        var heading='Ver Producto '+idProducto+'';
        doModal(heading, formContent, 0, 'modalZoomProducto');

        return false;
    }


    addCartProducto= function(idProducto,precio)
    {
    //$('.add_to_cart_button_'+idProducto).click(function(){
        alert(idProducto);
        var cantidad = $('#TCarrito_cantidad_'+idProducto).val();
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TCarrito/create")."',
            data : {idP:idProducto,p:precio,c:cantidad}, 
            dataType:'json',           
            success : function (data) {
                
                $('#cart').html('<i class=\"rt-icon2-cart highlight\"></i><span class=\"grey\">Carrito:</span><span class=\"count\">'+data.totalProducto+' items, $'+data.totalCarrito+'</span>');

                $('.widget_shopping_cart .widget_shopping_cart_content .total .amount').html('$'+data.totalCarrito);

                $.fn.yiiListView.update('carrito-compra-list');
                
                $.fn.yiiListView.update('productos');

                return false;
            }
        });
        return false;
    //});
    }

        

    "
    );

?>

<section id="content" class="ls section_padding_top_50 section_padding_bottom_75">
    <div class="container">
        <div class="row">

            <div class="col-sm-9 col-md-9 col-lg-9">                

                <!-- <div class="storefront-sorting divider_40"> -->
                <div class="storefront-sorting" style="margin-bottom:40px;">
                    
                    <form class="form-inline">
                        
                        <div class="form-group">
                            <label class="grey" for="orderby">Ordena por:</label>
                            <select class="form-control orderby" name="orderby" id="orderby">
                                <option value="nombre" selected>Nombre</option>
                                <option value="mayorPrecio">Mayor Precio</option>
                                <option value="menorPrecio">Menor Precio</option>
                                <option value="posicion">Posición</option>                                
                            </select>
                        </div>

                        <a href="#" id="sort_view">
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
                    
                    <?php $this->widget('zii.widgets.CListView', array(
                        'id'=>'productos',
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'application.modules.bms.views.tProducto._view',    
                        'summaryText'=>'Mostrando {start} - {end} de {count} productos',
                        //'ajaxUpdate' => false,
                        'htmlOptions'=>array('class' => 'lista-productos','live'=>false),
                        // 'afterAjaxUpdate'=>'js:function(){
                        //     alert($(this).attr());
                        //     jQuery(this).fancybox();
                        // }',
                        //'ajaxUrl'=> Yii::app()->createUrl('seguridad'),
                  //       'sortableAttributes'=>array(
                  //           'descripcion',
                  //           'codigo',
                  //           'idMarca.nombres',                            
                  // ),
                        'pager' => array(
                                //'cssFile' => Yii::app()->theme->baseUrl."/css/main2.css",
                                'htmlOptions'=>array('class'=>'pagination'),
                                'header' => '',
                                'firstPageLabel' => '<b><<</b>',
                                'lastPageLabel' => '<b>>></b>',
                                'prevPageLabel' => '<b><</b>',
                                'nextPageLabel' => '<b>></b>',
                                'selectedPageCssClass'=>'active',//default "selected"
                                //'nextPageCssClass' => 'ClassName',
                                //'previousPageCssClass' => 'ClassName',
                                //'selectedPageCssClass' => 'ClassName',
                                //'internalPageCssClass' => 'ClassName',
                            ),
                        'pagerCssClass' => 'row',
                    )); ?>                    
                        
                 </div>   
                
            <!-- </div> --> <!-- eof .columns-* -->

                
                
            </div> <!--eof .col-sm-8 (main content)-->

            <!-- sidebar -->

            <aside class="col-sm-3 col-md-3 col-lg-3">

                <div class="widget widget_search">
                <!-- <h3 class="widget-title">Site Search</h3> -->
                    <form role="search" method="get" class="searchform form-inline" action="">
                        <div class="form-group">
                            <label class="screen-reader-text" for="search">Buscar por: </label>
                            <input type="text" value="" id="search" name="search" class="form-control" placeholder="nombre, código, marcas ... " style="padding-left:10px !important;">
                        </div>
                        <!-- <button type="submit" class="theme_button" readonly>Buscar</button> -->
                        <a href="#" class="theme_button">Buscar</a>
                    </form>
                </div>
                
         
                <div class="widget widget_categories">
                    <h3 class="widget-title">Categor&iacute;as</h3>
                    <ul id="listaProdCategoria">
                    <?php 
                        //print_r($catCount);
                    	if (count($catCount) > 0 ) {
                    		# code...
                    	
                    	foreach ($catCount as $key => $value) {
                    		# code...
                    	
                    ?>
                        <li>
                            <a href="#" onclick="js:buscarCat(<?php echo $value->idProductoCategoria->id_producto_categoria; ?>,'',$('input#search').val());" title=""><?php echo $value->idProductoCategoria->descripcion; ?></a> <span>(<?php echo $value->items; ?>)</span>
                        </li>        
                        <?php }} ?>  

                        <?php 
                        if (count($marcaCount) > 0 ) {
                    	foreach ($marcaCount as $key3 => $value3) {
                    		# code...
                    	
                    ?>
                        <li>
                            <a href="#" onclick="js:buscarCat(<?php echo $value3->idProductoCategoria->id_producto_categoria; ?>,<?php echo $value3->idMarca->id_datos_basicos; ?>,$('input#search').val());" title=""><?php echo $value3->idMarca->nombres; ?></a> <span>(<?php echo $value3->items; ?>)</span>
                        </li>        
                        <?php }} ?>      
                    </ul>
                </div>

<!-- <div class="widget widget_price_filter">
    
    <h3 class="widget-title">Precios</h3> -->
    
    <!-- price slider -->
    <!-- <form method="get" action="/" class="form-inline">
         
        <div class="slider-range-price"></div>

        <div class="form-group">
            <label class="grey" for="slider_price_min">Desde:</label>
            <input type="text" class="slider_price_min form-control text-center" id="slider_price_min" readonly>
        </div>

        <div class="form-group">
            <label class="grey" for="slider_price_max">-</label>
            <input type="text" class="slider_price_max form-control text-center" id="slider_price_max" readonly>
        </div>

        <div class="text-right">
            <button type="submit" class="theme_button inverse">Filtrar</button>
        </div>
    </form> -->
<!-- </div> -->


                

            </aside> <!-- eof aside sidebar -->


        </div>
    </div>
</section>

