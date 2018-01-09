<style type="text/css">

    .grises img {
filter: url('#grayscale'); /* Versión SVG para IE10, Chrome 17, FF3.5, Safari 5.2 and Opera 11.6 */
-webkit-filter: grayscale(100%);
-moz-filter: grayscale(100%);
-ms-filter: grayscale(100%);
-o-filter: grayscale(100%);
filter: grayscale(100%); /* Para cuando es estándar funcione en todos */
filter: Gray(); /* IE4-8 and 9 */

-webkit-transition: all 0.5s ease;
-moz-transition: all 0.5s ease;
-ms-transition: all 0.5s ease;
-o-transition: all 0.5s ease;
transition: all 0.5s ease;
}
.grises img:hover {
-webkit-filter: grayscale(0%);
-moz-filter: grayscale(0%);
-ms-filter: grayscale(0%);
-o-filter: grayscale(0%);
filter: none;

-webkit-transition: all 0.5s ease;
-moz-transition: all 0.5s ease;
-ms-transition: all 0.5s ease;
-o-transition: all 0.5s ease;
transition: all 0.5s ease;
}

</style>
<section class="page_topline ls ms section_padding_0 table_section table_section_md">
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-center text-md-left">
        <div class="page_social_icons">
            <a class="soc-facebook" href="#" title="Facebook">#</a><a class="soc-twitter" href="#" title="Twitter">#</a><a class="soc-google" href="#" title="Google">#</a><a class="soc-linkedin" href="#" title="LinkedIn">#</a>
        </div>
            </div>

            <div class="col-md-9 text-center text-md-right">

                <span>
                    <!-- <i class="rt-icon2-pin-alt highlight"></i> Calle 50, PH Plaza Morica San Francisco, Panamá -->
                    <i class="rt-icon2-pin-alt highlight"></i> Panamá
                </span>

                <span>
                    <i class="rt-icon2-newspaper-alt highlight"></i> +507 836 7065
                </span>

                <span>
                    <i class="rt-icon2-envelope highlight"></i> biometabolicservice@gmail.com
                </span>

            </div>

        </div>
    </div>
</section>

<header class="page_header header_white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <a href="./" class="logo top_logo" style="font-size:28px;padding-top:36px">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" style="width:78px" alt="">Bio Metabolic Service
                </a>
            <!-- header toggler -->
            <span class="toggle_menu"><span></span></span>
          </div>
          <div class="col-lg-8 col-md-8 text-right">
                <!-- main nav start -->
                <nav class="mainmenu_wrapper">
                    <ul class="mainmenu nav sf-menu">
                        <li class="active">
                            <a href="#about" style="font-size:18px;">Nosotros</a>
                        </li>

                        <li>
                            <a href="#pre-featured" style="font-size:18px;">Productos</a>
                        </li>

                        <!-- <li>
                            <a href="#blog">Servicios</a>
                        </li> -->

                        <li>
                            <a href="#pre-featured-medico" style="font-size:18px;">M&eacute;dicos</a>
                        </li>

                        <li>
                            <a href="#pre-donaciones" style="font-size:18px;">Donaci&oacute;n</a>
                        </li>

                        <li>
                            <a href="#page_footer" style="font-size:18px;">Contacto</a>
                        </li>

                        <li><?php //echo "Usuario:".Yii::app()->session['_id']; ?>
                            <button onclick="js: $('#registro').show(); " class="btn" type="button" style="background:#820906; color: white; font-weight: bolder; font-size:18px;">Ingresa ya</button>

                        </li>

                    </ul>
                </nav>
                <!-- eof main nav -->
            </div>
        </div>

        <div class="row well" id="registro" style="display:none;">
            <div class="pull-right"><a href="#" onclick="js:$('#registro').hide();" title="Cerrar"><i class="fa fa-times-circle fa-lg highlight"></i></a></div>
            <?php
            $modelUsuario=new TUsuario;
            $modelDB=new TDatosBasicos;
            $modelDireccion=new TDatosBasicosDireccion;
            $model = new LoginForm();
            $this->renderPartial('_formNuevo',array('model'=>$model,'modelUsuario'=>$modelUsuario,'modelDB'=>$modelDB,'modelDireccion'=>$modelDireccion));?>
        </div>



    </div>
