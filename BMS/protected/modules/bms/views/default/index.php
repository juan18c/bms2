<?php 
    
    Yii::app()->clientScript->registerScript('init', "

        var parent = $('#menuInicio > a').parent();         
        visibleSubMenuClose();        
        parent.addClass('active');    

        // Use Morris.Area instead of Morris.Line
        Morris.Donut({
            element: 'graph-donut',
            data: [
                {value: 40, label: 'Clientes', formatted: 'at least 70%' },
                {value: 30, label: 'Donaciones', formatted: 'approx. 15%' },
                {value: 20, label: 'Cotizaciones', formatted: 'approx. 10%' },
                {value: 10, label: 'Órdenes', formatted: 'at most 99.99%' }
            ],
            backgroundColor: false,
            labelColor: '#fff',
            colors: [
                '#820906','#ff792b','#000','#323232'
            ],
            formatter: function (x, data) { return data.formatted; }
        });





    ",CClientScript::POS_READY);

    
?>

<!-- page heading start-->
<div class="page-heading">
    <h3>
        Hola, buenas tardes !!!
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Escritorio</a>
        </li>
        <li class="active"> Inicio </li>
    </ul>
    
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-6">
            <!--statistics start-->
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel vinotinto">
                        <div class="symbol">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">230</div>
                            <div class="title">Cotizaciones</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel naranja">
                        <div class="symbol">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">3490</div>
                            <div class="title">Órdenes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row state-overview">
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel negro">
                        <div class="symbol">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">22014</div>
                            <div class="title">Despachos</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6">
                    <div class="panel gris">
                        <div class="symbol">
                            <i class="fa fa-puzzle-piece"></i>
                        </div>
                        <div class="state-value">
                            <div class="value">390</div>
                            <div class="title"> Donaciones </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--statistics end-->
        </div>
        <div class="col-md-6">
            <!--more statistics box start-->
            <div class="panel deep-purple-box">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-7">
                            <div id="graph-donut" class="revenue-graph"></div>

                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <ul class="bar-legend">
                                <li><span class="vinotinto"></span> Clientes</li>
                                <li><span class="naranja"></span> Donaciones</li>
                                <li><span class="negro"></span> Cotizaciones</li>
                                <li><span class="gris"></span> Órdenes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--more statistics box end-->
        </div>
    </div>
    <div class="row">                
        <div class="col-md-4">
            <div class="panel">
                <header class="panel-heading">
                    Donaciones
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                    <ul class="goal-progress">
                        <li>
                            <div class="prog-avatar">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user1.png" alt=""/>
                            </div>
                            <div class="details">
                                <div class="title">
                                    <a href="#">John Doe</a> - Project Lead
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                        <span class="">70%</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="prog-avatar">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user2.png" alt=""/>
                            </div>
                            <div class="details">
                                <div class="title">
                                    <a href="#">Cameron Doe</a> - Sales
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 91%">
                                        <span class="">91%</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="prog-avatar">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user3.png" alt=""/>
                            </div>
                            <div class="details">
                                <div class="title">
                                    <a href="#">Hoffman Doe</a> - Support
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="">40%</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="prog-avatar">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user4.png" alt=""/>
                            </div>
                            <div class="details">
                                <div class="title">
                                    <a href="#">Jane Doe</a> - Marketing
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        <span class="">20%</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="prog-avatar">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/photos/user5.png" alt=""/>
                            </div>
                            <div class="details">
                                <div class="title">
                                    <a href="#">Hoffman Doe</a> - Support
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                        <span class="">45%</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center"><a href="#">Ver Todos</a></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel">
                <header class="panel-heading">
                    Pendientes
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                     </span>
                </header>
                <div class="panel-body">
                    <ul class="to-do-list" id="sortable-todo">
                        <li class="clearfix">
                            <span class="drag-marker">
                            <i></i>
                            </span>
                            <div class="todo-check pull-left">
                                <input type="checkbox" value="None" id="todo-check"/>
                                <label for="todo-check"></label>
                            </div>
                            <p class="todo-title">
                                Dashboard Design & Wiget placement
                            </p>
                            <div class="todo-actionlist pull-right clearfix">

                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <span class="drag-marker">
                            <i></i>
                            </span>
                            <div class="todo-check pull-left">
                                <input type="checkbox" value="None" id="todo-check1"/>
                                <label for="todo-check1"></label>
                            </div>
                            <p class="todo-title">
                                Wireframe prepare for new design
                            </p>
                            <div class="todo-actionlist pull-right clearfix">

                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <span class="drag-marker">
                            <i></i>
                            </span>
                            <div class="todo-check pull-left">
                                <input type="checkbox" value="None" id="todo-check2"/>
                                <label for="todo-check2"></label>
                            </div>
                            <p class="todo-title">
                                UI perfection testing for Mega Section
                            </p>
                            <div class="todo-actionlist pull-right clearfix">

                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <span class="drag-marker">
                            <i></i>
                            </span>
                            <div class="todo-check pull-left">
                                <input type="checkbox" value="None" id="todo-check3"/>
                                <label for="todo-check3"></label>
                            </div>
                            <p class="todo-title">
                                Wiget & Design placement
                            </p>
                            <div class="todo-actionlist pull-right clearfix">

                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <span class="drag-marker">
                            <i></i>
                            </span>
                            <div class="todo-check pull-left">
                                <input type="checkbox" value="None" id="todo-check4"/>
                                <label for="todo-check4"></label>
                            </div>
                            <p class="todo-title">
                                Development & Wiget placement
                            </p>
                            <div class="todo-actionlist pull-right clearfix">

                                <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </li>

                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" class="form-inline">
                                <div class="form-group todo-entry">
                                    <input type="text" placeholder="Enter your ToDo List" class="form-control" style="width: 100%">
                                </div>
                                <button class="btn btn-primary pull-right" type="submit">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>       

        <div class="col-md-4">
          <div class="panel">
              <div class="panel-body">
                  <div class="calendar-block">
                      <div class="cal1">

                      </div>
                  </div>

              </div>
          </div>
        </div>                
                
    </div>            
</div>
<!--body wrapper end
