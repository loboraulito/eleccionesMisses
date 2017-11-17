    <!-- Page Content -->
    <div class="container" style="margin-top: 80px; padding: 5px 0px 0px 0px;  border: 1px solid #d6d6d6; background-color: #fff; font-family:'Arial'; font-size:12px;">
     
             <div class="col-xs-0 col-sm-2 col-md-2 col-lg-2" style="font-family:'Arial';">                
                 <div class="list-group " style="margin: 4px 0px 8px 0px;" > 
                    
                 

             <?php if($this->session->userdata('rol')==1): ?> <!-- administrador -->
              <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                    <a href="<?php echo base_url();?>administracion/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Administración </a>                   
                    <a href="<?php echo base_url();?>administracion/empleado"  id="empleado" class="list-group-item "  ><span class="glyphicon glyphicon-user" ></span> Empleado</a>
                    <a href="<?php echo base_url();?>administracion/area_funcional" id="area_funcional" class="list-group-item "><span class="glyphicon glyphicon-th-list">  </span> Areas Func.</a>
                    <a href="<?php echo base_url();?>administracion/unidad_funcional" id="unidades_funcional" class="list-group-item "><span class="glyphicon glyphicon-list-alt">  </span> Unidades Func.</a>
                    <a href="<?php echo base_url();?>administracion/fuente_organismo" id="fuente_organismo" class="list-group-item "><span class="glyphicon glyphicon-th-large"> </span> Fuentes Org</a>
                    <a href="<?php echo base_url();?>administracion/proyecto" id="proyecto" class="list-group-item "><span class="glyphicon glyphicon-book">  </span> Proyectos</a>
                    <a href="<?php echo base_url();?>administracion/reportes" id="reportes" class="list-group-item " > <span class="glyphicon glyphicon-stats"> </span> Reportes </a>

                </div>               
                <?php endif;?>

                <?php if($this->session->userdata('rol')==2): ?> <!-- Operador Proyectos -->
                  <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                    <a href="<?php echo base_url();?>seguimiento/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Administración </a>                   
                    <a href="<?php echo base_url();?>seguimiento/proyecto"  id="proyecto" class="list-group-item "  ><span class="glyphicon glyphicon-book" ></span> Proyectos</a>                  
                    <a href="<?php echo base_url();?>seguimiento/reportes_operadorp" id="reportes" class="list-group-item " > <span class="glyphicon glyphicon-stats"> </span> Reportes </a>

                </div>               
                <?php endif;?>

                 <?php if($this->session->userdata('rol')==3): ?> <!-- Jefe Contrataciones -->
                  <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                  <a href="<?php echo base_url();?>seguimiento/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Administración </a>                   
                    <a href="<?php echo base_url();?>seguimiento/proyecto/listar_asignar"  id="asignar" class="list-group-item "  ><span class="glyphicon glyphicon-retweet" ></span> Asignar</a>                  
                    <a href="<?php echo base_url();?>seguimiento/empresa"  id="empresa" class="list-group-item "  ><span class="glyphicon glyphicon-tags" ></span> Empresa</a>                  
                    <a href="<?php echo base_url();?>seguimiento/reportes_jefac" id="reportes" class="list-group-item " > <span class="glyphicon glyphicon-stats"> </span> Reportes </a>

                </div>               
                <?php endif;?>


                 <?php if($this->session->userdata('rol')==4): ?> <!-- Operador Contrataciones -->
                  <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                  <a href="<?php echo base_url();?>seguimiento/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Administración </a>                   
                    <a href="<?php echo base_url();?>seguimiento/convocatoria/index"  id="aconvocatoria" class="list-group-item "  ><span class="glyphicon glyphicon-retweet" ></span> Convocatoria</a>                  
                    <a href="<?php echo base_url();?>seguimiento/contrato"  id="contrato" class="list-group-item "  ><span class="glyphicon glyphicon-file" ></span> Contratos</a>                  
                    <a href="<?php echo base_url();?>seguimiento/contrato/enviar_para_recepcion_y_pago"  id="enviarpago" class="list-group-item "  ><span class="glyphicon glyphicon-tags" ></span> Recepcion y Pago</a>                  
                    <a href="<?php echo base_url();?>seguimiento/reportes_ocontra" id="reportes" class="list-group-item " > <span class="glyphicon glyphicon-stats"> </span> Reportes </a>

                </div>               
                <?php endif;?>
    
              <?php if($this->session->userdata('rol')==5): ?> <!-- Operador PDPDI-->
                  <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                  <a href="<?php echo base_url();?>planilla/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Administración </a>                   
                    <a href="<?php echo base_url();?>planilla/proyecto"  id="aconvocatoria" class="list-group-item "  ><span class="glyphicon glyphicon-retweet" ></span> Proyectos</a>                                      
                    <a href="<?php echo base_url();?>planilla/reportes" id="reportes" class="list-group-item " > <span class="glyphicon glyphicon-stats"> </span> Reportes </a>

                </div>               
                <?php endif;?>

              <?php if($this->session->userdata('rol')==6): ?> <!-- Operador Presupuestos -->
                  <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                  <a href="<?php echo base_url();?>pago/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Administración </a>                   
                    <a href="<?php echo base_url();?>pago/planilla/index"  id="aconvocatoria" class="list-group-item "  ><span class="glyphicon glyphicon-retweet" ></span> Proyectos</a>                                      
                    <a href="<?php echo base_url();?>pago/reportes" id="reportes" class="list-group-item " > <span class="glyphicon glyphicon-stats"> </span> Reportes </a>

                </div>               
                <?php endif;?>
                
                <?php if($this->session->userdata('rol')==7): ?> <!-- Operador Presupuestos -->
                  <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                  <a href="<?php echo base_url();?>reporte/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Usuarios </a>                   
                    <a href="<?php echo base_url();?>reporte/reportes"  id="aconvocatoria" class="list-group-item "  ><span class="glyphicon glyphicon-retweet" ></span> Proyectos</a>                                      
                    
                </div>               
                <?php endif;?>

                <?php if($this->session->userdata('rol')==8): ?> <!-- Maxima Autoridad -->
                 <a href="#" class="list-group-item list-group-item-info">  Menu Principal </a>                   
                  <a href="<?php echo base_url();?>rector/index" id="inicio" class="list-group-item "  ><span class="glyphicon glyphicon-home"> </span> Inicio</a>                    
                    
                 <div class="list-group " style="margin: 10px 0px 8px 0px; "  > 
                    <a href="#" class="list-group-item list-group-item-success">  Usuarios </a>                   
                    <a href="<?php echo base_url();?>reporte/rector/proyectos"  id="aconvocatoria" class="list-group-item "  ><span class="glyphicon glyphicon-retweet" ></span> Proyectos</a>                                      
                    
                </div>             
                <?php endif;?>
                <div class="list-group "> 
                  <a href="#" class="list-group-item list-group-item-warning" >  Cerrar Sesion </a>                   
                  <a href="<?php echo base_url();?>home/logout" class="list-group-item" ><span class="glyphicon glyphicon-lock " > </span> Salir</a>
                </div>

                </div>                
            </div>
   

         