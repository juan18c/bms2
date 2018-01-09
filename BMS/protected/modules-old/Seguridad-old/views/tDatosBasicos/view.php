<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.plugins.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		if($("#idperfil").val()== "2" || ($("#idperfil").val()== "6")){
			$('#tdatosbasicosseguro-div').hide();
		}else{
			$('#tdatosbasicos-div').show();	
			$('#tdatosbasicosseguro-div').show();

		}
		if($("#idperfil").val()== "7"){
			$('#tdatosbasicosseguro-div').hide();
		}
       	if($("#idperfil").val()== "3" || ($("#idperfil").val()== "4") ){
    		$('#div_educacion').show();
			$('#div_experiencia').show();
			$('#tproveedor-div').hide();
			$('#tdatosbasicosseguro-div').show();
			$('#tmedico-div').hide();
			$('#tmedico-title').hide();
			$('#tseguro-div').hide();
			$('#tseguro-entidad-div').hide();
			if($("#idperfil").val()== "3"){
				$('#templeado-div').show();
			 	$('#tpostulante-div').hide();
			} 	
			if($("#idperfil").val()== "4"){
			 	$('#tpostulante-div').show();
				$('#templeado-div').hide();
			}
        }else{
        	if($("#idperfil").val()== "2" ){
			 	$('#tproveedor-div').show();
			 	$('#tdatosbasicosUbicacion-div').show();
			}else{
				$('#tproveedor-div').hide();
			}
			if($("#idperfil").val()== "5" ){
			 	$('#tmedico-div').show();
			 	$('#tmedico-title').show();
			 	$("#tdatosrepresentante-div").hide();
			 	$("#div-representante").hide();
        		$("#div-representante-otrosdatos").hide();
			}else{
				$('#tmedico-div').hide();
				$('#tmedico-title').hide();
			}
			// if($("#idperfil").val()== "6" ){
			//  	$('#tseguro-entidad-div').show();
			// }else{
			// 	$('#tseguro-entidad-div').hide();
			// }
			if($("#idperfil").val()== "7" ){
			 	$('#tentidad-div').show();
			 	$('#tipo_entidad').show();
			 	$("#tdatosrepresentante-div").hide();
			 	$("#div-representante").hide();
        		$("#div-representante-otrosdatos").hide();
			}else{
				$('#tentidad-div').hide();
				$('#tipo_entidad').hide();
			}
			if($("#titular_hidden").val()== 0 ){
			 	$('#trepresentante-div').hide();
			}else{
				$('#trepresentante-div').show();
			}

			if($("#beneficiarios_hidden").val()!= '1' ){
			 	$('#tbeneficiarios-div').hide();
			}else{
				if($("#idperfil").val()== "1" )
					$('#tbeneficiarios-div').show();
			}
			

        	$('#div_educacion').hide();
        	$('#div_experiencia').hide();
        	$('#templeado-div').hide();
        	$('#tpostulante-div').hide();
        	$('#totrosDatos-title').hide();
        }
        return false;
    });

</script>

<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */

// $this->breadcrumbs=array(
// 	'Usuarios'=>array('index'),
// 	$model->id_datos_basicos,
// );

// <<<<<<< .mine
// $this->menu=array(
// 	// array('label'=>'List TDatosBasicos', 'url'=>array('index')),
// 	//array('label'=>'Crear Usuario', 'url'=>array('createIntegrado')),
// 	array('label'=>'Modificar Usuario', 'url'=>array('update', 'id'=>$model->id_datos_basicos)),
// 	array('label'=>'Eliminar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_datos_basicos),'confirm'=>'Esta usted seguro de querer eliminar este item?')),
// 	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
// );

$this->menu=TUsuario::model()->CargarMenuLateral();

?>


<div class="row-fluid" style="width:100%">
	<div class="span12">
		<h1 class="heading">Consultar Usuarios #<?php echo $model->id_datos_basicos; ?></h1>
	</div>
