<?php $this->load->helper('cliente') ?>
<body class="container">
	<button type="button" class="btn btn-outline-success" id="nueCliente">Nuevo Cliente</button>
	<table border="1" class="table table-dark table-hover">
		<thead>
			<tr>
				<td>N°</td>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Suscripcion</td>
				<td>Genero</td>
				<td>Eliminar</td>
				<td>Actualizar</td>
				
			</tr>
		</thead>
		<tbody id="tabla_cliente">
			
		</tbody>
	</table>

	<div class="modal" tabindex="-1" role="dialog" id="modalBorrar">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Esta seguro de eliminar este registro?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnBorrar">Si, Eliminar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					
				</div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modalCliente">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formCliente" action="" method="POST">
						<input type="hidden" name="id_cliente" id="id">
						<div>
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre del cliente" maxlength="30">
						</div>
						<div>
							<label>Apellido</label>
							<input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese apellido del cliente" maxlength="30">
						</div>
						<div>
							<label>Suscripcion</label>
							<select id="suscripcion" name="suscripcion" class="form-control">
								
							</select>
						</div>
						<div>
							<label>Genero</label>
							<select id="genero" name="genero" class="form-control">
								
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>