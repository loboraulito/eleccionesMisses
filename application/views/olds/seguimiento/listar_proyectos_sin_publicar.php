<div id="container">
	<h3>Listado de Proyectos Nuevos Para Publicar</h1>	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
		
			<th>Cod. Cont.</th>
			<th>Descripción Item</th>			
			<th>Fecha Asignado</th>		
			<th>Fecha Apertura Sobres</th>			
			<th>Opciones</th>
		</tr>
	<?php foreach ($resultados as $detalle):?>
	   <tr>
		
			<td><?php echo $detalle->codigo_contrataciones; ?></td>
			<td><?php echo $detalle->descripcion ?></td>		
			<td><?php echo $detalle->fecha_registro_contrataciones ?></td>				
			<td><?php echo $detalle->fecha_apertura ?></td>	
			<td> 
			     <a type="button" class="btn btn-default btn-xs btn-editar" href="<?php echo base_url()."seguimiento/convocatoria/listar_items/".$detalle->codigo_sisin;?>" title="Publicar Items">
			         <span class="glyphicon glyphicon-th-list"></span> 
			     </a>
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="observar('<?php echo $detalle->codigo_sisin;?>')" title="Observar Proyecto">
			         <span class="glyphicon glyphicon-pencil"></span> 
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
					<h4 class="modal-title" id="myModalLabel">Nueva Observación</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="observacion">Observación</label>
								<div class="col-md-7">
									<textarea class="form-control" id="observacion" name="observacion"></textarea>
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
        todayHighlight: true
    });
    
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function observar_nuevo(id){	
	$('#form').validator('validate');
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'seguimiento/convocatoria/observar/';?>'+id,
        data: $('#form').serialize(),
        success: function(response){ $('#nuevo').modal('hide');location.reload();},
        error: function(){alert('Error');}
    }); 	
}



function observar(id){	
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		observar_nuevo(id);
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