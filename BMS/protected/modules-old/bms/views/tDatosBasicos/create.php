<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */

$this->breadcrumbs=array(
	'Datos Basicos'=>array('index'),
	'Crear',
);

$this->menu=array(	
	array('label'=>'Usuarios', 'url'=>array('admin')),
);
?>



<div class="row-fluid">

	<div class="span6">

		<h3 class="heading">Datos de Usuario</h3>	

		<p class="note">Los Campos con <span class="required">*</span> son Obligatorios.</p>		
<?php /*
		<div class="form-actions">
			<?php echo CHtml::ajaxButton('Crear','',array(
													'htmlOptions'=>array ('class'=>'btn btn-inverse'),
													'ajax'=>array(
															'type' => 'POST',
															'url'=>'Yii::app()->createUrl("Esculapio/TDatosBasicos/mostrarAdmin",array("id"=>1))',       
					                                        'success'=>'function(data){                                             
					                                                 $("#uploadBox").html(data).show();
					                                        }', 

														)
													)
										); 



			

			?>
			<?php
			/*echo CHtml::ajaxButton(
    $label = 'Click me', 
    $url = 'Yii::app()->createUrl("Esculapio/TDatosBasicos/create",array("id"=>1))', 
    $ajaxOptions=array (
        'type'=>'POST',
        'url'=> 'Yii::app()->createUrl("Esculapio/TDatosBasicos/create",array("id"=>1))', 
        //'dataType'=>'json',
        'success'=>'function(html){ jQuery("#uploadBox").html(html); }'
        ), 
    $htmlOptions=array ('class'=>'btn btn-inverse')
    );
			//Output
?>
<input type="hidden" name="ruta" id="ruta" value="<?php echo Yii::app()->createUrl('Esculapio/TDatosBasicos/mostrarAdmin',array('id'=>1)) ?>" />

<a href="#" id="enlace1">Click me</a>

<script type="text/javascript">
    jQuery('body').on('click', '#enlace1', function () {

    	var ruta = $("#ruta").val();

    	//$("#yt1").click(function(e){ 
    		//e.preventDefault();
    		
	        $.ajax({
	            'type': 'POST',
	            'url': ruta, 
	            //'dataType': 'json',
	            'success': function (html) {
	            	alert($("#ruta").val());
	                $("#uploadBox").html(html);
	            },
	            
	            /*'cache': false,
	            'data': jQuery(this).parents("form").serialize()/
	        });
        //})
        return false;
    });
    
</script>


<div id="uploadBox">Cargar Admin</div>

		</div>

		*/?>
		
		<?php $modelUsuario = new TUsuario; 
			//  $modelRol = new TRol;
		?>
		<?php $this->renderPartial('application.modules.seguridad.views.TUsuario._form', array('model'=>$modelUsuario)); ?>	

		<h3 class="heading">Datos Básicos</h3>			
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>

	<div class="span6">
		<h3 class="heading">Datos de Ubicación</h3>		
		<?php $modelUbicacion = new TDatosBasicosUbicacion(); ?>
		<?php $this->renderPartial('application.modules.Esculapio.views.TDatosBasicosUbicacion._form', array('model'=>$modelUbicacion)); ?> 
		
	</div>
</div>


