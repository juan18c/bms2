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
                    <i class="rt-icon2-pin-alt highlight"></i> Calle 50, PH Plaza Morica San Francisco, Panamá
                </span>

                <span>
                    <i class="rt-icon2-newspaper-alt highlight"></i> +507-456-7890
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
                            <a href="#about">Nosotros</a>
                        </li>

                        <li>
                            <a href="#featured">Suplementos</a>
                        </li>

                        <li>
                            <a href="#blog">Servicios</a>
                        </li>

                        <li>
                            <a href="#medico">M&eacute;dicos</a>
                        </li>

                        <li>
                            <a href="#contact">Contacto</a>
                        </li>

                        <li><?php //echo "Usuario:".Yii::app()->session['_id']; ?>
                            <button onclick="js: $('#registro').show(); " class="btn" type="button" style="background:#820906; color: white; font-weight: bolder;">Regístrate</button>
                            
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
                <span class="highlight">Somos una sociedad creada para respaldar el bienestar</span>
            </p>

            <h3 class="ls-l"
                style="top: 290px; left: 380px; white-space: nowrap;"
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
            <p class="ls-l" 
               style="top: 415px; left: 380px; white-space: nowrap;"
               data-ls="offsetxin:-150;
                        durationin:1200;
                        delayin:1400;
                        easingin:easeOutExpo;
                        offsetxout:-250;
                        durationout:500;
                        rotateyin:-90;
                        transformoriginin:right 50% 0;
                ">
                <span class="grey">
                    Servicios a tu Disposici&oacute;n 
                </span>
            </p>
            <p class="ls-l" 
               style="top: 460px; left: 375px; white-space: nowrap;"
               data-ls="offsetxin:0;
                        durationin:1600;
                        delayin:2000;
                        easingin:easeOutElastic;
                        offsetxout:left;
                        rotatexin:-90;
                        transformoriginin:50% top 0;
                ">
                <a href="services.html">
                    <i class="fa fa-ambulance"></i>
                </a>
                <a href="services.html">
                    <i class="fa fa-user-md"></i>
                </a>
                <a href="services.html">
                    <i class="fa fa-lightbulb-o"></i>
                </a>
                <a href="services.html">
                    <i class="fa fa-medkit"></i>
                </a>
            </p>
     
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
                <span class="highlight">Te Ayudamos a la Desintoxicaci&oacute;n y Reestablecimiento </span>
            </p>

            

            <h3 class="ls-slide"
                style="top: 290px; left: 372px; white-space: nowrap;"
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                <span class="highlight2">Natural del Ser Humano </span>
            </h3>
            <p class="ls-slide"
                style="top: 415px; left: 380px; white-space: nowrap;"
                data-ls="offsetxin:-150;
                        durationin:1200;
                        delayin:1400;
                        easingin:easeOutExpo;
                        offsetxout:-250;
                        durationout:500;
                        rotateyin:-90;
                        transformoriginin:right 50% 0;
                ">
                <span class="grey">
                    Nuestros productos y servicios favorecen la desintoxicación y<br>
                    restablecen las barreras de protección natural del ser humano
                </span>
            </p>
            <div class="ls-slide"
                style="top: 490px; left: 375px; white-space: nowrap;"
                data-ls="offsetxin:0;
                        durationin:1600;
                        delayin:2000;
                        easingin:easeOutElastic;
                        offsetxout:left;
                        rotatexin:-90;
                        transformoriginin:50% top 0;
                ">
                <a href="about.html" class="theme_button">About Us</a>
                <a href="timetable.html" class="theme_button color2">Timetable</a>
            </div>
     
        </div>

        <!-- slide 3 -->
        <div class="ls-slide" 
            data-ls="slidedelay: 5500; 
                    transition3d:28">
     
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
                <span class="highlight">Te ofrecemos Tratamientos Gentiles que reflejen la bondad y el </span>
            </p>

            <h3 class="ls-slide"
                style="top: 290px; left: 372px; white-space: nowrap;"
                data-ls="offsetxin:-50;
                        durationin:1200;
                        delayin:900;
                        easingin:easeOutExpo;
                        offsetxout:50;
                        durationout:500;
                        rotateyin:60;
                        transformoriginin:right 50% 0;
                ">
                Amor de nuestros seres queridos en los momentos de enfermedad
            </h3>

            <div class="ls-slide"
                style="top: 410px; left: 375px; white-space: nowrap;"
                data-ls="offsetxin:0;
                        durationin:1600;
                        delayin:2000;
                        easingin:easeOutElastic;
                        offsetxout:left;
                        rotatexin:-90;
                        transformoriginin:50% top 0;
                ">
                <a href="about.html" class="theme_button color2">Make Appointment</a>
            </div>
     
        </div>

    </div>
