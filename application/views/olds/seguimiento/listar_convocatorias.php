<div id="container">
	<h3>Lista de Items Adjudicados para Firma de Contrato</h3>
	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
		  
			<th>Cod. Contratacion</th>			
			<th>Item</th>
			<th>Descripcion Proyecto</th>
			<th>Descipcion del Item</th>
			<th>Fecha Adjudicacion</th>
								
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $detalle):?>
	   <tr>
	       
			<td><?php echo $detalle->codigo_contrataciones; ?></td>			
            <td><?php echo $detalle->item; ?></td>            
            <td><?php echo $detalle->descrip; ?></td>
            <td><?php echo $detalle->descripcion; ?></td>
            <td><?php echo $detalle->fecha_apertura; ?></td>
            <?php $monto_item = $detalle->cantidad*$detalle->precio_unidad; ?>
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="nuevo('<?php echo $detalle->item; ?>','<?php echo $detalle->descrip; ?>','<?php echo $detalle->descripcion; ?>','<?php echo $detalle->id_detalle_proyecto; ?>','<?php echo $monto_item; ?>')" title="Registrar Contrato">
			         <span class="glyphicon glyphicon-file"></span> 
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
                            <p><strong>No ITEM:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="item"></span></p>
                            <p><strong>Proyecto:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="descripcion"></span></p>
                            <p><strong>Detalle Item:</strong>&nbsp;&nbsp;&nbsp;<span id="itemdescrip"></span></p>
                            <p><strong>Costo del Item:</strong>&nbsp;&nbsp;&nbsp;<span id="monto_item"></span></p>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="monto_adjudicado">Monto Adjudicado</label>
								<div class="input-group col-md-7">
									<input id="monto_adjudicado" name="monto_adjudicado"
										placeholder="monto_adjudicado"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="id_empresa">Empresa</label>
								<div class="col-md-7">
									<select id="id_empresa" name="id_empresa"
										class="form-control" required>
										<option value="">- seleccione una opción -</option>
										<?php foreach ($data['empresa_model'] as $empresa):?>
										<option value="<?php echo $empresa->id_empresa;?>"><?php echo $empresa->nombre;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="numero_contrato">Nro de Contrato</label>
								<div class="input-group col-md-7">
									<input id="numero_contrato" name="numero_contrato"
										placeholder="numero_contrato"
										class="form-control input-md" type="text"
										pattern="^[A-z\s0-9]{1,}$" required
										data-error="Campo Obligatorio solo letras y espacios números"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="fecha_entrega_item">Fecha Entrega</label>
								<div class="input-group col-md-7">
									<input id="fecha_entrega_item" name="fecha_entrega_item"
										placeholder="fecha_entrega_item"
										class="form-control input-md fecha" type="text"
										required
										data-error="Campo Obligatorio"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="observacion">Observacion</label>
								<div class="input-group col-md-7">
									<input id="observacion" name="observacion"
										placeholder="Dirección del Empleado"
										class="form-control input-md" type="text"
										pattern="^[_A-z0-9\-]{1,}$" required
										data-error="Campo Obligatorio letras"> <span
										class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="fecha_contrato">Fecha Contrato</label>
								<div class="input-group col-md-7">
									<input id="fecha_contrato" name="fecha_contrato"
										placeholder="fecha_contrato"
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
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });
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

function guardar_nuevo(iditem){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/contrato/nuevo/';?>'+iditem,
            data: $('#form').serialize(),
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Formulario con errores');}
        }); 
	}	
}

function nuevo(item,descrip,itemdescrip,iddetalle,monto_item){
	$('#item').html(item);	
	$('#descripcion').html(descrip);
	$('#itemdescrip').html(itemdescrip);
	$('#iditem').html(iddetalle);
	$('#monto_item').html(monto_item);
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo(iddetalle);
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_empleado == id}
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