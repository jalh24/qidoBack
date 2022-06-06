<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
	protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
  }

  public function insert_data($data = array())
  {
      $this->db->table($this->table)->insert($data);
      return $this->db->insertID();
  }

  public function update_data($id, $data = array())
  {
      $this->db->table($this->table)->update($data, array(
          "idCliente" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function getClientes() { 
    $query = $this->db->query('select * from ' . $this->table . '');
    return $query->getResult();
  } 
  public function getClienteId($clienteFiltro) {   
    $query = $this->db->query('select * from ' . $this->table . ' where idCliente =  '. $clienteFiltro);
    return $query->getResult();
  }

  public function getClientesByContacto($dato) { 
    $query = $this->db->query('select *,CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from cliente where correoContacto="'.$dato.'"');
    return $query->getResult();
  }

  public function getColaboradoresByCliente($dato) { 
    $query = $this->db->query('select s.idServicio, s.cliente, s.procedimientos, cs.idColaborador, CONCAT_WS(" ",c.nombre,c.a_paterno,c.a_materno) as nombrecompleto from servicio s inner join colaboradorservicio cs on s.idServicio=cs.idServicio inner join colaborador c on c.idColaborador=cs.idColaborador where s.cliente = ' .$dato. ' order by s.idServicio desc');
    return $query->getResult();
  }

  public function getBitacorasByServicio($dato) { 
    $query = $this->db->query('select * from bitacoraservicio where idServicio="'.$dato.'" order by fechaCaptura desc');
    return $query->getResult();
  }
}