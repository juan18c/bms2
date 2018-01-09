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
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta charset="utf-8">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
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

<footer id="page_footer" class="page_footer ds ms bg_image section_padding_75">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6 to_animate">
                <div class="widget widget_text">
                    <h3 class="widget-title">Por que escogernos?</h3>
                    <!-- <p> -->
                    <ul>
                        <li>
                            <p class="post-date">
                            Queremos apoyarte en el proceso de recuperación de tu salud o la de tu familiar!
                            </p>
                        </li>
                        <li>
                            <p class="post-date">
                            Continuamente acumulamos experiencia de varios casos y bajo diferentes ópticas terapéuticas!
                            </p>
                        </li>
                        <li>
                            <p class="post-date">
                            Siempre estamos ubicando especialistas reconocidos de Medicina Integrativa!
                            </p>
                        </li>
                        <li>
                            <p class="post-date">
                            Integramos productos y servicios para que tengas todo a la mano!
                            </p>
                        </li>
                    <!-- </p> -->
                    </ul>
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