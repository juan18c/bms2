<?php
    if((Yii::app()->user->id==Yii::app()->session['_id']) && (Yii::app()->user->name!='Guest')){ 
?>

<section id="content" class="ls section_padding_top_100 section_padding_bottom_75">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="entry-title">Bienvenido a tu portal</h2>
                
               <!--  <div class="entry-thumbnail divider_40">
                    <img src="images/gallery/06.jpg" alt="">
                </div> -->

                <div class="entry-excerpt">
                    <p>
                    Aqui encontrar&aacute;s todo lo que necesitas para la sanaci&oacute;n de tu cuerpo a trav&eacute;s de las vitaminas, minerales y dem&aacute;s productos que te ayudaran a fortalecer tu sistema inmune. Acompa&ntilde;ados de los mejores especialistas segun tus necesidades y contando con nuestro apoyo en toda las fases de tu tratamiento.
                    </p>

                    <p>
                    Gracias por formar parte de nuestra familia.
                    </p>
                </div>                

                <ul class="list1 darklinks">
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
                </ul>
            </div>

            <div class="col-md-8 col-md-offset-1">

                <div class="panel-group" id="accordion">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab" data-toggle="collapse" data-parent="#accordion" href="#collapseCotizacion">
                                    <i class="fa fa-shopping-cart"></i>
                                    Mis Cotizaciones
                                </a>
                            </h4>
                        </div>
                        <div id="collapseCotizacion" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="media">                                    
                                    <div class="media-body">
                                        <?php $this->renderPartial('application.modules.bms.views.tCotizacion.adminFront',array('modelCotizacion'=>$modelCotizacion,'idResponsable'=>Yii::app()->user->id_persona),false,false); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOrdenes">
                                    <i class="fa fa-tags"></i>
                                    Mis &Oacute;rdenes
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOrdenes" class="panel-collapse collapse">
                            <div class="panel-body">                                
                                <div class="media">                                    
                                    <div class="media-body">
                                        <?php $this->renderPartial('application.modules.bms.views.tOrden.adminFront',array('model'=>$modelOrden,'idResponsable'=>Yii::app()->user->id_persona),false,false); ?>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDespachos">
                                    <i class="fa fa-truck"></i>
                                    Mis Despachos
                                </a>
                            </h4>
                        </div>
                        <div id="collapseDespachos" class="panel-collapse collapse">
                            <div class="panel-body">                                
                                <div class="media">                                    
                                    <div class="media-body">
                                        <?php $this->renderPartial('application.modules.bms.views.tDespachoCabecera.adminFront',array('model'=>$modelDespacho,'idResponsable'=>Yii::app()->user->id_persona),false,false); ?>
                                    </div>
                                </div>                           
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDonacion">
                                    <i class="fa fa-puzzle-piece"></i>
                                    Mis Donaciones Postuladadas
                                </a>
                            </h4>
                        </div>
                        <div id="collapseDonacion" class="panel-collapse collapse">
                            <div class="panel-body">                                
                                Proximamente...                                    
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseBeneficiario">
                                    <i class="fa fa-group"></i>
                                    Mis Beneficiarios
                                </a>
                            </h4>
                        </div>
                        <div id="collapseBeneficiario" class="panel-collapse collapse">
                            <div class="panel-body">
                                
                                <?php $this->renderPartial('application.modules.bms.views.tBeneficiario.adminFront',array('modelBeneficiario'=>$modelBeneficiario,'idResponsable'=>Yii::app()->user->id_persona),false,false); ?>                                
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDireccion">
                                    <i class="fa fa-map-marker"></i>
                                    Mis Direcciones
                                </a>
                            </h4>
                        </div>
                        <div id="collapseDireccion" class="panel-collapse collapse">
                            <div class="panel-body">                                
                                <?php $this->renderPartial('application.modules.Seguridad.views.tDatosBasicosDireccion.adminFront',array('modelDBD'=>$modelDBD,'idResponsable'=>Yii::app()->user->id_persona),false,false); ?>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseMisCitas">
                                    <i class="fa fa-credit-card"></i>
                                    Mis Citas
                                </a>
                            </h4>
                        </div>
                        <div id="collapseMisCitas" class="panel-collapse collapse">
                            <div class="panel-body">
                                Proximamente...
                            </div>
                        </div>
                    </div>
                </div>              

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