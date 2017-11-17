<div id="container">
	<h3>Lista de Empresas Registradas</h3>
	<a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>NIT</th>
			<th>Empresa</th>
			<th>Telefono</th>					
			<th>Dirección</th>
			<th>Email</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $empresa):?>
	   <tr class="<?php echo $empresa->estado=='I'?'danger':'';?>">
			<td><?php echo $empresa->nit; ?></td>
            <td><?php echo $empresa->nombre; ?></td>            
            <td><?php echo $empresa->telefono; ?></td>            
            <td><?php echo $empresa->direccion; ?></td> 
            <td><?php echo $empresa->email; ?></td> 
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar('<?php echo $empresa->id_empresa; ?>')">
			         <span class="glyphicon glyphicon-pencil"></span> Editar
			     </button>			     
			     <button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $empresa->id_empresa; ?>')">
			         <span class="glyphicon glyphicon-trash"></span> Borrar
			     </button>			     			     
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p>
	<?php endif;?>
	
	
	<div class="modal fade" id="nuevo" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Nueva Empresa</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombre">Nombre</label>
								<div class="input-group col-md-7">
									<input id="nombre" name="nombre"
										placeholder="Nombre de la Empresa"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9\s]{1,}$" required
										data-remote="<?php echo site_url('/seguimiento/empresa/validar_nombre_empresa');?>"
										data-error="Campo Obligatorio solo letras números y espacios"
										data-remote-error="La Empresa ya existe "> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="telefono">Telefono</label>
								<div class="input-group col-md-7">
									<input id="telefono" name="telefono"
										placeholder="telefono"
										class="form-control input-md" type="text"
										pattern="^[\s0-9\-]{1,}$" required
										data-error="Campo Obligatorio solo números, guione y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>							
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Dirección</label>
								<div class="input-group col-md-7">
									<input id="direccion" name="direccion"
										placeholder="Dirección del Empleado"
										class="form-control input-md" type="text"
										pattern="^[_A-z0-9\-\s]{1,}$" required
										data-error="Campo Obligatorio solo letras, números, espacios y guión"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>							
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Email</label>
								<div class="input-group col-md-7">
									<input id="email" name="email"
										placeholder="Email del Empleado"
										class="form-control input-md" type="email"
										required
										data-error="Campo Obligatorio debe ser un email válido"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="responsable_juridico">Responsable Jurídico</label>
								<div class="input-group col-md-7">
									<input id="responsable_juridico" name="responsable_juridico"
										placeholder="Responsable Jurídico"
										class="form-control input-md" type="text"
										required
										data-error="Campo Obligatorio"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nit">NIT</label>
								<div class="input-group col-md-7">
									<input id="nit" name="nit"
										placeholder="nit"
										class="form-control input-md" type="text"
										required
										data-remote="<?php echo site_url('/seguimiento/empresa/validar_nit');?>"
										data-error="Campo Obligatorio "
										data-remote-error="El NIT ya existe "> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>							
						</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button id="guardar-btn" type="button" class="btn btn-primary">Guardar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
<!-- editar empresa -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Empresa</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombre">Nombre</label>
								<div class="input-group col-md-7">
									<input id="nombre" name="nombre"
										placeholder="Nombre de la Empresa"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9\s]{1,}$" required
										data-error="Campo Obligatorio solo letras números y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="telefono">Telefono</label>
								<div class="input-group col-md-7">
									<input id="telefono" name="telefono"
										placeholder="telefono"
										class="form-control input-md" type="text"
										pattern="^[\s0-9\-]{1,}$" required
										data-error="Campo Obligatorio solo números, guione y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>							
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Dirección</label>
								<div class="input-group col-md-7">
									<input id="direccion" name="direccion"
										placeholder="Dirección del Empleado"
										class="form-control input-md" type="text"
										pattern="^[_A-z0-9\-\s]{1,}$" required
										data-error="Campo Obligatorio solo letras, números, espacios y guión"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>							
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Email</label>
								<div class="input-group col-md-7">
									<input id="email" name="email"
										placeholder="Email del Empleado"
										class="form-control input-md" type="email"
										required
										data-error="Campo Obligatorio debe ser un email válido"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="responsable_juridico">Responsable Jurídico</label>
								<div class="input-group col-md-7">
									<input id="responsable_juridico" name="responsable_juridico"
										placeholder="Responsable Jurídico"
										class="form-control input-md" type="text"
										required
										data-error="Campo Obligatorio"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nit">NIT</label>
								<div class="input-group col-md-7">
									<input id="nit" name="nit"
										placeholder="nit"
										class="form-control input-md" type="text"
										required
										data-error="Campo Obligatorio "> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="estado">Estado</label>
								<div class="col-md-7">
									<select id="estado" name="estado"
										class="form-control">
										<option value="A">Activo</option>
										<option value="I">Inactivo</option>										
									</select>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button id="guardar-btn1" type="button" class="btn btn-primary">Guardar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="confirmar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">¿Borrar?</h4>
				</div>
				<div class="modal-body">
					Esta seguro de Borrar el Empleado
				</div>
				<div class="modal-footer">
					<button id="confirmar-guardar-btn" type="button" class="btn btn-primary" >Si</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>	
</div>
<script>
var js_data = '<?php echo json_encode($resultados); ?>';
var js_obj_data = JSON.parse(js_data);



$(function() {
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });
	$('#editar').on('shown.bs.modal', function (e) { $('#form-editar').validator() });
	
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_nuevo(){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/empresa/nuevo';?>',
            data: $('#form').serialize(),
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Formulario con errores');}
        }); 
	}	
}

function guardar_editar(id){
	if(!$('#form-editar').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/empresa/editar/';?>'+id,
            data: $('#form-editar').serialize(),
            success: function(response){ $('#editar').modal('hide');location.reload();},
            error: function(){alert('Formulario con errores');}
        }); 
	}	
}

function nuevo(){
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo();
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_empresa == id}
		  );
	}	

function editar(id){
	$('#form-editar').resetear();
	populate_form(buscar(id)[0]);
	$('#editar').modal('show');
	$( "#guardar-btn1").unbind( "click" );
	$( "#guardar-btn1" ).bind( "click", function() {
		  guardar_editar(id);
	});
}

function borrar(id){	
	$('#confirmar').modal('show');
	$( "#confirmar-guardar-btn").unbind( "click" );
	$( "#confirmar-guardar-btn" ).bind( "click", function() {
		  guardar_borrar(id);
	});
}

function guardar_borrar(id){
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'seguimiento/empresa/borrar/';?>'+id,        
        success: function(response){ $('#confirmar').modal('hide');location.reload();},
        error: function(){alert('Formulario con errores');}
    }); 	
}
function populate_form(datos){
	//console.log(datos[0]);
	$.each(datos, function(name, val){
	    var $el = $('[name="'+name+'"]'),
	        type = $el.attr('type');
		console.log($el);
		console.log(type);
		console.log(val);
	    switch(type){
	        case 'checkbox':
	            $el.attr('checked', 'checked');
	            break;
	        case 'radio':
	            $el.filter('[value="'+val+'"]').attr('checked', 'checked');
	            break;
	        default:
	            $el.val(val);
	    }
	});
}


</script>