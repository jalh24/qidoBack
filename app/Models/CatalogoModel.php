<?php namespace App\Models;

use CodeIgniter\Model;

class CatalogoModel extends Model
{

	protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
  }

  public function getZonasLaborales() { 
    $query = $this->db->query('select * from zonalaboral');
    return $query->getResult();
  } 

  public function getClientes() { 
    $query = $this->db->query('select idCliente, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto, nombre,a_paterno,a_materno from cliente');
    return $query->getResult();
  }

  public function getClientesById($cliente) { 
    $query = $this->db->query('select * from cliente where idCliente='.$cliente);
    return $query->getResult();
  }

  public function getColaboradores() { 
    $query = $this->db->query('select idColaborador, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from colaborador');
    return $query->getResult();
  }

  public function getColaboradoresCurp() { 
    $query = $this->db->query('select idColaborador, curp from colaborador');
    return $query->getResult();
  } 

  public function getServicioColaboradoresFiltro() { 
    $query = $this->db->query('select DISTINCT c.idColaborador, CONCAT_WS(" ",c.nombre,c.a_paterno,c.a_materno) as nombrecompleto from colaborador c inner join servicio s on s.colaborador = c.idColaborador' );
    return $query->getResult();
  } 

  public function getEspecialidades() { 
    $query = $this->db->query('select * from especialidad');
    return $query->getResult();
  } 

  public function getHabilidades() { 
    $query = $this->db->query('select * from habilidad');
    return $query->getResult();
  } 

  public function getSexo() { 
    $query = $this->db->query('select * from sexocat');
    return $query->getResult();
  }

  public function getResponsable() { 
    $query = $this->db->query('select * from responsable');
    return $query->getResult();
  } 

  public function getParentescos() { 
    $query = $this->db->query('select * from parentescocat');
    return $query->getResult();
  } 

  public function getEstatusPago() { 
    $query = $this->db->query('select * from tipoestatuspago');
    return $query->getResult();
  } 

  public function getEstatusOperacion() { 
    $query = $this->db->query('select * from tipoestatusoperacion');
    return $query->getResult();
  } 

  public function getTez() { 
    $query = $this->db->query('select * from tezcat');
    return $query->getResult();
  } 

  public function getComplexiones() { 
    $query = $this->db->query('select * from complexiones');
    return $query->getResult();
  } 

  public function getBanco() { 
    $query = $this->db->query('select * from banco');
    return $query->getResult();
  } 

  public function getCalificacion() { 
    $query = $this->db->query('select * from calificacion');
    return $query->getResult();
  }

  public function getGradoEstudio() { 
    $query = $this->db->query('select * from ultimogradoestudios');
    return $query->getResult();
  }

  public function getTipoVisa() { 
    $query = $this->db->query('select * from tipovisa');
    return $query->getResult();
  } 

  public function getTipoCliente() { 
    $query = $this->db->query('select * from tipocliente');
    return $query->getResult();
  } 

  public function getTipoColaborador() { 
    $query = $this->db->query('select * from tipocolaborador');
    return $query->getResult();
  } 

  public function getTiposTelefono() { 
    $query = $this->db->query('select * from tipotelefono');
    return $query->getResult();
  }

  public function getPermanencias() { 
    $query = $this->db->query('select * from permanencia');
    return $query->getResult();
  } 

  public function getEstadoCivil() { 
    $query = $this->db->query('select * from estadocivilcat');
    return $query->getResult();
  } 

  public function getPaises() { 
    $query = $this->db->query('select * from pais');
    return $query->getResult();
  } 
  
  public function getEstados($pais) { 
    $query = $this->db->query('select * from estado where idPais='.$pais);
    return $query->getResult();
  }

  public function getCiudad($estado) { 
    $query = $this->db->query('select * from ciudad where idEstado='.$estado);
    return $query->getResult();
  }

  public function getColonias($pais) { 
    $query = $this->db->query('select * from colonia where idCiudad='.$ciudad);
    return $query->getResult();
  }

  public function getColoniasByCodigoPostal($codigoPostal) { 
    $query = $this->db->query('select * from colonia where codigoPostal='.$codigoPostal);
    return $query->getResult();
  }
  public function getCiudadesByCodigoPostal($codigoPostal) { 
    $query = $this->db->query('select * from ciudad where idCiudad='.$codigoPostal);
    return $query->getResult();
  }
  public function getEstadosByCodigoPostal($codigoPostal) { 
    $query = $this->db->query('select * from estado where idEstado='.$codigoPostal);
    return $query->getResult();
  }

  public function getEstatus($tipo) { 
    $query = $this->db->query('select * from estatus where tipo=\''.$tipo.'\'');
    return $query->getResult();
  }


}