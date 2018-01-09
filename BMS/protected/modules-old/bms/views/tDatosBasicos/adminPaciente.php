<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */
//Yii::app()->clientScript->registerCoreScript('jquery-ui');
/*
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administrar',
);*/

$this->menu=array(	
	array('label'=>'Crear Paciente', 'url'=>array('createIntegrado', 'id_perfil'=>'1')), //HAY QUE PASAR VARIABLE A FORM PARA QUE CARGUE SOLO EL TIPO DE PERSONA PACIENTE
	array('label'=>'Administrar Paciente sin ID', 'url'=>array('adminPacienteSI')) 
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tdatos-basicos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="row-fluid">
	<div class="span12">
		<h1 class="heading">Pacientes</h1>
	</div>

	<p>
	Puede utilizar los siguientes operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	o <b>=</b>) para realizar busquedas especificas.
	</p>
</div>

<?php //echo CHtml::link('B&uacute;squeda Avanzada','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,

)); */?> 
</div>--><!-- search-form -->


<?php 
	/*$option = "";
 	$tipoAsistencia = CHtml::listData(TTipoAsistencia::model()->findAll(),'id_tipo_asistencia','descripcion');
 	foreach ($tipoAsistencia as $key => $value) {
 		$option .= '<option value="'.$key.'">'.$value.'</option>'; 
 	}*/
 	
?>

