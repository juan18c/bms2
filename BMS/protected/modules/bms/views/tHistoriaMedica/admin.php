<?php
$urlBusqueda = Yii::app()->createUrl("bms/TCotizacion/buscarDocumentoHistoria");
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'thistoria-medica-grid',
	'dataProvider'=>$modelHMC->searchCot($idHM,$idR,$idDocumento),
	'filter'=>$modelHMC,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		//'idHistoriaMedica.id_historia_medica',
		array(
			'header'=>'Nombre',
            'name'=>'nombre',
            'filter' => CHtml::activeTextField($modelHMC, 'nombre'), 
            'value' => '$data->nombre'
        ),
		//'id_responsable',
		array(
			'header'=>'Tipo',
            'name'=>'tipo_carga',
            'filter' => CHtml::activeTextField($modelHMC, 'tipo_carga'), 
            'value' => '$data->tipo_carga'
        ),
        array(
			'header'=>'Documentos',
            'name'=>'documento',            
            'value' => 'THistoriaMedicaDocumento::model()->getDocumentos($data->id_historia_medica_caso)',
            'type'=>'raw'
        ),
        array(
			'header'=>'Médico Tratante',
            'name'=>'medico',
            //'filter' => CHtml::activeTextField($modelHMM, 'id_historia_medica_medico'), 
            'value' => 'THistoriaMedicaCasoMedico::model()->getMedicos($data->id_historia_medica_caso)'
        ),   
		//'tHistoriaMedicaCasos.tipo_carga',
		//'tHistoriaMedicaCasos.duracion',
		'fecha_realizacion',
		//'id_estatus',
		//'fecha_creacion',
		array(
			'class'=>'CButtonColumn',								
			'template'=>'{borrar}',
			'buttons'=>array(
				'borrar' => array                            
                (
                    'label'=>'',	
                    'url'=>'Yii::app()->createUrl("bms/THistoriaMedicaCaso/deleteCaso",array("id"=>$data->id_historia_medica_caso))',
		            'options'=>array(		            	
		            	'title' => 'Eliminar Caso',
		            	'onclick'=>'					            		
							var r = confirm("¿Está seguro que desea borrar este caso?");
							
							if (r == true) {											   
			            		$.ajax({
								    url:$(this).attr("href"),
								    type:"POST",   
								    dataType:"json",								    
								    success: function(data){ 
								    	if(data.salida == "ok"){														
								    		$("#divHistoriaMedicaMensaje").html(data.mensaje).show(); 

		            						$("#THistoriaMedicaCaso_id_historia_medica_caso option[value=\'"+data.id +"\']").each(function() {
											    $(this).remove();
											});

                                            $("#THistoriaMedicaCaso_id_historia_medica_caso").selectpicker("refresh");                                            
                                            var burl= "'.$urlBusqueda.'";
                                            $.ajax({
			                                    type : "POST",
			                                    url : burl+"/idR/"+$("#idResponsable").val()+"/idHM/"+$("#idHistoriaMedica").val()+"/idHMC/"+$("#THistoriaMedicaCaso_id_historia_medica_caso").selectpicker("val"),
			                                    data : data,
			                                    dataType: "json",                                               
			                                    success : function (data) {
			                                        $("#historia-documentos-div").html(data.documento).show();
			                                    }
			                                
			                                });

			                                return false;


			            				}else{
			            					alert(data);
			            				}

			            				return false;															            				
									}
								});	
							} 
							return false;								            		
		            	',
                   		'class'=>'fa fa-trash fa-lg'
		            ),															             
		            'click'=>'js: function(){ return false; } ',   
		            //'visible'=>'$data["id_medico"] == '.$idMedico,
                ),



			    
			),	
		),
	),
)); ?>