</header>

<section id="mainslider" class="ls mainslider">
    <div id="layerslider" style="width: 1920px; height: 800px;">
        <!-- slide 1 -->
        <div class="ls-slide"
            data-ls="slidedelay: 5500;
                    transition2d:44">

            <!-- slide background -->
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bms_1.jpg" class="ls-bg" alt="Slide background">

            <p class="ls-slide"
               style="top: 230px; left: 380px; white-space: nowrap; font-size: 50px; font-weight: 300;"
               data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight" style="color:#fccd0e; text-shadow: 2px 2px #3191ED;">Somos una sociedad creada para respaldar el bienestar</span>
            </p>

            <h3 class="ls-l highlight"
                style="top: 290px; left: 380px; white-space: nowrap;color:#fccd0e;"
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                y la Salud de la Familia!
            </h3>
        </div>

        <!-- slide 2 -->
        <div class="ls-slide"
            data-ls="slidedelay: 5500;
                    transition2d:24">

            <!-- slide background -->
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bms_2.jpeg" class="ls-bg" alt="Slide background">


            <p class="ls-slide"
                style="top: 230px; left: 380px; white-space: nowrap; font-size: 50px; font-weight: 300;"
                data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight" style="color:#EE110D;text-shadow: 2px 2px #123265">Apoyamos la Medicina Integrativa - la Visión Holística del Ser </span>
            </p>



            <h3 class="ls-l highlight"
                style="top: 290px; left: 380px; white-space: nowrap;color:#EE110D;"
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                "> <!-- 25 lETRAS -->
                Restablece tu Equilibrio!
            </h3>


            <!-- <h3 class="ls-l highlight"
                style="top: 290px; left: 372px; white-space: nowrap; color:#EE110D;"
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                para Promover y Restablecer su Equilibrio!
            </h3>         -->
        </div>

        <!-- slide 3 -->
        <div class="ls-slide"
            data-ls="slidedelay: 5500;
                    transition2d:24">

            <!-- slide background -->
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bms_33.jpg" class="ls-bg" alt="Slide background">

            <p class="ls-slide"
                style="top: 230px; left: 380px; white-space: nowrap; font-size: 50px; font-weight: 300;"
                data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight" style="color: #D3F5FE; text-shadow: 2px 2px #02283B;">Reconocer Nuestras Emociones son el Inicio de la Recuperación</span>
            </p>

            <h3 class="ls-l highlight"
                style="top: 290px; left: 372px; white-space: nowrap; color: #D3F5FE; "
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                Apoyados en Familia y Amigos!
            </h3>

        </div>

        <!-- slide 4 -->
        <div class="ls-slide"
            data-ls="slidedelay: 5500;
                    transition3d:28">

            <!-- slide background -->
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bms_4.jpg" class="ls-bg" alt="Slide background">

            <p class="ls-slide"
                style="top: 230px; left: 380px; white-space: nowrap; font-size: 50px; font-weight: 300;"
                data-ls="offsetxin:-100;
                        durationin:1200;
                        delayin:200;
                        easingin:easeOutExpo;
                        offsetxout:100;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:left 50% 0;
                ">
                <span class="highlight" style=" color: #093104; text-shadow: 2px 2px #FFF;">Todos Somos Merecedores de Paz, Armonía y Bienes Materiales</span>
            </p>

            <h3 class="ls-l highlight"
                style="top: 290px; left: 372px; white-space: nowrap; color: #093104; "
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                Amor, Salud Física y Espiritual!
            </h3>

        </div>


    </div>
</section>

