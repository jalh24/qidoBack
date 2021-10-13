<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

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
    if(!empty($colaboradorFiltro->zonasLaborales)){
      $filter = ' inner join colaboradorzona colabzona on colab.idColaborador = colabzona.idColaborador where colab.idColaborador > 0 ';
    } else{
      $filter = ' where idColaborador > 0 ';  
    }
    
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
      if(!empty($colaboradorFiltro->calificacion1) && !empty($colaboradorFiltro->calificacion2)){
        $filter = $filter . ' and (idCalificacion between ' . $colaboradorFiltro->calificacion1 . ' and ' . $colaboradorFiltro->calificacion2 .' ) ';
      }
      if(!empty($colaboradorFiltro->edad1) && !empty($colaboradorFiltro->edad2)){
        $diaActual = new DateTime();
        // $diaActual = date("Y-m-d");
        $diaActualMin = new DateTime();
        $diaActualMax = new DateTime();
        $diaActualMax->sub(new DateInterval('P'.($colaboradorFiltro->edad2+1).'Y'));
        $diaActualMax->add(new DateInterval('P1D'));
        $diaActualMin->sub(new DateInterval('P'.($colaboradorFiltro->edad1).'Y'));
        $diaActualConv = $diaActual->format('Y-m-d');
        $diaActualMinConv = $diaActualMin->format('Y-m-d');
        $diaActualMaxConv = $diaActualMax->format('Y-m-d');
        $filter = $filter . ' and (fecha_nacimiento between \'' . $diaActualMaxConv . '\' and \'' . $diaActualMinConv .'\' ) ';
      }
      if(!empty($colaboradorFiltro->zonasLaborales)){
          $filter = $filter . ' and colabzona.idZonaLaboral in  ( ';
          $x =1;
          foreach($colaboradorFiltro->zonasLaborales as $zonas){
            $filter = $filter . $zonas->idZonaLaboral;
            if($x < count($colaboradorFiltro->zonasLaborales)){
              $filter = $filter . ',';
              $x++;
            }
          }
          $filter = $filter . ' ) ';
      }
    }
    
    //  var_dump('select DISTINCT colab.* from ' . $this->table . ' colab '.
    //  $filter . ' LIMIT '.$colaboradorFiltro->start.','. $colaboradorFiltro->limit);
   

    $query = $this->db->query('select DISTINCT colab.* from ' . $this->table . ' colab '.
                              $filter . ' LIMIT '.$colaboradorFiltro->start.','. $colaboradorFiltro->limit);
    return $query->getResult();
  } 

  public function getColaboradoresNums($colaboradorFiltro) { 
    if(!empty($colaboradorFiltro->zonasLaborales)){
      $filter = ' inner join colaboradorzona colabzona on colab.idColaborador = colabzona.idColaborador where colab.idColaborador > 0 ';
    } else{
      $filter = ' where idColaborador > 0 ';  
    }

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
    if(!empty($colaboradorFiltro->calificacion1) && !empty($colaboradorFiltro->calificacion2)){
      $filter = $filter . ' and (idCalificacion between ' . $colaboradorFiltro->calificacion1 . ' and ' . $colaboradorFiltro->calificacion2 .' ) ';
    }
    if(!empty($colaboradorFiltro->edad1) && !empty($colaboradorFiltro->edad2)){
      $diaActual = new DateTime();
      // $diaActual = date("Y-m-d");
      $diaActualMin = new DateTime();
      $diaActualMax = new DateTime();
      $diaActualMax->sub(new DateInterval('P'.($colaboradorFiltro->edad2+1).'Y'));
      $diaActualMax->add(new DateInterval('P1D'));
      $diaActualMin->sub(new DateInterval('P'.($colaboradorFiltro->edad1).'Y'));
      $diaActualConv = $diaActual->format('Y-m-d');
      $diaActualMinConv = $diaActualMin->format('Y-m-d');
      $diaActualMaxConv = $diaActualMax->format('Y-m-d');
      $filter = $filter . ' and (fecha_nacimiento between \'' . $diaActualMaxConv . '\' and \'' . $diaActualMinConv .'\' ) ';
    }
    if(!empty($colaboradorFiltro->zonasLaborales)){
          $filter = $filter . ' and colabzona.idZonaLaboral in  ( ';
          $x =1;
          foreach($colaboradorFiltro->zonasLaborales as $zonas){
            $filter = $filter . $zonas->idZonaLaboral;
            if($x < count($colaboradorFiltro->zonasLaborales)){
              $filter = $filter . ',';
              $x++;
            }
          }
          $filter = $filter . ' ) ';
      }
      
    /*var_dump('select * from ' . $this->table .
                              $filter . ' LIMIT '.$colaboradorFiltro->limit.','. $colaboradorFiltro->start);
    */
                                
    $query = $this->db->query('select count(DISTINCT colab.idColaborador) total from ' . $this->table . ' colab '.
                              $filter );
    return $query->getResult();
  }
  
  public function getColaboradorId($colaboradorFiltro) { 
    $filter = ' inner join colaboradorzona colabzona on colab.idColaborador = colabzona.idColaborador';
    $filter = $filter . ' left join tipocolaborador tipoColaboradorConId on colab.idTipoColaborador = tipoColaboradorConId.idTipoColaborador';
    $filter = $filter . ' left join pais paisNacimiento on colab.idPaisNacimiento = paisNacimiento.idPais';
    $filter = $filter . ' left join estado estadoNacimiento on colab.idEstadoNacimiento = estadoNacimiento.idEstado';
    $filter = $filter . ' left join ciudad ciudadNacimiento on colab.idCiudadNacimiento = ciudadNacimiento.idCiudad';
    $filter = $filter . ' left join colonia coloniaDir on colab.idColonia = coloniaDir.idColonia';
    $filter = $filter . ' left join ciudad ciudadDir on colab.idCiudad = ciudadDir.idCiudad';
    $filter = $filter . ' left join estado estadoDir on colab.idEstado = estadoDir.idEstado';
    $filter = $filter . ' left join pais paisDir on colab.idPais = paisDir.idPais';
    $filter = $filter . ' left join sexocat genero on colab.idSexo = genero.idSexo';
    $filter = $filter . ' left join tezcat tez on colab.idTez = tez.idTez';
    $filter = $filter . ' left join estadocivilcat estadoCivil on colab.idEstadoCivil = estadoCivil.idEstadoCivil';
    $filter = $filter . ' left join tipotelefono tipoTelefono1 on colab.idTipoTelefono = tipoTelefono1.idTipoTel';
    $filter = $filter . ' left join tipotelefono tipoTelefono2 on colab.idTipoTelefono2 = tipoTelefono2.idTipoTel';
    $filter = $filter . ' left join permanencia permanenciaColab on colab.idPermanencia = permanenciaColab.idPermanencia';

    $query = $this->db->query('select DISTINCT colab.*, tipoColaboradorConId.nombre tipoColaboradorConId, 
    paisNacimiento.nombre paisNacimiento, 
    estadoNacimiento.nombre estadoNacimiento, 
    ciudadNacimiento.nombre ciudadNacimiento,
    coloniaDir.nombre coloniaDir,
    ciudadDir.nombre ciudadDir,
    estadoDir.nombre estadoDir,
    paisDir.nombre paisDir,
    genero.nombre genero,
    tez.nombre tez,
    estadoCivil.nombre estadoCivil,
    tipoTelefono1.nombre tipoTelefono1,
    tipoTelefono2.nombre tipoTelefono2,
    permanenciaColab.nombre permanenciaColab from ' . $this->table . ' colab '.
                              $filter . ' where colab.idColaborador =  '. $colaboradorFiltro);
    return $query->getResult();
  } 

}