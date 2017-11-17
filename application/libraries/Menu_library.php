<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_library {
  public function get_menu($rol) {
    if($rol==1){ 
       $menu[]=array(
           'template'=>'class="glyphicon glyphicon-home"',
           'titulo'=>'Empleados',
           'link'=>'administracion/empleado'
       );
       $menu[]=array(
           'titulo'=>'Áreas Funcionales',
           'link'=>'administracion/area_funcional'
       );
       $menu[]=array(
           'titulo'=>'Unidades Funcionales',
           'link'=>'administracion/unidad_funcional'
       );
       $menu[]=array(
           'titulo'=>'Fuentes de Financiamiento',
           'link'=>'administracion/fuente_organismo'
       );
       $menu[]=array(
           'titulo'=>'Proyectos',
           'link'=>'administracion/proyecto'
       );
    }
    
    if($rol==2){ 
        $menu[]=array(
            'titulo'=>'Proyectos',
            'link'=>'seguimiento/proyecto'
        );
        $menu[]=array(
            'titulo'=>'Reportes',
            'link'=>'seguimiento/reporte'
        );
    }
    if($rol==3){ 
        $menu[]=array(
            'titulo'=>'Asignar',
            'link'=>'seguimiento/proyecto/listar_asignar'
        );
        $menu[]=array(
            'titulo'=>'Empresas',
            'link'=>'seguimiento/empresa'
        );
    }
    if($rol==4){ //
        $menu[]=array(
            'titulo'=>'Publicar',
            'link'=>'seguimiento/convocatoria/index'
        );
        $menu[]=array(
            'titulo'=>'Contratos',
            'link'=>'seguimiento/contrato'
        );
        $menu[]=array(
            'titulo'=>'Recepción y Pago',
            'link'=>'seguimiento/contrato/enviar_para_recepcion_y_pago'
        );
    }
    if($rol==6){ //
        $menu[]=array(
            'titulo'=>'Proyectos',
            'link'=>'pago/pago/index'
        );
        $menu[]=array(
            'titulo'=>'Reportes',
            'link'=>'pago/reporte'
        );
    }
    return $menu;
  }
}

    
    