</div>


<div class="row-fluid">
	<div class="span6">
		<h3 class="heading">Datos de Perfil</h3>	
		<?php echo CHtml::hiddenField('perfil', $modelPerfil->id_perfil, array('id' => 'idperfil'));  ?>
		<div data-provides="fileupload" class="fileupload fileupload-new span4"><input type="hidden" value="" />
			<?php if((isset($model->img_perfil))&&($model->img_perfil!="")){ ?>
				<div style="width: 150px; height: 150px; line-height: 150px;" class="fileupload-new thumbnail"><img src='<?php echo $model->img_perfil; ?>' alt="" /></div> 
			<?php }else{ ?>
				<div style="width: 150px; height: 150px; line-height: 150px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/150x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /></div> 
			<?php } ?>
			<div style="width: 150px; height: 150px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>

		</div>	
		<div class="span7">	
			<?php 
				//$this->widget('zii.widgets.CDetailView', array(
				$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array('name' => 'id_datos_basicos','label'=>'COD Usuario'),
					array('name' => 'id_tipo_identificacion','label'=>'Identificación','value'=>TTipoIdentificacion::model()->findByPk($model->id_tipo_identificacion)->abreviatura.'- '.$model->nro_identificacion), 
					array('name' => 'titular','label'=>'Titular'),  
					array('name' => 'nombres','label'=>'Nombres, Apellido','value'=>$model->nombres.', '.$model->apellidos),      
					array('name' => 'sexo','label'=>'Sexo','value'=>($model->sexo=='F')?'Femenino':'Masculino'),  
					array('name' => 'fecha_nacimiento','label'=>'Fecha de Nacimiento'),  
					array('name' => 'id_estado_civil','label'=>'Estado Civil', 'value'=>TEstadoCivil::model()->findByPk($model->id_estado_civil)->descripcion),   
					array('name' => 'fecha_creacion','label'=>'Fecha de Creación'),  
				    array('name' => 'id_estatus','label'=>'Estatus','value'=>TEstatus::model()->getDescEstatus($model->id_estatus)),      
				),
			)); ?>
		</div>
		<?php echo CHtml::hiddenField('titular_hidden', $model->titular, array('id' => 'titular_hidden'));  ?>
	</div>
	<div class="span6">
		<h3 class="heading">Dirección</h3>		
		<?php 
			if (isset(TLocalizacionPais::model()->findByPk($modelUbicacion->id_pais)->descripcion_pais)){
				$direc1=TLocalizacionPais::model()->findByPk($modelUbicacion->id_pais)->descripcion_pais;
			}else{
				$direc1='';
			}
			if(isset(TLocalizacionEstado::model()->findByPk($modelUbicacion->id_estado)->nombre_estado)){
				$direc1.= '- '.TLocalizacionEstado::model()->findByPk($modelUbicacion->id_estado)->nombre_estado;
			}else{
				$direc1.='';	
			}
			if(isset(TLocalizacionMunicipio::model()->findByPk($modelUbicacion->id_municipio)->nombre_municipio)){
				$direc2=TLocalizacionMunicipio::model()->findByPk($modelUbicacion->id_municipio)->nombre_municipio;
			}else{
				$direc2='';	
			}
			if(isset(TLocalizacionParroquia::model()->findByPk($modelUbicacion->id_parroquia)->nombre_parroquia)){
				$direc2.=TLocalizacionParroquia::model()->findByPk($modelUbicacion->id_parroquia)->nombre_parroquia;
			}else{
				$direc2.='';	
			}
			if(isset(TLocalizacionCiudad::model()->findByPk($modelUbicacion->id_ciudad)->nombre_ciudad)){
				$direc3=TLocalizacionCiudad::model()->findByPk($modelUbicacion->id_ciudad)->nombre_ciudad;
			}else{
				$direc3='';	
			}


			$this->widget('bootstrap.widgets.TbDetailView', array(
			'data'=>$modelUbicacion,
			'attributes'=>array(
				array('name' => 'id_pais','label'=>'País/ Estado','value'=>$direc1),//.', '. ? 'No Asignado' : TLocalizacionEstado::model()->findByPk($modelUbicacion->id_estado)->nombre_estado),
				//array('name' => 'id_estado','label'=>'Estado','value'=>TLocalizacionEstado::model()->findByPk($modelUbicacion->id_estado)->nombre_estado),
				array('name' => 'id_municipio','label'=>'Municipio/ Parroquia','value'=>$direc2),//TLocalizacionMunicipio::model()->findByPk($modelUbicacion->id_municipio)->nombre_municipio.'- '. TLocalizacionParroquia::model()->findByPk($modelUbicacion->id_parroquia)->nombre_parroquia),
				//array('name' => 'id_ciudad','label'=>'Ciudad','value'=>TLocalizacionCiudad::model()->findByPk($modelUbicacion->id_ciudad)->nombre_ciudad),
				array('name' => 'id_ciudad','label'=>'Ciudad','value'=>$direc3), //
				array('name' => 'tipo_direccion','label'=>'Tipo de Direc.','value'=>$modelUbicacion->tipo_direccion),
				array('name' => 'codigo_postal','label'=>'Código Postal','value'=>$modelUbicacion->codigo_postal),
				array('name' => 'telefono_fijo','label'=>'Teléfono Fijo','value'=>$modelUbicacion->telefono_fijo),
				array('name' => 'telefono_movil','label'=>'Teléfono Móvil','value'=>$modelUbicacion->telefono_movil),
				array('name' => 'direccion','label'=>'Dirección','value'=>$modelUbicacion->direccion), 
				array('name' => 'email','label'=>'E-mail','value'=>$modelUbicacion->email), 
			),
		)); ?>
	</div>
