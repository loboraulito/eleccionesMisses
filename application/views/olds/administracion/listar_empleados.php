<div id="container">
	<h3>Administración de Empleados de la UTO</h3>
	<a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus"
		data-toggle="modal" style="font-size: 15px; padding-bottom: 10px;">Nuevo</a>

	<?php if($resultados):?>
	
	<form action="<?php echo base_url();?>administracion/empleado">
		<div class="filtro-buscar form-group col-md-12 col-xs-12 col-sm-12">
			<div class="input-group col-md-12">
				<input id="buscar" name="buscar" placeholder="Nombre, Apellido o Carnet"
					class="form-control input-md" type="text"> 
				<span
					class="input-group-btn">
					<button class="btn btn-default btn-primary" type="submit">Buscar</button>
				</span>
			</div>
		</div>
	</form>
	
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Apellidos</th>
			<th>Nombres</th>
			<th>Celular</th>
			<th>Unidad</th>
			<th>Email</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $empleado):?>
	   <tr class="<?php echo $empleado->estado=='I'?'danger':'';?>">
			<td><?php echo $empleado->apellidos; ?></td>
			<td><?php echo $empleado->nombres; ?></td>
			<td><?php echo $empleado->telefonos; ?></td>
			<td><?php echo $empleado->usigla; ?></td>
			<td><?php echo $empleado->email; ?></td>
			<td>
				<button type="button" class="btn btn-default btn-xs btn-editar"
					onclick="editar('<?php echo $empleado->id_empleado; ?>')"
					title="Editar">
					<span class="glyphicon glyphicon-pencil"></span>
				</button> <a type="button"
				class="btn btn-default btn-xs btn-usuarios"
				href="<?php echo base_url().'administracion/usuario/index/'.$empleado->id_empleado;?>"
				title="Usuarios"> <span class="glyphicon glyphicon-user"></span>
			</a>
				<button type="button" class="btn btn-default btn-xs btn-borrar"
					onclick="borrar('<?php echo $empleado->id_empleado;?>')"
					title="Borrar">
					<span class="glyphicon glyphicon-trash"></span>
				</button>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p>
	<?php endif;?>
	
	
	<div class="modal fade" id="nuevo" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Nuevo Empleado</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal" data-toggle="validator"
						role="form">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Nombres</label>
								<div class="input-group col-md-7">
									<input id="nombres" name="nombres"
										placeholder="Nombre del Empleado"
										class="form-control input-md" type="text"
										pattern="^[A-z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Apellidos</label>
								<div class="input-group col-md-7">
									<input id="apellidos" name="apellidos"
										placeholder="Apellidos del Empleado"
										class="form-control input-md" type="text"
										pattern="^[A-z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">CI</label>
								<div class="input-group col-md-7">
									<input id="ci" name="ci" placeholder="CI del Empleado"
										class="form-control input-md" type="text"
										pattern="^[_A-Z0-9\-]{1,}$" required
										data-error="Campo Obligatorio solo números y letras mayúsculas y guión">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
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
										pattern="^[A-z0-9\s]{1,}$" required
										data-error="Campo Obligatorio solo números y letras y guión">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Teléfonos</label>
								<div class="input-group col-md-7">
									<input id="telefonos" name="telefonos"
										placeholder="Teléfonos del Empleado"
										class="form-control input-md" type="text"
										pattern="^[0-9\-\(\)]{1,}$" required
										data-error="Campo Obligatorio solo números y guiónes y parentésis">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Email</label>
								<div class="input-group col-md-7">
									<input id="email" name="email" placeholder="Email del Empleado"
										class="form-control input-md" type="email" required
										data-error="Campo Obligatorio debe ser un email válido"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="cargo">Cargo</label>
								<div class="col-md-7">
									<input id="cargo" name="cargo" placeholder="Cargo"
										class="form-control input-md" type="text"
										pattern="^[a-zA-Z\s]{1,}$" required
										data-error="Campo Obligatorio debe ser texto"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>

								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Área
									Funcional</label>
								<div class="col-md-7">
									<select id="id_area_funcional" name="id_area_funcional"
										class="form-control">
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['area_funcional_model'] as $area):?>
										<option value="<?php echo $area->id_area_funcional;?>"><?php echo $area->sigla;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Unidad
									Funcional</label>
								<div class="col-md-7">
									<select id="id_unidad_funcional" name="id_unidad_funcional"
										class="form-control">
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['unidad_funcional_model'] as $unidad):?>
										<option value="<?php echo $unidad->id_unidad_funcional;?>"
											class="<?php echo $unidad->id_area_funcional?>"><?php echo $unidad->sigla;?></option>
										<?php endforeach;?>
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
	<!-- Editar Empleado-->
	<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Empleado</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal"
						data-toggle="validator" role="form">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Nombres</label>
								<div class="input-group col-md-7">
									<input id="nombres" name="nombres"
										placeholder="Nombre del Empleado"
										class="form-control input-md" type="text"
										pattern="^[A-z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Apellidos</label>
								<div class="input-group col-md-7">
									<input id="apellidos" name="apellidos"
										placeholder="Apellidos del Empleado"
										class="form-control input-md" type="text"
										pattern="^[A-z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras y espacios"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">CI</label>
								<div class="input-group col-md-7">
									<input id="ci" name="ci" placeholder="CI del Empleado"
										class="form-control input-md" type="text"
										pattern="^[_A-Z0-9\-]{1,}$" required
										data-error="Campo Obligatorio solo números y letras mayúsculas y guión">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
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
										pattern="^[A-z0-9\s]{1,}$" required
										data-error="Campo Obligatorio solo números y letras y guión">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Teléfonos</label>
								<div class="input-group col-md-7">
									<input id="telefonos" name="telefonos"
										placeholder="Teléfonos del Empleado"
										class="form-control input-md" type="text"
										pattern="^[0-9\-\(\)]{1,}$" required
										data-error="Campo Obligatorio solo números y guiónes y parentésis">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="nombres">Email</label>
								<div class="input-group col-md-7">
									<input id="email" name="email" placeholder="Email del Empleado"
										class="form-control input-md" type="email" required
										data-error="Campo Obligatorio debe ser un email válido"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="cargo">Cargo</label>
								<div class="col-md-7">
									<input id="cargo" name="cargo" placeholder="Cargo"
										class="form-control input-md" type="text"
										pattern="^[a-zA-Z\s]{1,}$" required
										data-error="Campo Obligatorio debe ser texto"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>

								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Área
									Funcional</label>
								<div class="col-md-7">
									<select id="id_area_funcional1" name="id_area_funcional1"
										class="form-control">
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['area_funcional_model'] as $area):?>
										<option value="<?php echo $area->id_area_funcional;?>"><?php echo $area->sigla;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Unidad
									Funcional</label>
								<div class="col-md-7">
									<select id="id_unidad_funcional1" name="id_unidad_funcional1"
										class="form-control">
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['unidad_funcional_model'] as $unidad):?>
										<option value="<?php echo $unidad->id_unidad_funcional;?>"
											class="<?php echo $unidad->id_area_funcional?>"><?php echo $unidad->sigla;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="estado">Estado</label>
								<div class="col-md-7">
									<select id="estado" name="estado" class="form-control">
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
				<div class="modal-body">Esta seguro de Borrar el Empleado</div>
				<div class="modal-footer">
					<button id="confirmar-guardar-btn" type="button"
						class="btn btn-primary">Si</button>
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
	$("#id_unidad_funcional").chained("#id_area_funcional");
	$("#id_unidad_funcional1").chained("#id_area_funcional1");
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_nuevo(){
	
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
		$.ajax({
	        type: "POST",
	        url: '<?php echo base_url().'administracion/empleado/nuevo';?>',
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
            url: '<?php echo base_url().'administracion/empleado/editar/';?>'+id,
            data: $('#form-editar').serialize(),
            success: function(response){ $('#editar').modal('hide');location.reload();},
            error: function(){alert('Formulario con errores');}
        });
	} 	
}