</section>

<section id="about" class="ls section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
                <h2 class="widget-title">Departments</h2>

                <div class="panel-group" id="accordion">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    Psychiatry Department
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
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
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">
                                    Pediatrics
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
                                        Consetetur sadipscing elitr, sed diam nonumy eirmod tempor.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed">
                                    Dental Clinic
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
                                        Consetetur sadipscing elitr, sed diam nonumy eirmod tempor.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="collapsed">
                                    Cardiology
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
                                        Consetetur sadipscing elitr, sed diam nonumy eirmod tempor.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
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
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <h2 class="widget-title">Services</h2>

                <p>Duis autem veiudolorn hendrerit vulputate velit esse molestie. consequat, vel illum dolore eu feugiat nulla facilisis at vereros accumsan etiusto dignissim:</p>

                
                <ul class="list1 darklinks">
                    <li>
                        <a href="services.html">Lorem ipsum dolor sit amet</a>
                    </li>
                    <li>
                        <a href="services.html">Sint animi non ut sed</a>
                    </li>
                    <li>
                        <a href="services.html">Eaque blanditiis nemo</a>
                    </li>
                    <li>
                        <a href="services.html">Amet, consectetur adipisicing</a>
                    </li>
                    <li>
                        <a href="services.html">Blanditiis nemo quaerat</a>
                    </li>
                </ul>

                
            </div>

            <div class="col-md-4">
                <h2 class="widget-title">Advantages</h2>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Quality</a></li>
                    <li><a href="#tab2" role="tab" data-toggle="tab">Comfort</a></li>
                    <li><a href="#tab3" role="tab" data-toggle="tab">Results</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <p class="featured-tab-image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/01.jpg" alt="">
                        </p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi minus tenetur sunt aspernatur vitae, corporis nostrum quibusdam molestias, laudantium quia in a natus facilis beatae culpa inventore quidem illo atque.
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <p class="featured-tab-image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/02.jpg" alt="">
                        </p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, enim saepe libero iure tenetur optio nisi aliquam molestias ratione magnam ab ut quod possimus hic suscipit doloremque, deleniti ipsa quia!
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <p class="featured-tab-image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/03.jpg" alt="">
                        </p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis est, dolores, ex ducimus cumque iusto ipsam odit voluptatum autem error impedit obcaecati quisquam molestiae, optio porro inventore nostrum deleniti cupiditate.
                    </div>
                </div>
                
                
            </div>
            
        </div>
    </div>
</section>

<section class="ls ms section_padding_50 table_section">
    <div class="container">
        <div class="row text-xs-center">
            <div class="col-sm-9 to_animate" data-animation="pullDown">
                <h2 class="margin_0"><span class="highlight">Like this theme?</span> <span class="thin">Get your copy of this great theme now!</span></h2>
            </div>
            <div class="col-sm-3 to_animate text-right text-xs-center" data-animation="pullDown">
                <a href="#" class="theme_button inverse">Purchase</a>
            </div>
            
        </div>
    </div>
</section>

