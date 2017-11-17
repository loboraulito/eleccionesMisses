<div id="container">
	<h3>Detalle de Observaciones</h3>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
	<div class="row">
		<p class="dato col-xs-8">
			<strong>Código SISIN: &nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->codigo_sisin; ?>
		</p>
		<p class="dato col-xs-4">
			<strong>Tipo Proyecto: &nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->tipo_proyecto; ?>
		</p>
		<p class="dato col-xs-8">
			<strong>Descripción:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->descripcion; ?>
		</p>
		
		<p class="dato col-xs-4">
			<strong>Monto Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->monto_total; ?>
		</p>		
		<p class="dato col-xs-8">
			<strong>Responsable :&nbsp;&nbsp;</strong><?php echo  $proyecto_model->nombres."&nbsp;".$proyecto_model->apellidos; ?>
		</p>
		
	</div>	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
		    <th>Nro.</th>
			<th>Observación</th>
			<th>Fecha de Observacion</th>
			<th>Empleado</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	<?php $cont=1;?>
	<?php foreach ($resultados as $detalle):?>
	   <tr  class="<?php echo $detalle->estado!='N'?'danger':'';?>">
			<td><?php echo $cont; ?></td>
			<td><?php echo $detalle->observacion; ?></td>
			<td><?php echo $detalle->fecha; ?></td>
			<td><?php echo $detalle->nombre_completo; ?></td>			
			<td><?php echo $detalle->estado=='N'?'Anulado':'Vigente'; ?></td>
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar(<?php echo $detalle->id_observacion;?>)" title="Editar">
			         <span class="glyphicon glyphicon-pencil"></span> 
			     </button>
			     <?php if($detalle->estado!='N'):?>
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="anular(<?php echo $detalle->id_observacion;?>)" title="Anular ">
			         <span class="glyphicon glyphicon-remove"></span> 
			     </button>	
			     <?php endif;?>		     
			</td>
		</tr>
	   <?php $cont=$cont+1;?>
	<?php endforeach;?>
	</table>
	<p><?php //echo $links; ?></p>
	<?php else:?>
    	<div class="alert alert-info">
          <strong>No existen Observaciones</strong> para este Proyecto
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
					<h4 class="modal-title" id="myModalLabel">Nueva Observación</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="observacion">Observación</label>
								<div class="col-md-7">
									<textarea class="form-control" id="observacion" name="observacion" required ></textarea>
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
<!-- editar -->
	<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Observación</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
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
					<button id="guardar-btn1" type="button" class="btn btn-primary">Guardar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	
</div>
<script>
var js_data = '<?php echo json_encode($resultados); ?>';
var js_obj_data = JSON.parse(js_data);
var cod_sisin= '<?php echo $proyecto_model->codigo_sisin; ?>';


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
    	var datos=$('#form').serializeArray();
    	datos.push({name: 'codigo_sisin', value: cod_sisin});
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/proyecto_observacion/nuevo';?>',
            data: datos,
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Formulario Vacio');}
        });
	} 	
}

function guardar_editar(id){
	if(!$('#form-editar').find('.has-error').length) {
    	var datos=$('#form-editar').serializeArray();
    	datos.push({name: 'id_observacion', value: id});
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'seguimiento/proyecto_observacion/editar';?>',
            data: datos,
            success: function(response){ $('#editar').modal('hide');location.reload();},
            error: function(){alert('Error');}
        });
	} 	
}

function anular(id){	
	var datos=cod_sisin;
	$.ajax({
        type: "POST",
        url: '<?php echo base_url().'seguimiento/proyecto_observacion/anular/';?>'+id,        
        data: datos,
        success: function(response){location.reload();},
        error: function(){alert('Error');}
    });
}

function nuevo(){
	console.log('A')
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo();
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_observacion == id}
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