</div>
<?php echo CHtml::hiddenField('beneficiarios_hidden', $beneficiario, array('id' => 'beneficiarios_hidden'));  ?>
<div class="row-fluid">
	<div id="tdatosbasicosseguro-div" class="span6"  style='display:none'>
		<h3 class="heading">Seguro</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbGridView', array(
				'id'=>'tdbseguro-grid',
				'dataProvider'=>$dp,
				
				'columns'=>array(
						array('name' => 'id_seguro', 'header' =>'Aseguradora'),//'value'=>'TSeguro::model()->getSeguro_DatosBasicos($data->id_seguro)'),
						array('name' => 'numero_poliza', 'header' =>'Num. Poliza'),
						array('name' => 'tipo_poliza', 'header' =>'Tipo de Poliza'),
						array('name' => 'cobertura', 'header' =>'Cobertura'),
					),
				)); 
		?>


	</div>
	<div id="trepresentante-div" class="span6" style='display:none'>
		<h3 class="heading">Datos del Representante</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$modelRepresentante,
				'attributes'=>array(
					array('name' => 'id_datos_basicos_representante','label'=>'COD Usuario','value'=>$model->id_datos_basicos_representante),
					array('name' => 'nombres_representante','label'=>'Nombres, Apellido','value'=>$model->nombres_representante.', '.$model->apellidos_representante),      
					array('name' => 'sexo','label'=>'Sexo','value'=>($model->sexo_representante=='F')?'Femenino':'Masculino'),  
					array('name' => 'fecha_nacimiento_representante','label'=>'Fecha de Nacimiento', 'value'=>$model->fecha_nacimiento_representante),  
				),
			));	
		?>
	</div>
	<div id="tbeneficiarios-div" class="span6" style='display:none' >
		<h3 class="heading">Datos del(los) Representado(s)</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbGridView', array(
				'id'=>'tdbbeneficiarios-grid',
				'dataProvider'=>$dpBeneficiario,
				
				'columns'=>array(
						array('name' => 'id_datos_basicos', 'header' =>'COD Usuario'),
						array('name' => 'nombres','header'=>'Nombres'), 
						array('name' => 'apellidos','header'=>'Apellidos'),
						array('name' => 'fecha_nacimiento', 'header' =>'Fecha Nacimiento'),
					),
				));	
		?>
	</div>
