<?php namespace App\Models;

use CodeIgniter\Model;

class ColaboradorModel extends Model
{
  protected $table = 'colaborador';
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
          "idColaborador" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idColaborador" => $id,
      ));
  }

  public function getColaboradores($colaboradorFiltro) { 
    $filter = ' where idColaborador > 0 ';
    if($colaboradorFiltro->genero >0){
      $filter = $filter . ' and idSexo= ' . $colaboradorFiltro->genero;
    }
    if($colaboradorFiltro->permanencia >0){
      $filter = $filter . ' and idPermanencia= ' . $colaboradorFiltro->permanencia;
    }
    if($colaboradorFiltro->atiendeCovid){
      $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
    }
    if($colaboradorFiltro->antecedentePenales){
      $filter = $filter . ' and antecedentePenales= ' . $colaboradorFiltro->antecedentePenales;
    }
    if($colaboradorFiltro->autoPropio){
      $filter = $filter . ' and autoPropio= ' . $colaboradorFiltro->autoPropio;
    }
    if($colaboradorFiltro->dispuestoViajar){
      $filter = $filter . ' and dispuestoViajar= ' . $colaboradorFiltro->dispuestoViajar;
    }
    if($colaboradorFiltro->peso1 >0 && $colaboradorFiltro->peso2 >0){
      $filter = $filter . ' and (peso between ' . $colaboradorFiltro->peso1 . ' and ' . $colaboradorFiltro->peso2 .' ) ';
    }
    if($colaboradorFiltro->estatura1 >0 && $colaboradorFiltro->estatura2 >0){
      $filter = $filter . ' and (estatura between ' . $colaboradorFiltro->estatura1 . ' and ' . $colaboradorFiltro->estatura2 .' ) ';
    }
    /*var_dump('select * from ' . $this->table .
                              $filter);*/
    $query = $this->db->query('select * from ' . $this->table .
                              $filter);
    return $query->getResult();
  } 

}