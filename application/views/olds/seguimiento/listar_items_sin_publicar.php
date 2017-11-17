<div id="container">    
	<h3>Detalle de Items para Publicar</h3>	
	<?php if($resultados):?>
	
	<div class="row">
		<p class="dato col-xs-8">
			<strong>Código SISIN:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->codigo_sisin;?>
		</p>  
		<p class="dato col-xs-4">
			<strong>Tipo Proyecto:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->tipo_proyecto;?>
		</p>
		<p class="dato col-xs-8">
			<strong>Descripción:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->descripcion;?>
		</p>
		
		<p class="dato col-xs-4">
			<strong>Monto Total:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->monto_total;$total_proyecto=$proyecto_model->monto_total;?>
		</p>		
		<p class="dato col-xs-8">
			<strong>Responsable Proy.:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo  $proyecto_model->nombres."&nbsp;".$proyecto_model->apellidos;?>
		</p>
		<p class="dato col-xs-4">
			<strong>Estado:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->estado;?>
		</p>
	</div>
	
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Id item</th>
			<th>Descripción Item</th>
			<th>Apertura de sobres</th>
			<th>Estado</th>
			<th>Estado Pub.</th>
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $detalle):?>
	   <tr>
			<td><?php echo $detalle->item; ?></td>			
			<td><?php echo $detalle->descripcion; ?></td>		
			<td><?php echo $detalle->fecha_apertura; ?></td>			
			<td><?php echo $detalle->estado; ?></td>
			<td><?php echo $detalle->estado_publicacion; ?></td>
			<td> 			    	
			     <button type="button" title="Publicar Item" class="btn btn-default btn-xs btn-editar <?php echo (($detalle->estado=='N' || $detalle->estado=='D') && ($detalle->estado_publicacion != 'I') && ($proyecto_model->estado == 'P' or ($proyecto_model->estado == 'D' && $detalle->estado!='D')))?'':'hide';?>" onclick="publicar(<?php echo $detalle->id_detalle_proyecto;?>,'<?php echo $detalle->codigo_sisin;?>','<?php echo $detalle->descripcion;?>')">
			         <span class="glyphicon glyphicon-pencil"></span> Publicar
			     </button>		
			     <button type="button" title="Registrar Estado" class="btn btn-default btn-xs btn-editar <?php echo $detalle->estado=='P'?'':'hide';?>" onclick="registrar(<?php echo $detalle->id_detalle_proyecto;?>,'<?php echo $detalle->codigo_sisin;?>','<?php echo $detalle->descripcion;?>')">
			         <span class="glyphicon glyphicon-pencil"></span> Estado
			     </button>	
			     <span class="<?php echo (($detalle->estado=='N' || $detalle->estado=='D') && ($detalle->estado_publicacion == 'I'))?'':'hide';?>">
			         Item Cerrado
			     </span>			     			     		     
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p>
	<?php endif;?>
	
	<div class="modal fade" id="publicar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Publicar</h4>
				</div>
				<p class="dato col-xs-4">
        			<strong>Código SISIN:</strong><p id="form_codigosisin"></p>
        		</p>
        		<p class="dato col-xs-4">
        			<strong>Descripción:</strong><p id="form_descripcion"></p>
        		</p>
        		
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

						    <!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="codigo_contrataciones">Publicación</label>
								<div class="input-group col-md-7">
									<input id="fecha_publicacion" name="fecha_publicacion"
										placeholder="fecha_publicacion"
										class="form-control input-md fecha" type="text"
										required
										data-error="Campo Obligatorio">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>							
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="fecha_apertura">Apertura de Sobres</label>
								<div class="input-group col-md-7">
									<input id="fecha_apertura" name="fecha_apertura"
										placeholder="fecha_publicacion"
										class="form-control input-md fecha" type="text"
										required
										data-error="Campo Obligatorio">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="fecha_contrato">Firma de Contrato</label>
								<div class="input-group col-md-7">
									<input id="fecha_contrato" name="fecha_contrato"
										placeholder="fecha_publicacion"
										class="form-control input-md fecha" type="text"
										required
										data-error="Campo Obligatorio">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>	
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="fecha_entrega">Entrega</label>
								<div class="input-group col-md-7">
									<input id="fecha_entrega" name="fecha_entrega"
										placeholder="fecha_publicacion"
										class="form-control input-md fecha" type="text"
										required
										data-error="Campo Obligatorio">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
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
	
	<div class="modal fade" id="estado" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Registrar Estados</h4>
				</div>
				<p class="dato col-xs-6">
        			<strong>Código SISIN:</strong><p id="form_codigosisin2"></p>
        		</p>
        		<p class="dato col-xs-6">
        			<strong>Descripción:</strong><p id="form_descripcion2"></p>
        		</p>
        		
				<div class="modal-body col-xs-12">
					<form id="form2" class="form-horizontal">
						<fieldset>
						   <!-- Select Basic -->
							<div class="form-group row">
								<label class="col-md-4 control-label" for="estado">estado_convocatoria</label>
								<div class="col-md-7">
									<select id="estado" name="estado" class="form-control" required>
										<option value="">- seleccione una opción -</option>
										<option value="A">Adjudicado</option>
										<option value="D">Desierto</option>
										
										
									</select>
								</div>
							</div>	 			
						</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button id="guardar-btn2" type="button" class="btn btn-primary">Guardar</button>
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
	$('#publicar').on('shown.bs.modal', function (e) { $('#form').validator() });
	$('#estado').on('shown.bs.modal', function (e) { $('#form2').validator() });
    $('.fecha').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        todayHighlight: true,
        autoclose:true
    });
    
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function publicar_nuevo(id){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
    	console.log(id);	
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/convocatoria/nuevo/';?>'+id,
            data: $('#form').serialize(),
            success: function(response){ $('#publicar').modal('hide');location.reload();},
            error: function(){alert('Error');}
        }); 
	}	
}



function publicar(id,codigo_sisin,descripcion){
	$('#form_id_detalle').html(id);
	$('#form_codigosisin').html(codigo_sisin);
	$('#form_descripcion').html(descripcion);
	$('#form').resetear();
	$('#publicar').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		publicar_nuevo(id);
	});
}

function registrar_nuevo(id){	
	$('#form2').validator('validate');
	if(!$('#form2').find('.has-error').length) {
    	console.log(id);	
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/convocatoria/registrar_estado/';?>'+id,
            data: $('#form2').serialize(),
            success: function(response){ $('#publicar').modal('hide');location.reload();},
            error: function(){alert('Error');}
        }); 
	}	
}



function registrar(id,codigo_sisin,descripcion){
	$('#form_id_detalle2').html(id);
	$('#form_codigosisin2').html(codigo_sisin);
	$('#form_descripcion2').html(descripcion);
	$('#form2').resetear();
	$('#estado').modal('show');
	$( "#guardar-btn2").unbind( "click" );
	$( "#guardar-btn2" ).bind( "click", function() {
		registrar_nuevo(id);
	});
}

function buscar(codigo_sisin) {
	return js_obj_data.filter(
		      function(data){return data.id_proyecto_detalle == codigo_sisin}
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