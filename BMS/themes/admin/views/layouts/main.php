<?php
  //Yii::app()->clientScript->reset(); 
  Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false);

  // Yii::app()->clientScript->scriptMap = array(
  //       'jquery.js'     => false,
  //       'jquery.min.js' => false,
  //       // 'core.css'      => false,
  //       // 'styles.css'    => false,
  //       // 'pager.css'     => false,
  //       // 'default.css'   => false,
  //       // 'bootstrap-yii.css'=> false,
  //       // 'jquery-ui-bootstrap.css'=>false,
  //       // 'bootstrap.min.css'=>false,
  //       // 'bootbox.min.js'=>false,
  //       // 'notify.min.js'=>false,
  //       // 'bootstrap-noconflict.js'=>false,
  //       // 'bootstrap.min.js'=>false,
  //       //'jquery.ba-bbq.js'=>false,
  //       //'jquery.yiigridview.js'=>true

  //   );

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title><?php echo CHtml::encode($this->pageTitle); ?> - Admin</title>

  <!--icheck-->
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/iCheck/skins/square/blue.css" rel="stylesheet">


  <!--dashboard calendar-->
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/clndr.css" rel="stylesheet">

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/morris-chart/morris.css">


  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-select.css" rel="stylesheet">

  <!--pickers css-->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

  <!--toggle css-->
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet" />

    
    <!--file upload-->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-fileupload.min.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jasny-bootstrap/css/jasny-bootstrap.min.css" /> -->
  <!--common-->
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">  
  <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-responsive.css" rel="stylesheet">
  <!-- <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.stepy.css" rel="stylesheet"> -->


  <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
       

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/html5shiv.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">
    
    /*.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
    .toggle.ios .toggle-handle { border-radius: 20px; }*/
  
    .btn-custom {
        background-color: #820906;
        border-color: #ff792b;
        color: #fff;
        font-weight: bold;
    }

    .btn-custom1 {
        background-color: #FCFF00;
        border-color: #ff792b;
        color: #000;
        font-weight: bold;
    }
     
    .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
    }

    .quantity {
      position: relative;
      display: inline-block;
    }

    .quantity [type="button"] {
      position: absolute;
      right: 0;
      top: 0;
      line-height: 1;
      border: none;
      width: 22px;
      height: 24px;
      background-color: transparent;
    }

    .quantity [type="button"].minus {
      top: auto;
      bottom: 0;
    }

    .quantity [type="numbers"] {
      padding-right: 20px;
      padding-left: 10px;
      max-width: 70px;
    }

  </style>
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html" style="color:#000000; font-size:15px; padding-top:10px; font-weight: bold"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" alt="" width="22%">&nbsp;Bio Metabolic Service</a>
        </div>

        <div class="logo-icon text-center" style="background:#fff;height: 50px !important; margin-top: -52px !important;">
            <a href="index.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" alt="" width="90%" style="padding-top: 15px"></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">John Doe</a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li id="menuInicio"><a href="<?php echo Yii::app()->createUrl('bms/'); ?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                <li class="menu-list" id="menuUsuarios"><a href=""><i class="fa fa-users"></i> <span>Usuarios </span></a>
                    <ul class="sub-menu-list">
                        <li id="subMenuCliente"><a href="<?php echo Yii::app()->createUrl('bms/TDatosBasicos/createIntegrado/id_perfil/1'); ?>">Clientes</a></li>
                        <li id="subMenuEmpresa"><a href="<?php echo Yii::app()->createUrl('bms/TDatosBasicos/createIntegrado/id_perfil/7'); ?>">Empresas</a></li>
                        <li id="subMenuMedico"><a href="<?php echo Yii::app()->createUrl('bms/TDatosBasicos/createIntegrado/id_perfil/2'); ?>">Médicos</a></li>
                        <li id="subMenuProveedor"><a href="<?php echo Yii::app()->createUrl('bms/TProveedor/admin'); ?>">Proveedores</a></li> <!-- id_perfil = 6 -->

                        <li id="subMenuEmpleado"><a href="<?php echo Yii::app()->createUrl('bms/TDatosBasicos/createIntegrado/id_perfil/5'); ?>"> Empleado</a></li>
                        
                        <li id="subMenuLaboratorio"><a href="<?php echo Yii::app()->createUrl('bms/TDatosBasicos/createIntegrado/id_perfil/3'); ?>"> Laboratorios</a></li>
                        <li id="subMenuMarcaCom"><a href="<?php echo Yii::app()->createUrl('bms/TDatosBasicos/createIntegrado/id_perfil/4'); ?>"> Marca Comercial</a></li>

                    </ul>
                </li>                
                <li class="menu-list"><a href=""><i class="fa fa-cogs"></i> <span>Configuración</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo Yii::app()->createUrl('bms/TBanco/admin'); ?>">Bancos</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('bms/TPais/admin'); ?>">Pa&iacute;ses</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->createUrl('bms/TProducto/admin'); ?>"><i class="fa fa-flask"></i> <span>Productos</span></a></li>

                <li><a href="<?php echo Yii::app()->createUrl('bms/TCotizacion/admin'); ?>"><i class="fa fa-shopping-cart"></i> <span>Cotizaciones</span></a>                    
                </li>

                <li><a href="<?php echo Yii::app()->createUrl('bms/TOrden/admin'); ?>"><i class="fa fa-money"></i> <span>Órdenes</span></a></li>                

                <li><a href="<?php echo Yii::app()->createUrl('bms/TDespacho/admin'); ?>"><i class="fa fa-truck"></i> <span>Despachos</span></a></li>

                <li><a href="<?php echo Yii::app()->createUrl('bms/TInventario/admin'); ?>"><i class="fa fa-file"></i> <span>Inventario</span></a>                    
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-puzzle-piece"></i> <span>Donaciones</span></a>
                    <ul class="sub-menu-list">
                      <li><a href="<?php echo Yii::app()->createUrl('bms/TDonacion/indexAdmin'); ?>">Casos</a></li>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-pie-chart"></i> <span>Estadisticas</span></a>
                    <ul class="sub-menu-list">
                      <li><a href="<?php echo Yii::app()->createUrl('bms/TCliente/reporte'); ?>">Clientes</a></li>
                      <li><a href="<?php echo Yii::app()->createUrl('bms/TCotizacion/reporte'); ?>">Cotizaciones</a></li>
                      <li><a href="<?php echo Yii::app()->createUrl('bms/TOrden/reporte'); ?>">Órdenes</a></li>
                      <li><a href="<?php echo Yii::app()->createUrl('bms/TDespacho/reporte'); ?>">Despachos</a></li>
                      <li><a href="<?php echo Yii::app()->createUrl('bms/TDonacion/reporte'); ?>">Donaciones</a></li>
                    </ul>
                </li>
                
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->     

            
            <!--notification menu start -->
            <div class="menu-right">
                
                <ul class="notification-menu">
                  <li>
                    
                    <a href="#" class="btn btn-default info-number" >
                            <i class="fa fa-clock"></i>
                            <span id="date-part"></span>&nbsp; <span id="time-part"></span>
                        </a>
                  </li>
                  <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user-avatar.png" alt="" />
                            &nbsp;<?php echo ucwords(Yii::app()->user->getState('nombreUsuario')); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  Perfil</a></li>                         
                            <li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>"><i class="fa fa-sign-out"></i> Salir </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

        <?php echo $content; ?>
        

        <!--footer section start-->
        <footer>
            2016 &copy; Bio Metabolic Service S.A.
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.10.2.min.js"></script>
<!-- <script
        src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
