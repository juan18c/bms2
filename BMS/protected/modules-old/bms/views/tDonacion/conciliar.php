

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
        url :'<?php echo Yii::app()->createUrl("bms/TDonacionAdjudicado/updateEstatus");?>',            
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
		    	Conciliar Pagos de la Donación #<?php echo $model->codigo_donacion; ?>
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



		    	    <div class="form-group">
                        <div class="col-xs-3">
                            <label class="control-label" for="TDonacion_monto_solicitado">Monto Solicitado</label>                          
                           <?php echo $form->textField($model,'monto_solicitado',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'$0.00','readOnly'=>true)); ?>

                            <?php echo $form->error($model,'monto_solicitado'); ?>
                        </div>
                        <div class="col-xs-3">
                            <label class="control-label" for="TDonacion_monto_acumulado">Monto Acumulado</label>                          
                           <?php echo $form->textField($model,'monto_acumulado',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'$0.00','readOnly'=>true)); ?>

                            <?php echo $form->error($model,'monto_acumulado'); ?>
                        </div>
                        <div class="col-xs-3">
                            <label class="control-label" for="TDonacion_monto_conciliado">Monto Conciliado</label>                          
                           <?php echo $form->textField($model,'monto_conciliado',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'0.00','readOnly'=>true)); ?>

                            <?php echo $form->error($model,'monto_conciliado'); ?>
                        </div>
                        <div class="col-xs-3">
                        	<div class="form-group clearfix" style="margin-top:23px">
                        	<button class="btn btn-primary" type="button" id="conciliar_datos" name="conciliar_datos" disabled="disabled"><i class="fa fa-save"></i> Conciliar</button>
                        	</div>
                        </div>
                        <input type="hidden" id="datos_conciliar" name="datos_conciliar" value="" />

                    </div>

                 

		       <div class="adv-table">
                    <!-- <div class="columns-3"> -->
                <div id="productos-div" class="adv-table">
                    
                    <?php
                     $modelAdjudicado= new TDonacionAdjudicado; 
                     $this->widget('booster.widgets.TbExtendedGridView', array(
                        'id'=>'tconciliar-grid',
                        'dataProvider'=>$dataProvider,
                        'filter'=>$modelAdjudicado,
                        'itemsCssClass'=>'table table-bordered table-striped table-condensed',
                        'columns'=>array(
                        	 array(
					            'header' => '#',
					            'value' => '++$row',
					            'headerHtmlOptions' => array('style' => 'width: 3%'), 
					        ),                        
                            array(  
                                'name'=>'id_donador',
                                'header' =>'Nombre Donador', 
                                'headerHtmlOptions' => array('style' => 'width: 12%'),  
                                'filter'=>false,                         
                                'value'=>'$data->idDonador->nombres." ".$data->idDonador->apellidos'
                            ),
                            array(  
                                'name'=>'fecha_creacion',
                                'headerHtmlOptions' => array('style' => 'width: 8%'),                            
                                'value'=>'date(\'d/m/Y\',strtotime($data->fecha_creacion))',
                                'filter'=>false,   
                            ),
                            array(  
                                'name'=>'id_medio_pago',
                                'header' =>'Medio Pago', 
                                'headerHtmlOptions' => array('style' => 'width: 10%'),                            
                                'value'=>'$data->idMedioPago->descripcion',
                                'filter'=>false,   
                            ),
                            array(  
                                'name'=>'email',
                                'header' =>'Email Pago', 
                                'headerHtmlOptions' => array('style' => 'width: 10%'),                            
                                'value'=>'$data->email',
                                'filter'=>false,  
                                //'visible' =>'$data->id_medio_pago==1' 
                            ),
                            array(  
                                'name'=>'nombre_banco',
                                'header' =>'Banco', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                                'value'=>'$data->nombre_banco',
                                'filter'=>false,  
                                //'visible' =>'$data->id_medio_pago==2||$data->id_medio_pago==4' 
                            ),
                            array(  
                                'name'=>'numero_cuenta',
                                'header' =>'# Cuenta', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                               // 'value'=>'$data->nombre_banco',
                                'filter'=>false,  
                                //'visible' =>'$data->id_medio_pago==2||$data->id_medio_pago==4? true:false'
                            ),
                            array(  
                                'name'=>'numero_ruta_bancaria',
                                'header' =>'# Ruta', 
                                'headerHtmlOptions' => array('style' => 'width: 15%'),                            
                               // 'value'=>'$data->nombre_banco',
                                'filter'=>false, 
                               // 'visible' =>'$data->id_medio_pago==2||$data->id_medio_pago==4'  
                            ),
                            
							array(   
                                'name'=>'monto',
                                'header'=>'Monto Donado',
                                'headerHtmlOptions' => array('style' => 'width: 10%'),                            
                                'value'=>'"$".$data->monto',
                                'filter'=>false, 
                                //'footer'=>'Total Monto Verificado'  
                            ),
                            array(   
                                'name'=>'monto',
                                'header'=>'Monto Verificado',
                                'type'=>'raw',
                                'headerHtmlOptions' => array('style' => 'width: 10%'),                            
                                'value'=>'CHtml::textField("monto-$data->id_donacion_adjudicado","",array("style"=>"span2","class"=>"form-control","id"=>"$data->id_donacion_adjudicado","name"=>"texto"))',
                                'filter'=>false,   
                                //'class'=>'booster.widgets.TbTotalSumColumn'
                            ),
                            array(
							'id'=>'autoId',
							'class'=>'CCheckBoxColumn',
							'selectableRows' => '50',
							'headerHtmlOptions' => array('style' => 'width: 5%'),
							'value'=>'$data->monto."-".$data->id_donacion_adjudicado',
							

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