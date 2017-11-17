<div id="container">
	<h3>Listado de Fuentes de Financiamiento del Proyecto </h3>
	 <a href="#" onclick="nuevo('<?php echo $proyecto_model->codigo_sisin; ?>');" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>

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
			<strong>Responsable :&nbsp;&nbsp;</strong><?php echo $proyecto_model->nombres."&nbsp;".$proyecto_model->apellidos;?>
		</p>
		
	</div>	
	
	<?php $cont=1;$total1=0; $total=0;?>

	<?php if($resultados):?>		
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>Sigla Fuente</th>
			<th>Fuente</th>			
			<th>Monto</th>			
			<th>Opciones</th>
		</tr>
	
	<?php foreach ($resultados as $proyecto_fuente):?>

		<?php $total = $proyecto_fuente->monto;?>

	   <tr  class="<?php echo $proyecto_fuente->estado=='I'?'danger':'';?>">

			<td><?php echo $proyecto_fuente->sigla; ?></td>
			<td><?php echo $proyecto_fuente->descripcion_organismo;  ?></td>			
			<td><?php echo $proyecto_fuente->monto; ?></td>			
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar('<?php echo $proyecto_fuente->id_proyecto_fuente; ?>')" title="Editar">
			         <span class="glyphicon glyphicon-pencil"></span> 
			     </button>
			     <button type="button" class="btn btn-default btn-xs btn-borrar" onclick="borrar('<?php echo $proyecto_fuente->id_proyecto_fuente; ?>')" title="Borrar">
			         <span class="glyphicon glyphicon-trash"></span> 
			     </button>			     		     
			</td>
		</tr>
	 <?php $cont=$cont+1;  $total1=$total1+$total;?>
	<?php endforeach;?>
	
	</table>
	
	<?php endif;?>
	<div class="alert <?php if ($total>$proyecto_model->monto_total) echo 'alert-danger'; else echo 'alert-success';?>">
        <strong>Monto Total de las Fuentes:&nbsp;&nbsp;&nbsp;</strong><?php echo $total1;?><br>   
        <strong>Monto Total del Proyecto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->monto_total;?> 
    </div>	
	
	<div class="modal fade" id="nuevo" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Nueva Fuente</h4>
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
								<label class="col-md-4 control-label" for="monto">Monto</label>
								<div class="input-group col-md-7">
									<input id="monto" name="monto"
										placeholder="monto"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números"> <span
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
<!-- editar formulario -->
	<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Fuente</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
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
								<label class="col-md-4 control-label" for="monto">Monto</label>
								<div class="input-group col-md-7">
									<input id="monto" name="monto"
										placeholder="monto"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números"> <span
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



$(function() {
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator() });    
	$('#editar').on('shown.bs.modal', function (e) { $('#form-editar').validator() });    
	
	jQuery.fn.resetear = function () {
		  $(this).each (function() { this.reset(); });
		}
	
});

function guardar_nuevo(id){
	$('#form').validator('validate');
	if(!$('#form').find('.has-error').length) {
		var total = <?php echo $total1;?>; // esta variable de donde viene
		var monto_total = <?php echo $proyecto_model->monto_total;?>;
		var monto_a_insertar = $('#monto').val();
		if( (monto_a_insertar ) <= monto_total )  //if( (monto_a_insertar +total) <= monto_total ) sale mensaje 
    		$.ajax({
                type: "POST",
                url: '<?php echo base_url().'administracion/proyecto_fuente/nuevo/';?>'+id,
                data: $('#form').serialize(),
                success: function(response){ $('#nuevo').modal('hide');location.reload();},
                error: function(){alert('Formulario con Errores');}
            });
		else{
			alert('El monto no puede ser mayor que el monto total asignado al proyecto');
		}
    } 	
}

function guardar_editar(id){
	if(!$('#form-editar').find('.has-error').length) {
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'administracion/proyecto_fuente/editar/';?>'+id,
            data: $('#form-editar').serialize(),
            success: function(response){ $('#editar').modal('hide');location.reload();},
            error: function(){alert('Error');}
        });
	} 	
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
		      function(data){return data.id_proyecto_fuente == id}
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
        url: '<?php echo base_url().'administracion/proyecto_fuente/borrar/';?>'+id,        
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


</script>
<style>
.datepicker{z-index:1151 !important;}
</style>