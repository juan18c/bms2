<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<?php //Yii::app()->clientScript->reset(); 

        // Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false);
?>
<?php
    
    $carrito = TCarrito::model()->find('t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL');
    
    if(empty($carrito))
    {
        $model=new TCarrito;
        $model->id_datos_basicos = Yii::app()->user->id_persona; //VALIDAR CONTRA VARIABLE DE SESION
        if ($model->save()) 
            $carrito = TCarrito::model()->find('t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL');
    }
    
    $criteria=new CDbCriteria;
    $criteria->with = array('idProducto');
    $criteria->condition='t.id_carrito='.$carrito->id_carrito.' AND t.id_estatus=1';

    $dataProviderCart = new CActiveDataProvider( 'TCarritoDetalle', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>20) ) );
    
	$criteriaTotal=new CDbCriteria;
    $criteriaTotal->select = array('count(*) as items');
    $criteriaTotal->with = 'tCarritoDetalles';
    $criteriaTotal->condition='t.id_carrito = '.$carrito->id_carrito;

	$totalProducto = TCarrito::model()->find($criteriaTotal)->items;

	$criteriaC=new CDbCriteria;
    $criteriaC->select = array('sum((`tInventarios`.`precio`) * `tCarritoDetalles`.`cantidad` ) as total');
    $criteriaC->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
    $criteriaC->condition='t.id_carrito = '.$carrito->id_carrito;
	$totalCarrito = TCarrito::model()->find($criteriaC)->total;

	$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');
?>
<section class="page_topline ls ms section_padding_0 table_section table_section_md">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left">

                <span>
                    <i class="rt-icon2-phone-outline highlight"></i> Llamanos al +507-456-7890
                </span>

                <span>
                    <i class="rt-icon2-envelope highlight"></i> biometabolicservice@gmail.com
                </span>
           
            </div> <!-- eof .col- -->

            <div class="col-md-6 text-center text-md-right">
                <ul class="inline-dropdown">
                    <li class="currency-dropdown">
                        <!-- <a id="currency" role="button"> -->
                            USD
                            <!--<i class="arrow-icon-down-open-mini grey"></i>-->
                        <!-- </a>    -->                     
                    </li>
                                        
                    <?php if (Yii::app()->user->isGuest){ ?>
                    <li class="dropdown login-dropdown">

                        <a id="login" data-target="#loginFront" href="/" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" dropdown-toggle>
                            Login
                        </a>

                        <div id="loginFront" class="dropdown-menu" aria-labelledby="login">
                            <p>
                                <strong class="grey">If you have an account, please log in:</strong>
                            </p>
                            <form role="form" action="/">
                                
                                <div class="form-group">
                                    <label for="login_email">Email</label>
                                    <input type="email" class="form-control" id="login_email" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <label for="login_password">Password</label>
                                    <input type="password" class="form-control" id="login_password" placeholder="Password">
                                </div>
                                
                            
                                <button type="button" class="theme_button color1">
                                    Log in
                                </button>
                                <a href="register-right.html" class="theme_button color2">Registrarse</a>
                                           
                            </form>
                            <div class="greylinks topmargin_20">
                                <a href="register-right.html">Forgot Your Password?</a>
                            </div>
                        </div>

                    </li>
                    <?php }else{ ?>
                    <li class="dropdown currency-dropdown">
                        <a id="logout" href="/" class="" data-toggle="dropdown" data-target="#" aria-haspopup="true" role="button" aria-expanded="false">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/53.png" alt="" width="20" />
                            &nbsp;<?php echo ucwords(Yii::app()->user->getState('nombreUsuario')); ?>
                            <i class="arrow-icon-down-open-mini grey"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="logout">
                            <li><a href="#"><i class="fa fa-user"></i>  Perfil</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  Ayuda</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                    <?php } ?>

                </ul>
            </div> <!-- eof .col- -->

        </div>
    </div>
</section>

<header class="page_header header_gradient">
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
                        <?php if (Yii::app()->user->getState('id_rol') === 'donador'){
                         ?> 
                         <li class="active">                            
                            <a href="<?php echo Yii::app()->createUrl('bms/tDonacion/index'); ?>">Inicio</a>                              
                        </li>                           
                        <li >                            
                            <a href="<?php echo Yii::app()->createUrl('bms/tDonacionAdjudicado/adminDonador',array('idDonador'=>TUsuario::model()->findByPk(Yii::app()->session['_id'])->id_persona)) ?>">Mis Donaciones</a>                               
                        </li>
                        <?php } ?>  
                                
                        <!-- blog -->
                        <!-- <li>
                            <a href="<?php echo Yii::app()->createUrl('bms/tDonacion/adminFront'); ?>">Donaciones</a>                            
                        </li> -->
                        <!-- eof blog -->

                                        
                    </ul>
                </nav>
                <!-- eof main nav -->
            </div>
        </div>
    </div>
</header>

		<?php echo $content; ?>

<section id="subscribe" class="section_subscribe cs section_padding_50 table_section table_section_lg" style="background:url('<?php echo Yii::app()->theme->baseUrl;?>/images/ninos-saltando.jpg') no-repeat fixed">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 text-center text-lg-left">
                <h2 class="margin_0"><span class="highlight">Lo apoyamos con la salud de los mas pequeños de la casa </span> </h2>
            </div>
            <div class="col-lg-7 text-center text-lg-right">
            	Alergias alimentarias y ambientales / Problemas de aprendizaje y conducta / Deficit de atención e hiperactividad / Trastorno general del desarrollo                
            </div>
        </div>
    </div>
</section>

<?php $this->endContent(); ?>