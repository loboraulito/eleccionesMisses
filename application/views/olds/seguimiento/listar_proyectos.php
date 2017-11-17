<div id="container">
	<h3>Listado de Proyectos Registrados</h3>	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Codigo SISIN</th>
			<th>Descripción</th>
			<th>Fecha de Registro</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $proyecto):?>
	   <tr class="<?php echo $proyecto->c_obs>0?'danger':($proyecto->c_det==0?'warning':'');?>">
			<td><?php echo $proyecto->codigo_sisin; ?></td>
			<td><?php echo $proyecto->descripcion; ?></td>
			<td><?php echo $proyecto->fecha_registro; ?></td>
			<td>
				<?php echo $proyecto->c_obs>0?'Observado':($proyecto->estado == 'P'?'Aprobado':'Activo');?>
			</td>			
			<td> 
			     <a type="button" class="btn btn-default btn-xs btn-usuarios" href="<?php echo base_url().'seguimiento/proyecto_observacion/index/'.$proyecto->codigo_sisin;?>" title="Observaciones">
			         <span class="glyphicon glyphicon-edit"></span> 
			     </a>
			     <a type="button" class="btn btn-default btn-xs btn-editar" href="<?php echo base_url().'seguimiento/proyecto_detalle/index/'.$proyecto->codigo_sisin;?>" title=" Registrar Detalles">
			         <span class="glyphicon glyphicon-th-list"></span> 
			     </a>
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="aprobar('<?php echo $proyecto->codigo_sisin;?>',<?php echo $proyecto->c_obs;?>,<?php echo $proyecto->c_det;?>)" title="Aprobar Proyecto">
			         <span class="glyphicon glyphicon-ok"></span> 
			     </button>			     		     
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p>
	<?php endif;?>
</div>
<script>
function aprobar(codigo_sisin,c_obs,c_det){
	var numobs =0;
	if(c_obs==0 && c_det>0){
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/proyecto/aprobar/';?>'+codigo_sisin,        
            success: function(response){
                numobs=response;
                alert('Proyecto Aprobado');
                location.reload();
                },
            error: function(){alert('Error al intentar aprobar el proyecto');}
        });
	}else{
		if(c_obs>0)
			alert('No se puede aprobar el proyecto con observaciones');
		else
		if(c_det==0)
			alert('No se puede aprobar el proyecto sin items');
	}
    
}


</script>