</div>
<div class="row-fluid">
	<div id="tproveedor-div" class="span12"  style='display:none'>
		<h3 class="heading">Otros Datos del Proveedor</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$modelProveedor,
				'attributes'=>array(
					array('name' => 'nit','label'=>'Nit','value'=>$modelProveedor->nit),
					array('name' => 'tipo','label'=>'Tipo','value'=> ($modelProveedor->tipo== 'I')? 'Internacional' : 'Nacional'),
					array('name' => 'personacontacto','label'=>'Persona de Contacto','value'=>$modelProveedor->personacontacto),
					array('name' => 'notas','label'=>'Notas','value'=>$modelProveedor->notas),
				),
			));		
		?>
	</div>
</div>
<div class="row-fluid">
	<div id="tentidad-div" class="span12"  style='display:none'>
		<h3 class="heading">Otros Datos del Centro de Salud</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$modelEntidad,
				'attributes'=>array(
					array('name' => 'nit','label'=>'Nit','value'=>$modelEntidad->nit),
					array('name' => 'procedencia','label'=>'Tipo','value'=> ($modelEntidad->procedencia== 'I')? 'Internacional' : 'Nacional'),
					array('name' => 'personacontacto','label'=>'Persona de Contacto','value'=>$modelEntidad->personacontacto),
					array('name' => 'notas','label'=>'Notas','value'=>$modelEntidad->notas),
				),
			));		
		?>
	</div>
</div>
<div class="row-fluid">
	<div id="tmedico-div" class="span12"  style='display:none'>
		<h3 class="heading">Otros Datos del Médico</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$modelMedico,
				'attributes'=>array(
					array('name' => 'cod_matricula','label'=>'Cod. Matricula','value'=>$modelMedico->cod_matricula),
					array('name' => 'rif','label'=>'RIF','value'=>$modelMedico->rif),
					array('id' => 'especialidad','label'=>'Especialidad','value'=>$dpespecialidad),
				),
			));		
		?>

	</div>
</div>
<div class="row-fluid">
	<div id="templeado-div" class="span12"  style='display:none'>
		<h3 class="heading">Otros Datos del Empleado</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$modelEmpleado,
				'attributes'=>array(
					// array('name' => 'tipo','label'=>'Tipo','value'=>$modelEmpleado->tipo),
					array('name' => 'persona_contacto','label'=>'Persona de Contacto','value'=>$modelEmpleado->persona_contacto),
					array('name' => 'tlf_persona','label'=>'Teléfono de Contacto','value'=>$modelEmpleado->tlf_persona),
					array('name' => 'fecha_ing','label'=>'Fecha de ingreso','value'=>$modelEmpleado->fecha_ing),
					array('name' => 'fecha_sal','label'=>'Fecha de salida','value'=>$modelEmpleado->fecha_sal),
					array('name' => 'id_cargo','label'=>'Cargo','value'=>(isset(TCargo::model()->findByPk($modelEmpleado->id_cargo)->descripcion))? TCargo::model()->findByPk($modelEmpleado->id_cargo)->descripcion:'No Asignado'),
					array('name' => 'id_turno','label'=>'Turno','value'=>(isset(TTurno::model()->findByPk($modelEmpleado->id_turno)->descripcion))? TTurno::model()->findByPk($modelEmpleado->id_turno)->descripcion:'No Asignado'),
					array('name' => 'sueldo','label'=>'Sueldo Actual','value'=>$modelEmpleado->sueldo),
					array('name' => 'sueldo_hora','label'=>'Sueldo por Hora','value'=>$modelEmpleado->sueldo_hora),
					array('name' => 'tlf_ofic','label'=>'Teléfono de Oficina','value'=>$modelEmpleado->tlf_ofic),
					array('name' => 'id_banco','label'=>'Banco','value'=>(isset(TBanco::model()->findByPk($modelEmpleado->id_banco)->descripcion))? TBanco::model()->findByPk($modelEmpleado->id_banco)->descripcion:'No Asignado'),
					array('name' => 'num_cuenta','label'=>'Núm. Cuenta','value'=>$modelEmpleado->num_cuenta),
					array('name' => 'notas','label'=>'Notas','value'=>$modelEmpleado->notas),
				),
			));		
		?>
	</div>