<section id="about" class="ls section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <h2 class="widget-title">Quienes Somos</h2>

                <div class="panel-group" id="accordion">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    La Empresa
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" alt="" width="50">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        Somos una sociedad fundada en 2014 especializada en evaluaciones y tratamientos para desórdenes metabólicos, inmunológicos, nutricionales, tóxicos e infecciosos.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">
                                    Qué Hacemos?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/recent_post2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        Comercializamos exámenes de laboratorio especiales, suplementos nutricionales y otros productos y servicios para apoyar a los médicos en la recuperación de sus pacientes.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed">
                                    Donde Estamos?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/recent_post1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        Aunque estamos administrativamente en la ciudad de Panamá operamos con la ayuda de aliados en varios países de Latinoamérica.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="collapsed">
                                    Nuestro Objetivo
                                </a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/recent_post2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        Queremos apoyarte en el proceso de recuperación de tu salud o la de tu familiar!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="collapsed">
                                    Outpatient Surgery
                                </a>
                            </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/recent_post1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        Consetetur sadipscing elitr, sed diam nonumy eirmod tempor.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>

            </div>

            <div class="col-md-4">

                <h2 class="widget-title">Servicios</h2>

                <!-- <p>Duis autem veiudolorn hendrerit vulputate velit esse molestie. consequat, vel illum dolore eu feugiat nulla facilisis at vereros accumsan etiusto dignissim:</p> -->


                <ul class="list1 darklinks">
                    <li>
                        <a href="#medico">Enlace con médicos de prestigio en Medicina Integrativa.</a>
                    </li>
                    <li>
                        <a href="#productos">Venta de exámenes de afamados laboratorios a nivel Mundial.</a>
                    </li>
                    <li>
                        <a href="#productos">Venta de vitaminas, minerales, ácidos grasos, probióticos, antioxidantes, aminoácidos, encimas, reguladores inmunológicos, extractos botánicos, desintoxicantes, productos y equipos especiales de la mejor calidad.</a>
                    </li>
                    <li>
                        <a href="#productos">Terapia Bioenergética a distancia</a>
                    </li>
                    <li>
                        <a href="#">Administración de su compra a través de su portal de cliente.</a>
                    </li>
                </ul>


            </div>

            <div class="col-md-4">
                <h2 class="widget-title">Ventajas</h2>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab1" role="tab" data-toggle="tab" style="padding-right: 15px; padding-left: 15px; ">Atención</a></li>
                    <li><a href="#tab2" role="tab" data-toggle="tab" style="padding-right: 15px; padding-left: 15px; ">Presupuestos</a></li>
                    <li><a href="#tab3" role="tab" data-toggle="tab" style="padding-right: 15px; padding-left: 15px; ">Donaciones</a></li>
                    <!-- <li><a href="#tab4" role="tab" data-toggle="tab">Despachos</a></li>
                    <li><a href="#tab5" role="tab" data-toggle="tab">Donaciones</a></li> -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <p class="featured-tab-image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/" alt="">
                        </p>
                        <ul class="list1 darklinks">
                            <li>Atención a distancia! No requieres moverte de tu casa, ciudad o país!</li>
                            <li>Asesoría para que logres tu objetivo de salud: manejo de recursos, selección de especialistas, y otras áreas de interés</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <p class="featured-tab-image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/progress.jpg" alt="">
                        </p>
                        <ul class="list1 darklinks">
                            <li>Elaboramos presupuestos detallados para que estimes correctamente los recursos necesarios para apoyar tu proceso de recuperación.</li>
                            <li>Despachos parciales para maximizar el uso de tu dinero</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <p class="featured-tab-image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/family/family1.png" alt="">
                        </p>
                        Con nuestro portal de donaciones te apoyamos en caso de requerir ayudas económicas para cubrir tus gastos de recuperación.
                    </div>

                </div>


            </div>

        </div>
    </div>
</section>

<section id="pre-featured" class="ls ms section_padding_50 table_section">
    <div class="container">
        <div class="row text-xs-center">
            <div class="col-sm-9 to_animate" data-animation="pullDown">
                <h2 class="margin_0"><span class="highlight">Te Asesoramos en Todo el Proceso de Compra </span><br><span class="thin"> Ingresa Ya! y Comienza a Disfrutar de Todos Nuestros Servicios! </span></h2>
            </div>
            <div class="col-sm-3 to_animate text-right text-xs-center" data-animation="pullDown">
                <a href="#" class="theme_button inverse">Ingresar</a>
            </div>

        </div>
    </div>
