<?php $this->widget('zii.widgets.CListView', array(
                        'id'=>'productos',
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'application.modules.bms.views.tProducto._view',    
                        'summaryText'=>'Mostrando {start} - {end} de {count} productos',
                        //'ajaxUpdate' => false,
                        'htmlOptions'=>array('class' => 'lista-productos','live'=>false),
                        // 'afterAjaxUpdate'=>'js:function(){
                        //     alert($(this).attr());
                        //     jQuery(this).fancybox();
                        // }',
                        //'ajaxUrl'=> Yii::app()->createUrl('seguridad'),
                  //       'sortableAttributes'=>array(
                  //           'descripcion',
                  //           'idProducto',
                  //           'idMarca.nombres',                            
                  // ),
                        'pager' => array(
                                //'cssFile' => Yii::app()->theme->baseUrl."/css/main2.css",
                                'htmlOptions'=>array('class'=>'pagination'),
                                'header' => '',
                                'firstPageLabel' => '<b><<</b>',
                                'lastPageLabel' => '<b>>></b>',
                                'prevPageLabel' => '<b><</b>',
                                'nextPageLabel' => '<b>></b>',
                                'selectedPageCssClass'=>'active',//default "selected"
                                //'nextPageCssClass' => 'ClassName',
                                //'previousPageCssClass' => 'ClassName',
                                //'selectedPageCssClass' => 'ClassName',
                                //'internalPageCssClass' => 'ClassName',
                            ),
                        'pagerCssClass' => 'row',
                    )); ?>