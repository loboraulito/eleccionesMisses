<div id="container">
	<h3>Listado de Fuentes y Organismos Financiadores</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
	
<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Fuente</th>	
			<th>Descripción Fuente</th>			
			<th>Organismo</th>
			<th>Descripción Organismo</th>			
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $fuente):?>
	   <tr class="<?php echo $fuente->estado=='I'?'danger':'';?>">
			<td><?php echo $fuente->codigo_fuente; ?></td>
			<td><?php echo $fuente->descripcion_fuente; ?></td>   
            <td><?php echo $fuente->codigo_organismo; ?></td>
            <td><?php echo $fuente->descripcion_organismo; ?></td>            
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar('<?php echo $fuente->id_fuente_organismo; ?>')" title="Editar">
			         <span class="glyphicon glyphicon-pencil"></span> 
			     </button>			     
			     <button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $fuente->id_fuente_organismo; ?>')" title="Borrar">
			         <span class="glyphicon glyphicon-trash"></span> 
			     </button>			     			     
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<p><?php //echo $links; ?></p>
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
					<h4 class="modal-title" id="myModalLabel">Nueva Fuente de Financiamiento</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="sigla">Sigla</label>
								<div class="input-group col-md-7">
									<input id="sigla" name="sigla"
										placeholder="Sigla"
										class="form-control input-md" type="text"
										pattern="^[A-Z]{1,}$" required
										data-error="Campo Obligatorio solo letras Mayusculas"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_fuente">Código de Fuente</label>
								<div class="input-group col-md-7">
									<input id="codigo_fuente" name="codigo_fuente"
										placeholder="Código de Fuente"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,2}$" required
										data-error="Campo Obligatorio solo números de dos digitos"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="descripcion_fuente">Descripción de la Fuente</label>
								<div class="input-group col-md-7">
									<input id="descripcion_fuente" name="descripcion_fuente"
										placeholder="Descripción de la Fuente"
										class="form-control input-md" type="text"
										pattern="^[a-zA-Z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_organismo">Código del Organismo</label>
								<div class="input-group col-md-7">
									<input id="codigo_organismo" name="codigo_organismo"
										placeholder="Código del Organismo"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$"
										data-remote="<?php echo site_url('administracion/fuente_organismo/validar_cod_organismo');?>" required
										data-error="Campo Obligatorio solo números de tres digitos"
										data-remote-error="Debe ser Único"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="descripcion_organismo">Descripción del Organismo</label>
								<div class="input-group col-md-7">
									<input id="descripcion_organismo" name="descripcion_organismo"
										placeholder="Descripción del Organismo"
										class="form-control input-md" type="text"
										pattern="^[a-zA-Z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras"> <span
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
					<h4 class="modal-title" id="myModalLabel">Editar Fuente de Financiamiento</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="sigla">Sigla</label>
								<div class="input-group col-md-7">
									<input id="sigla" name="sigla"
										placeholder="Sigla"
										class="form-control input-md" type="text"
										pattern="^[A-Z]{1,}$" required
										data-error="Campo Obligatorio solo letras Mayusculas"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_fuente">Código de Fuente</label>
								<div class="input-group col-md-7">
									<input id="codigo_fuente" name="codigo_fuente"
										placeholder="Código de Fuente"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,2}$" required
										data-error="Campo Obligatorio solo números de dos digitos"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="descripcion_fuente">Descripción de la Fuente</label>
								<div class="input-group col-md-7">
									<input id="descripcion_fuente" name="descripcion_fuente"
										placeholder="Descripción de la Fuente"
										class="form-control input-md" type="text"
										pattern="^[a-zA-Z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_organismo">Código del Organismo</label>
								<div class="input-group col-md-7">
									<input id="codigo_organismo" name="codigo_organismo"
										placeholder="Código del Organismo"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$"										
										data-error="Campo Obligatorio solo números de tres digitos"
										readonly> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="descripcion_organismo">Descripción del Organismo</label>
								<div class="input-group col-md-7">
									<input id="descripcion_organismo" name="descripcion_organismo"
										placeholder="Descripción del Organismo"
										class="form-control input-md" type="text"
										pattern="^[a-zA-Z\s]{1,}$" required
										data-error="Campo Obligatorio solo letras"> <span
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
				Esta seguro de Borrar la Fuente de Financiamiento
			</div>
			<div class="modal-footer">
				<button id="confirmar-guardar-btn" type="button" class="btn btn-primary" >Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<script>
var js_data = '<?php echo json_encode($resultados); ?>';
var js_obj_data = JSON.parse(js_data);
var id_fuente_organismo;


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
            url: '<?php echo base_url().'administracion/fuente_organismo/nuevo';?>',
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
            url: '<?php echo base_url().'administracion/fuente_organismo/editar/';?>'+id,
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
		      function(data){return data.id_fuente_organismo == id}
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
        url: '<?php echo base_url().'administracion/fuente_organismo/borrar/';?>'+id,        
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

function validar_cod_organismo(){
	val = $('#codigo_organismo').val();
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'administracion/fuente_organismo/validar_cod_organismo/';?>'+val,
    }); 	
}
</script>