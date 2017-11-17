<div id="container">
	<h3>Items Adjudicados para su Recepcion y Envio a Pago </h3>
	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Cod. Contratacion</th>
			<th>Item</th>		
			<th>Descripcion</th>
			<th>Fecha Entrega</th>				
			<th>Monto Adj.</th>
			<th>empresa</th>					
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $detalle):?>
	   <tr>
			<td><?php echo $detalle->codigo_contrataciones; ?></td>
			<td><?php echo $detalle->item; ?></td>
            <td><?php echo $detalle->descripcion; ?></td>
            <td><?php echo $detalle->fecha_entrega_item; ?></td>                        
            <td><?php echo $detalle->monto_adjudicado; ?></td>
            <td><?php echo $detalle->empresa; ?></td>          
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar <?php echo $detalle->estado=='C'?'':'hide';?>" onclick="recepcion(<?php echo $detalle->id_detalle_proyecto; ?>,<?php echo $detalle->id_contrato; ?>)">
			         <span class="glyphicon glyphicon-pencil"></span> Recepción
			     </button>	
			     <button type="button" class="btn btn-default btn-xs btn-editar <?php echo $detalle->estado=='R'?'':'hide';?>" onclick="enviar_para_pago(<?php echo $detalle->id_detalle_proyecto; ?>,<?php echo $detalle->id_contrato; ?>)">
			         <span class="glyphicon glyphicon-pencil"></span> Enviar para Pago
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
					<h4 class="modal-title" id="myModalLabel">Nuevo Contrato</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>
                            <p>Esta seguro de enviar para Pago</p>
							<strong>Id:</strong><span id="id"></span>
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
	
	<div class="modal fade" id="nueva_recepcion" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Recepción del Item</h4>
				</div>
				<div class="modal-body">
					<form id="form_recepcion" class="form-horizontal">
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="descripcion">Descripción</label>
							<div class="col-md-7">
								<input id="descripcion" name="descripcion"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="cantidad">Cantidad</label>
							<div class="col-md-7">
								<input id="cantidad" name="cantidad"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="item">Item</label>
							<div class="col-md-7">
								<input id="item" name="item"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="monto_adjudicado">Monto Contrato</label>
							<div class="col-md-7">
								<input id="monto_adjudicado" name="monto_adjudicado"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Textarea -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="observacion">Observación</label>
							<div class="col-md-7">
								<textarea class="form-control" id="observacion" name="observacion">descripción de la Recepción</textarea>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group has-feedback">
							<label class="col-md-4 control-label" for="fecha_recepcion">Fecha de Recepción</label>
							<div class="input-group col-md-7">
								<input id="fecha_recepcion" name="fecha_recepcion"
									placeholder="fecha_recepcion"
									class="form-control input-md fecha" type="text"
									required
									data-error="Campo Obligatorio">
								<span class="glyphicon form-control-feedback"
									aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>	
					</form>
				</div>
				<div class="modal-footer">
					<button id="guardar-btn-recepcion" type="button" class="btn btn-primary">Guardar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="modal fade" id="nuevo_enviar_para_pago" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Enviar para Pago</h4>
				</div>
				<div class="modal-body">
					<form id="form_enviar_para_pago" class="form-horizontal">
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="descripcion">Descripción</label>
							<div class="col-md-7">
								<input id="descripcion" name="descripcion"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="cantidad">Cantidad</label>
							<div class="col-md-7">
								<input id="cantidad" name="cantidad"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="item">Item</label>
							<div class="col-md-7">
								<input id="item" name="item"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="monto_adjudicado">Monto Contrato</label>
							<div class="col-md-7">
								<input id="monto_adjudicado" name="monto_adjudicado"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="empresa">Empresa</label>
							<div class="col-md-7">
								<input id="empresa" name="empresa"									
									class="form-control input-md" type="text" readonly>
							</div>
						</div>
						<!-- Textarea -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="observacion_envio">Observación</label>
							<div class="col-md-7">
								<textarea class="form-control" id="observacion_envio" name="observacion_envio">descripción</textarea>
							</div>
						</div>
						<!-- Text input-->
						<div class="form-group has-feedback">
							<label class="col-md-4 control-label" for="fecha_envio">Fecha de Envio</label>
							<div class="input-group col-md-7">
								<input id="fecha_envio" name="fecha_envio"
									placeholder="fecha_recepcion"
									class="form-control input-md fecha" type="text"
									required
									data-error="Campo Obligatorio">
								<span class="glyphicon form-control-feedback"
									aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>	
					</form>
				</div>
				<div class="modal-footer">
					<button id="guardar-btn-enviar_para_pago" type="button" class="btn btn-primary">Guardar</button>
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
	$('#nueva_recepcion').on('shown.bs.modal', function (e) { $('#form_recepcion').validator() });
	$('#nuevo_enviar_para_pago').on('shown.bs.modal', function (e) { $('#form_enviar_para_pago').validator() });
    $('.fecha').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        autoclose: true,
        todayHighlight: true
    });
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_recepcion(id_detalle,id_contrato){
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'seguimiento/contrato/recepcionar/';?>'+id_detalle+'/'+id_contrato,
        data: $('#form_recepcion').serialize(),
        success: function(response){ $('#nueva_recepcion').modal('hide');location.reload();},
        error: function(){alert('Formulario con errores');}
    }); 	
}

function recepcion(id_detalle,id_contrato){	
	
	$('#form_recepcion').resetear();
	populate_form(buscar(id_detalle)[0]);
	$('#nueva_recepcion').modal('show');
	$( "#guardar-btn-recepcion").unbind( "click" );
	$( "#guardar-btn-recepcion" ).bind( "click", function() {
		guardar_recepcion(id_detalle,id_contrato);
	});
}

function guardar_enviar_para_pago(id_detalle,id_contrato){
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'seguimiento/contrato/enviar_para_pago/';?>'+id_detalle+'/'+id_contrato,
        data: $('#form_enviar_para_pago').serialize(),
        success: function(response){ $('#nuevo_enviar_para_pago').modal('hide');location.reload();},
        error: function(){alert('Formulario con errores');}
    }); 	
}

function enviar_para_pago(id_detalle,id_contrato){	
	
	$('#form_enviar_para_pago').resetear();
	populate_form(buscar(id_detalle)[0]);
	$('#nuevo_enviar_para_pago').modal('show');
	$( "#guardar-btn-enviar_para_pago").unbind( "click" );
	$( "#guardar-btn-enviar_para_pago" ).bind( "click", function() {
		guardar_enviar_para_pago(id_detalle,id_contrato);
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_detalle_proyecto == id}
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
<style>
.datepicker{z-index:1151 !important;}
</style>