<section id="featured" class="cs parallax section_padding_bottom_0 section_padding_top_100">
    <div class="container">
        <div class="row">
            
            <div class="col-md-8 col-md-push-4">
                <h2 class="section_header">
                    No busques m&aacute;s !!!
                </h2>
                <p>
                    Te ofrecemos los mejores Suplementos Nutricionales y Ex&aacute;menes de Laboratorio para apoyar la salud de los m&aacute;s peque&ntilde;os de la casa y el resto de tu familia
                 </p>
                 <div class="row">
                     <div class="col-lg-6">
                        <div class="teaser media to_animate" data-animation="pullDown">
                            <div class="media-left">
                                <div class="teaser_icon highlight main_bg_color size_small round">
                                    <i class="fa fa-hospital-o"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="about.html">Modern Clinic</a>
                                </h3>
                                <p>Consetetur sadipscing elitr sed diam nonumy.</p>
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
                                    <a href="about.html">Qualified Doctors</a>
                                </h3>
                                <p>Eirmod tempor invidunt ut labore et dolore magna.</p>
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
                                    <a href="about.html">Emergency</a>
                                </h3>
                                <p>Aliquam sed diam voluptua vero eoset.</p>
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
                                    <a href="about.html">Health Care</a>
                                </h3>
                                <p>Stet clita kasd gubergren no sea takimata.</p>
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

<section id="folio" class="ls section_padding_0 columns_padding_0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
               
                <div id="isotope_container" class="isotope row masonry-layout">


                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/16.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/16.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-4 webdesign photography">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/01.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/01.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 development">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/03.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/03.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 development">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/04.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/04.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>


                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 photography">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/06.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/06.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                               
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 development programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/07.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/07.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/13.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/13.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/09.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/09.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>


                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/10.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/10.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>


                    <div class="isotope-item gallery-item col-sm-6 col-lg-4 webdesign">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/15.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/15.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/12.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/12.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>


                    <div class="isotope-item gallery-item col-sm-6 col-lg-2 programming">
                        <div>
                            <div class="gallery-image">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/01.jpg" alt="">
                                <div class="gallery-image-links">
                                    <a class="p-view prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="images/gallery/01.jpg"></a>
                                    <a class="p-link" title="" href="gallery-single.html"></a>
                                </div>
                            </div>
                            <div class="gallery-item-description">
                                <h3><a href="gallery-single.html">Lorem Ipsum Dolor</a></h3>
                                <p class="item-meta">
                                    November 27 '14
                                </p>
                                
                            </div>
                        </div>
                    </div>

                </div><!-- eof #isotope_container -->

            </div>
        </div>
    </div>
</section>

