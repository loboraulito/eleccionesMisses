<div id="container">
	<h1>Lista de los Items del Proyecto</h1>
	 <a href="#" onclick="nuevo();" class="glyphicon glyphicon-plus" data-toggle="modal" style="font-size:15px; padding-bottom:10px;">Nuevo</a>
		
	<div class="row">
		<p class="dato col-xs-8">
			<strong>Código SISIN:&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $proyecto_model->codigo_sisin;?>
		</p>
		<p class="dato col-xs-4">
			<strong>Tipo Proyecto:&nbsp;&nbsp;&nbsp;&nbsp;  </strong><?php echo $proyecto_model->tipo_proyecto;?>
		</p>		
		<p class="dato col-xs-8">
			<strong>Descripción: &nbsp;&nbsp;&nbsp;&nbsp;   </strong><?php echo $proyecto_model->descripcion;?>
		</p>		
		<p class="dato col-xs-4">
			<strong>Monto Total: &nbsp;&nbsp;&nbsp;&nbsp;   </strong><?php echo $proyecto_model->monto_total;$total_proyecto=$proyecto_model->monto_total;?>
		</p>		
		<p class="dato col-xs-8">
			<strong>Responsable: &nbsp;&nbsp;&nbsp;&nbsp;     </strong><?php echo  $proyecto_model->nombres."&nbsp;".$proyecto_model->apellidos; ?>
		</p>
		<p class="dato col-xs-4">
			<strong>Estado:  &nbsp;&nbsp;&nbsp;&nbsp;      </strong><?php echo $proyecto_model->estado=='O'?'Observado':($proyecto_model->estado == 'P'?'Aprobado':'Activo');?>
		</p>
	</div>	
	<?php if($resultados):?>
	<table class="table table-bordered table-striped table-hover">
		<tr>
		    <th>Nro.</th>
			<th>Item</th>
			<th>Descripción</th>
			<th>Unidad</th>
			<th>Cantidad</th>
			<th>Precio Unitario</th>
			<th>Total</th>
			<th>Opciones</th>
		</tr>
	<?php $cont=1;$total_items=0;?>
	<?php foreach ($resultados as $detalle):?>
	   <?php $fuente = $detalle->unidad;$cantidad = $detalle->cantidad; $precio = $detalle->precio_unidad;$total_item = ($cantidad*$precio);$total_items+=$total_item;?>
	   <tr>
			<td><?php echo $cont; ?></td>
			<td><?php echo $detalle->item; ?></td>
			<td><?php echo $detalle->descripcion; ?></td>
			<td><?php echo $detalle->unidad; ?></td>			
			<td><?php echo $detalle->cantidad; ?></td>
			<td><?php echo $detalle->precio_unidad;?></td>
			<td><?php echo $total_item;?></td>
			<td> 
			     <button type="button" class="btn btn-default btn-xs btn-editar" onclick="editar(<?php echo $detalle->id_detalle_proyecto;?>)">
			         <span class="glyphicon glyphicon-pencil"></span> Modificar
			     </button>			     	     
			</td>
		</tr>
	   <?php $cont=$cont+1;?>
	<?php endforeach;?>
	</table>
	<p><?php echo $links; ?></p>
	
	<div class="alert <?php if ($total_items>$total_proyecto) echo 'alert-danger'; else echo 'alert-success';?>">
        <strong>Monto Total de los Items:</strong><?php echo $total_items;?><br>   
        <strong>Monto Total del Proyecto:</strong><?php echo $total_proyecto;?> 
    </div>	   
	
	<?php else:?>
    	<div class="alert alert-info">
          <strong>No existen Detalles</strong> para este Proyecto
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
					<h4 class="modal-title" id="myModalLabel">Nuevo Detalle</h4>
				</div>
				<div class="modal-body">
					<form id="form" class="form-horizontal">
						<fieldset>

						    <!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="item">Item</label>
								<div class="input-group col-md-7">
									<input id="item" name="item"
										placeholder="Item"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9]{1,}$" required
										data-error="Campo Obligatorio solo letras números y guiones">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="descripcion">Descripción</label>
								<div class="col-md-7">
									<textarea class="form-control" id="descripcion" name="descripcion"></textarea>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="unidad">Unidad</label>
								<div class="input-group col-md-7">
									<input id="unidad" name="unidad"
										placeholder="Unidad"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9]{1,}$" required
										data-error="Campo Obligatorio solo letras números y guiones">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="cantidad">Cantidad</label>
								<div class="input-group col-md-7">
									<input id="cantidad" name="cantidad"
										placeholder="Cuenta del Empleado"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="precio_unidad">Precio Unidad</label>
								<div class="input-group col-md-7">
									<input id="precio_unidad" name="precio_unidad"
										placeholder="Cuenta del Empleado"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números">
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
	
<!--editar-->
	<div class="modal fade" id="editar" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Editar Detalle</h4>
				</div>
				<div class="modal-body">
					<form id="form-editar" class="form-horizontal">
						<fieldset>

						    <!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="item">Item</label>
								<div class="input-group col-md-7">
									<input id="item" name="item"
										placeholder="Item"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9]{1,}$" required
										data-error="Campo Obligatorio solo letras números y guiones">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="descripcion">Descripción</label>
								<div class="col-md-7">
									<textarea class="form-control" id="descripcion" name="descripcion"></textarea>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="unidad">Unidad</label>
								<div class="input-group col-md-7">
									<input id="unidad" name="unidad"
										placeholder="Unidad"
										class="form-control input-md" type="text"
										pattern="^[A-z0-9]{1,}$" required
										data-error="Campo Obligatorio solo letras números y guiones">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="cantidad">Cantidad</label>
								<div class="input-group col-md-7">
									<input id="cantidad" name="cantidad"
										placeholder="Cuenta del Empleado"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group has-feedback">
								<label class="col-md-4 control-label" for="precio_unidad">Precio Unidad</label>
								<div class="input-group col-md-7">
									<input id="precio_unidad" name="precio_unidad"
										placeholder="Cuenta del Empleado"
										class="form-control input-md" type="text"
										pattern="^[0-9]{1,}$" required
										data-error="Campo Obligatorio solo números">
									<span class="glyphicon form-control-feedback"
										aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
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
	$('#nuevo').on('shown.bs.modal', function (e) { $('#form').validator()});
	$('#editar').on('shown.bs.modal', function (e) { $('#form-editar').validator()});
	
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
            url: '<?php echo base_url().'index.php/seguimiento/proyecto_detalle/nuevo';?>',
            data: datos,
            success: function(response){ $('#nuevo').modal('hide');location.reload();},
            error: function(){alert('Error');}
        }); 
	}	
}

function guardar_editar(id){
	if(!$('#form-editar').find('.has-error').length) {
    	var datos=$('#form-editar').serializeArray();
    	datos.push({name: 'id_detalle_proyecto', value: id});
    	$.ajax({
            type: "POST",
            url: '<?php echo base_url().'index.php/seguimiento/proyecto_detalle/editar';?>',
            data: datos,
            success: function(response){ $('#editar').modal('hide');location.reload();},
            error: function(){alert('Error');}
        }); 	
	}
}

function nuevo(){
	$('#form').resetear();
	$('#nuevo').modal('show');
	$( "#guardar-btn").unbind( "click" );
	$( "#guardar-btn" ).bind( "click", function() {
		  guardar_nuevo();
	});
}

function buscar(id) {
	return js_obj_data.filter(
		      function(data){return data.id_detalle_proyecto == id}
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