<?php

namespace App\Controllers;
use App\Models\ColaboradorModel;
use App\Models\ContactoColaboradorModel;
use App\Models\CuentaColaboradorModel;
use App\Models\ExperienciaModel;
use App\Models\EstudioModel;
use App\Models\ZonaModel;
use App\Libraries\Twilio; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Colaborador extends BaseController
{
	use ResponseTrait;

	public function lista()
    {
        $json = file_get_contents('php://input');
        $dataColaborador = json_decode($json);
        $colaboradorModel = new ColaboradorModel();
        $colaboradores = $colaboradorModel->getColaboradores($dataColaborador);
        
        if(!empty($dataColaborador->habilidades)){
            $colabs=[];
            $x=0;
            foreach($colaboradores as $colaborador) { 
                $filtroFind = false;                
                foreach(json_decode($colaborador->habilidades) as $habilidad) { 
                    foreach($dataColaborador->habilidades as $habilidadFiltro) { 
                        if($habilidadFiltro->nombre == $habilidad->nombre){
                            $filtroFind = true;
                        }
                    }
                    
                }
                if($filtroFind){
                    $colabs[$x]=$colaborador;
                    $x++;
                }
            }
            $colaboradores =$colabs;    
        }

        if(!empty($dataColaborador->diasLaborales) && empty($dataColaborador->turnoHorario)){
            $colabs=[];
            $x=0;
            foreach($colaboradores as $colaborador) {
                $filtroFind = false;   
                $diaLaboral1 = json_decode($colaborador->horario);
                if (sizeof($dataColaborador->diasLaborales) == 7){
                    if ($diaLaboral1->todosDias){
                        $filtroFind = true;
                    }
                } else {
                foreach($dataColaborador->diasLaborales as $diaLaboralFiltro){
                    if($diaLaboralFiltro->nombre == "Lunes"){
                        if($diaLaboral1->lunes){
                            // if($diaLaboral1->lunesTurno ==){
                            //     $filtroFind = true;
                            // }
                            $filtroFind = true;
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Martes"){
                        if($diaLaboral1->martes){
                            $filtroFind = true;
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Miercoles"){
                        if($diaLaboral1->miercoles){
                            $filtroFind = true;
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Jueves"){
                        if($diaLaboral1->jueves){
                            $filtroFind = true;
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Viernes"){
                        if($diaLaboral1->viernes){
                            $filtroFind = true;
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Sabado"){
                        if($diaLaboral1->sabado){
                            $filtroFind = true;
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Domingo"){
                        if($diaLaboral1->domingo){
                            $filtroFind = true;
                        }
                    }
                }
            }
                // var_dump(json_decode($colaborador->horario));
                //  foreach(json_decode($colaborador->horario) as $diaLaboral) { 
                //     foreach($dataColaborador->diasLaborales as $diaLaboralFiltro) {
                //         var_dump($diaLaboralFiltro);
                //         // if($diaLaboralFiltro->nombre == "Lunes"){
                //         //     if($diaLaboral->lunes){
                //         //         $filtroFind = true;
                //         //     }
                //         // }
                //     }                   
                //  }
                if($filtroFind){
                    $colabs[$x]=$colaborador;
                    $x++;
                }
            }
            $colaboradores =$colabs;    
        } else if (!empty($dataColaborador->diasLaborales) && !empty($dataColaborador->turnoHorario)){
            $colabs=[];
            $x=0;
            foreach($colaboradores as $colaborador) {
                $filtroFind = false;   
                $diaLaboral1 = json_decode($colaborador->horario);
                if (sizeof($dataColaborador->diasLaborales) == 7){
                    if ($diaLaboral1->todosDias){
                        if($diaLaboral1->todosDiasTurno == $dataColaborador->turnoHorario){
                            $filtroFind = true;
                        }
                    }
                } else {
                foreach($dataColaborador->diasLaborales as $diaLaboralFiltro){
                    if($diaLaboralFiltro->nombre == "Lunes"){
                        if($diaLaboral1->lunes){
                            if($diaLaboral1->lunesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Martes"){
                        if($diaLaboral1->martes){
                            if($diaLaboral1->martesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Miercoles"){
                        if($diaLaboral1->miercoles){
                            if($diaLaboral1->miercolesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Jueves"){
                        if($diaLaboral1->jueves){
                            if($diaLaboral1->juevesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Viernes"){
                        if($diaLaboral1->viernes){
                            if($diaLaboral1->viernesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Sabado"){
                        if($diaLaboral1->sabado){
                            if($diaLaboral1->sabadoTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                    if($diaLaboralFiltro->nombre == "Domingo"){
                        if($diaLaboral1->domingo){
                            if($diaLaboral1->domingoTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    }
                }
            }
                // var_dump(json_decode($colaborador->horario));
                //  foreach(json_decode($colaborador->horario) as $diaLaboral) { 
                //     foreach($dataColaborador->diasLaborales as $diaLaboralFiltro) {
                //         var_dump($diaLaboralFiltro);
                //         // if($diaLaboralFiltro->nombre == "Lunes"){
                //         //     if($diaLaboral->lunes){
                //         //         $filtroFind = true;
                //         //     }
                //         // }
                //     }                   
                //  }
                if($filtroFind){
                    $colabs[$x]=$colaborador;
                    $x++;
                }
            }
            $colaboradores =$colabs;
        } else if (empty($dataColaborador->diasLaborales) && !empty($dataColaborador->turnoHorario)){
            $colabs=[];
            $x=0;
            foreach($colaboradores as $colaborador) {
                $filtroFind = false;   
                $diaLaboral1 = json_decode($colaborador->horario);
                // if (sizeof($dataColaborador->diasLaborales) == 7){
                    if ($diaLaboral1->todosDias){
                        if($diaLaboral1->todosDiasTurno == $dataColaborador->turnoHorario){
                            $filtroFind = true;
                        }
                    }
                // } else {
                // foreach($dataColaborador->diasLaborales as $diaLaboralFiltro){
                    // if($diaLaboralFiltro->nombre == "Lunes"){
                        if($diaLaboral1->lunes){
                            if($diaLaboral1->lunesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                    // if($diaLaboralFiltro->nombre == "Martes"){
                        if($diaLaboral1->martes){
                            if($diaLaboral1->martesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                    // if($diaLaboralFiltro->nombre == "Miercoles"){
                        if($diaLaboral1->miercoles){
                            if($diaLaboral1->miercolesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                    // if($diaLaboralFiltro->nombre == "Jueves"){
                        if($diaLaboral1->jueves){
                            if($diaLaboral1->juevesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                    // if($diaLaboralFiltro->nombre == "Viernes"){
                        if($diaLaboral1->viernes){
                            if($diaLaboral1->viernesTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                    // if($diaLaboralFiltro->nombre == "Sabado"){
                        if($diaLaboral1->sabado){
                            if($diaLaboral1->sabadoTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                    // if($diaLaboralFiltro->nombre == "Domingo"){
                        if($diaLaboral1->domingo){
                            if($diaLaboral1->domingoTurno == $dataColaborador->turnoHorario){
                                $filtroFind = true;
                            }
                        }
                    // }
                // }
            // }
                // var_dump(json_decode($colaborador->horario));
                //  foreach(json_decode($colaborador->horario) as $diaLaboral) { 
                //     foreach($dataColaborador->diasLaborales as $diaLaboralFiltro) {
                //         var_dump($diaLaboralFiltro);
                //         // if($diaLaboralFiltro->nombre == "Lunes"){
                //         //     if($diaLaboral->lunes){
                //         //         $filtroFind = true;
                //         //     }
                //         // }
                //     }                   
                //  }
                if($filtroFind){
                    $colabs[$x]=$colaborador;
                    $x++;
                }
            }
            $colaboradores =$colabs;
        }
        /*if(!empty($dataColaborador->zonasLaborales)){
            $colabs=[];
            $x=0;
            foreach($colaboradores as $colaborador) { 
                $filtroFind = false;                
                foreach(json_decode($colaborador->zonasLaborales) as $zonaLaboral) { 
                    foreach($dataColaborador->zonasLaborales as $zonaFiltro) { 
                        if($zonaFiltro->nombre == $zonaLaboral->nombre){
                            $filtroFind = true;
                        }
                    }
                    
                }
                if($filtroFind){
                    $colabs[$x]=$colaborador;
                    $x++;
                }
            }
            $colaboradores =$colabs;    
        }*/

        $resp["data"]=$colaboradores;
        $resp["count"] =$colaboradorModel->getColaboradoresNums($dataColaborador)[0];
        return $this->respond($resp);
    }

    // create
    public function create() {
        $colaboradorModel = new ColaboradorModel();
        $json = file_get_contents('php://input');
        $dataColaborador = json_decode($json);
        $data = [
            'nombre'  => $dataColaborador->nombre,
            'a_paterno'  => $dataColaborador->a_paterno,
            'a_materno'  => $dataColaborador->a_materno,
            'correoElectronico'  => $dataColaborador->correoElectronico,
            'hijos'  => intval($dataColaborador->hijos),
            'hijosViven'  => intval($dataColaborador->hijosViven),
            'idGradoEstudio'  => $dataColaborador->idGradoEstudio,
            'telefono'  => $dataColaborador->telefono,
            'idTipoTelefono'  => $dataColaborador->idTipoTelefono,
            'telefono2'  => $dataColaborador->telefono2,
            'idTipoTelefono2'  => $dataColaborador->idTipoTelefono2,
            'foto'  => $dataColaborador->foto,
            'fotoNombre'=> $dataColaborador->fotoNombre,
            'idCalificacion'=> $dataColaborador->idCalificacion,
            'idTipoColaborador'=> $dataColaborador->idTipoColaborador,
            'observaciones'=> $dataColaborador->observaciones,
            'rfc' => $dataColaborador->rfc,
            'nss'  => $dataColaborador->nss,
            'fecha_nacimiento'  => $dataColaborador->fecha_nacimiento,
            'idPaisNacimiento'  => $dataColaborador->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataColaborador->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataColaborador->idCiudadNacimiento,
            'comprobanteDomicilio'  => $dataColaborador->comprobanteDomicilio,
            'comprobanteNombre'  => $dataColaborador->comprobanteNombre,
            'idSexo'  => $dataColaborador->idSexo,
            'peso'  => $dataColaborador->peso,
            'estatura'  => $dataColaborador->estatura,
            'idEstadoCivil'  => $dataColaborador->idEstadoCivil,
            'idTez'  => $dataColaborador->idTez,
            'sgmm'  => $dataColaborador->sgmm,
            'atiendeCovid'  => intval($dataColaborador->atiendeCovid),
            'antecedentePenales'  => intval($dataColaborador->antecedentePenales),
            'autoPropio'  => intval($dataColaborador->autoPropio),
            'licenciaManejar'  => intval($dataColaborador->licenciaManejar),
            'dispuestoViajar'  => intval($dataColaborador->dispuestoViajar),
            'visa'  => intval($dataColaborador->visa),
            'visaNumero'  => $dataColaborador->visaNumero,
            'tipoVisa'  => $dataColaborador->tipoVisa,
            'expiracionVisa'  => $dataColaborador->expiracionVisa,
            'visaImagen'  => $dataColaborador->visaImagen,
            'visaNombre'  => $dataColaborador->visaNombre,
            'pasaporte'  => intval($dataColaborador->pasaporte),
            'pasaporteNumero'  => $dataColaborador->pasaporteNumero,
            'expiracionPasaporte'  => $dataColaborador->expiracionPasaporte,
            'pasaporteImagen'  => $dataColaborador->pasaporteImagen,
            'hacerComer'  => intval($dataColaborador->hacerComer),
            'limpiarUtensiliosCocina'  => intval($dataColaborador->limpiarUtensiliosCocina),
            'limpiarDormitorio'  => intval($dataColaborador->limpiarDormitorio),
            'limpiarBano'  => intval($dataColaborador->limpiarBano),
            'ayudaPaciente'  => intval($dataColaborador->ayudaPaciente),
            'pasaporteNombre'  => $dataColaborador->pasaporteNombre,
            'ine1'  => $dataColaborador->ine1,
            'ine2'  => $dataColaborador->ine2,
            'ine1Nombre'  => $dataColaborador->ine1Nombre,
            'ine2Nombre'  => $dataColaborador->ine2Nombre,
            'idPermanencia'  => $dataColaborador->idPermanencia,
            'idEstatus'  => $dataColaborador->idEstatus,
            'calle1'  => $dataColaborador->calle1,
            'calle2'  => $dataColaborador->calle2,
            'codigoPostal'  => $dataColaborador->codigoPostal,
            'idPais'  => $dataColaborador->idPais,
            'idEstado'  => $dataColaborador->idEstado,
            'idCiudad'  => $dataColaborador->idCiudad,
            'idColonia'  => $dataColaborador->idColonia,
            'noExt'  => $dataColaborador->noExt,
            'noInt'  => $dataColaborador->noInt,
            'horario'  => json_encode($dataColaborador->horario),
            'habilidades'  => json_encode($dataColaborador->habilidades),
            'especialidades'  => json_encode($dataColaborador->especialidades),
            'fechaCreacion' =>date('Y-m-d H:m:s')
        ];

        //Se crea el colaborador y regresa el id para sus relaciones
        $colaborador= $colaboradorModel->insert_data($data);

        // Se guardan los contactos del colaborador
        $contactoColaboradorModel = new ContactoColaboradorModel();
        $contactosColaboradorList = $dataColaborador->contactosColaborador;

        foreach($contactosColaboradorList as $contacto1){            
            $contacto = [
                'idColaborador'=>$colaborador,
                'nombre'  => $contacto1->nombre,
                'correoElectronico'  => $contacto1->correoElectronico,
                'telefono'  => $contacto1->telefono,
                'idParentesco' =>$contacto1->idParentesco
            ];
            
            $contactoColaboradorModel->insert_data($contacto);
        }

        // Se guardan las cuentas del colaborador
        $cuentaColaboradorModel = new CuentaColaboradorModel();
        $cuentasColaboradorList = $dataColaborador->cuentasColaborador;

        foreach($cuentasColaboradorList as $cuenta1){            
            $cuenta = [
                'idColaborador'=>$colaborador,
                'idBanco'  => $cuenta1->banco->idBanco,
                'beneficiario' => $cuenta1->nombre,
                'numero'  => $cuenta1->numero,
                'tipoCuenta' => $cuenta1->tipoCuenta
            ];
            $cuentaColaboradorModel->insert_data($cuenta);
        }

        // Se guardan las experiencias del colaborador
        $experienciaModel = new ExperienciaModel();
        $experienciasList = $dataColaborador->experiencias;

        foreach($experienciasList as $experiencia1){            
            $experiencia = [
                'idColaborador'=>$colaborador,
                'empresa'  => $experiencia1->empresa,
                'fechaInicio'  => date('Y-m-d',strtotime($experiencia1->fechaInicio)),
                'fechaFin'  => date('Y-m-d',strtotime($experiencia1->fechaFin)),
                'referencia'  => $experiencia1->referencia,
                'comentario'  => $experiencia1->comentario,
                'telefono'  => $experiencia1->telefono
            ];
            $experienciaModel->insert_data($experiencia);
        }

        // Se guardan los estudios del colaborador
        $estudioModel = new EstudioModel();
        $estudiosList = $dataColaborador->estudios;

        foreach($estudiosList as $estudio1){            
            $estudio = [
                'idColaborador'=>$colaborador,
                'institucion'  => $estudio1->institucion,
                'fechaInicio'  => date('Y-m-d',strtotime($estudio1->fechaInicio)),
                'fechaFin'  => date('Y-m-d',strtotime($estudio1->fechaFin)),
                'cedula'  => $estudio1->cedula,
                'comentarios'  => $estudio1->comentarios,
                'idEstatus'  => intval($estudio1->estatus->idEstatus)
            ];
            $estudioModel->insert_data($estudio);
        }

        // Se guardan las Zonas del colaborador
        $zonaModel = new ZonaModel();
        $zonasList = $dataColaborador->zonas;

        foreach($zonasList as $zona1){            
            $zona = [
                'idColaborador'=>$colaborador,
                'idZonaLaboral'  => $zona1->idZonaLaboral
            ];
            $zonaModel->insert_data($zona);
        }

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Colaborador creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }

    // update
    public function update($id = null){
        $colaboradorModel = new ColaboradorModel();
        $id = $this->request->getVar('num_colaborador');
        $data = [
            'rfc' => $this->request->getVar('rfc'),
            'foto'  => $this->request->getVar('foto'),
            'nombre'  => $this->request->getVar('nombre'),
            'a_paterno'  => $this->request->getVar('a_paterno'),
            'a_materno'  => $this->request->getVar('a_materno'),
            'nss'  => $this->request->getVar('nss'),
            'ine'  => $this->request->getVar('ine'),
            'fecha_nacimiento'  => $this->request->getVar('fecha_nacimiento'),
            'ldn_ciudad'  => $this->request->getVar('ldn_ciudad'),
            'ldn_pais'  => $this->request->getVar('ldn_pais'),
            'calle1'  => $this->request->getVar('calle1'),
            'calle2'  => $this->request->getVar('calle2'),
            'no_ext'  => $this->request->getVar('no_ext'),
            'no_int'  => $this->request->getVar('no_int'),
            'colonia'  => $this->request->getVar('colonia'),
            'ciudad'  => $this->request->getVar('ciudad'),
            'estado'  => $this->request->getVar('estado'),
            'pais'  => $this->request->getVar('pais'),
            'codigo_postal'  => $this->request->getVar('codigo_postal'),
            'comprobante'  => $this->request->getVar('comprobante'),
            'sexo'  => $this->request->getVar('sexo'),
            'peso'  => $this->request->getVar('peso'),
            'tez'  => $this->request->getVar('tez'),
            'estado_civil'  => $this->request->getVar('estado_civil'),
            'telefono1'  => $this->request->getVar('telefono1'),
            'telefono1_tipo'  => $this->request->getVar('telefono1_tipo'),
            'telefono2'  => $this->request->getVar('telefono2'),
            'telefono2_tipo'  => $this->request->getVar('telefono2_tipo'),
            'correo_electronico'  => $this->request->getVar('correo_electronico'),
            'hijos'  => $this->request->getVar('hijos'),
            'hijosViven'  => $this->request->getVar('hijosViven'),
            'sgmm'  => $this->request->getVar('sgmm'),
            'aseguradora'  => $this->request->getVar('aseguradora'),
            'permanencia'  => $this->request->getVar('permanencia'),
            'atiende_covid'  => $this->request->getVar('atiende_covid'),
            'a_penales'  => $this->request->getVar('a_penales'),
            'disp_viajar'  => $this->request->getVar('disp_viajar'),
            'visa'  => $this->request->getVar('visa'),
            'num_visa'  => $this->request->getVar('num_visa'),
            'tipo_visa'  => $this->request->getVar('tipo_visa'),
            'fechaexp_visa'  => $this->request->getVar('fechaexp_visa'),
            'pasaporte'  => $this->request->getVar('pasaporte'),
            'num_pasaporte'  => $this->request->getVar('num_pasaporte'),
            'fechaexp_pasaporte'  => $this->request->getVar('fechaexp_pasaporte'),
            'hacerComer'  => $this->request->getVar('hacerComer'),
            'limpiarUtensiliosCocina'  => $this->request->getVar('limpiarUtensiliosCocina'),
            'limpiarDormitorio'  => $this->request->getVar('limpiarDormitorio'),
            'limpiarBano'  => $this->request->getVar('limpiarBano'),
            'ayudaPaciente'  => $this->request->getVar('ayudaPaciente'),
            'referencia'  => $this->request->getVar('referencia'),
            'estatura'  => $this->request->getVar('estatura'),
            'contacto1'  => $this->request->getVar('contacto1'),
            'parentesco_con1'  => $this->request->getVar('parentesco_con1'),
            'telefono_con1'  => $this->request->getVar('telefono_con1'),
            'correo_con1'  => $this->request->getVar('correo_con1'),
            'contacto2'  => $this->request->getVar('contacto2'),
            'parentesco_con2'  => $this->request->getVar('parentesco_con2'),
            'telefono_con2'  => $this->request->getVar('telefono_con2'),
            'correo_con2'  => $this->request->getVar('correo_con2'),
            'zona_laboral'  => $this->request->getVar('zona_laboral'),
            'auto_propio'  => $this->request->getVar('auto_propio'),
            'licenciaManejar'  => $this->request->getVar('licenciaManejar')
        ];

        $colaboradorModel->update_data($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Employee updated successfully'
          ]
      ];
      return $this->respond($response);
    }

    // delete
    public function delete($id = null){
        $colaboradorModel = new ColaboradorModel();
        $id = $this->request->getVar('num_colaborador');
                    $colaboradorModel->delete_data($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        
    }

    // colaboradorId
    public function colaboradorId(){
        $colaboradorModel = new ColaboradorModel();
        $cuentaColaboradorModel = new CuentaColaboradorModel();
        $estudioModel = new EstudioModel();
        $experienciaModel = new ExperienciaModel();
        $id = $this->request->getVar('idColaborador');
        $colaborador=$colaboradorModel->getColaboradorId($id);
        $colaborador["cuentas"] = $cuentaColaboradorModel->getContactosColaborador($id);
        $colaborador["estudios"] = $estudioModel->getEstudiosColaborador($id);
        $colaborador["experiencia"] = $experienciaModel->getExperienciasColaborador($id);

        $resp["data"] = $colaborador;

        return $this->respond($resp);        
    }

    public function enviaMensaje(){
        $json = file_get_contents('php://input');
        $dataColaborador = json_decode($json);

        

        $resp["data"] = $colaborador;

        return $this->respond($resp);        
    }

}
