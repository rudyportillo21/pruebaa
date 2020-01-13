<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteM extends CI_Model {
	public function get_cliente(){
		$pa_mostrarCliente ="CALL pa_mostrarCliente()";
		$query = $this->db->query($pa_mostrarCliente);
		if($query->num_rows()>0){
			return $query->result();
		}
	}

	public function eliminar($id){
		$pa_eliminarCliente ="CALL pa_eliminarCliente(?)";
		$arreglo= array('id_cliente'=>$id);
		$query = $this->db->query($pa_eliminarCliente,$arreglo);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_suscripcion(){
		$exe = $this->db->get('suscripcion');
		return $exe->result();
	}
	public function get_genero(){
		$exe = $this->db->get('genero');
		return $exe->result();
	}

	public function ingresar($datos){
		$pa_insertarCliente ="CALL pa_insertarCliente(?,?,?,?)";
		$arreglo= array('nombre'=>$datos['nombre'],
			'apellido'=>$datos['apellido'],
			'id_suscripcion'=>$datos['suscripcion'],
			'id_genero'=>$datos['genero']);
		$query = $this->db->query($pa_insertarCliente,$arreglo);
		if($query!==null){
			return "add";
		}else{
			return false;
		}
	}

	public function get_datos($id){
		$this->db->where('id_cliente',$id);
		$exe = $this->db->get('clientes');
		return $exe->row();
	}


	public function actualizar($datos){
		$pa_editarCliente ="CALL pa_editarCliente(?,?,?,?,?)";
		$arreglo= array(
			'id_cliente'=>$datos['id_cliente'],
			'nombre'=>$datos['nombre'],
			'apellido'=>$datos['apellido'],
			'id_suscripcion'=>$datos['suscripcion'],
			'id_genero'=>$datos['genero']);
		$query = $this->db->query($pa_editarCliente,$arreglo);
		if($query!==null){
			return "edi";
		}else{
			return false;
		}
	}
}