function nuevo(){
	$('#form').resetear();
	$('#nuevo').appendTo("body").modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo();
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_empleado == id}
		  );
	}	

function editar(id){
	$('#form-editar').resetear();
	datos = buscar(id)[0];
	
	populate_form(datos);
	$("#id_area_funcional1 option[value="+datos.id_area_funcional+"]").attr("selected","selected");
	$("#id_area_funcional1 option[value="+datos.id_area_funcional+"]").trigger("change");
	$("#id_unidad_funcional1 option[value="+datos.id_unidad_funcional+"]").attr("selected","selected");
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
        url: '<?php echo base_url().'administracion/empleado/borrar/';?>'+id,        
        success: function(response){ $('#confirmar').modal('hide');location.reload();},
        error: function(){alert('Formulario con errores');}
    }); 	
}

function populate_form(datos){
	//console.log(datos[0]);
	$.each(datos, function(name, val){
	    var $el = $('[name="'+name+'"]'),
	        type = $el.attr('type');
		console.log(name);
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
<?php
function buscar($lista,$campo,$valor,$campo_a_retornar){
    foreach($lista as &$elemento) {
        $elemento     = get_object_vars($elemento);
        $val = $elemento[$campo];
        if ($val == $valor) return $elemento[$campo_a_retornar];
    }
    return '';
}
?>