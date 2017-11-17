<h3>Listado de Jurados</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>id</th>
			<th>Nombre</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $jurado):?>
	   <tr>
			<td><?php echo $jurado->idjurado; ?></td>
			<td><?php echo $jurado->nombre; ?></td>
			<td><?php echo $jurado->estado; ?></td>
			<td>
				<button type="button" class="btn btn-default btn-xs btn-editar"
					onclick="editar(<?php echo $jurado->idjurado;?>)" title="Editar">
					<span class="glyphicon glyphicon-pencil"></span>Editar
				</button>
				<button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $jurado->idjurado; ?>')" title="Borrar">
					<span class="glyphicon glyphicon-trash"></span> Borrar
				</button>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	
	<?php else:;?>
	<p>No existen jurados</p>
	<?php endif;?>