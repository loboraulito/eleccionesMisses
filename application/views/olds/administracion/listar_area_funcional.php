<div id="container">
	<h3>Administración de Areas Funcionales</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>

	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Código de Área</th>			
			<th>Sigla</th>
			<th>Descripción</th>			
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $area):?>
	   <tr class="<?php echo $area->estado=='I'?'danger':'';?>">
			<td><?php echo $area->codigo_area; ?></td>
            <td><?php echo $area->sigla; ?></td>
            <td><?php echo $area->descripcion; ?></td>            
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar('<?php echo $area->id_area_funcional; ?>')" title="Editar">
			         <span class="glyphicon glyphicon-pencil"></span> 
			     </button>			     
			     <button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $area->id_area_funcional; ?>')" title="Borrar">
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
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"> Nueva Área Funcional</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_area">Código de Área</label>
								<div class="input-group col-md-7">
									<input id="codigo_area" name="codigo_area"
										placeholder="Código de Área"
										class="form-control input-md" type="text"
										pattern="^[A-Z]{1,}$" required
										data-remote="<?php echo site_url('/administracion/area_funcional/validar_area');?>"
										data-error="Campo Obligatorio solo una letra mayuscula"
										data-remote-error="El codigo ya existe"> 
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="sigla">Sigla</label>
								<div class="input-group col-md-7">
									<input id="sigla" name="sigla"
										placeholder="Sígla del Área Funcional"
										class="form-control input-md" type="text"
										pattern="^[A-Za-z\s\.]{1,}$" required
										data-error="Campo Obligatorio solo letras "> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="descripcion">Descripción</label>
								<div class="input-group col-md-7">
									<input id="descripcion" name="descripcion"
										placeholder="Descripción"
										class="form-control input-md" type="textarea"
										required
										data-error="Campo Obligatorio"> <span
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

		<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"> Editar Área Funcional</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_area">Código de Área</label>
								<div class="input-group col-md-7">
									<input id="codigo_area" name="codigo_area" readonly="" 
										placeholder="Código de Área"
										class="form-control input-md" type="text"
										pattern="^[A-Z]{1,}$" required
										data-error="Campo Obligatorio solo una letra mayuscula"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="sigla">Sigla</label>
								<div class="input-group col-md-7">
									<input id="sigla" name="sigla"
										placeholder="Sígla del Área Funcional"
										class="form-control input-md" type="text"
										pattern="^[A-Za-z\s\.]{1,}$" required
										data-error="Campo Obligatorio solo letras "> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="descripcion">Descripción</label>
								<div class="input-group col-md-7">
									<input id="descripcion" name="descripcion"
										placeholder="Descripción"
										class="form-control input-md" type="textarea"
										required
										data-error="Campo Obligatorio"> <span
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
				Esta seguro de Borrar el Area Funcional
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
var id_area_funcional;


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
            url: '<?php echo base_url().'administracion/area_funcional/nuevo';?>',
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
            url: '<?php echo base_url().'administracion/area_funcional/editar/';?>'+id,
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
		      function(data){return data.id_area_funcional == id}
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
        url: '<?php echo base_url().'administracion/area_funcional/borrar/';?>'+id,        
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