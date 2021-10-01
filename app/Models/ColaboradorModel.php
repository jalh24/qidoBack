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
    if(!empty($colaboradorFiltro)){

    if(!empty($colaboradorFiltro->genero)){
      $filter = $filter . ' and idSexo= ' . $colaboradorFiltro->genero;
    }
    if(!empty($colaboradorFiltro->permanencia)){
      $filter = $filter . ' and idPermanencia= ' . $colaboradorFiltro->permanencia;
    }
    if(!empty($colaboradorFiltro->atiendeCovid)){
      $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
    }
    if(!empty($colaboradorFiltro->antecedentePenales)){
      $filter = $filter . ' and antecedentePenales= ' . $colaboradorFiltro->antecedentePenales;
    }
    if(!empty($colaboradorFiltro->autoPropio)){
      $filter = $filter . ' and autoPropio= ' . $colaboradorFiltro->autoPropio;
    }
    if(!empty($colaboradorFiltro->dispuestoViajar)){
      $filter = $filter . ' and dispuestoViajar= ' . $colaboradorFiltro->dispuestoViajar;
    }
    if(!empty($colaboradorFiltro->peso1) && !empty($colaboradorFiltro->peso2)){
      $filter = $filter . ' and (peso between ' . $colaboradorFiltro->peso1 . ' and ' . $colaboradorFiltro->peso2 .' ) ';
    }
    if(!empty($colaboradorFiltro->estatura1) && !empty($colaboradorFiltro->estatura2)){
      $filter = $filter . ' and (estatura between ' . $colaboradorFiltro->estatura1 . ' and ' . $colaboradorFiltro->estatura2 .' ) ';
    }
  }
    /*var_dump('select * from ' . $this->table .
                              $filter);*/
    $query = $this->db->query('select * from ' . $this->table .
                              $filter);
    return $query->getResult();
  } 

}