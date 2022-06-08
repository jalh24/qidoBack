<?php namespace App\Models;

use CodeIgniter\Model;

class UsuariofacturacionModel extends Model
{
  protected $table = 'usuariofacturacion';
  protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
      // OR $this->db = db_connect();
  }

  public function insert_data($data = array())
  {
      $this->db->table($this->table)->insert($data);
      return $this->db->insertID();
  }

  public function selectId($id)
  {
    $query = $this->db->query('select idUsuarioFacturacion, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from ' . $this->table . ' where idUsuarioFacturacion =  '. $id);
    return $query->getResult();
  }

  public function getUsuariosFacturacion() {
    $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from usuariofacturacion');
    return $query->getResult();
  }

//   public function update_data($id, $data = array())
//   {
//       $this->db->table($this->table)->update($data, array(
//           "idContactoCliente" => $id,
//       ));
//       return $this->db->affectedRows();
//   }

//   public function delete_data($id)
//   {
//       return $this->db->table($this->table)->delete(array(
//           "idContactoCliente" => $id,
//       ));
//   }

}