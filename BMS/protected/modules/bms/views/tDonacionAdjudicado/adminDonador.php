

<section id="content" class="ls section_padding_25">
  <div class="container">
    <div class="page-heading">
          <h3>Mis Donaciones</h3>
    </div>
	<div class="row">
	    <div class="col-sm-12"> 
	       <div class="adv-table">
                <!-- <div class="columns-3"> -->
            <div id="productos-div" class="adv-table">
                
                <?php
				$this->widget('booster.widgets.TbExtendedGridView', array(
                    'id'=>'tconciliar-grid',
                    'dataProvider'=>$model->searchDonador($_GET['idDonador']),
                   // 'filter'=>$modelAdjudicado,
                    'itemsCssClass'=>'table table-bordered table-striped table-condensed',
                    'columns'=>array(
                    	 array(
				            'header' => '#',
				            'value' => '++$row',
				            'headerHtmlOptions' => array('style' => 'width: 3%'), 
				        ),                        
                        array(  
                            'name'=>'fecha_creacion',
                            'header' => 'Fecha Donación',
                            'headerHtmlOptions' => array('style' => 'width: 8%'),                            
                            'value'=>'date(\'d/m/y\',strtotime($data->fecha_creacion))',
                            'filter'=>false,   
                        ),
                        array(  
                            'name'=>'id_medio_pago',
                            'header' =>'Medio Pago', 
                            'headerHtmlOptions' => array('style' => 'width: 15%'),                            
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
                            'name'=>'monto_conciliado',
                            'header'=>'Monto Conciliado',
                            'headerHtmlOptions' => array('style' => 'width: 10%'),                            
                            'value'=>'"$".$data->monto_conciliado',
                            'filter'=>false, 
                            //'footer'=>'Total Monto Verificado'  
                        ),
                    ),
                    ));

                ?>  
                </div>
            </div>
		</div>
	 </div>

	</div>
</section>


 


