
<?php
 Yii::app()->clientScript->registerScript('pagProductos',"
        var ajaxUpdateTimeout;
        var ajaxRequest;
        $('#showcount1').change(function(){
            ajaxRequest = {size:$('#showcount1').val()}
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
                    // this is the id of the CListView
                    'productos1',
                    {data: ajaxRequest}                    
                )
            },
            // this is the delay
            300);
        });



        ordenarPor= function()
        {
           ajaxRequest = {tipo:$('#orderby').val(),size:$('#showcount2').val()}            
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
                    'productos2',
                    {data: ajaxRequest}                    
                )
            },
             // this is the delay
            300);
        }


         $('#showcount2').change(function(){
            ajaxRequest = {size:$('#showcount2').val()}
            
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
                    // this is the id of the CListView
                    'productos2',
                    {data: ajaxRequest}                    
                )
            },
            // this is the delay
            300);
        });


        "
    );


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
                    
                   // $('#listaProdCategoria').html(data.catCount);

                   // if (data.marcaCount != '') {
                    //$('#listaProdCategoria').html(data.marcaCount);
                    //}
                    $('#productos-div1').html(data.gridProductos1).show();
                    $('#productos-div2').html(data.gridProductos2).show();
                    return false;
                   
                }
            });

            return false;
        }

        $('input#search').keyup(function(){

             ajaxRequest = {size:$('#showcount1').val(),search:$(this).val()}
            
            clearTimeout(ajaxUpdateTimeout);
            ajaxUpdateTimeout = setTimeout(function () {
                $.fn.yiiListView.update(
                    // this is the id of the CListView
                    'productos1',
                    {data: ajaxRequest}                    
                )
            },
            // this is the delay
            300);            
            
        });
            


        //$('#productos').find('.items').removeClass().addClass('columns-3');

 
     

    "
    );

?>
<section id="mainslider" class="ls mainslider">
    <div id="layerslider" style="width: 1920px; height: 600px;">
        <!-- slide 1 -->
        <div class="ls-slide" 
            data-ls="slidedelay: 5500; 
                    transition3d:28">
     
            <!-- slide background -->
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Fundacion/3.jpg" class="ls-bg" alt="Slide background">
            
            <p class="ls-slide"
                style="top: 100px; left: 280px; white-space: nowrap; font-size: 40px; font-weight: 300;"
                data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight">NOS UNIMOS SOLIDARIAMENTE <br>PARA QUE MAS FAMILIAS TENGAN ACCESO <br>A NUESTROS PRODUCTOS Y SERVICIOS</span>
            </p>

            <h3 class="ls-slide"
                style="top: 280px; left: 278px; white-space: nowrap; color: #000"
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                FUNDACI&Oacute;N BMS
            </h3>

            <div class="ls-slide"
                style="top: 360px; left: 285px; white-space: nowrap;"
                data-ls="offsetxin:0;
                        durationin:1600;
                        delayin:2000;
                        easingin:easeOutElastic;
                        offsetxout:left;
                        rotatexin:-90;
                        transformoriginin:50% top 0;
                ">
                <a href="#section-donaciones-recibidas" class="theme_button inverse">Mira las Familias Beneficiadas!!!</a>
            </div>
     
        </div>

        <!-- slide 2 -->
        <div class="ls-slide" 
            data-ls="slidedelay: 5500; 
                    transition2d:44">

            <!-- slide background -->
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Fundacion/2.jpg" class="ls-bg" alt="Slide background">

            <p class="ls-l" 
               style="top: 100px; left: 280px; white-space: nowrap; font-size: 40px; font-weight: 300;"
               data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight">RECURSOS QUE PROVIENEN DE <br>AMIGOS, CLIENTES, FAMILIARES<br> Y PUBLICO GENERAL</span>
            </p>
     
        </div>


        <!-- slide 3 -->
        <div class="ls-slide" 
            data-ls="slidedelay: 5500; 
                    transition3d:28">
     
            <!-- slide background -->
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Fundacion/1.jpg" class="ls-bg" alt="Slide background">
            
            <p class="ls-slide"
                style="top: 200px; left: 280px; white-space: nowrap; font-size: 50px; font-weight: 300;"
                data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight" style=" color: #FFF;">TRABAJAMOS DE LA MANO CON FUNDACIONES LOCALES!!!</span>
            </p>

            <div class="ls-slide"
                style="top: 350px; left: 285px; white-space: nowrap;"
                data-ls="offsetxin:0;
                        durationin:1600;
                        delayin:2000;
                        easingin:easeOutElastic;
                        offsetxout:left;
                        rotatexin:-90;
                        transformoriginin:50% top 0;
                ">
                <a href="#section-fundaciones" class="theme_button">Mira las Fundaciones !!!</a>
            </div>
        </div>

    </div>