<script
        src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
        integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
        crossorigin="anonymous"></script> -->

<!-- <script
        src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"
        integrity="sha256-JklDYODbg0X+8sPiKkcFURb5z7RvlNMIaE3RA2z97vw="
        crossorigin="anonymous"></script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-migrate-1.2.1.min.js"></script>
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.validate.min.js"></script> -->
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stepy.js"></script> -->
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/modernizr.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.nicescroll.js"></script>

<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/html5shiv.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/respond.min.js"></script> -->

<!--easy pie chart-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/easypiechart/jquery.easypiechart.js"></script>

<!--Sparkline Chart-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/iCheck/jquery.icheck.js"></script>


<!-- jQuery Flot Chart-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/flot-chart/jquery.flot.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/morris-chart/morris.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/calendar/clndr.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/calendar/evnt.calendar.init.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

 

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-select.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

<!--file upload-->
<!-- <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-fileupload.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jasny-bootstrap/js/jasny-bootstrap.min.js"></script> -->

 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>       
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>

<!--common scripts for all pages-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scripts.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.lang("es").format('dddd').substring(0,1).toUpperCase()+momentNow.lang("es").format('dddd').substring(1,momentNow.lang("es").format('dddd').lenght)+', '+momentNow.format('DD MMMM YYYY'));
        $('#time-part').html(momentNow.format('hh:mm:ss A'));
    }, 100);

    visibleSubMenuClose = function() {
        $('.menu-list').each(function() {
           var t = $(this);
           if(t.hasClass('nav-active')) {
              t.find('> ul').slideUp(200, function(){
                 t.removeClass('nav-active');
              });
           }
        });
    }

    mainContentHeightAdjust = function() {
        // Adjust main content height
        var docHeight = $(document).height();
        if(docHeight > $('.main-content').height())
           $('.main-content').height(docHeight);
    }


});

</script>


</body>
</html>