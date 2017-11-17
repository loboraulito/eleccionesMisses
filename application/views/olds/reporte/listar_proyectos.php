<div id="container">
    <h3>Listado de Proyectos</h3>
            	           
            	<?php if($proyectos):?>
            	<table class="table table-bordered table-striped table-hover">
            		<tr>
            			<th>Codigo SISIN</th>
            			<th>Descripcion</th>			
            			<th>Unidad Funcional</th>		
            			<th>Fecha Registro</th>			
            			<th>Opciones</th>
            		</tr>
            	<?php foreach ($proyectos as $proyecto):?>
            	   <tr class="<?php echo $proyecto->estado=='I'?'danger':'';?>">
            			<td><?php echo $proyecto->codigo_sisin; ?></td>
            			<td><?php echo $proyecto->descripcion; ?></td>
            			<td><?php echo $proyecto->usigla; ?></td>
            			<td><?php echo $proyecto->fecha_registro; ?></td>			
            			<td> 
            			 <a href="<?php echo base_url().'reporte/reportes/detalles/'.$proyecto->codigo_sisin;?>" target="_blank"> <img src="<?php echo base_url().'public/img/print.png'; ?>"></a>  
            			</td>
            		</tr>
            	<?php endforeach;?>
            	</table>            	
            	<?php endif;?>       

	

</script>
<style>
.datepicker{z-index:1151 !important;}
</style>