</section>

<section id="featured" class="cs parallax section_padding_bottom_0 section_padding_top_100">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-push-4" style="padding-right: 0px;">
                <h2 class="section_header">
                    Llegaste al Sitio Indicado!!!
                </h2>
                <p style="font-size: 16px;">
                    Te ofrecemos los mejores servicios para la evaluación y tratamiento de tu salud a través de la medicina integrativa!
                 </p>
                 <div class="row">
                     <div class="col-lg-6">
                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-flask"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Exámenes de Laboratorio!</a>
                                </h3>
                                <p>disponibles en tu país y de afamados laboratorios a nivel Mundial!</p>
                            </div>
                        </div>


                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-cutlery"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Utensilios de Cocina!</a>
                                </h3>
                                <p>te permiten mantener los nutrientes de los alimentos evitando toxinas</p>
                            </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Suplementos Nutricionales!</a>
                                </h3>
                                <p>Gran variedad de suplementos y productos especiales de las mejores casas del ramo!</p>
                            </div>
                        </div>


                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-tint"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Equipos de Purificación Aire y Agua!</a>
                                </h3>
                                <p>Equipos con las tecnologías mas avanzadas adaptados a todos los presupuestos!</p>
                            </div>
                        </div>
                     </div>
                 </div>
            </div>

            <div class="col-md-4 col-md-pull-8 text-center to_animate" data-animation="fadeInLeft">
                <img id="featured-person" class="top-overlap" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/girl.png" alt="">
            </div>


        </div>
    </div>
</section>


<section id="pre-featured-medico" class="ls ms section_padding_50 table_section">
    <div class="container">
        <div class="row text-xs-center">
            <div class="col-sm-9 to_animate" data-animation="pullDown">
                <h2 class="margin_0"><span class="highlight">Contacta Supervisión Medica Especializada </span><br><span class="thin"> Ingresa Ya! y Comienza a Disfrutar de Todos Nuestros Servicios </span></h2>
            </div>
            <div class="col-sm-3 to_animate text-right text-xs-center" data-animation="pullDown">
                <a href="#" class="theme_button inverse">Ingresar</a>
            </div>

        </div>
    </div>
</section>


<section id="medico" class="ls section_padding_50">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center to_animate" data-animation="fadeInDown">
                <h2 class="section_header">Asesoría Médica</h2>
                <p>Te ponemos en contacto con médicos independientes que trabajan en varias partes del mundo y que a través de nuestro portal de cliente están mas cerca de ti!</p>
                <!-- <div>
                    <a href="blog-right.html" class="theme_button inverse">Go To Blog</a>
                </div> -->
            </div>
        </div>
    </div>
</section>
<section class="ls ms section_padding_75">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel" data-dots="true">
                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/01.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->

                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/02.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->

                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/03.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->

                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/04.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->

                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/05.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->

                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/06.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->

                    <div class="item">
                        <div class="thumbnail">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/team/07.jpg" alt="">
                            <div class="caption">
                                <h3>
                                    <a href="team-single.html">Michael Bean</a>
                                </h3>
                                <p>Director</p>
                                <p class="text-center social-icons">
                                    <a class="soc-facebook" href="#" title="Facebook" data-toggle="tooltip">#</a>
                                    <a class="soc-twitter" href="#" title="Twitter" data-toggle="tooltip">#</a>
                                    <a class="soc-google" href="#" title="Google" data-toggle="tooltip">#</a>
                                </p>
                            </div>
                        </div>
                    </div> <!-- eof item -->


                </div>
            </div>
        </div>
    </div>
</section>

<section id="pre-donaciones" class="ls ms section_padding_50 table_section">
    <div class="container">
        <div class="row text-xs-center">
            <div class="col-sm-9 to_animate" data-animation="pullDown">
                <h2 class="margin_0"><span class="highlight">Te Apoyamos Si Requieres Ayuda Económica </span><br><span class="thin"> Ingresa Ya! y Comienza a Disfrutar de Todos Nuestros Servicios </span></h2>
            </div>
            <div class="col-sm-3 to_animate text-right text-xs-center" data-animation="pullDown">
                <a href="<?php echo Yii::app()->createUrl('site/loginDonar'); ?>" class="theme_button inverse">Donar</a>
            </div>

        </div>
    </div>
