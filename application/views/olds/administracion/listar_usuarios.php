<div id="container">
	<h3>Listado de Usuarios por Empleado</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>

	<div class="row">
		<p class="dato col-xs-6">
			<strong>Nombres:&nbsp;&nbsp; </strong><?php echo $empleado_model->nombres?>
		</p>
		<p class="dato col-xs-6">
			<strong>Apellidos:&nbsp;&nbsp;</strong><?php echo $empleado_model->apellidos;?>
		</p>
		<p class="dato col-xs-6">
			<strong>CI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $empleado_model->ci;?>
		</p>
		<p class="dato col-xs-6">
			<strong>Telefonos:&nbsp;&nbsp;</strong><?php echo $empleado_model->telefonos;?>
		</p>
		<p class="dato col-xs-6">
			<strong>E-mail:&nbsp;&nbsp;</strong><?php echo $empleado_model->email;?>
		</p>
		<p class="dato col-xs-6">
			<strong>Cargo:&nbsp;&nbsp;</strong><?php echo $empleado_model->cargo;?>
		</p>				
	</div>
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Cuenta</th>
			<th>Rol</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $usuario):?>
	   <tr>
			<td><?php echo $usuario->cuenta; ?></td>
			<td><?php switch ($usuario->rol) {
					    case 1:echo 'Administrador'; break;
						case 2:echo 'Operador Proyectos'; break;
						case 3:echo 'Jefe de Contrataciones'; break;
						case 4:echo 'Operador de Contrataciones'; break;
						case 5:echo 'Asistente DPDI'; break;
						case 6:echo 'Operador de Presupuestos'; break;
						case 7:echo 'Usuario'; break;
						case 8:echo 'Maxima Autoridad'; break;
					}?></td>
			<td><?php echo $usuario->estado=='A'?'Activo':'Inactivo'; ?></td>
			<td>
				<button type="button" class="btn btn-default btn-xs btn-editar"
					onclick="editar(<?php echo $usuario->id_usuario;?>)" title="Cambiar Clave">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
				<button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $usuario->id_usuario; ?>')" title="Borrar">
					<span class="glyphicon glyphicon-trash"></span> 
				</button>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	
	<?php else:;?>
	<p>No existen usuarios para este empleado</p>
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
					<h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="cuenta">Cuenta</label>
								<div class="input-group col-md-7">
									<input id="cuenta" name="cuenta"
										placeholder="Cuenta del Empleado"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9_\-]{1,}$" required
										data-remote="<?php echo site_url('/administracion/usuario/validar_cuenta');?>"
										data-error="Campo Obligatorio solo letras números y guiones" 	
										data-remote-error="La cuenta ya existe">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="inputPassword">Password</label>
								<div class="input-group col-md-7">
									<input type="password" data-minlength="6" class="form-control"
										id="inputPassword" name="inputPassword" placeholder="Password"
										required> <span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="password">Repita el
									Password</label>
								<div class="input-group col-md-7">
									<input type="password" data-minlength="6" class="form-control"
										id="password" name="password" data-match="#inputPassword"
										data-match-error="los passwords deben ser iguales"
										placeholder="Confirmar" required> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="rol">Rol</label>
								<div class="col-md-7">
									<select id="rol" name="rol" class="form-control">										
										<option value="1">Administrador</option>
										<option value="2">Operador Proyectos</option>
										<option value="3">Jefe de Contrataciones</option>
										<option value="4">Operador de Contrataciones</option>
										<option value="5">Asistente DPDI</option>
										<option value="6">Operador de Presupuestos</option>
										<option value="7">Usuario</option>
										<option value="8">Maxima Autoridad</option>
									</select>
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
<!-- editar usuario-->
	<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="cuenta">Cuenta</label>
								<div class="input-group col-md-7">
									<input id="cuenta" name="cuenta"
										placeholder="Cuenta del Empleado"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9_\-]{1,}$" required readonly="" 
										data-error="Campo Obligatorio solo letras números y guiones">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="inputPassword">Password</label>
								<div class="input-group col-md-7">
									<input type="password" data-minlength="6" class="form-control"
										id="inputPassworda" name="inputPassworda" placeholder="Password"
										required> <span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="password">Repita el
									Password</label>
								<div class="input-group col-md-7">
									<input type="password" data-minlength="6" class="form-control"
										id="passworda" name="passworda" data-match="#inputPassworda"
										data-match-error="los passwords deben ser iguales"
										placeholder="Confirmar" required> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="rol">Rol</label>
								<div class="col-md-7">
									<select id="rol" name="rol" class="form-control">									
										<option value="1">Administrador</option>
										<option value="2">Operador Proyectos</option>
										<option value="3">Jefe de Contrataciones</option>
										<option value="4">Operador de Contrataciones</option>
										<option value="5">Asistente DPDI</option>
										<option value="6">Operador de Presupuestos</option>
										<option value="7">Usuario</option>
										<option value="8">Maxima Autoridad</option>
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
				Esta seguro de Borrar al Usuario 
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
var id_empleado_var= <?php echo $empleado_model->id_empleado; ?>;


$(function() {
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });
	$('#editar').on('shown.bs.modal', function (e) { $('#form-editar').validator() });
	
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_nuevo(){
	$('#form').validator('validate');
	var datos=$('#form').serializeArray();
	datos.push({name: 'id_empleado', value: id_empleado_var});
	if(!$('#form').find('.has-error').length) {
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'administracion/usuario/nuevo';?>',
        data: datos,
        success: function(response){ $('#nuevo').modal('hide');location.reload();},
        error: function(){alert('Formulario con errores');}
    }); 
    }	
}

function guardar_editar(id){
	if(!$('#form-editar').find('.has-error').length) {
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'administracion/usuario/editar/';?>'+id,
        data: $('#form-editar').serializeArray(),
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
		      function(data){return data.id_usuario == id}
		  );
	}	

function editar(id){
	console.log(id);
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
        url: '<?php echo base_url().'administracion/usuario/borrar/';?>'+id,        
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