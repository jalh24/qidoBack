<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class ServicioModel extends Model
{
  protected $table = 'servicio';
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

  public function getDatos($dato) { 
    $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from servicio where idServicio='.$dato);
    return $query->getResult();
  }

  public function getDatosServClien($dato) { 
    $query = $this->db->query('select idCliente, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from cliente where idCliente='.$dato);
    return $query->getResult();
  }

  public function getDatosServColab($dato) { 
    $query = $this->db->query('select colaboradorservicio.idColaborador, CONCAT_WS(" ",colaborador.nombre,colaborador.a_paterno,colaborador.a_materno) as nombrecompleto, colaboradorservicio.sueldo, colaboradorservicio.observacion from servicio inner JOIN colaboradorservicio ON servicio.idServicio = colaboradorservicio.idServicio left join colaborador on colaborador.idColaborador = colaboradorservicio.idColaborador where servicio.idServicio='.$dato);
    return $query->getResult();
  }

  public function getServicios($servicioFiltro) {
    $filter = ' where serv.idServicio > 0 ';
    if(!empty($servicioFiltro)) {
      if(!empty($servicioFiltro->fecha1) && !empty($servicioFiltro->fecha2)) {
        $fecha1Conv = strtotime($servicioFiltro->fecha1);
        $fecha1new = date('Y-m-d',$fecha1Conv);
        $fecha2Conv = strtotime($servicioFiltro->fecha2);
        $fecha2new = date('Y-m-d',$fecha2Conv);
        $filter = $filter . ' and (serv.fechaCreacion between \'' . $fecha1new . '\' and \'' . $fecha2new .'\' ) ';
      }
      // if(!empty($servicioFiltro->colaboradores)){
      //   // $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
      //   // $col = json_decode($servicioFiltro->colaboradores[1]);
      //   // $col = implode(",",$servicioFiltro->colaboradores);
      //   // var_dump($servicioFiltro->colaboradores[0]->nombrecompleto);
      //   $filter = $filter . ' and CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno)= \'' . $servicioFiltro->colaboradores[0]->nombrecompleto.'\'';
      // }
      if(!empty($servicioFiltro->responsables)) {
        $filter = $filter . ' and serv.idResponsable= ' . $servicioFiltro->responsables[0]->idResponsable;
      }
      if(!empty($servicioFiltro->pacientes)) {
        $filter = $filter . ' and serv.cliente= ' . $servicioFiltro->pacientes[0]->cliente;
      }
      if(!empty($servicioFiltro->estatusOperativo)) {
        $filter = $filter . ' and serv.estatusOperativo= \'' . $servicioFiltro->estatusOperativo.'\'';
      }
      if(!empty($servicioFiltro->estatusPago)) {
        $filter = $filter . ' and serv.estatusPago= \'' . $servicioFiltro->estatusPago.'\'';
      }
  }
    
    //  var_dump('select DISTINCT serv.*, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, DATE_FORMAT(serv.fechaCreacion,"%d/%m/%Y") AS formatoFecha, CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno) as nombrecompletocolab from ' . $this->table . ' serv ' . ' left join colaborador colab on colab.idColaborador = serv.colaborador '.
    //  $filter);

    $query = $this->db->query('select DISTINCT serv.*, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, DATE_FORMAT(serv.fechaCreacion,"%d/%m/%Y") AS formatoFecha, resp.nombre as nombreResp, est.Nombre as estatusOperativoNombre, estp.Nombre as estatusPagoNombre from ' . $this->table . ' serv ' . ' left join responsable resp on resp.idResponsable = serv.idResponsable left join tipoestatusoperacion est on est.idTipoEstatusOperacion = serv.estatusOperativo left join tipoestatuspago estp on estp.idTipoEstatusPago=serv.estatusPago'.
                              $filter. ' LIMIT '.$servicioFiltro->start.','. $servicioFiltro->limit);

    // $query = $this->db->query('select DISTINCT serv.*, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, DATE_FORMAT(serv.fechaCreacion,"%d/%m/%Y ") AS formatoFecha, resp.nombre as nombreResp, colabs.idColaborador as idColaborador, CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno) as nombrecompletocolab from ' . $this->table . ' serv ' . ' left join responsable resp on resp.idResponsable = serv.idResponsable left join colaboradorservicio colabs on colabs.idServicio = serv.idServicio left join colaborador colab on colab.idColaborador = colabs.idColaborador '.
    //                           $filter. ' order by serv.idServicio asc '. ' LIMIT '.$servicioFiltro->start.','. $servicioFiltro->limit);

    return $query->getResult();
  }

  public function getServicios1($servicioFiltro) {
    $filter = ' where serv.idServicio > 0 ';
    if(!empty($servicioFiltro)) {
      if(!empty($servicioFiltro->fecha1) && !empty($servicioFiltro->fecha2)) {
        $fecha1Conv = strtotime($servicioFiltro->fecha1);
        $fecha1new = date('Y-m-d',$fecha1Conv);
        $fecha2Conv = strtotime($servicioFiltro->fecha2);
        $fecha2new = date('Y-m-d',$fecha2Conv);
        $filter = $filter . ' and (serv.fechaCreacion between \'' . $fecha1new . '\' and \'' . $fecha2new .'\' ) ';
      }
      // if(!empty($servicioFiltro->colaboradores)){
      //   // $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
      //   // $col = json_decode($servicioFiltro->colaboradores[1]);
      //   // $col = implode(",",$servicioFiltro->colaboradores);
      //   // var_dump($servicioFiltro->colaboradores[0]->nombrecompleto);
      //   $filter = $filter . ' and CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno)= \'' . $servicioFiltro->colaboradores[0]->nombrecompleto.'\'';
      // }
      if(!empty($servicioFiltro->responsables)) {
        $filter = $filter . ' and serv.idResponsable= ' . $servicioFiltro->responsables[0]->idResponsable;
      }
      if(!empty($servicioFiltro->estatus)) {
        $filter = $filter . ' and estatus= \'' . $servicioFiltro->estatus.'\'';
      }
  }
    
    //  var_dump('select DISTINCT serv.*, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, DATE_FORMAT(serv.fechaCreacion,"%d/%m/%Y") AS formatoFecha, CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno) as nombrecompletocolab from ' . $this->table . ' serv ' . ' left join colaborador colab on colab.idColaborador = serv.colaborador '.
    //  $filter);

    // $query = $this->db->query('select DISTINCT serv.*, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, DATE_FORMAT(serv.fechaCreacion,"%d/%m/%Y") AS formatoFecha, resp.nombre as nombreResp from ' . $this->table . ' serv ' . ' left join responsable resp on resp.idResponsable = serv.idResponsable '.
    //                           $filter. ' LIMIT '.$servicioFiltro->start.','. $servicioFiltro->limit);

    $query = $this->db->query('select DISTINCT serv.*, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, DATE_FORMAT(serv.fechaCreacion,"%d/%m/%Y ") AS formatoFecha, resp.nombre as nombreResp, colabs.idColaborador as idColaborador, CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno) as nombrecompletocolab from ' . $this->table . ' serv ' . ' left join responsable resp on resp.idResponsable = serv.idResponsable left join colaboradorservicio colabs on colabs.idServicio = serv.idServicio left join colaborador colab on colab.idColaborador = colabs.idColaborador '.
                              $filter. ' order by serv.idServicio asc '. ' LIMIT '.$servicioFiltro->start.','. $servicioFiltro->limit);

    return $query->getResult();
  }

  public function getServicios2() { 
    $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from servicio');
    return $query->getResult();
  } 

  public function getServiciosNums($servicioFiltro) {
    $filter = ' where idServicio > 0 ';
    if(!empty($servicioFiltro)) {
      if(!empty($servicioFiltro->fecha1) && !empty($servicioFiltro->fecha2)) {
        $fecha1Conv = strtotime($servicioFiltro->fecha1);
        $fecha1new = date('Y-m-d',$fecha1Conv);
        $fecha2Conv = strtotime($servicioFiltro->fecha2);
        $fecha2new = date('Y-m-d',$fecha2Conv);
        $filter = $filter . ' and (serv.fechaCreacion between \'' . $fecha1new . '\' and \'' . $fecha2new .'\' ) ';
      }
      // if(!empty($servicioFiltro->colaboradores)){
      //   // $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
      //   // $col = json_decode($servicioFiltro->colaboradores[1]);
      //   // $col = implode(",",$servicioFiltro->colaboradores);
      //   // var_dump($servicioFiltro->colaboradores[0]->nombrecompleto);
      //   $filter = $filter . ' and CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno)= \'' . $servicioFiltro->colaboradores[0]->nombrecompleto.'\'';
      // }
      if(!empty($servicioFiltro->estatus)) {
        $filter = $filter . ' and estatus= \'' . $servicioFiltro->estatus.'\'';
      }
  }
                                
    $query = $this->db->query('select count(DISTINCT serv.idServicio) total from ' . $this->table . ' serv '.
                              $filter);
    return $query->getResult();
  }

  public function update_data($id, $data = array())
  {
      $this->db->table($this->table)->update($data, array(
          "idServicio" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function getColaboradoresAntes($idServicioColaborador) {
    
    $query = $this->db->query('select colaboradorservicio.idColaborador, CONCAT_WS(" ",colaborador.nombre,colaborador.a_paterno,colaborador.a_materno) as nombrecompleto, colaboradorservicio.sueldo, colaboradorservicio.observacion from servicio inner JOIN colaboradorservicio ON servicio.idServicio = colaboradorservicio.idServicio left join colaborador on colaborador.idColaborador = colaboradorservicio.idColaborador where servicio.idServicio=' . $idServicioColaborador);

    return $query->getResult();
  }

  public function eliminarColaboradores($idServicioColaborador,$colabServ) {

      $query = $this->db->query('delete from colaboradorservicio where idServicio=' . $idServicioColaborador . ' and idColaborador=' . $colabServ->idColaborador);
  }

  public function agregarColaboradores($idServicioColaborador,$colabServ) {
    $query = $this->db->query('insert into colaboradorservicio(idServicio,idColaborador,sueldo,observacion) values (' . $idServicioColaborador . ' ,' . $colabServ->idColaborador . ' ,' . $colabServ->sueldo . ' ,' . "'".$colabServ->observacion."'" . ')');
  }
//   public function delete_data($id)
//   {
//       return $this->db->table($this->table)->delete(array(
//           "idColaborador" => $id,
//       ));
//   }

//   public function getColaboradores($colaboradorFiltro) { 
//     if(!empty($colaboradorFiltro->zonasLaborales)){
//       $filter = ' left join colaboradorzona colabzona on colab.idColaborador = colabzona.idColaborador where colab.idColaborador > 0 ';
//     } else{
//       $filter = ' where idColaborador > 0 ';  
//     }
    
//     if(!empty($colaboradorFiltro)){

//       if(!empty($colaboradorFiltro->genero)){
//         $filter = $filter . ' and idSexo= ' . $colaboradorFiltro->genero;
//       }
//       if(!empty($colaboradorFiltro->permanencia)){
//         $filter = $filter . ' and idPermanencia= ' . $colaboradorFiltro->permanencia;
//       }
//       if(!empty($colaboradorFiltro->atiendeCovid)){
//         $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
//       }
//       if(!empty($colaboradorFiltro->antecedentePenales)){
//         $filter = $filter . ' and antecedentePenales= ' . $colaboradorFiltro->antecedentePenales;
//       }
//       if(!empty($colaboradorFiltro->autoPropio)){
//         $filter = $filter . ' and autoPropio= ' . $colaboradorFiltro->autoPropio;
//       }
//       if(!empty($colaboradorFiltro->dispuestoViajar)){
//         $filter = $filter . ' and dispuestoViajar= ' . $colaboradorFiltro->dispuestoViajar;
//       }
//       if(!empty($colaboradorFiltro->hijos)){
//         $filter = $filter . ' and hijos= ' . $colaboradorFiltro->hijos;
//       }
//       if(!empty($colaboradorFiltro->hijosViven)){
//         $filter = $filter . ' and hijosViven= ' . $colaboradorFiltro->hijosViven;
//       }
//       if(!empty($colaboradorFiltro->hacerComer)){
//         $filter = $filter . ' and hacerComer= ' . $colaboradorFiltro->hacerComer;
//       }
//       if(!empty($colaboradorFiltro->limpiarUtensiliosCocina)){
//         $filter = $filter . ' and limpiarUtensiliosCocina= ' . $colaboradorFiltro->limpiarUtensiliosCocina;
//       }
//       if(!empty($colaboradorFiltro->limpiarDormitorio)){
//         $filter = $filter . ' and limpiarDormitorio= ' . $colaboradorFiltro->limpiarDormitorio;
//       }
//       if(!empty($colaboradorFiltro->limpiarBano)){
//         $filter = $filter . ' and limpiarBano= ' . $colaboradorFiltro->limpiarBano;
//       }
//       if(!empty($colaboradorFiltro->ayudaPaciente)){
//         $filter = $filter . ' and ayudaPaciente= ' . $colaboradorFiltro->ayudaPaciente;
//       }
//       if(!empty($colaboradorFiltro->peso1) && !empty($colaboradorFiltro->peso2)){
//         $filter = $filter . ' and (peso between ' . $colaboradorFiltro->peso1 . ' and ' . $colaboradorFiltro->peso2 .' ) ';
//       }
//       if(!empty($colaboradorFiltro->estatura1) && !empty($colaboradorFiltro->estatura2)){
//         $filter = $filter . ' and (estatura between ' . $colaboradorFiltro->estatura1 . ' and ' . $colaboradorFiltro->estatura2 .' ) ';
//       }
//       if(!empty($colaboradorFiltro->calificacion1) && !empty($colaboradorFiltro->calificacion2)){
//         $filter = $filter . ' and (idCalificacion between ' . $colaboradorFiltro->calificacion1 . ' and ' . $colaboradorFiltro->calificacion2 .' ) ';
//       }
//       if(!empty($colaboradorFiltro->edad1) && !empty($colaboradorFiltro->edad2)){
//         $diaActual = new DateTime();
//         // $diaActual = date("Y-m-d");
//         $diaActualMin = new DateTime();
//         $diaActualMax = new DateTime();
//         $diaActualMax->sub(new DateInterval('P'.($colaboradorFiltro->edad2+1).'Y'));
//         $diaActualMax->add(new DateInterval('P1D'));
//         $diaActualMin->sub(new DateInterval('P'.($colaboradorFiltro->edad1).'Y'));
//         $diaActualConv = $diaActual->format('Y-m-d');
//         $diaActualMinConv = $diaActualMin->format('Y-m-d');
//         $diaActualMaxConv = $diaActualMax->format('Y-m-d');
//         $filter = $filter . ' and (fecha_nacimiento between \'' . $diaActualMaxConv . '\' and \'' . $diaActualMinConv .'\' ) ';
//       }
//       if(!empty($colaboradorFiltro->zonasLaborales)){
//           $filter = $filter . ' and colabzona.idZonaLaboral in  ( ';
//           $x =1;
//           foreach($colaboradorFiltro->zonasLaborales as $zonas){
//             $filter = $filter . $zonas->idZonaLaboral;
//             if($x < count($colaboradorFiltro->zonasLaborales)){
//               $filter = $filter . ',';
//               $x++;
//             }
//           }
//           $filter = $filter . ' ) ';
//       }
//     }
    
//     //  var_dump('select DISTINCT colab.* from ' . $this->table . ' colab '.
//     //  $filter . ' LIMIT '.$colaboradorFiltro->start.','. $colaboradorFiltro->limit);
   

//     $query = $this->db->query('select DISTINCT colab.* from ' . $this->table . ' colab '.
//                               $filter . ' LIMIT '.$colaboradorFiltro->start.','. $colaboradorFiltro->limit);
//     return $query->getResult();
//   } 

//   public function getColaboradoresNums($colaboradorFiltro) { 
//     if(!empty($colaboradorFiltro->zonasLaborales)){
//       $filter = ' inner join colaboradorzona colabzona on colab.idColaborador = colabzona.idColaborador where colab.idColaborador > 0 ';
//     } else{
//       $filter = ' where idColaborador > 0 ';  
//     }

//     if(!empty($colaboradorFiltro->genero)){
//       $filter = $filter . ' and idSexo= ' . $colaboradorFiltro->genero;
//     }
//     if(!empty($colaboradorFiltro->permanencia)){
//       $filter = $filter . ' and idPermanencia= ' . $colaboradorFiltro->permanencia;
//     }
//     if(!empty($colaboradorFiltro->atiendeCovid)){
//       $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
//     }
//     if(!empty($colaboradorFiltro->antecedentePenales)){
//       $filter = $filter . ' and antecedentePenales= ' . $colaboradorFiltro->antecedentePenales;
//     }
//     if(!empty($colaboradorFiltro->autoPropio)){
//       $filter = $filter . ' and autoPropio= ' . $colaboradorFiltro->autoPropio;
//     }
//     if(!empty($colaboradorFiltro->dispuestoViajar)){
//       $filter = $filter . ' and dispuestoViajar= ' . $colaboradorFiltro->dispuestoViajar;
//     }
//     if(!empty($colaboradorFiltro->hijos)){
//       $filter = $filter . ' and hijos= ' . $colaboradorFiltro->hijos;
//     }
//     if(!empty($colaboradorFiltro->hijosViven)){
//       $filter = $filter . ' and hijosViven= ' . $colaboradorFiltro->hijosViven;
//     }
//     if(!empty($colaboradorFiltro->hacerComer)){
//       $filter = $filter . ' and hacerComer= ' . $colaboradorFiltro->hacerComer;
//     }
//     if(!empty($colaboradorFiltro->limpiarUtensiliosCocina)){
//       $filter = $filter . ' and limpiarUtensiliosCocina= ' . $colaboradorFiltro->limpiarUtensiliosCocina;
//     }
//     if(!empty($colaboradorFiltro->limpiarDormitorio)){
//       $filter = $filter . ' and limpiarDormitorio= ' . $colaboradorFiltro->limpiarDormitorio;
//     }
//     if(!empty($colaboradorFiltro->limpiarBano)){
//       $filter = $filter . ' and limpiarBano= ' . $colaboradorFiltro->limpiarBano;
//     }
//     if(!empty($colaboradorFiltro->ayudaPaciente)){
//       $filter = $filter . ' and ayudaPaciente= ' . $colaboradorFiltro->ayudaPaciente;
//     }
//     if(!empty($colaboradorFiltro->peso1) && !empty($colaboradorFiltro->peso2)){
//       $filter = $filter . ' and (peso between ' . $colaboradorFiltro->peso1 . ' and ' . $colaboradorFiltro->peso2 .' ) ';
//     }
//     if(!empty($colaboradorFiltro->estatura1) && !empty($colaboradorFiltro->estatura2)){
//       $filter = $filter . ' and (estatura between ' . $colaboradorFiltro->estatura1 . ' and ' . $colaboradorFiltro->estatura2 .' ) ';
//     }
//     if(!empty($colaboradorFiltro->calificacion1) && !empty($colaboradorFiltro->calificacion2)){
//       $filter = $filter . ' and (idCalificacion between ' . $colaboradorFiltro->calificacion1 . ' and ' . $colaboradorFiltro->calificacion2 .' ) ';
//     }
//     if(!empty($colaboradorFiltro->edad1) && !empty($colaboradorFiltro->edad2)){
//       $diaActual = new DateTime();
//       // $diaActual = date("Y-m-d");
//       $diaActualMin = new DateTime();
//       $diaActualMax = new DateTime();
//       $diaActualMax->sub(new DateInterval('P'.($colaboradorFiltro->edad2+1).'Y'));
//       $diaActualMax->add(new DateInterval('P1D'));
//       $diaActualMin->sub(new DateInterval('P'.($colaboradorFiltro->edad1).'Y'));
//       $diaActualConv = $diaActual->format('Y-m-d');
//       $diaActualMinConv = $diaActualMin->format('Y-m-d');
//       $diaActualMaxConv = $diaActualMax->format('Y-m-d');
//       $filter = $filter . ' and (fecha_nacimiento between \'' . $diaActualMaxConv . '\' and \'' . $diaActualMinConv .'\' ) ';
//     }
//     if(!empty($colaboradorFiltro->zonasLaborales)){
//           $filter = $filter . ' and colabzona.idZonaLaboral in  ( ';
//           $x =1;
//           foreach($colaboradorFiltro->zonasLaborales as $zonas){
//             $filter = $filter . $zonas->idZonaLaboral;
//             if($x < count($colaboradorFiltro->zonasLaborales)){
//               $filter = $filter . ',';
//               $x++;
//             }
//           }
//           $filter = $filter . ' ) ';
//       }
      
//     /*var_dump('select * from ' . $this->table .
//                               $filter . ' LIMIT '.$colaboradorFiltro->limit.','. $colaboradorFiltro->start);
//     */
                                
//     $query = $this->db->query('select count(DISTINCT colab.idColaborador) total from ' . $this->table . ' colab '.
//                               $filter );
//     return $query->getResult();
//   }
  
//   public function getColaboradorId($colaboradorFiltro) { 
//     $filter = ' inner join colaboradorzona colabzona on colab.idColaborador = colabzona.idColaborador';
//     $filter = $filter . ' left join calificacion calificacionConId on colab.idCalificacion = calificacionConId.idCalificacion';
//     $filter = $filter . ' left join tipocolaborador tipoColaboradorConId on colab.idTipoColaborador = tipoColaboradorConId.idTipoColaborador';
//     $filter = $filter . ' left join pais paisNacimiento on colab.idPaisNacimiento = paisNacimiento.idPais';
//     $filter = $filter . ' left join estado estadoNacimiento on colab.idEstadoNacimiento = estadoNacimiento.idEstado';
//     $filter = $filter . ' left join ciudad ciudadNacimiento on colab.idCiudadNacimiento = ciudadNacimiento.idCiudad';
//     $filter = $filter . ' left join colonia coloniaDir on colab.idColonia = coloniaDir.idColonia';
//     $filter = $filter . ' left join ciudad ciudadDir on colab.idCiudad = ciudadDir.idCiudad';
//     $filter = $filter . ' left join estado estadoDir on colab.idEstado = estadoDir.idEstado';
//     $filter = $filter . ' left join pais paisDir on colab.idPais = paisDir.idPais';
//     $filter = $filter . ' left join sexocat genero on colab.idSexo = genero.idSexo';
//     $filter = $filter . ' left join tezcat tez on colab.idTez = tez.idTez';
//     $filter = $filter . ' left join estadocivilcat estadoCivil on colab.idEstadoCivil = estadoCivil.idEstadoCivil';
//     $filter = $filter . ' left join tipotelefono tipoTelefono1 on colab.idTipoTelefono = tipoTelefono1.idTipoTel';
//     $filter = $filter . ' left join tipotelefono tipoTelefono2 on colab.idTipoTelefono2 = tipoTelefono2.idTipoTel';
//     $filter = $filter . ' left join permanencia permanenciaColab on colab.idPermanencia = permanenciaColab.idPermanencia';

//     $query = $this->db->query('select DISTINCT colab.*, calificacionConId.nombre calificacionConId,
//     tipoColaboradorConId.nombre tipoColaboradorConId, 
//     paisNacimiento.nombre paisNacimiento, 
//     estadoNacimiento.nombre estadoNacimiento, 
//     ciudadNacimiento.nombre ciudadNacimiento,
//     coloniaDir.nombre coloniaDir,
//     ciudadDir.nombre ciudadDir,
//     estadoDir.nombre estadoDir,
//     paisDir.nombre paisDir,
//     genero.nombre genero,
//     tez.nombre tez,
//     estadoCivil.nombre estadoCivil,
//     tipoTelefono1.nombre tipoTelefono1,
//     tipoTelefono2.nombre tipoTelefono2,
//     permanenciaColab.nombre permanenciaColab from ' . $this->table . ' colab '.
//                               $filter . ' where colab.idColaborador =  '. $colaboradorFiltro);
//     return $query->getResult();
//   } 

}