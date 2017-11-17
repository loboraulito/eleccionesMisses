<div id="container">
	<h3>Listado de Proyectos de Inversión</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>

	<?php if($datos):?>
	
	<form action="<?php echo base_url();?>administracion/proyecto">
		<div class="filtro-buscar form-group col-md-12 col-xs-12 col-sm-12">
			<div class="input-group col-md-12">
				<input id="buscar" name="buscar" placeholder="Codigo SISIN o Descripción"
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
			<th>Codigo SISIN</th>
			<th>Descripcion</th>			
			<th>Unidad Funcional</th>		
			<th>Fecha Registro</th>			
			<th>Opciones</th>
		</tr>
	<?php foreach ($results as $proyecto):?>
	   <tr class="<?php echo $proyecto->estado=='I'?'danger':($proyecto->num_fuentes==0?'info':'');?>">
			<td><?php echo $proyecto->codigo_sisin; ?></td>
			<td><?php echo $proyecto->descripcion; ?></td>
			<td><?php echo $proyecto->usigla; ?></td>
			<td class="col-md-2"><?php echo $proyecto->fecha_registro; ?></td>			
			<td > 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar('<?php echo $proyecto->codigo_sisin; ?>')" title="Editar">
			         <span class="glyphicon glyphicon-pencil"></span> 
			     </button>			    
			     <a type="button" class="btn btn-default btn-xs btn-borrar" href="<?php echo base_url().'administracion/Proyecto_fuente/index/'.$proyecto->codigo_sisin;?>" title="Asignar Fuente">
			         <span class="glyphicon glyphicon-list-alt"></span> 
			     </a>	
			     		     
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
					<h4 class="modal-title" id="myModalLabel">Nuevo Proyecto</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_sisin">Codigo Sisin</label>
								<div class="input-group col-md-7">
									<input id="codigo_sisin" name="codigo_sisin"
										placeholder="código sisin del proyecto"
										class="form-control input-md" type="text"
										pattern="^[_0-9]{1,}$" required
										data-remote="<?php echo site_url('/administracion/proyecto/validar_codigo_sisin');?>"
										data-error="Campo Obligatorio solo números"
										data-remote-error="El codigo ya fue utilizado"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>

							</div>
                            <!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textarea">Descripción</label>
								<div class="col-md-7">
									<textarea class="form-control" id="descripcion" name="descripcion">descripción del proyecto</textarea>
								</div>
							</div>							
							
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Unidad 	Funcional</label>
								<div class="col-md-7">
									<select id="id_unidad_funcional" name="id_unidad_funcional"
										class="form-control" required>
										<option value="-1">- seleccione una opción -</option>
										<?php foreach ($data['unidad_funcional_model'] as $unidad):?>
										<option value="<?php echo $unidad->id_unidad_funcional;?>"><?php echo $unidad->sigla;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textinput">Codigo POA</label>
								<div class="col-md-7">
									<input id="codigo_poa" name="codigo_poa"
										placeholder="código poa del proyecto"
										class="form-control input-md" type="text"
										pattern="^[-A-z0-9\/]{1,}$" required										
										data-error="Campo Obligatorio solo números y letras">
								</div>
							</div>

							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textinput">Apertura Programática</label>
								<div class="col-md-7">
									<input id="apertura_programatica" name="apertura_programatica"
										placeholder="código de la estructura programática del proy."
										class="form-control input-md" type="text"
										pattern="^[-0-9]{1,}$" required										
										data-error="Campo Obligatorio solo números y letras">
								</div>
							</div>

							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Tipo Proyecto</label>
								<div class="col-md-7">
									<select id="tipo_proyecto" name="tipo_proyecto"
										class="form-control">
										<option value="Equipamiento">Equipamiento</option>
										<option value="Construcción">Construcción</option>
										<option value="Evaluación">Evaluación</option>
										<option value="Investigación">Investigación</option>
									</select>
								</div>
							</div>
							
							<!-- Prepended text-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="monto_total">Monto Total</label>
								<div class="col-md-7">
									<div class="input-group">
										<span class="input-group-addon">Bs.</span> <input
											id="monto_total" name="monto_total"
											class="form-control input-md" type="text"
										pattern="^[_0-9]{1,}$" required										
										data-error="Campo Obligatorio solo números">
									</div>
								</div>
							</div>
													
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="id_empleado_tecnico">Responsable del proyecto</label>
								<div class="col-md-7">
									<select id="id_empleado_tecnico" name="id_empleado_tecnico"
										class="form-control" required>
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['empleado_model'] as $profile):?>
										<option value="<?php echo $profile->id_empleado;?>"><?php echo $profile->nombres.' '.$profile->apellidos;?></option>
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
<!-- editar proyecto -->
	<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Proyecto</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_sisin">Codigo Sisin</label>
								<div class="input-group col-md-7">
									<input id="codigo_sisin" name="codigo_sisin"
										placeholder="código sisin del proyecto"
										class="form-control input-md" type="text"
										pattern="^[_0-9]{1,}$" required readonly="" 										
										data-error="Campo Obligatorio solo números"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>

							</div>
                            <!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textarea">Descripción</label>
								<div class="col-md-7">
									<textarea class="form-control" id="descripcion" name="descripcion">descripción del proyecto</textarea>
								</div>
							</div>							
							
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Unidad
									Funcional</label>
								<div class="col-md-7">
									<select id="id_unidad_funcional" name="id_unidad_funcional"
										class="form-control" required>
										<option value="-1">- seleccione una opción -</option>
										<?php foreach ($data['unidad_funcional_model'] as $unidad):?>
										<option value="<?php echo $unidad->id_unidad_funcional;?>"><?php echo $unidad->sigla;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textinput">Codigo POA</label>
								<div class="col-md-7">
									<input id="codigo_poa" name="codigo_poa"
										placeholder="código poa del proyecto"
										class="form-control input-md" type="text"
										pattern="^[-A-z0-9\/]{1,}$" required										
										data-error="Campo Obligatorio solo números y letras">
								</div>
							</div>

							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textinput">Apertura.
									Programática</label>
								<div class="col-md-7">
									<input id="apertura_programatica" name="apertura_programatica"
										placeholder="código de la estructura programática del proy."
										class="form-control input-md" type="text"
										pattern="^[-0-9]{1,}$" required										
										data-error="Campo Obligatorio solo números y letras">
								</div>
							</div>

							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Tipo
									Proyecto</label>
								<div class="col-md-7">
									<select id="tipo_proyecto" name="tipo_proyecto" class="form-control">
										<option value="Equipamiento">Equipamiento</option>
										<option value="Construcción">Construcción</option>
										<option value="Evaluación">Evaluación</option>
										<option value="Investigación">Investigación</option>
									</select>
								</div>
							</div>
							
							<!-- Prepended text-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="monto_total">Monto Total</label>
								<div class="col-md-7">
									<div class="input-group">
										<span class="input-group-addon">Bs.</span> <input
											id="monto_total" name="monto_total"
											class="form-control input-md" type="text"
										pattern="^[_0-9]{1,}$" required										
										data-error="Campo Obligatorio solo números">
									</div>
								</div>
							</div>
													
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="id_empleado_tecnico">Responsable del proyecto</label>
								<div class="col-md-7">
									<select id="id_empleado_tecnico" name="id_empleado_tecnico"
										class="form-control" required>
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['empleado_model'] as $profile):?>
										<option value="<?php echo $profile->id_empleado;?>"><?php echo $profile->nombres.' '.$profile->apellidos;?></option>
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

</div>

<script>
var js_data = '<?php echo json_encode($results); ?>';
var js_obj_data = JSON.parse(js_data);



$(function() {
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });
	$('#editar').on('shown.bs.modal', function (e) { $('#form-editar').validator() });
    //$("#id_empleado_tecnico").chosen({max_selected_options: 5,width: "300px"});
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_nuevo(){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'administracion/proyecto/nuevo';?>',
            data: $('#form').serialize(),
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Error');}
        });
	} 	
}

function guardar_editar(id){
	if(!$('#form-editar').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'administracion/proyecto/editar/';?>'+id,
            data: $('#form-editar').serialize(),
            success: function(response){ $('#editar').modal('hide');location.reload();},
            error: function(){alert('Error');}
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

function buscar(codigo_sisin) {
	return js_obj_data.filter(
		      function(data){return data.codigo_sisin == codigo_sisin}
		  );
	}	

function editar(id){
	$('#form-editar').resetear();
	datos = buscar(id)[0];
	populate_form(datos);
	$('#editar').modal('show');
	$( "#guardar-btn1").unbind( "click" );
	$( "#guardar-btn1" ).bind( "click", function() {
		  guardar_editar(id);
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
<style>
.datepicker{z-index:1151 !important;}
</style>