</div>
<div class="row-fluid">
	<div id="tpostulante-div" class="span12"  style='display:none'>
		<h3 class="heading">Otros Datos del Postulante</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbDetailView', array(
				'data'=>$modelPostulante,
				'attributes'=>array(
					array('name' => 'persona_contacto','label'=>'Persona de Contacto','value'=>$modelPostulante->persona_contacto),
					array('name' => 'tlf_persona','label'=>'Teléfono de Contacto','value'=>$modelPostulante->tlf_persona),
					array('name' => 'fecha_entrevista','label'=>'Fecha Entrevista','value'=>$modelPostulante->fecha_entrevista),
					array('name' => 'ult_sueldo','label'=>'último Sueldo','value'=>$modelPostulante->ult_sueldo),
					array('name' => 'notas','label'=>'Notas','value'=>$modelPostulante->notas),
				),
			));		
		?>
	</div> 
</div>

<div class="row-fluid">
	<div id="div_educacion" class="span12"  style='display:none'>
		<h3 class="heading">Educación</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbGridView', array(
				'id'=>'teducacion-grid',
				'dataProvider'=>$dpeducacion,
				
				'columns'=>array(
						array('name' => 'id_nivel_educativo', 'header' =>'Nivel Educativo'),//'value'=>'TSeguro::model()->getSeguro_DatosBasicos($data->id_seguro)'),
						array('name' => 'id_mencion', 'header' =>'Mención'),
						array('name' => 'id_pais', 'header' =>'Pais'),
						array('name' => 'institucion', 'header' =>'Institución'),
						array('name' => 'fecha_desde', 'header' =>'Fecha Desde'),
						array('name' => 'fecha_hasta', 'header' =>'Fecha Hasta'),
						array('name' => 'ultimo_anio_aprobado', 'header' =>'Último Año Aprobado'),
						array('name' => 'graduado', 'header' =>'Graduado'),
					),
				)); 
		?>


	</div>
</div> 
<div class="row-fluid">
	<div id="div_experiencia" class="span12"  style='display:none'>
		<h3 class="heading">Experiencia Laboral</h3>		
		<?php 
			$this->widget('bootstrap.widgets.TbGridView', array(
				'id'=>'texplaboral-grid',
				'dataProvider'=>$dpexplaboral,
				
				'columns'=>array(
						array('name' => 'nombre_empresa', 'header' =>'Nombre Empresa'),//'value'=>'TSeguro::model()->getSeguro_DatosBasicos($data->id_seguro)'),
						array('name' => 'id_pais', 'header' =>'Pais'),
						array('name' => 'cargo_ocupado', 'header' =>'Cargo Ocupado'),
						array('name' => 'condicion_cargo', 'header' =>'Condición del Cargo'),
						array('name' => 'fecha_desde', 'header' =>'Fecha Desde'),
						array('name' => 'fecha_hasta', 'header' =>'Fecha Hasta'),
						array('name' => 'ultimo_sueldo', 'header' =>'Último Sueldo'),
						array('name' => 'telefono_empresa', 'header' =>'Teléfono Empresa'),
						array('name' => 'motivo_retiro', 'header' =>'Motivo de Retiro'),
					),
				)); 
		?>
	</div>
</div> 