</section>

<section id="donaciones" class="cs parallax section_padding_bottom_0 section_padding_top_100">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-push-4" style="padding-right: 0px;">
                <h2 class="section_header">
                    Envía o Recibe tu Donación!!!
                </h2>
                <p style="font-size: 16px;">
                    A través de la Fundación BMS tendrás la oportunidad de ayudar a otros! o de exponer en detalle que ayudas económicas necesitas!
                 </p>
                 <div class="row">
                     <div class="col-lg-6" style="padding-right: 0px;">
                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-hospital-o"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="<?php echo Yii::app()->createUrl('site/loginDonar'); ?>">Donación</a>
                                </h3>
                                <p>Efectúa una donación a la familia de tu preferencia!</p>
                            </div>
                        </div>


                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-user-md"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="<?php echo Yii::app()->createUrl('site/loginDonar'); ?>">Confianza</a>
                                </h3>
                                <p>Pacientes, médicos y fundaciones reales! Entregamos solo productos y servicios!</p>
                            </div>
                        </div>
                     </div>

                     <div class="col-lg-6" style="padding-right: 0px;">
                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="<?php echo Yii::app()->createUrl('site/loginDonar'); ?>">Recolecta de Fondos</a>
                                </h3>
                                <p>Para que amigos y familiares colaboren con tu causa! Arma tu caso</p>
                            </div>
                        </div>


                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-medkit"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="<?php echo Yii::app()->createUrl('site/donar'); ?>">Fundación BMS</a>
                                </h3>
                                <p>Ayúdanos, tenemos un plan propio para colaborar con otros!</p>
                            </div>
                        </div>
                     </div>
                 </div>
            </div>

            <div class="col-md-4 col-md-pull-8 text-center to_animate" data-animation="fadeInLeft">
                <img id="featured-person" class="top-overlap" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/family/family9.png" alt="">   <!-- family3.png -->
            </div>


        </div>
    </div>
</section>




<section id="partners" class="ls parallax section_padding_0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="partners-carousel" class="owl-carousel grises" data-nav="true">
                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/culturelle.fw.png" alt="">
                        </a>

                    </div>

                    <div >
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/kirkman.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/prothera.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/now.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/holistic-health.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/houston-enzymes.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/klaire.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/marcas/pure-labs.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Laboratorios/greatplains.fw.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/Laboratorios/mayo.fw.png" alt="">
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section id="progress" class="cs main_color2 section_padding_50 parallax">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6">

                <div class="teaser text-center">
                    <div class="teaser_icon grey size_normal">
                        <i class="fa fa-user-md"></i>
                    </div>
                    <h3 class="counter highlight" data-from="0" data-to="10" data-speed="1800">0</h3>
                    <p>Médicos</p>
                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="teaser text-center">
                    <div class="teaser_icon grey size_normal">
                        <i class="fa fa-thumbs-o-up"></i>
                    </div>
                    <h3 class="counter highlight" data-from="0" data-to="100" data-speed="2100">0</h3>
                    <p>Clientes</p>
                </div>

            </div>


            <div class="col-md-3 col-sm-6">

                <div class="teaser text-center">
                    <div class="teaser_icon grey size_normal">
                        <i class="fa fa-hospital-o"></i>
                    </div>
                    <h3 class="counter highlight" data-from="0" data-to="10" data-speed="1400">0</h3>
                    <p>Marcas</p>
                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="teaser text-center">
                    <div class="teaser_icon grey size_normal">
                        <i class="fa fa-trophy"></i>
                    </div>
                    <h3 class="highlight counter-wrap">
                        <span class="counter" data-from="0" data-to="2" data-speed="1500">0</span><span class="counter-add">+</span>
                    </h3>
                    <p>Paises</p>
                </div>

            </div>
        </div>
    </div>
</section>
