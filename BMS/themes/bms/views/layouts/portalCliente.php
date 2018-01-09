<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<?php //Yii::app()->clientScript->reset(); 

        // Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false);
?>
<?php
    $ruta=Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;
    //echo $ruta;
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
                        <a id="currency" role="button">
                            USD
                            <!--<i class="arrow-icon-down-open-mini grey"></i>-->
                        </a>                        
                    </li>
                    <?php if (Yii::app()->user->getState('id_rol') != 'donador'){ ?>

                    <li class="dropdown cart-dropdown">

                        <a id="cart" data-target="#" href="/" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" dropdown-toggle>
                            <i class="rt-icon2-cart highlight"></i> 
                            <span class="grey">Carrito:</span>
                            <span class="count"><?php echo $totalProducto; ?> items,
                            $<?php echo (empty($totalCarrito))?0:$totalCarrito; ?></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="cart">
                            <strong class="grey">Agregados recientemente</strong>
                            <div class="widget widget_shopping_cart">
    
							    <div class="widget_shopping_cart_content">

								    <?php $this->widget('zii.widgets.CListView', array(
								        'id'=>'carrito-compra-list',
								        'dataProvider'=>$dataProviderCart,
								        'itemView'=>'application.modules.bms.views.tCarritoDetalle._view', 
								        'summaryText'=>'Mostrando {start} - {end} de {count} productos',
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
								        'pagerCssClass' => 'col-sm-12',
								    )); ?>        

							        <p class="total"><strong class="grey">Subtotal: <span class="amount">$<?php echo (empty($totalCarrito))?0:$totalCarrito; ?></span></strong></p>

							        <p class="buttons">
							            <a href="<?php echo Yii::app()->createUrl('bms/tCarritoDetalle/cartPrevio'); ?>" class="theme_button color1">Ver Todos</a>
							            <a href="<?php echo Yii::app()->createUrl('bms/tCarritoDetalle/checkout'); ?>" target="_blank" class="theme_button color2">Comprar</a>
							        </p>

							    </div>
							</div>
                        </div>

                    </li>
                       <?php } ?>
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
                        <?php if (Yii::app()->user->getState('id_rol') != 'donador'){ ?>
                            
                        <li <?php  if ($ruta=="default/index") echo 'class="active"';?>>                            
                            <a href="<?php echo Yii::app()->createUrl('seguridad'); ?>">Inicio</a>                               
                        </li>
                        <?php } ?>     
                        
                        <!-- pages -->
                         <?php if (Yii::app()->user->getState('id_rol') != 'donador'){ ?>

                        <li>
                            <a href="#">Productos</a>
                            <ul style="display: block; width: 940px; transform: translate(-74%, 0px); right: auto;">
                                <li>
                                	<div class="row">

                                		<div class="col-md-4" style="border-right:1px solid #EEE;">
                                			<a href="<?php echo Yii::app()->createUrl('bms/tProducto/index'); ?>"><i class="rt-icon2-pil"></i>&nbsp;Suplementos Nutricionales</a>
                                				
                                				<?php
                                					foreach ($categorias as $key => $value) {
                                                        $url = Yii::app()->createUrl('bms/tProducto/index/cat/'.$value->id_producto_categoria);
                                						echo '<a href="'.$url.'" style="font-size:14px; padding: 0 0 0 65px !important; "><i class="fa fa-circle"></i> '.$value->descripcion.'</a>';
                                					}
                                				?>
                                				
                                			
                                		</div>
                                		<div class="col-md-8">
                                			<div class="col-md-6">
                                			<a href="<?php echo Yii::app()->createUrl('bms/tProducto/index/cat/1'); ?>"><i class="rt-icon2-lab"></i>&nbsp;Ex&aacute;menes de Laboratorio</a>
                                		
                                			<a href="<?php echo Yii::app()->createUrl('bms/tProducto/index/cat/1'); ?>"><i class="rt-icon2-heart3"></i>&nbsp;Desintoxicaci&oacute;n Asistida</a>
                                			</div>
                                			<div class="col-md-6">
                                			<a href="<?php echo Yii::app()->createUrl('bms/tProducto/index/cat/1'); ?>"><i class="rt-icon2-leaf"></i>&nbsp;Equipos de Purificaci&oacute;n y Aire</a>
                                		
                                			<a href="<?php echo Yii::app()->createUrl('bms/tProducto/index/cat/1'); ?>"><i class="rt-icon2-restaurant_menu"></i>&nbsp;Utensilios de Cocina</a>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-10" style="top:47px;left:15%;">
                                					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/atencion-tercera-edad2.jpg">
                                				</div>

                                			</div>
                                		</div>
                                	</div>
                                    

                                </li>
                                
                            </ul>

                        </li>

                         <?php } ?>

                        <!-- eof pages -->

                        <!-- features -->
                         <?php if (Yii::app()->user->getState('id_rol') != 'donador'){ ?>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('bms/tMedico/adminFront'); ?>">Médicos</a>                            
                        </li>
                         <?php }?>
                         
                                
                        <!-- blog -->
                         <?php if (Yii::app()->user->getState('id_rol') === 'donador'){ ?>
                        <li <?php  if ($ruta=="tDonacion/index") echo 'class="active"';?> >
                            <a href="<?php echo Yii::app()->createUrl('bms/tDonacion/index'); ?>">                      
                                Inicio
                            </a>                            
                        </li>
                        <li  <?php  if ($ruta=="tDonacionAdjudicado/adminDonador") echo 'class="active"';?> >
                            <a href="<?php echo Yii::app()->createUrl('bms/tDonacionAdjudicado/adminDonador',array('idDonador'=>TUsuario::model()->findByPk(Yii::app()->session['_id'])->id_persona)) ?>">    
                                Mis donaciones                            
                            </a>                            
                        </li>
                        <?php }else{?>
                         <li <?php  if ($ruta=="tDonacion/index") echo 'class="active"';?> >
                            <a href="<?php echo Yii::app()->createUrl('bms/tDonacion/index'); ?>">                      
                                Donaciones
                            </a>                            
                        </li>
                               
                        <?php }?>

                        <!-- eof blog -->

                        <!-- shop -->
                        <!-- <li>
                            <a href="<?php //echo Yii::app()->createUrl('bms/tHistoria/admin');?>">Historia M&eacute;dica</a>                            
                        </li>

                         <li>
                            <a href="<?php //echo Yii::app()->createUrl('bms/tCita/admin');?>">Citas</a>                            
                        </li> -->
                        <!-- eof shop -->                        
                    </ul>
                </nav>
                <!-- eof main nav -->
            </div>
        </div>
    </div>
</header>

		<?php echo $content; ?>

<section id="subscribe" class="section_subscribe cs section_padding_50 table_section table_section_lg" style="background:url('<?php echo Yii::app()->theme->baseUrl;?>/images/ninos-saltando.jpg') no-repeat fixed; background-size: 100%; ">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 text-center text-lg-left">
                <h2 class="margin_0"><span class="highlight">Lo apoyamos con la salud de los mas pequeños de la casa </span> </h2>
            </div>
            <div class="col-lg-7 text-center text-lg-right">
            	Alergias alimentarias y ambientales / Problemas de aprendizaje y conducta / Deficit de atención e hiperactividad / Trastorno general del desarrollo
                <!-- <div class="widget widget_mailchimp">
                    <form id="signup" action="/" method="get">
                        <div class="form-group inline-block">
                            <input class="form-control" name="email" id="mailchimp_email" type="email" placeholder="Email Address">
                        </div>
                        <button type="submit" class="theme_button color1">Suscribete</button>
                        <div id="response"></div>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
</section>

<?php $this->endContent(); ?>