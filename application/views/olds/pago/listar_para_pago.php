<div id="container">
	<h1>Lista de Pagos </h1>
	
	<div class="btn-group">
		<button type="button" class="btn btn-primary dropdown-toggle"
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="glyphicon glyphicon-th-list"></span> Opciones <span
				class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="#" onclick="nuevo(<?php echo $id_planilla;?>);"><span
					class="glyphicon glyphicon-list-alt"></span> Nuevo</a></li>
		</ul>
	</div>
	
	<form id="form-datos" class="form row">
	   <!-- Text input-->
		<div class="form-group">
			<label class="col-xs-4 control-label" for="codigo_sisin">Codigo SISIN</label>
			<div class="col-xs-8">
				<input id="codigo_sisin" name="codigo_sisin"									
					class="form-control input-md" type="text" value="<?php echo $datos_pago->codigo_sisin.$datos_pago->codigo_sisin1;?>" readonly>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-xs-4 control-label" for="apertura_programatica">Ape. Programática</label>
			<div class="col-xs-8">
				<input id="apertura_programatica" name="apertura_programatica" value="<?php echo $datos_pago->apertura_programatica.$datos_pago->apertura_programatica1;?>"
					class="form-control input-md" type="text" readonly>
			</div>
		</div>
	   <!-- Text input-->
		<div class="form-group">
			<label class="col-xs-4 control-label" for="descripcion_proyecto">Descripción</label>
			<div class="col-xs-8">
				<input id="descripcion_proyecto" name="descripcion_proyecto" value="<?php echo $datos_pago->descripcion_detalle.$datos_pago->descripcion_proyecto1;?>"
					class="form-control input-md" type="text" readonly>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-xs-4 control-label" for="monto_total">Monto Proyecto</label>
			<div class="col-xs-8">
				<input id="monto_total" name="monto_total" value="<?php echo $datos_pago->monto_total.$datos_pago->monto_total1;?>"
					class="form-control input-md" type="text" readonly>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-xs-4 control-label" for="item">Item</label>
			<div class="col-xs-8">
				<input id="item" name="item" value="<?php echo $datos_pago->item;?>"
					class="form-control input-md" type="text" readonly>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="monto_adjudicado">Monto Contrato o Monto Planilla</label>
			<div class="col-md-8">
				<input id="monto_adjudicado" name="monto_adjudicado" value="<?php echo $datos_pago->monto_adjudicado.$datos_pago->monto;?>"
					class="form-control input-md" type="text" readonly>
			</div>
		</div>						
	</form>

	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
		    <th>Monto Cancelado</th>  
		    <th>Fecha Pago</th>
			<th>Observación</th>
			<th>Opciones</th>
		</tr>
	<?php $cont=1;$total_items=0;?>
	<?php foreach ($resultados as $pago):?>
	   <?php //$cantidad = $detalle->cantidad; $precio = $detalle->precio_unidad;$total_item = ($cantidad*$precio);$total_items+=$total_item;?>
	   <tr>
			<td><?php echo $pago->monto_cancelado; ?></td>
			<td><?php echo $pago->fecha_pago; ?></td>
			<td><?php echo $pago->observacion; ?></td>
			<td> 
			     <!--<button type="button" class="btn btn-default btn-xs btn-editar" onclick="nuevo(<?php echo $pago->id_pago;?>)">
			         <span class="glyphicon glyphicon-pencil"></span> Para pago
			     </button> -->			     	     
			</td>
		</tr>
	   <?php $cont=$cont+1;?>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p> 
	
	<?php else:?>
    	<div class="alert alert-info">
          <strong>No existen Pagos</strong> en esta planilla
        </div>	   
	<?php endif;?>
	
	<div class="modal fade" id="nuevo" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>fuente_organismo_model
					</button>
					<h4 class="modal-title" id="myModalLabel">Pagar</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
					   					
						<fieldset>
                            <!-- Select Basic -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="id_fuente_organismo">Fuente:</label>
								<div class="col-md-7">
									<select id="id_fuente_organismo" name="id_fuente_organismo"
										class="form-control">
										<option value="-1">- seleccione una opción -</option>
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
									<textarea class="form-control" id="observacion" name="observacion"></textarea>
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

function guardar_editar(id){
	var datos=$('#form').serializeArray();
	datos.push({name: 'id_detalle_proyecto', value: id});
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'seguimiento/proyecto_detalle/editar';?>',
        data: datos,
        success: function(response){ $('#nuevo').modal('hide');location.reload();},
        error: function(){alert('Error');}
    }); 	
}

function nuevo(id){
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo(id);
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_detalle_proyecto == id}
		  );
	}	

function editar(id){
	$('#form').resetear();
	populate_form(buscar(id)[0]);
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
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