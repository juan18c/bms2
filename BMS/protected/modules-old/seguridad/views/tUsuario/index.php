<?php
/* @var $this TUsuarioController */
/* @var $model TUsuario */
/* @var $form CActiveForm */
?>

<div class="formSep">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tusuario-imagen-logueo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation' => false,
	/*'clientOptions'=> array('validateOnSubmit'=>true,
                            'afterValidate'=>'js:function() 
                            {     
                               	return false
                            }'
    ),*/
	
)); ?>
	
	<p class="note">Bienvenido, por favor elija su imagen de acceso.</p>

	<?php //echo $form->errorSummary($model); ?>


     <div class="container"> 
        
            <div class="row-fluid">
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="enfermera" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/enfermera.png" alt="" width="170" /></a>
                </div>
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="muestra_laboratorio" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/muestras_laboratorio.png" alt="" width="170" /></a>
                </div>
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="cancer_mama" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/cancer_mama.png" alt="" width="170" /></a>
                </div>
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="silla_rueda" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/silla_rueda.png" alt="" width="170" /></a>
        		</div>
        	</div>
        	<br><br><br>
        	<div class="row-fluid">
                <div class="span3">	
        			<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); " ><img id="corazon" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/corazon.png" alt="" width="170" /></a>
        		</div>
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="inyectadora" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/inyectadora.png" alt="" width="170" /></a>
                </div>
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="maleta" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/maleta.png" alt="" width="170" /></a>
                </div>
                <div class="span3">
                	<a href="" onclick="js: $('#tusuario-imagen-logueo-form').submit(); "><img id="pastillas"align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/pastillas.png" alt="" width="170" /> </a>
        		</div>
        	</div>
        </div>


<?php
    $this->widget(
    'ext.EFullCalendar.EFullCalendar',
    array('id' => 'calendar',
            'lang'=>'es',
            'htmlOptions'=>array('width'=>'100%'),
            'options'=>array(
                'selectable'=>true,
                'select'=>'js: function(){

                    $("#myModal").modal("show");
                }'
                ),

        )
    ); 
?>
<?php $this->endWidget(); ?>

</div><!-- form -->