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
}