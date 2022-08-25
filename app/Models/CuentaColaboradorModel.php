<?php namespace App\Models;

use CodeIgniter\Model;

class CuentaColaboradorModel extends Model
{
  protected $table = 'cuentacolaborador';
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

  public function update_data($id, $data = array())
  {
      $this->db->table($this->table)->update($data, array(
          "idCuenta" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idCuenta" => $id,
      ));
  }

  public function getContactosColaborador($idColaborador) {
    //   var_dump('select * from ' . $this->table . 'inner join banco on' . $this->table . '.idBanco = banco.idBanco where idColaborador ='.$idColaborador);
    $query = $this->db->query('select * from ' . $this->table . ' inner join banco on ' . $this->table . '.idBanco = banco.idBanco where idColaborador ='.$idColaborador);
    return $query->getResult();
  } 

  public function getCuentasAntes($idColaborador) {
    
    $query = $this->db->query('select * from cuentacolaborador where idColaborador = ' . $idColaborador);

    return $query->getResult();
  }

  public function eliminarCuentas($idColaborador,$colabServ) {

    $query = $this->db->query('delete from cuentacolaborador where idColaborador=' . $idColaborador . ' and idCuenta=' . $colabServ->idCuenta);
}

public function agregarCuentas($idColaborador,$colabServ) {
    // var_dump('insert into cuentacolaborador(idColaborador, idBanco, beneficiario, numero, tipoCuenta) VALUES ('. $idColaborador .', '. $colabServ->banco->idBanco .', '. $colabServ->nombre .', '. $colabServ->numero .', '. "'".$colabServ->tipoCuenta."'" .', '. $colabServ->comprobantePago .')');
    // $colabServ->comprobantePago = base64_encode($colabServ->comprobantePago);
  $query = $this->db->query('insert into cuentacolaborador(idColaborador, idBanco, beneficiario, numero, tipoCuenta, comprobantePago) VALUES ('. $idColaborador .', '. $colabServ->banco->idBanco .', '. "'".$colabServ->nombre."'" .', '. $colabServ->numero .', '. "'".$colabServ->tipoCuenta."'"  .', '. "'".$colabServ->comprobantePago."'" .')');
//   'insert into cuentacolaborador(idColaborador, idBanco, beneficiario, numero, tipoCuenta) VALUES ('. $idColaborador .', '. $colabServ->idBanco .', '. $colabServ->beneficiario .', '. $colabServ->numero .', '. $colabServ->tipoCuenta .', '. $colabServ->comprobantePago .')'
}

}