<?php
    //Yii::app()->clientScript->reset(); 
    
    Yii::app()->clientScript->scriptMap = array(
        'jquery.js'     => false,
        'jquery.min.js' => false,
        // 'core.css'      => false,
        'styles.css'    => false,
        // 'pager.css'     => false,
        'default.css'   => false,
        //'bootstrap-yii.css'=> false,
        //'jquery-ui-bootstrap.css'=>false,
        'bootstrap.min.css'=>false,
        // 'bootbox.min.js'=>false,
        // 'notify.min.js'=>false,
        // 'bootstrap-noconflict.js'=>false,
        'bootstrap.min.js'=>false
    );
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>Caso BMS </title>
    <link rel="image_src" href="http://www.biometabolicservice.com/images/2-caso.jpg" />

    <meta charset="utf-8">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->

    <meta property="og:url" content="http://biometabolicservice.com/index.php/site/detalleCaso?idDonacion=2" />  
    <meta property="og:title" content="Haz tu donación" />
    <meta property="og:description" content="Caso BMS puedes donar en cualquier momento" />  
    <meta property="og:image" content="http://biometabolicservice.com/images/FotoCasos/1-caso.jpg" />
  
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main2.css" id="color-switcher-link">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animations.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fonts.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/layerslider/css/layerslider.css">

    <!--toggle css-->
    <!-- <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css"> -->

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">   

    <!--pickers css-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/modernizr-2.6.2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox-4.0.2/dist/ekko-lightbox.css" media="screen" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" media="screen" />

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />


   
    <!--[if lt IE 9]>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/html5shiv.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/respond.min.js"></script>
    <![endif]-->

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

    .features-list {
        margin-top: 0px !important;
    }

</style>

</head>

<body>
    <!--[if lt IE 9]>
        <div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
    <![endif]-->

<!-- wrappers for visual page editor and boxed version of template -->
<div id="canvas">
<div id="box_wrapper">

<!-- template sections -->

<?php echo $content; ?>

<section class="ls section_padding_50" id="section-fundaciones">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center to_animate" data-animation="fadeInDown">
                <div class="owl-carousel single-slide"
                    data-loop="false"
                    data-autoplay="true"
                    data-margin="0"
                    data-nav="false"
                    data-dots="true"
                    data-items="1"
                    data-responsive-xs="1"
                    data-responsive-sm="1"
                    data-responsive-md="1"
                    data-responsive-lg="1"
                >
                    
                    <div>
                        
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Fundacion/colaboradores/1.png" style="width: 20%; margin: 0 auto; text-align: center;">
                        
                        <h3 class="thin">
                            Sovenia, <span class="highlight">Sociedad Venezolana para Niños Autistas</span>
                        </h3>
                    </div>
                    
                    <div>
                        
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Fundacion/colaboradores/3.png" style="width: 20%; margin: 0 auto; text-align: center;">
                        
                        <h3 class="thin">
                            Autismo en Voz Alta, <span class="highlight">Fundaci&oacute;n ONG</span>
                        </h3>
                    </div>

                    <div>
                       
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Fundacion/colaboradores/2.png" style="width: 20%; margin: 0 auto; text-align: center;">
                        
                        <h3 class="thin">
                            BMS, <span class="highlight">Bio Metabolic Service</span>
                        </h3>
                    </div>

  
                </div>
            </div>
        </div>
    </div>
</section>


