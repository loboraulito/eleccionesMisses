<h3>Listado de Participantes</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>id</th>
			<th>Apellidos</th>
			<th>Nombres</th>
			<th>Hobbies</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $participante):?>
	   <tr>
			<td><?php echo $participante->idparticipante; ?></td>
			<td><?php echo $participante->apellidos; ?></td>
			<td><?php echo $participante->nombres; ?></td>
			<td><?php echo $participante->hobies; ?></td>
			<td>
				<button type="button" class="btn btn-default btn-xs btn-editar"
					onclick="editar(<?php echo $participante->idparticipante;?>)" title="Editar">
					<span class="glyphicon glyphicon-pencil"></span>Editar
				</button>
				<button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $participante->idparticipante; ?>')" title="Borrar">
					<span class="glyphicon glyphicon-trash"></span> Borrar
				</button>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	
	<?php else:;?>
	<p>No existen participantes</p>
	<?php endif;?>