<section id="blog" class="ls section_padding_top_75 section_padding_bottom_100">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Latest from Blog</h2>
            </div>
        </div>
        <div class="row">
            <article class="col-sm-4 post format-standard to_animate">
                        
                <div class="entry-thumbnail">
                    
                    <div class="entry-meta-corner">
                        <span class="date">
                            <time datetime="2014-12-09T15:05:23+00:00" class="entry-date">
                                <strong>03</strong>
                                March
                            </time>
                        </span>

                        <span class="comments-link">
                            <a href="blog-single-right.html#comments">
                                <strong>
                                    <i class="rt-icon2-comment"></i> 5
                                </strong>
                            </a>
                        </span>
                    </div>

                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/01.jpg" alt="">
                </div>

                <div class="post-content">
                    <div class="entry-content">
                        <header class="entry-header">

                            <h3 class="entry-title">
                                <a href="blog-single-right.html" rel="bookmark">Duis eum iriure</a>
                            </h3>

                            <div class="entry-meta">

                                <span class="author">
                                    <i class="rt-icon2-user2 highlight2"></i>
                                    by 
                                    <a href="blog-right.html">Admin</a>
                                </span>

                                <span class="categories-links">
                                    <i class="rt-icon2-tag5 highlight2"></i>
                                    In
                                    <a rel="category" href="#">Pediatrics</a>
                                </span>
                                
                            </div>
                            <!-- .entry-meta --> 

                        </header>
                        <!-- .entry-header -->

                        <p>Duis autem eumre dolor hendrerit vulputate veliesse molestie consequat.</p>
                        

                    </div><!-- .entry-content -->

                </div><!-- .post-content -->
            </article>
            <!-- .post --> 


            <article class="col-sm-4 post format-standard to_animate">
                
                <div class="entry-thumbnail">
                    
                    <div class="entry-meta-corner">
                        <span class="date">
                            <time datetime="2014-12-09T15:05:23+00:00" class="entry-date">
                                <strong>05</strong>
                                March
                            </time>
                        </span>

                        <span class="comments-link">
                            <a href="blog-single-right.html#comments">
                                <strong>
                                    <i class="rt-icon2-comment"></i> 13
                                </strong>
                            </a>
                        </span>
                    </div>

                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/02.jpg" alt="">
                </div>

                <div class="post-content">
                    <div class="entry-content">
                        <header class="entry-header">

                            <h3 class="entry-title">
                                <a href="blog-single-right.html" rel="bookmark">Veliesse Molestie</a>
                            </h3>

                            <div class="entry-meta">

                                <span class="author">
                                    <i class="rt-icon2-user2 highlight2"></i>
                                    by 
                                    <a href="blog-right.html">Admin</a>
                                </span>

                                <span class="categories-links">
                                    <i class="rt-icon2-tag5 highlight2"></i>
                                    In
                                    <a rel="category" href="#">Pediatrics</a>
                                </span>
                                
                            </div>
                            <!-- .entry-meta --> 

                        </header>
                        <!-- .entry-header -->

                        <p>Duis autem eumre dolor hendrerit vulputate veliesse molestie consequat vel illum dolore at vero.</p>
                        
                    </div><!-- .entry-content -->

                </div><!-- .post-content -->
            </article>
            <!-- .post --> 


            <article class="col-sm-4 post format-standard to_animate">
                
                <div class="entry-thumbnail">
                    
                    <div class="entry-meta-corner">
                        <span class="date">
                            <time datetime="2014-12-09T15:05:23+00:00" class="entry-date">
                                <strong>07</strong>
                                March
                            </time>
                        </span>

                        <span class="comments-link">
                            <a href="blog-single-right.html#comments">
                                <strong>
                                    <i class="rt-icon2-comment"></i> 11
                                </strong>
                            </a>
                        </span>
                    </div>

                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/gallery/03.jpg" alt="">
                </div>

                <div class="post-content">
                    <div class="entry-content">
                        <header class="entry-header">

                            <h3 class="entry-title">
                                <a href="blog-single-right.html" rel="bookmark">Hendrerit Vulputate</a>
                            </h3>

                            <div class="entry-meta">

                                <span class="author">
                                    <i class="rt-icon2-user2 highlight2"></i>
                                    by 
                                    <a href="blog-right.html">Admin</a>
                                </span>

                                <span class="categories-links">
                                    <i class="rt-icon2-tag5 highlight2"></i>
                                    In
                                    <a rel="category" href="#">Pediatrics</a>
                                </span>
                                
                            </div>
                            <!-- .entry-meta --> 

                        </header>
                        <!-- .entry-header -->

                        <p>Consequat vel illum dolore at vero eros et accumsan et iusto odio dignissim.</p>
                        
                    </div><!-- .entry-content -->

                </div><!-- .post-content -->
            </article>
            <!-- .post --> 
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="blog-right.html" class="theme_button inverse">See More</a>
            </div>
        </div>
    </div>
</section>

<section id="medico" class="ls section_padding_50">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center to_animate" data-animation="fadeInDown">
                <h2 class="section_header">Welcome to Medico!</h2>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore.</p>
                <div>
                    <a href="blog-right.html" class="theme_button inverse">Go To Blog</a>
                </div>
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

<section id="partners" class="ls parallax section_padding_0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="partners-carousel" class="owl-carousel" data-nav="true">
                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner1.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner2.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner3.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner4.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner5.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner6.png" alt="">
                        </a>

                    </div>

                    <div>
                        <a href="#">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/partners_grey/partner1.png" alt="">
                        </a>

                    </div>

                </div>
            </div>
            
        </div>
    </div>
</section>

<section id="progress" class="cs main_color2 section_padding_50 parallax">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">

                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="chart" data-percent="96">
                            <span class="percent grey"></span>
                            <p>Lorem Ipsum</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart" data-percent="98">
                            <span class="percent grey"></span>
                            <p>Dolor Sit</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="chart" data-percent="88">
                            <span class="percent grey"></span>
                            <p>Amet Dolorin</p>
                        </div>
                    </div>
                                        
                </div>

            </div>
        </div>
    </div>
</section>