<footer id="page_footer" class="page_footer ds ms bg_image section_padding_75">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6 to_animate">
                <div class="widget widget_text">
                    <h3 class="widget-title">Fundación BIO METABOLIC SERVICE</h3>
                    <p align="justify">
                        En Bio Metabolic Service nos unimos solidariamente para que mas familias tengan acceso a nuestros productos y servicios, canalizando recursos que provienen de publico general, amigos, clientes y familiares generosos y que recaudamos en nombre de familias que estan en situacion de necesidad a traves de varios portales de donaciones o que recibimos de manera directa a traves de transferencias a las cuentas de la empresa. <br><br>

                        Trabajamos de la mano de fundaciones locales que postulan a los candidatos a recibir el apoyo verificando ademas la verdadera necesidad de los pacientes, datos medicos y situacion socio economica.<br><br>

                        Nunca se entrega dinero en efectivo o electronico al receptor de la donacion, solo se entregan suplementos nutricionales o examenes de laboratorio por el monto de la donacion asignada.

                    </p>
                    
                </div>
            </div>
                
            <!-- <div class="col-md-3 col-sm-6 to_animate">
                <div class="widget widget_recent_entries">
                    <h3 class="widget-title">Latest Posts</h3>
                    <ul>
                        <li>
                            <p class="post-date">
                                <a href="blog-single-right.html">23 Feb '15</a>
                            </p>
                            <p>Lorem ipsum dolor simet </p>
                        </li>
                        <li>
                            <p class="post-date">
                                <a href="blog-single-right.html">12 Feb '15</a>
                            </p>
                            <p>Consetetur spselitrsed diam</p>
                        </li>
                        <li>
                            <p class="post-date">
                                <a href="blog-single-right.html">03 Feb '15</a>
                            </p>
                            <p>Nonumy eirmod tempor</p>
                        </li>
                    </ul>
                </div>
            </div> -->
                
            <div class="col-md-4 col-sm-6 to_animate">
                <div class="widget widget_text">
                    <h3 class="widget-title">Cont&aacute;ctenos</h3>
                    <!-- <p>Calle 50, PH Plaza Morica. San Francisco, Ciudad de Panam&aacute;, Panam&aacute;</p> -->
                    <p>Ciudad de Panam&aacute;, Panam&aacute;</p>
                    <div class="border-paragraphs">
                        <p>
                            <i class="highlight2 rt-icon2-phone-outline"></i> +507 836 7065
                        </p>
                        <p>
                            <i class="highlight2 rt-icon2-globe3"></i> <a href="./" style="color:#fff;">www.biometabolicservice.com</a>
                        </p>
                        <p>
                            <i class="highlight2 rt-icon2-mail2"></i> <a href="mailto:biometabolicservice@gmail.com" style="color:#fff;">biometabolicservice@gmail.com</a>
                        </p>
                        
                    </div>
                    
                </div>
            </div>
                            
            <div class="col-md-2 col-sm-6 to_animate">
                <div class="widget widget_text">
                    <h3 class="widget-title">Encuentranos</h3>
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" class="color-icon bg-icon rounded-icon soc-facebook">#</a>
                        </div>
                        <div class="media-body media-middle">
                            Facebook
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" class="color-icon bg-icon rounded-icon soc-twitter">#</a>
                        </div>
                        <div class="media-body media-middle">
                            Twitter
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" class="color-icon bg-icon rounded-icon soc-google">#</a>
                        </div>
                        <div class="media-body media-middle">
                            Google+
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" class="color-icon bg-icon rounded-icon soc-linkedin">#</a>
                        </div>
                        <div class="media-body media-middle">
                            LinkedIn
                        </div>
                    </div>
                    
                    
                </div>

            </div>
        </div>
    </div>
</footer>

<section class="page_copyright ls section_padding_50">
    <div class="container">
        <div class="row to_animate">
            <div class="col-sm-12 text-center">
                <a href="./" class="logo vertical_logo" style="color:#820906;">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.fw.png" alt=""><br>Maximizar el potencial humano
                </a>
            </div>
            <div class="col-sm-12 text-center">
                <p>Copyright 2017. Bio Metabolic Service S.A.</p>
            </div>
        </div>
    </div>
</section>

</div><!-- eof #box_wrapper -->
</div><!-- eof #canvas -->

<!--<div class="preloader">
    <div class="preloader_image"></div>
</div>-->

        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/compressed.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>
        
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
        <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>

        <script src=" <?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery.elevateZoom-3.0.8.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/fancybox/jquery.fancybox.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox-4.0.2/dist/ekko-lightbox.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-creditcardvalidator/jquery.creditCardValidator.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>       
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>

       
        <!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->
        
        
    </body>
</html>