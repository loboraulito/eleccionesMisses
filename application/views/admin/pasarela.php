<h3>Listado de Pasarelas</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>id</th>
			<th>Nombre</th>
			<th>Ponderacion</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $pasarela):?>
	   <tr>
			<td><?php echo $pasarela->idpasarela; ?></td>
			<td><?php echo $pasarela->nombre; ?></td>
			<td><?php echo $pasarela->ponderacion; ?></td>
			<td>
				<button type="button" class="btn btn-default btn-xs btn-editar"
					onclick="editar(<?php echo $pasarela->idpasarela;?>)" title="Editar">
					<span class="glyphicon glyphicon-pencil"></span>Editar
				</button>
				<button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $pasarela->idpasarela; ?>')" title="Borrar">
					<span class="glyphicon glyphicon-trash"></span> Borrar
				</button>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	
	<?php else:;?>
	<p>No existen pasarelas</p>
	<?php endif;?>