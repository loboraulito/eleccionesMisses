<div id="container">
	<h3>Listado de Proyectos de Inversión</h3>	

	<?php if($datos):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Codigo SISIN</th>
			<th>Descripcion</th>			
			<th>Unidad Funcional</th>		
			<th>Fecha Registro</th>			
			<th>Opciones</th>
		</tr>
	<?php foreach ($results as $proyecto):?>
	   <tr class="<?php echo $proyecto->estado=='I'?'danger':'';?>">
			<td><?php echo $proyecto->codigo_sisin; ?></td>
			<td><?php echo $proyecto->descripcion; ?></td>
			<td><?php echo $proyecto->usigla; ?></td>
			<td><?php echo $proyecto->fecha_registro; ?></td>			
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="nuevo('<?php echo $proyecto->codigo_sisin; ?>')" title="Planilla">
			         <span class="glyphicon glyphicon-pencil"></span> Planilla
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
					<h4 class="modal-title" id="myModalLabel">Proyecto</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_sisin">Codigo
									Sisin</label>
								<div class="input-group col-md-7">
									<input id="codigo_sisin" name="codigo_sisin"
										placeholder="código sisin del proyecto"
										class="form-control input-md" type="text"										
										readonly>
								</div>

							</div>
                            <!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textarea">Descripción</label>
								<div class="col-md-7">
									<textarea class="form-control" id="descripcion" name="descripcion" readonly>descripción del proyecto</textarea>
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
										readonly>
									</div>
								</div>
							</div>
							<!-- Prepended text-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="monto_contrato">Monto Contrato</label>
								<div class="col-md-7">
									<div class="input-group">
										<span class="input-group-addon">Bs.</span> <input
											id="monto_adjudicado" name="monto_adjudicado"
											class="form-control input-md" type="text"
										readonly>
									</div>
								</div>
							</div>
												
							<!-- Prepended text-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="monto_a_pagar">Monto a Pagar</label>
								<div class="col-md-7">
									<div class="input-group">
										<span class="input-group-addon">Bs.</span> <input
											id="monto_a_pagar" name="monto_a_pagar"
											class="form-control input-md" type="text"
										pattern="^[_0-9]{1,}$" required										
										data-error="Campo Obligatorio solo números">
									</div>
								</div>
							</div>
							
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="detalle">Detalle</label>
								<div class="col-md-7">
									<textarea class="form-control" id="detalle" name="detalle"></textarea>
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
var js_data = '<?php echo json_encode($results); ?>';
var js_obj_data = JSON.parse(js_data);



$(function() {
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });
    //$("#id_empleado_tecnico").chosen({max_selected_options: 5,width: "300px"});
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_nuevo(id){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'planilla/proyecto/planilla/';?>'+id,
            data: $('#form').serialize(),
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Error');}
        });
	} 	
}

function buscar(codigo_sisin) {
	return js_obj_data.filter(
		      function(data){return data.codigo_sisin == codigo_sisin}
		  );
	}	

function nuevo(id){
	$('#form').resetear();
	datos = buscar(id)[0];
	populate_form(datos);	
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		guardar_nuevo(id);
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