<script type="text/javascript">
	$(document).ready(function(){
		mostrarClientes();

		function mostrarClientes(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('clienteC/get_cliente') ?>',
				dataType: 'json',

				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for (i = 0; i <datos.length; i++) {
						tabla+=
						'<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+'</td>'+
						'<td>'+datos[i].apellido+'</td>'+
						'<td>'+datos[i].suscripcion+'</td>'+
						'<td>'+datos[i].genero+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger borrar" data="'+datos[i].id_cliente+'">EIMINAR</a>'+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-primary editar" data="'+datos[i].id_cliente+'">EDITAR</a>'+'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_cliente').html(tabla);
				}
			});
		};// fin del metodo mostrar con ajax

		$('#tabla_cliente').on('click','.borrar',function(){
			$id = $(this).attr('data');
			$('#modalBorrar').modal('show');
			$('#modalBorrar').find('.modal-title').text('Eliminar Cliente');
			$('#btnBorrar').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('clienteC/eliminar') ?>',
					data:{id:$id},
					dataType: 'json',

					success: function(respuesta){
						$('#modalBorrar').modal('hide');
						if(respuesta==true){
							alertify.notify('Eliminado exitosamente','success',10,null);
							mostrarClientes();
						}else{
							alertify.notify('Error al eliminar','error',10,null);
						}
					},
					error: function(){
						alertify.notify('Error al eliminar, registro dependiente!!!','error',10,null);
					}
				});
			});
		});

		get_suscripcion();

		function get_suscripcion(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('clienteC/get_suscripcion') ?>',
				dataType: 'json',

				success: function(datos){
					var op='';
					var i;

					op+="<option value=''>Seleccione suscripcion</option>";

					for (i = 0; i <datos.length; i++) {
						op+="<option value='"+datos[i].id_suscripcion+"'>"+datos[i].suscripcion+"</option>";
					}

					$('#suscripcion').html(op);
				}
			});
		}


		get_genero();

		function get_genero(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('clienteC/get_genero') ?>',
				dataType: 'json',

				success: function(datos){
					var op='';
					var i;

					op+="<option value=''>Seleccione genero</option>";

					for (i = 0; i <datos.length; i++) {
						op+="<option value='"+datos[i].id_genero+"'>"+datos[i].genero+"</option>";
					}

					$('#genero').html(op);
				}
			});
		};

		$('#nueCliente').click(function(){
			$('#modalCliente').modal('show');
			$('#modalCliente').find('.modal-title').text('Nuevo Cliente');
			$('#formCliente').attr('action','<?= base_url('clienteC/ingresar') ?>');

		});

		$('#btnGuardar').click(function(){
			$resultado = validar();


			if($resultado==true){
				$url = $('#formCliente').attr('action');
				$data = $('#formCliente').serialize();
				$.ajax({
					type: 'ajax',
					method: 'post',
					url:$url,
					data:$data,
					dataType: 'json',

					success: function(respuesta){
						$('#modalCliente').modal('hide');

						if(respuesta=="add"){
							alertify.notify('Ingresado exitosamente','success',19,null);
							mostrarClientes();
						}else if (respuesta=="edi"){
							alertify.notify('Actualizado exitosamente','success',10,null);
						}else{
							alertify.notify('Error al ingresar','error',10,null);
						}

						$('#formCliente')[0].reset();
					}

				});

			}
		});

		$('#tabla_cliente').on('click','.editar',function(){
			$id = $(this).attr('data');
			$('#modalCliente').modal('show');
			$('#modalCliente').find('.modal-title').text('Editar Cliente');
			$('#formCliente').attr('action','<?= base_url('clienteC/actualizar') ?>');
			

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('clienteC/get_datos') ?>',
				data:{id:$id},
				dataType: 'json',

				success: function(datos){
					$('#id').val(datos.id_cliente);
					$('#nombre').val(datos.nombre);
					$('#apellido').val(datos.apellido);
					$('#suscripcion').val(datos.id_suscripcion);
					$('#genero').val(datos.id_genero);
				}

			});
			
		});

		function validar(){
			$nombre = $('#nombre').val();
			$apellido = $('#apellido').val();
			$suscripcion = $('#suscripcion').val();
			$genero = $('#genero').val();

			if($nombre==0 || $nombre>30){
				$('#nombre').css('borderColor','red');
				$('#nombre').attr('placeholder','Campo obligatorio');
				$('#nombre').css('boxShadow','0 0 5px red');
				return false;
			}else{
				$('#nombre').css('borderColor','green');
				$('#nombre').css('boxShadow','0 0 5px green');
			}

			if($apellido==0 || $apellido>30){
				$('#apellido').css('borderColor','red');
				$('#apellido').attr('placeholder','Campo obligatorio');
				$('#apellido').css('boxShadow','0 0 5px red');
				return false;
			}else{
				$('#apellido').css('borderColor','green');
				$('#apellido').css('boxShadow','0 0 5px green');
			}

			if($suscripcion==''){
				$('#suscripcion').css('borderColor','red');
				$('#suscripcion').css('boxShadow','0 0 5px red');
				return false;
			}else{
				$('#suscripcion').css('borderColor','green');
				$('#suscripcion').css('boxShadow','0 0 5px green');
			}

			if($genero==''){
				$('#genero').css('borderColor','red');
				$('#genero').css('boxShadow','0 0 5px red');
				return false;
			}else{
				$('#genero').css('borderColor','green');
				$('#genero').css('boxShadow','0 0 5px green');
			}

			return true;
		}

	});

</script>