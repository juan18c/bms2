<?php
/* @var $this TCotizacionController */
/* @var $modelCotizacion TCotizacion */

Yii::app()->clientScript->registerScript('search', "

getCotizacionResponsables= function(parametros){   
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/cargarModalDonacion")."'+parametros,            
        dataType:'json',           
        success : function (data) {   
            $('#idResponsable').val(data.idP);
            $('#TCotizacion_id_cotizacion').val(data.idCot);            
            
            $('#TDatosBasicos_nombres').val(data.nombreBeneficiario);
            $('#TDatosBasicos_apellidos').val(data.nombreResponsable);

           // $('#TDatosBasicos_email').val(data.email);
            $('#modalSolicitudDonacion .modal-body').html(data.dona); 
            //$('#modalSolicitudDonacion').modal('show'); 


            $('#modalSolicitudDonacion .modal-body').find('#TDonacion_foto').fileinput('destroy');
            var fotoDe=$('#modalSolicitudDonacion .modal-body').find('#foto').val();

			$('#TDonacion_foto').fileinput({
				initialPreview: [fotoDe],
		        initialPreviewAsData: true,
		        // initialPreviewConfig: [
		        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
		        // ],
		        overwriteInitial: true,
				language:'es',
				browseLabel:'Seleccionar',
				browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
				showUpload: false,
				showCaption: false,
				showClose:false,
				browseClass: 'btn btn-primary',
				fileType: 'any',
		        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
			});

            $('.file-preview ').attr('style','border:0px;');


        }

  });
}            



borrarItem = function(idCarritoDetalle){
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/deleteItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val(),
        //data : {}, 
        dataType:'json',            
        success : function (data) {
                          
            $('#shop-order-div').html(data.totalOrden);
            $('#tcarrito-cotizacion-grid').yiiGridView('update',{data: {idcarr:$('#TCotizacion_id_carrito').val() }});

            return false;               
        }

    });

    return false;
}



imprimir = function(e){

    var ind_membrete = $('#ind_membrete').val();
    var ind_cuenta = $('#ind_cuenta').val();
    var ind_laboratorio = $('#ind_laboratorio').val();

    var url = $('#urlImpresion').val()+'/indM/'+ind_membrete+'/indC/'+ind_cuenta+'/indL/'+ind_laboratorio;

    window.open(url,'_blank'); 
}


    $('#buttonSolicitarDonacion').click(function(e){
    	e.preventDefault();

    	form=$('#modalSolicitudDonacion').find('form');

    	var formData = new FormData(document.getElementById('tdonacion-form'));

    	$.ajax({
    		type : 'POST',
    		dataType: 'json',
        	url : '".Yii::app()->createUrl("bms/TDonacion/create")."',
        	data : formData,        	
        	cache: false,
        	contentType: false,
        	processData: false,
        	success : function (data) {	        		
          		if (data.salida == 'COMPLETO') {          			
          			$('#divDonacionMensaje').html(data.mensaje);
          			$('#modalSolicitudDonacion').modal('hide');
          			$('#tcotizacion-grid').yiiGridView('update', {
						data: $(this).serialize()
					});

		            return false;
          		}else{
          			$('#divDonacionMensaje').html(data.mensaje);

          		}
        	}
    	});  

    	return false; 	
      	
    });


",CClientScript::POS_READY);


?>

<!--body wrapper start-->

<!-- 	<div class="row">
        <div class="col-sm-12"> -->
