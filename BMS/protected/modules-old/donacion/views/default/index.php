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
                    <p> siiiiiiiiiiiiiiii
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