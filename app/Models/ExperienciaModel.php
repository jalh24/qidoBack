<?php namespace App\Models;

use CodeIgniter\Model;

class ExperienciaModel extends Model
{
  protected $table = 'experiencia';
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
          "idExperiencia" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idExperiencia" => $id,
      ));
  }

  public function getExperienciasColaborador($idColaborador) { 
    $query = $this->db->query('select * from ' . $this->table . ' where idColaborador ='.$idColaborador);
    return $query->getResult();
  } 

//   public function getExperienciasAntes($idColaborador) {
    
//     $query = $this->db->query('select * from cuentacolaborador where idColaborador = ' . $idColaborador);

//     return $query->getResult();
//   }

  public function eliminarExperiencias($idColaborador,$colabServ) {

    $query = $this->db->query('delete from ' . $this->table . ' where idColaborador=' . $idColaborador . ' and idExperiencia=' . $colabServ->idExperiencia);
}

public function agregarExperiencias($idColaborador,$colabServ) {
    // var_dump('insert into experiencia(idColaborador, empresa, fechaInicio, fechaFin, referencia, comentario, telefono) VALUES ('. $idColaborador .', '. '"'.$colabServ->empresa .'"'.', '. '"'.$colabServ->fechaInicio .'"'.', '. '"'.$colabServ->fechaFin .'"'.', '. '"'.$colabServ->referencia.'"'. ', '. '"'.$colabServ->comentario .'"'.', '. '"'.$colabServ->telefono.'"'.')');
  $query = $this->db->query('insert into experiencia(idColaborador, empresa, fechaInicio, fechaFin, referencia, comentario, telefono) VALUES ('. $idColaborador .', '. '"'.$colabServ->empresa .'"'.', '. '"'.$colabServ->fechaInicio .'"'.', '. '"'.$colabServ->fechaFin .'"'.', '. '"'.$colabServ->referencia.'"'. ', '. '"'.$colabServ->comentario .'"'.', '. '"'.$colabServ->telefono.'"'.')');
}

}