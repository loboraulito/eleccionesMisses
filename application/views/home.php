 <div class="container-fluid">
    <div class="block-header">
        <h2>Ingreso al Sistema</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Datos del Jurado
                    </h2>                    
                </div>
                <div class="body">
                    <form class="form-horizontal" method="get" action="<?php echo base_url('index.php/home/login');?>">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="nombre">ID Jurado</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su ID de Jurado">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <input  type="submit" class="btn btn-primary m-t-15 waves-effect"></input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
</div>