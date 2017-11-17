<div id="container">
	<h3>Proyectos Aprobados</h3>
	 
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Codigo SISIN</th>
			<th>Descripción</th>
		
			<th>Fecha Aprobación</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $proyecto):?>
	   <tr>
			<td><?php echo $proyecto->codigo_sisin; ?></td>
			<td><?php echo $proyecto->descripcion; ?></td>

			<td><?php echo $proyecto->fecha_aprobado; ?></td>
					
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="asignar('<?php echo $proyecto->codigo_sisin;?>', '<?php echo $proyecto->descripcion;?>','<?php echo $proyecto->monto_total;?>')" title="Asignar Codigo y Tecnico">
			         <span class="glyphicon glyphicon-saved"></span> 
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
					<h4 class="modal-title" id="myModalLabel">Asignar Proyecto</h4>
				</div>
				<p class="dato col-xs-3">
        			<strong>Código SISIN:</strong><p id="form_codigosisin"></p>
        		</p>
        		<p class="dato col-xs-3">
        			<strong>Descripción:</strong><p id="form_descripcion"></p>
        		</p>
        		<p class="dato col-xs-3">
        			<strong>Monto Total:</strong><p id="form_montototal"></p>
        		</p>
        	
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

						    <!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_contrataciones">Código Contrataciones</label>
								<div class="input-group col-md-7">
									<input id="codigo_contrataciones" name="codigo_contrataciones"
										placeholder="codigo_contrataciones"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9_\-]{1,}$" required
										data-error="Campo Obligatorio solo letras números y guiones">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="id_empleado_encargado">Técnico
									Asignado</label>
								<div class="col-md-7">
									<select id="id_empleado_encargado" name="id_empleado_encargado"
										class="form-control"
										required>
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
</div>
<script>
var js_data = '<?php echo json_encode($resultados); ?>';
var js_obj_data = JSON.parse(js_data);



$(function() {
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });
	
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function asignar_nuevo(codigosisin, descripcion, montototal){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {    	
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/proyecto/asignar/';?>'+codigosisin,
            data: $('#form').serialize(),
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Error');}
        }); 
	}	
}


function asignar(codigosisin, descripcion, montototal){
	$('#form_codigosisin').html(codigosisin);
	$('#form_descripcion').html(descripcion);
	$('#form_montototal').html(montototal);
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		asignar_nuevo(codigosisin, descripcion, montototal);
	});
}

function buscar(codigo_sisin) {
	return js_obj_data.filter(
		      function(data){return data.codigo_sisin == codigo_sisin}
		  );
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