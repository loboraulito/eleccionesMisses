<div id="container">
	<h3>Lista de Proyectos para pago</h3>
	
	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
		    <th>Cod. SISIN</th>
			<th>Ape. Programática</th>
			<th>Desc. Proyecto</th>			
			<th>Desc. Item</th>
			<th>Fecha Envio</th>
			<th>Monto Adjudicado o Solicitado</th>
			<th>Opciones</th>
		</tr>
	<?php $cont=1;$total_items=0;?>
	<?php foreach ($resultados as $planilla):?>
	   <?php //$cantidad = $detalle->cantidad; $precio = $detalle->precio_unidad;$total_item = ($cantidad*$precio);$total_items+=$total_item;?>
	   <tr>
			<td><?php echo $planilla->codigo_sisin.$planilla->codigo_sisin1; ?></td>
			<td><?php echo $planilla->apertura_programatica.$planilla->apertura_programatica1; ?></td>
			<td><?php echo $planilla->descripcion_proyecto.$planilla->descripcion_proyecto1; ?></td>			
			<td><?php echo $planilla->descripcion_detalle.$planilla->observacion_envio; ?></td>
			<td><?php echo $planilla->fecha_envio; ?></td>
			<td><?php echo $planilla->monto_adjudicado.$planilla->monto; ?></td>
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="nuevo(<?php echo $planilla->id_planilla;?>)">
			         <span class="glyphicon glyphicon-pencil"></span> Pagos
			     </button>			     	     
			</td>
		</tr>
	   <?php $cont=$cont+1;?>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p> 
	
	<?php else:?>
    	<div class="alert alert-info">
          <strong>No existen Contratos</strong> para pago
        </div>	   
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
					<h4 class="modal-title" id="myModalLabel">Pagar</h4>
				</div>
				<div class="modal-body">
				    
				    
					<form id="form" class="form-horizontal">
					   <!-- Text input-->
                		<div class="form-group">
                			<label class="col-xs-4 control-label" for="codigo_sisin">Codigo SISIN</label>
                			<div class="col-xs-8">
                				<input id="codigo_sisin" name="codigo_sisin"									
                					class="form-control input-md" type="text" readonly>
                			</div>
                		</div>
                		<!-- Text input-->
                		<div class="form-group">
                			<label class="col-xs-4 control-label" for="apertura_programatica">Ape. Programática</label>
                			<div class="col-xs-8">
                				<input id="apertura_programatica" name="apertura_programatica" 
                					class="form-control input-md" type="text" readonly>
                			</div>
                		</div>
                	   <!-- Text input-->
                		<div class="form-group">
                			<label class="col-xs-4 control-label" for="descripcion_proyecto">Descripción</label>
                			<div class="col-xs-8">
                				<input id="descripcion_proyecto" name="descripcion_proyecto"
                					class="form-control input-md" type="text" readonly>
                			</div>
                		</div>
                		<!-- Text input-->
                		<div class="form-group">
                			<label class="col-xs-4 control-label" for="monto_total">Monto Proyecto</label>
                			<div class="col-xs-8">
                				<input id="monto_total" name="monto_total" 
                					class="form-control input-md" type="text" readonly>
                			</div>
                		</div>
                		<!-- Text input-->
                		<div class="form-group">
                			<label class="col-xs-4 control-label" for="item">Item</label>
                			<div class="col-xs-8">
                				<input id="item" name="item" 
                					class="form-control input-md" type="text" readonly>
                			</div>
                		</div>
                		<!-- Text input-->
                		<div class="form-group">
                			<label class="col-md-4 control-label" for="monto_adjudicado">Monto Contrato o Monto Planilla</label>
                			<div class="col-md-8">
                				<input id="monto_adjudicado" name="monto_adjudicado" 
                					class="form-control input-md" type="text" readonly>
                			</div>
                		</div>
					
					
						<fieldset>
                            <!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="id_fuente_organismo">Fuente:</label>
								<div class="col-md-7">
									<select id="id_fuente_organismo" name="id_fuente_organismo" required
										class="form-control">
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['fuente_organismo_model'] as $fuente):?>
										<option value="<?php echo $fuente->id_fuente_organismo;?>"><?php echo $fuente->sigla;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>	
						    <!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="monto_cancelado">Monto a Cancelar</label>
								<div class="input-group col-md-7">
									<input id="monto_cancelado" name="monto_cancelado"
										placeholder="monto"
										class="form-control input-md" type="text"
										pattern="^[0-9_\-]{1,}$" required
										data-error="Campo Obligatorio solo números enteros">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="observacion">Observación</label>
								<div class="col-md-7">
									<textarea class="form-control" id="observacion" name="observacion" required></textarea>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="fecha_pago">Fecha de Pago</label>
								<div class="input-group col-md-7">
									<input id="fecha_pago" name="fecha_pago"
										placeholder="fecha_pago"
										class="form-control input-md fecha" type="text"
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
	
</div>
<script>
var js_data = '<?php echo json_encode($resultados); ?>';
var js_obj_data = JSON.parse(js_data);



$(function() {
	$('#nuevo_proyecto').on('shown.bs.modal', function (e) { $('#form').validator()});
	
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	$('.fecha').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        autoclose: true,
        todayHighlight: true
    });
});

function guardar_nuevo(id){
	$('#form').validator('validate');
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'pago/pago/nuevo/';?>'+id,
        data: $('#form').serialize(),
        success: function(response){ $('#nuevo').modal('hide');location.reload();},
        error: function(){alert('Error');}
    });	
}

function nuevo(id){
	$('#form').resetear();
	llenar_datos(buscar(id)[0]);
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo(id);
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_planilla == id}
		  );
	}	

function llenar_datos(datos){
	if(datos.codigo_sisin)
		$('[name=codigo_sisin]').val(datos.codigo_sisin);
	else
		$('[name=codigo_sisin]').val(datos.codigo_sisin1);

	if(datos.apertura_programatica)
		$('[name=apertura_programatica]').val(datos.apertura_programatica);
	else
		$('[name=apertura_programatica]').val(datos.apertura_programatica1);

	if(datos.codigo_sisin)
		$('[name=descripcion_proyecto]').val(datos.descripcion_proyecto);
	else
		$('[name=descripcion_proyecto]').val(datos.descripcion_proyecto1);

	if(datos.codigo_sisin)
		$('[name=monto_total]').val(datos.monto_total);
	else
		$('[name=monto_total]').val(datos.monto_total1);

	if(datos.descripcion_detalle)
		$('[name=item]').val(datos.descripcion_detalle);
	else
		$('[name=item]').val(datos.descripcion_detalle1);

	if(datos.monto_adjudicado)
		$('[name=monto_adjudicado]').val(datos.monto_adjudicado);
	else
		$('[name=monto_adjudicado]').val(datos.monto);
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