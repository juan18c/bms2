

<script type="text/javascript">
$("body").on("click","button[name='conciliar_datos']",function(){
	
	$("input[name=\'autoId[]\']").each(function() {	         	
         	var id_text=$(this).val().split("-");
         	if ($(this).is(":checked")){
	         	if ($("#"+id_text[1]).val()==""){
	         		$("#"+id_text[1]).attr('disabled','disabled');
	         	}
	        }else{
	        	$("#"+id_text[1]).val("");
	        	$("#"+id_text[1]).attr('disabled','disabled');
	        }
    });
	var formData = new FormData(document.getElementById('tdonacionguardar-form'));
    $.ajax({
        type : 'POST',
        url : '/bms/index.php/bms/TDonacionAdjudicado/updateEstatus',            
        dataType:'json',      
        data : formData,            
        cache: false,
        contentType: false,
        processData: false,
        success : function (data) {                    
           if (data.salida == 'COMPLETO') {                     
				location.reload();
	        }
        }
    })
     return false; 
	
});
 
$("body").on("click","input[name='autoId[]']",function(){
var check = 0;	
	check = $("input[name='autoId[]']:checked").length;
	contar = $("input[name='autoId[]']").length;
	var suma=0;
	var resta=0;
	var info="";
	if (check > 0) {		
		$("input[name=\'autoId[]\']:checked").each(function() {	
         	
         	var id_text=$(this).val().split("-");
         	if ($("#"+id_text[1]).val()==""){
         		suma= suma + parseFloat($(this).val()); 
         	}else{
         		suma= suma + parseFloat($("#"+id_text[1]).val());        		 
         	}
         	//$("#"+id_text[1]).removeAttr('disabled');
        });
		$('#TDonacion_monto_conciliado').val(parseFloat($('#TDonacion_monto_acumulado').val()) + suma);
		$("#conciliar_datos").prop('disabled', false);
	}else{	    
		$('#TDonacion_monto_conciliado').val("0.00");
		$("#conciliar_datos").prop('disabled', true);
		//alert($(this).val());


	}
	if (($("input[name='autoId_all']").is(":checked"))&&(check!=contar)){
		$("input[name='autoId_all']").removeAttr('checked'); 
	}
	if (!$(this).is(":checked")){
		var id_text=$(this).val().split("-");
        $("#"+id_text[1]).val("");
	}


	if (check==contar){
		$("input[name='autoId_all']").attr('checked','checked'); 
	}
	
	
});

$("body").on("click","input[name='autoId_all']",function(){
	var suma=0;
	var resta=0;
	
	if ($("input[name='autoId_all']").is(":checked")) {
		$("input[name=\'autoId[]\']").each(function() {	
         	
         	var id_text=$(this).val().split("-");
         	//if ($("#"+id_text[1]).val()==""){
         		$("#"+id_text[1]).removeAttr('disabled');
         	//}
        });


		$("input[name=\'autoId[]\']").each(function() {	
         	$(this).attr('checked','checked'); 
        });
		$("input[name=\'autoId[]\']:checked").each(function() {	
			var id_text=$(this).val().split("-");
         	if ($("#"+id_text[1]).val()==""){
         		suma= suma + parseFloat($(this).val()); 
         	}else{
         		suma= suma + parseFloat($("#"+id_text[1]).val()); 
         	}
        });
		$('#TDonacion_monto_conciliado').val(parseFloat($('#TDonacion_monto_acumulado').val()) + suma);
		$("#conciliar_datos").prop('disabled', false);
		
	}else{
		$("input[name=\'autoId[]\']").each(function() {	
         	$(this).removeAttr('checked'); 
        });
        $('#TDonacion_monto_conciliado').val("0.00");
		$("#conciliar_datos").prop('disabled', true);	   
	}
});

</script>

<div class="row">
    <div class="col-sm-12">
	    <section class="panel">
	    	<header class="panel-heading">
		    	Pagos de la Donación #<?php echo $model->codigo_donacion; ?>
		        <span class="text-muted" style="font-size:10px;">Campos con <span class="required">*</span> son obligatorios.</span>		            
		        <span class="tools pull-right">
		            <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		        </span>
		    </header>
		    <div class="panel-body">


		    <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'tdonacionguardar-form',
				'enableAjaxValidation'=>false,
		        'enableClientValidation' => true,
				'htmlOptions' => array(
		        'enctype' => 'multipart/form-data'),
					)); ?>
                  
                <div id="direccionEnvioModal"></div>
                <div id="divDonacionMensaje"></div>
                <!-- <div class="alert alert-info" role="alert"><i class="glyphicon glyphicon-info-sign"></i>Campos con <b>*</b> son obligatorios</div> -->                 

		       <div class="adv-table">
                    <!-- <div class="columns-3"> -->
                <div id="productos-div" class="adv-table">
                    
                    <?php
                     $modelAdjudicado= new TDonacionAdjudicado; 
                     $this->widget('booster.widgets.TbExtendedGridView', array(
                        'id'=>'tconciliar-grid',
                        'dataProvider'=>$dataProvider,
                        'filter'=>$modelAdjudicado,
                        // 'type'=>'striped bordered',
                        // 'template' => "{items}",
                        'itemsCssClass'=>'table table-bordered table-striped table-condensed',
                        // 'template' => "{items}\n{extendedSummary}",
                        'columns'=>array(
                        	 array(
					            'header' => '#',
					            'value' => '++$row',
                                'headerHtmlOptions' => array('style' => 'width: 5%'),
					        ),                        
                            array(  
                                'name'=>'id_donador',
                                'header' =>'Nombre Donador', 
                                'headerHtmlOptions' => array('style' => 'width: 20%'),  
                                'filter'=>false,                         
                                'value'=>'$data->idDonador->nombres." ".$data->idDonador->apellidos'
                            ),
                            array(  
                                'name'=>'fecha_creacion',
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                                'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
                                'filter'=>false,   
                            ),
                            array(  
                                'name'=>'id_medio_pago',
                                'header' =>'Medio de Pago', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                                'value'=>'$data->idMedioPago->descripcion',
                                'filter'=>false,   
                            ),
							array(   
                                'name'=>'monto',
                                'header'=>'Monto Donado',
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                                'value'=>'$data->monto',
                                'filter'=>false,
                                'footer'=>'Total Monto Verificado'   
                            ),
                            array(   
                                'name'=>'monto_conciliado',
                                'header'=>'Monto Verificado',
                                'headerHtmlOptions' => array('style' => 'width: 15%') ,                         
                                'value'=>'$data->monto_conciliado==000 ? "No conciliado":$data->monto_conciliado',
                                'filter'=>false,
                                'class'=>'booster.widgets.TbTotalSumColumn'   
                            ),
                            
                        ),                                           
                        ));

                    ?>  
                    </div>
                </div>

			<?php $this->endWidget(); ?>


	        </div>
        </section>
	</div>
</div>