<div class="adv-table table-responsive">
	<?php 
		$modelCotizacion->id_estatus=1; //PARA QUE MUESTRE SOLO LAS COT ACTIVAS
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'tcotizacion-grid',
		'dataProvider'=>$modelCotizacion->searchFront($idResponsable),
		'filter'=>$modelCotizacion,
		'itemsCssClass'=>'table table-bordered table-striped table-condensed',
		'columns'=>array(
			array(
				'name'=>'codigo_cotizacion',
				'header' =>'Cotización',
	            //'value' =>'<a href="bms/TCotizacion/update/.$data->id_cotizacion.">..</a>',
	            'value'=>'CHtml::link(substr($data->codigo_cotizacion, 2, 5), array("../bms/TCotizacion/update/id/".$data->id_cotizacion),array("target"=>"_blank"))',
	            'type'=>'raw'
				//'headerHtmlOptions' => array('style' => 'width: 5%'),		
				//'filter'=> true
			),					
			array(	'name'=>'nombreBeneficiario',
					'header' =>'Beneficiario', 
					//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
					'value'=>'$data->idBeneficiario->idBeneficiarioDB->nombres." ".$data->idBeneficiario->idBeneficiarioDB->apellidos." (".$data->idBeneficiario->idParentesco->descripcion.")"'
			),

			array(	'name'=>'fecha_creacion',
					'header' =>'Creación', 
					//'headerHtmlOptions' => array('style' => 'width: 18%'),
					'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
					'filter'=> true						
			),
	        array(  'name'=>'fecha_envio',
	                        'header' =>'Envío',                                
	                        'value'=>'TCotizacion::model()->getDatosEnvio($data->fecha_envio,$data->datos_envio)',
	                        'filter'=> false,
	                        'htmlOptions'=>array('style' => 'text-align:center; ', ),
	                        'type'=>'raw'
	                ),

	        array(  'name'=>'monto',
	                        'header' =>'Monto',	                        
	                        'filter'=> false,
	                        'htmlOptions'=>array('style' => 'text-align:center; ', )
	                        //'type'=>'raw'
	                ),
			
			array(
				'class'=>'CButtonColumn',								
				'template'=>'{reporte}&nbsp;{donacion}',
	            'htmlOptions' => array('style'=>'white-space: nowrap;text-align:center;'),
				'buttons'=>array(						    

				    'reporte' => array(
			        	'label'=>'',
			            'url'=>'Yii::app()->createUrl("bms/TCotizacion/cotizacion", array("idCotizacion"=>$data["id_cotizacion"]))',
						'options'=>array(
			            	'class'=>'fa fa-file-pdf-o fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Cotización',									
							'target'=>'_blank'							
			            ),
			            'click'=>'js: function(e){                                                
	                       
	                        e.preventDefault();
	                        $("#urlImpresion").val($(this).attr("href"));
	                        imprimir();

	                        return false;

	                    }',
			        	'live'=>false						        	
	                ),

				    
	                'donacion' => array(
	                	'label'=>'',
				        'url'=>'"/idP/".$data->id_responsable."/idCot/".$data->id_cotizacion',
				        'options'=>array(
			            	'class'=>'fa fa-puzzle-piece fa-lg tooltips','title'=>'Solicitar DonaciÃ³n','role'=>'button','data-toggle'=>'modal','data-target'=>'#modalSolicitudDonacion','onclick'=>'js: getCotizacionResponsables($(this).attr("href"));  return false; '
			            ),		
				       // 'click'=>'function(){ getCotizacionResponsable($(this).attr("href")); return false; }',
				    	//'live'=>false,

			            //'click'=>'js: function(){return false;} ',
			            // 'click'=>'js: function(e){
	              //           e.preventDefault();
	              //           $("#modalSolicitudDonacion").modal("modal");
	              //           return false;
	              //       }',
			        	//'live'=>false						        	
	                ),		  



				),	
			),
		),
	)); ?>

	<input type="hidden" id="ind_membrete" name="ind_membrete" value="true" />
	<input type="hidden" id="ind_cuenta" name="ind_cuenta" value="true" /> 
	<input type="hidden" id="ind_laboratorio" name="ind_laboratorio" value="true" /> 
	<input type="hidden" id="id_laboratorio" name="id_laboratorio" value="1" /> <!-- BMS por defecto -->
	<input type="hidden" id="urlImpresion" name="urlImpresion" value="" />

</div>

<?php 
/*	$modelBeneficiario=new TBeneficiario;
	$modelDB=new TDatosBasicos;
	$modelParentesco=new TParentesco;
	$modelMedico=new TMedico;
	$modelDBMedico=new TDatosBasicos;
	$modelDirMedico=new TDatosBasicosDireccion;
	$modelEspecialidad=new TEspecialidad;*/
?>

<!-- Popup Header -->
<div class="modal fade" id="modalSolicitudDonacion" tabindex="-1" role="dialog" aria-labelledby="modalSolicitudDonacionLabel" >

<div class="modal-dialog modal-lg role='document'">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalSolicitudDonacionLabel">Arma tu caso!</h4>
	</div>
	<!-- Popup Content -->
	<div class="modal-body">

	</div>
	<!-- Popup Footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-default theme_button color1 pull-right" id="buttonSolicitarDonacion">Postular</button> 
	     
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  

	</div>
</div>
</div>
</div>