</section>

<section id="sliderteasers" class="ls section_padding_0 columns_padding_0 table_section table_section_md">
    <div class="container">
        <div class="row">
            <div class="col-md-4 bg_teaser after_cover color_bg_1">
              
                <img src="images/teaser01.jpg" alt="">
                <div class="teaser_content">

                    <div class="teaser text-justify">
                        <h4 class="text-uppercase">BMS</h4>
                        <h3 class="highlight text-uppercase">Fundaci&oacute;n</h3>
                        <p>
                            En BMS nos unimos solidariamente para que más familias tengan acceso a nuestros productos y servicios, canalizando recursos que provienen de pÃºblico general, amigos, familiares y clientes generosos; y que recaudamos en nombre de familias que est&aacute;n en situaci&oacute;n de necesidad a trav&eacute;s de varios portales de donaciones...
                        </p>
                        <a href="services.html" class="theme_button inverse">Leer M&aacute;s</a>
                    </div>

                </div>
                                
            </div>

            <div class="col-md-4 bg_teaser after_cover color_bg_2">
               
                <img src="images/teaser02.jpg" alt="">
                <div class="teaser_content">

                    <div class="teaser text-justify">
                        <h4 class="text-uppercase">Tipos</h4>
                        <h3 class="highlight text-uppercase">Donativos</h3>
                        <ul>
                            <li>Gen&eacute;rico: distribuido a los candidatos en lista de espera.</li>
                            <li>Particular: especificas a que persona va dirigido tu donativo.</li>
                        </ul> 
                        <p style="margin-bottom: 76px;">                
                            <i class="fa fa-exclamation-circle fa-lg"></i> Nunca se entrega dinero en efectivo o electr&oacute;nico al receptor de la donaci&oacute;n, solo se entregan suplementos nutricionales o ex&aacute;menes de laboratorio por el monto de la donaci&oacute;n asignada.
                        </p>                         
                        <!-- <a href="#donacionesRecibidas" class="theme_button inverse">Ver Detalle</a> -->
                    </div>

                </div>
                
            </div>

            <div class="col-md-4 bg_teaser after_cover color_bg_3">
            
                <img src="images/teaser03.jpg" alt="">
                <div class="teaser_content">

                    <div class="teaser text-justify">
                        <h4 class="text-uppercase">Registro P&uacute;blico de</h4>
                        <h3 class="highlight text-uppercase">Donaciones</h3>
                        <p>
                            Queremos que toda la operaci&oacute;n de donaci&oacute;n y distribuci&oacute;n de los recursos se efectue de manera transparente. Los donativos gen&eacute;ricos se asignaran considerando la edad del paciente, tiempo en espera y monto solicitado. Los donativos particulares se asignaran directamente a la persona indicada en el donativo.
                        </p>  
                        <a href="#donacionesRecibidas" class="theme_button inverse">Ver Detalle</a>                     
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>