<div class="row-fluid">
	<?php 
		$criteria= new CDbCriteria;
 		//$criteria->condition="t.id_tipo_estatus=1 ";
 		$criteria->order = "t.descripcion";

		$this->widget('bootstrap.widgets.TbGroupGridView', array(
		'id'=>'tdatos-basicos-pacientes-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'type'=>'striped bordered',
		'columns'=>array(
				array('name' => 'cedula','header' =>'C&eacute;dula'),
				array('name' => 'nombre_completo','header' =>'Paciente'),
				array('name' => 'sexo','header' =>'Sexo','filter'=>''),				
				array('name' => 'edad','header'=>'Edad'),
				//array('name' => 'email','header'=>'Email'),
				//array('name' => 'telefono_movil','header'=>'Celular'),
				//array('name' => 'procedencia','header'=>'Direcci&oacute;n'),				
				//array('name' => 'seguro','header' =>'Seguro'),
				//array('name' => 'descripcion_beneficiario','header' =>'Beneficiario'),
				array('name' => 'cod_historia','header' =>'# Historia'),
				//array('name' => 'id_evento','header' =>'# Caso'),
				//array('name' => 'motivo_consulta','header' => 'Motivo'),
				//array('name' => 'nombre_medico','header' => 'M&eacute;dico'),
				/*array('name' => 'id_tipo_asistencia','header' => 'Asistencia',						
					  'value'=> 'TTipoAsistencia::model()->getDescripcion($data->id_tipo_asistencia)',
					  'filter'=> CHtml::listData(TTipoAsistencia::model()->findAll(), 'id_tipo_asistencia', 'descripcion')
					  ),*/
				//array('name' => 'fecha_creacion','header' => 'Fecha'),
				//array('name' => 'id_estatus','header' => 'Estatus', 'value'=>'TEstatus::model()->getDescEstatus($data->id_estatus)', 'filter'=> CHtml::listData(TEstatus::model()->findAll(), 'id_estatus', 'descripcion')),
				//id_entidad,
			
				array('header' =>'Opciones', 'class'=>'bootstrap.widgets.TbButtonColumn',
					//'template'=>'{create}{view}{update}',
					'template'=>'{view}{update}',
				    'buttons'=>array
				    (
				    	/*'create' => array
				        (
				            'label'=>'',
				            'icon'=>'plus-sign',
				            'options'=>array('id'=>'$data["id_datos_basicos"]','url'=>'Yii::app()->createUrl("Esculapio/THistoriaMedica/create",array("id"=>$data->id_datos_basicos))',
				            	'onmouseover'=>'	
				            		url = $(this).attr("url");

				            		enviarDatos = function(tipo,motivo){				            			
				            			window.location = url+"&tipo="+tipo+"&motivo="+motivo;
				            		}
				            		
				            		//alert($(this).attr("id"));
				            		//$(this).parent().parent().children(":nth-child(1)").text(); para traer datos del registro seleccionado en la tabla	

						            $(this).popover({
						                //trigger:"\'click\'",
						                title:\'Datos de la Historia  <a id="\'+$(this).attr("id")+\'" class="close" href="#" onclick="js:$(this).parent().parent().remove(); ">&times;</a>\',
						                html: true,
						                placement:\'top\',						                
				                content:\'<div class="row-fluid"><div class="span12"><div id="control-group_\'+$(this).attr("id")+\'" class="control-group"><label for="id_tipo_asistencia_\'+$(this).attr("id")+\'">Tipo de Asistencia</label><select id="id_tipo_asistencia_\'+$(this).attr("id")+\'" name="id_tipo_asistencia_\'+$(this).attr("id")+\'"><option value="">Seleccione >></option>'.$option.'</select><label for="motivo_consulta_\'+$(this).attr("id")+\'">Motivo de Consulta</label><input type="text" id="motivo_consulta_\'+$(this).attr("id")+\'" name="motivo_consulta_\'+$(this).attr("id")+\'" class="input-normal" /><div id="div_error_\'+$(this).attr("id")+\'" class="help-block" style="display:none"></div></div><br><input type="button" id="datos_basicos_\'+$(this).attr("id")+\'" name="datos_basicos_\'+$(this).attr("id")+\'" value="Enviar" class="btn btn-inverse" onclick="js: tipo = $(&quot;#id_tipo_asistencia_\'+$(this).attr("id")+\'&quot;).val(); motivo = $(&quot;#motivo_consulta_\'+$(this).attr("id")+\'&quot;).val(); if(tipo == &quot;&quot; || motivo == &quot;&quot;){ $(&quot;#control-group_\'+$(this).attr("id")+\'&quot;).addClass(&quot;error&quot;); $(&quot;#div_error_\'+$(this).attr("id")+\'&quot;).html(&quot;Complete todos los datos&quot;).show(); return false; }else{ $(&quot;#control-group_\'+$(this).attr("id")+\'&quot;).removeClass(&quot;error&quot;); $(&quot;#div_error_\'+$(this).attr("id")+\'&quot;).html(&quot;&quot;).hide(); } enviarDatos(tipo,motivo); " /></div></div>\',
						              
						            });
				            	'),
				            //'url'=> 'Yii::app()->createUrl("Esculapio/THistoriaMedica/update",array("id"=>$data->id_datos_basicos))',	  
				            'click'=>'js: function(){ return false; } ',   
				            'visible'=>'$data->cod_historia == ""',
				        ),*/
				        'view' => array
				        (
				            'label'=>'',
				            'icon'=>'folder-close',
				            //'imageUrl'=>'',
				            'options'=>array('title'=>'Ver Historia','target'=>'_blank','live'=>false),
				            'url'=> 'Yii::app()->createUrl("Esculapio/THistoriaMedica/update",array("historia"=>$data->cod_historia,"id"=>$data->id_datos_basicos))',	     
				            'visible'=>'$data->cod_historia != ""',
				        ),
				         'update' => array
				        (
				            'label'=>'',
				            'icon'=>'pencil',
				            //'imageUrl'=>'',				            
				            'options'=>array('title'=>'Modificar Paciente'),
				            'url'=> 'Yii::app()->createUrl("Esculapio/TDatosBasicos/update",array("id"=>$data->id_datos_basicos))',
				        ),
				        /* 'delete' => array
				        (
				            'label'=>'',
				            'imageUrl'=>'',
				           
				            'options'=>array('class'=>'icon-trash'),
				            
				        ),*/
				    ),
				),
			),
		)); 
?>

</div>