<section id="section-donaciones-recibidas" class="ls section_padding_0 columns_padding_0 table_section table_section_md">
    <div class="container">
       
        <div class="row"> 

            <div class="col-md-12">
                <div class="widget widget_search" style="margin-bottom:5px;">
                    <h2 style="margin-bottom:5px;"><i class="fa fa-check-circle fa-lg"></i> Donaciones Recibidas </h2>                 
                    <div class="" >                        
                        <?php
                        $sum=0; 
                        foreach($dataProvider1->getData() as $data){
                            $sum=$sum+ (float)$data->monto_conciliado;
                        }
                        echo '<h2 style="margin-bottom:5px;"> Total Donaciones Recibidas: '; echo $sum." $".'</h2>';
                       /* echo CHtml::checkBox('mostrar','publico',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Mesual '$monto'$",'data-off'=>"Anual", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"250",'data-height'=>"58",'data-size'=>"normal")); */?>
                    </div>
                    <form role="search" method="get" class="searchform form-inline" action="">
                        <div class="form-group">
                            <label class="screen-reader-text" for="search">ENCUENTRA TU DONACIÓN AQUÍ! </label>
                            <input value="" id="search" name="search" class="form-control" placeholder="INGRESA TU NOMBRE Y ENCUENTRA TU APORTE AQUI!!! " style="padding-left:10px !important;" type="text">
                        </div>
                        <!-- <button type="submit" class="theme_button" readonly>Buscar</button> -->
                        <a href="#" class="theme_button">Buscar</a>
                    </form>
                </div>                

                <div id="productos1-div" class="adv-table">
                    <div class="columns-4">  
                    <?php 
                        $this->widget('zii.widgets.CListView', array(
                        'id'=>'productos1',
                        'dataProvider'=>$dataProvider1,
                        'itemView'=>'application.modules.bms.views.tDonacionAdjudicado._viewDonacion',    
                        'summaryText'=>'<span class="pull-right" style="font-size:12px;">Mostrando {start} - {end} de {count} Donaciones</span>',
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
                                'selectedPageCssClass'=>'active',
                            ),
                        'pagerCssClass' => 'row',
                    )); ?>                    
                        
                    </div> 

                 </div>
                            

            </div>
        </div>
    </div>
</section>


<section id="section-donaciones-enviadas" class="ls section_padding_0 columns_padding_0 table_section table_section_md">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-arrow-circle-o-right fa-lg"></i> Donaciones Enviadas </h2>  
                    <div class="" >                        
                        <?php
                        $sum1=0; //print_r($dataProvider2->getData());
                        foreach($dataProvider2->getData() as $data){
                            $sum1=$sum1+ (float)$data->monto_conciliado;
                        }
                        echo '<h2 style="margin-bottom:5px;"> Total Donaciones Enviadas: '; echo $sum1." $".'</h2>';
                       /* echo CHtml::checkBox('mostrar','publico',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Mesual '$monto'$",'data-off'=>"Anual", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"250",'data-height'=>"58",'data-size'=>"normal")); */?>
                    </div>
            </div>
        </div>
        <div class="row"> 

           
            <div class="col-md-12">
                
                <div class="storefront-sorting" style="margin-bottom:40px;">
                    
                    <form class="form-inline">
                        
                        <div class="form-group">
                            <label class="grey" for="orderby">Ordena por:</label>
                            <select class="form-control orderby" name="orderby" id="orderby">
                                <option value="alta" selected>Donaci&oacute;n más Alta</option>
                                <option value="baja">Donaci&oacute;n más baja</option>
                                <option value="bene">Beneficiario</option> 
                                <option value="pais">País</option>                              
                            </select>
                        </div>

                        <a href="#" id="sort_view" name="sort_view" onclick="ordenarPor()">
                            <i class="arrow-icon-up-small"></i>
                        </a>
                        
                        
                        <div class="form-group pull-right">
                            <label class="grey" for="showcount">Mostrar:</label>
                            <select class="form-control showcount" name="showcount2" id="showcount2">
                                <option value="18" selected>18</option>
                                <option value="27">27</option>
                                <option value="36">36</option>                                
                            </select>
                        </div>

                    </form>

                </div>


                
                <div id="productos-div2" class="adv-table">
                  <div class="columns-4">  
                    <?php 

                        $this->widget('zii.widgets.CListView', array(
                        'id'=>'productos2',
                        'dataProvider'=>$dataProvider2,
                        'itemView'=>'application.modules.bms.views.tDonacion._viewBeneficiarios',    
                        'summaryText'=>'Mostrando {start} - {end} de {count} productos',
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
                                //'nextPageCssClass' => 'ClassName',
                                //'previousPageCssClass' => 'ClassName',
                                //'selectedPageCssClass' => 'ClassName',
                                //'internalPageCssClass' => 'ClassName',
                            ),
                        'pagerCssClass' => 'row',
                    )); ?>                    
                        
                 </div>   
                 </div>
                            

            </div>
        </div>
    </div>
</section>