<?php

namespace App\Controllers;
use App\Models\ServicioModel;
use App\Models\AsignacionColaboradorModel;
use App\Libraries\Twilio; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Servicio extends BaseController
{
	use ResponseTrait;

    public function lista()
    {
        $json = file_get_contents('php://input');
        $dataServicio = json_decode($json);
        $servicioModel = new ServicioModel();
        $servicios = $servicioModel->getServicios($dataServicio);
        
        $resp["data"]=$servicios;
        $resp["count"] =$servicioModel->getServiciosNums($dataServicio)[0];
        return $this->respond($resp);
    }

    public function lista1()
    {
        $json = file_get_contents('php://input');
        $dataServicio = json_decode($json);
        $servicioModel = new ServicioModel();
        $servicios = $servicioModel->getServicios1($dataServicio);
        
        $resp["data"]=$servicios;
        $resp["count"] =$servicioModel->getServiciosNums($dataServicio)[0];
        return $this->respond($resp);
    }

    public function lista2()
	{
        $servicioModel = new ServicioModel();
        $resp["data"]=$servicioModel->getServicios2();
		return $this->respond($resp);
	}

    // create
    public function create() {
        $servicioModel = new ServicioModel();
        $json = file_get_contents('php://input');
        $dataServicio = json_decode($json);
        $data = [
            'cliente'  => $dataServicio->cliente,
            'nombre'  => $dataServicio->nombre,
            'a_paterno'  => $dataServicio->a_paterno,
            'a_materno'  => $dataServicio->a_materno,
            'fecha_nacimiento'  => $dataServicio->fecha_nacimiento,
            'idPaisNacimiento'  => $dataServicio->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataServicio->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataServicio->idCiudadNacimiento,
            'calle1'  => $dataServicio->calle1,
            'calle2'  => $dataServicio->calle2,
            'noExt'  => $dataServicio->noExt,
            'noInt'  => $dataServicio->noInt,
            'codigoPostal'  => $dataServicio->codigoPostal,
            'idColonia'  => $dataServicio->idColonia,
            'idCiudad'  => $dataServicio->idCiudad,
            'idEstado'  => $dataServicio->idEstado,
            'idPais'  => $dataServicio->idPais,
            'referenciaDireccion'  => $dataServicio->referenciaDireccion,
            'idSexo'  => $dataServicio->idSexo,
            'idComplexion'  => $dataServicio->idComplexion,
            'peso'  => $dataServicio->peso,
            'estatura'  => $dataServicio->estatura,
            'idEstadoCivil'  => $dataServicio->idEstadoCivil,
            'telefono'  => $dataServicio->telefono,
            'idTipoTelefono'  => $dataServicio->idTipoTelefono,
            'correoElectronico'  => $dataServicio->correoElectronico,
            'idParentesco'  => $dataServicio->idParentesco,
            'nombreMedico'  => $dataServicio->nombreMedico,
            'especialidadMedico'  => $dataServicio->especialidadMedico,
            'telefonoMedico'  => $dataServicio->telefonoMedico,
            'correoElectronicoMedico'  => $dataServicio->correoElectronicoMedico,
            'enfermedades'  => $dataServicio->enfermedades,
            'procedimientos'  => $dataServicio->procedimientos,
            'medicamentos'  => $dataServicio->medicamentos,
            'notas'  => $dataServicio->notas,
            'tieneCovid'  => intval($dataServicio->tieneCovid),
            'tieneAlzheimer'  => intval($dataServicio->tieneAlzheimer),
            'movimiento'  => intval($dataServicio->movimiento),
            'idTipoServicio'  => $dataServicio->idTipoServicio,
            'idResponsable'  => $dataServicio->idResponsable,
            'precioServicio'  => $dataServicio->precioServicio,
            'cantidadPagada'  => $dataServicio->cantidadPagada,
            'cantidadPorPagar'  => $dataServicio->cantidadPorPagar,
            'colabReq'  => $dataServicio->colabReq,
            'pagoColaborador'  => $dataServicio->pagoColaborador,
            'estatus'  => $dataServicio->estatus,
            'fechaCreacion' =>date('Y-m-d H:m:s'),
            'estatusOperativo'  => $dataServicio->estatusOperativo,
            'estatusPago'  => $dataServicio->estatusPago,
            'fechaTerminacion'  => $dataServicio->fechaTerminacion,
        ];

        //Se crea el colaborador y regresa el id para sus relaciones
        $idServicio= $servicioModel->insert_data($data);

        $asignacionColaboradorModel = new AsignacionColaboradorModel();
        $asignacionColaboradorList = $dataServicio->colaboradores;

        foreach($asignacionColaboradorList as $colaborador1){            
            $colaborador = [
                'idServicio'=>$idServicio,
                'idColaborador'=>$colaborador1->idColaborador,
                'sueldo'=>$colaborador1->sueldo
            ];
            
            $asignacionColaboradorModel->insert_data($colaborador);
        }

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Servicio creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }

    // update
    public function update($id = null){
        $servicioModel = new ServicioModel();
        $json = file_get_contents('php://input');
        $dataServicio = json_decode($json);
        $id = $this->request->getVar('idServicio');
        $data = [
            'cliente'  => $dataServicio->cliente,
            'nombre'  => $dataServicio->nombre,
            'a_paterno'  => $dataServicio->a_paterno,
            'a_materno'  => $dataServicio->a_materno,
            'fecha_nacimiento'  => $dataServicio->fecha_nacimiento,
            'idPaisNacimiento'  => $dataServicio->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataServicio->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataServicio->idCiudadNacimiento,
            'calle1'  => $dataServicio->calle1,
            'calle2'  => $dataServicio->calle2,
            'noExt'  => $dataServicio->noExt,
            'noInt'  => $dataServicio->noInt,
            'codigoPostal'  => $dataServicio->codigoPostal,
            'idColonia'  => $dataServicio->idColonia,
            'idCiudad'  => $dataServicio->idCiudad,
            'idEstado'  => $dataServicio->idEstado,
            'idPais'  => $dataServicio->idPais,
            'referenciaDireccion'  => $dataServicio->referenciaDireccion,
            'idSexo'  => $dataServicio->idSexo,
            'idComplexion'  => $dataServicio->idComplexion,
            'peso'  => $dataServicio->peso,
            'estatura'  => $dataServicio->estatura,
            'idEstadoCivil'  => $dataServicio->idEstadoCivil,
            'telefono'  => $dataServicio->telefono,
            'idTipoTelefono'  => $dataServicio->idTipoTelefono,
            'correoElectronico'  => $dataServicio->correoElectronico,
            'idParentesco'  => $dataServicio->idParentesco,
            'nombreMedico'  => $dataServicio->nombreMedico,
            'especialidadMedico'  => $dataServicio->especialidadMedico,
            'telefonoMedico'  => $dataServicio->telefonoMedico,
            'correoElectronicoMedico'  => $dataServicio->correoElectronicoMedico,
            'enfermedades'  => $dataServicio->enfermedades,
            'procedimientos'  => $dataServicio->procedimientos,
            'medicamentos'  => $dataServicio->medicamentos,
            'notas'  => $dataServicio->notas,
            'tieneCovid'  => intval($dataServicio->tieneCovid),
            'tieneAlzheimer'  => intval($dataServicio->tieneAlzheimer),
            'movimiento'  => intval($dataServicio->movimiento),
            'idTipoServicio'  => $dataServicio->idTipoServicio,
            'idResponsable'  => $dataServicio->idResponsable,
            'precioServicio'  => $dataServicio->precioServicio,
            'cantidadPagada'  => $dataServicio->cantidadPagada,
            'cantidadPorPagar'  => $dataServicio->cantidadPorPagar,
            'colabReq'  => $dataServicio->colabReq,
            'pagoColaborador'  => $dataServicio->pagoColaborador,
            'estatus'  => $dataServicio->estatus,
            'fechaCreacion' =>date('Y-m-d H:m:s'),
            'estatusOperativo'  => $dataServicio->estatusOperativo,
            'estatusPago'  => $dataServicio->estatusPago,
            'fechaTerminacion'  => $dataServicio->fechaTerminacion,
        ];

        $servicioModel->update_data($id, $data);

        $colaboradoresAntes = $servicioModel->getColaboradoresAntes($id);
        // var_dump($dataServicio->colaboradores);
        // $asignacionColaboradorModel = new AsignacionColaboradorModel();
        $asignacionColaboradorList = $dataServicio->colaboradores;
        $colaboradoresBorrar = [];
        $x = 0;
        foreach($colaboradoresAntes as $colaboradoresAnt){ 
            $existe = false;          
            foreach($asignacionColaboradorList as $colaboradoresNuevos){
                if ($colaboradoresNuevos->idColaborador == $colaboradoresAnt->idColaborador) {
                    $existe = true;
                }
            }
            if(!$existe) {
                $colaboradoresBorrar[$x] = $colaboradoresAnt;
                $x++;
            }
        }

        foreach($colaboradoresBorrar as $colaboradorBorrar) {
            $servicioModel->eliminarColaboradores($id,$colaboradorBorrar);
        }  

        $colaboradoresAntes = $servicioModel->getColaboradoresAntes($id);
        $colaboradoresAgregar = [];
        $y = 0;
        foreach($dataServicio->colaboradores as $colaboradoresNuevos) {
            $existe = false;
            foreach($colaboradoresAntes as $colaboradoresAnt) {
                if ($colaboradoresAnt->idColaborador == $colaboradoresNuevos->idColaborador) {
                    $existe = true;
                }
            }
            if(!$existe) {
                $colaboradoresAgregar[$y] = $colaboradoresNuevos;
                $y++;
            }
        }

        foreach($colaboradoresAgregar as $colaboradorAgregar){
            $servicioModel->agregarColaboradores($id,$colaboradorAgregar);
        }

            // $colaboradoresBorrar = [
            //     'idServicio'=>$idServicio,
            //     'idColaborador'=>$colaborador1->idColaborador
            // ];    
            // $colaborador = [
            //     'idServicio'=>$idServicio,
            //     'idColaborador'=>$colaborador1->idColaborador
            // ];
            
            // $asignacionColaboradorModel->update_data($colaborador);


        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Servicio Actualizado'
          ]
      ];
      return $this->respond($response);
    }

    // update pago
    public function updatePago($id = null){
        $servicioModel = new ServicioModel();
        $json = file_get_contents('php://input');
        $dataServicio = json_decode($json);
        $id = $this->request->getVar('idServicio');
        $data = [
            'cliente'  => $dataServicio->cliente,
            'nombre'  => $dataServicio->nombre,
            'a_paterno'  => $dataServicio->a_paterno,
            'a_materno'  => $dataServicio->a_materno,
            'fecha_nacimiento'  => $dataServicio->fecha_nacimiento,
            'idPaisNacimiento'  => $dataServicio->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataServicio->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataServicio->idCiudadNacimiento,
            'calle1'  => $dataServicio->calle1,
            'calle2'  => $dataServicio->calle2,
            'noExt'  => $dataServicio->noExt,
            'noInt'  => $dataServicio->noInt,
            'codigoPostal'  => $dataServicio->codigoPostal,
            'idColonia'  => $dataServicio->idColonia,
            'idCiudad'  => $dataServicio->idCiudad,
            'idEstado'  => $dataServicio->idEstado,
            'idPais'  => $dataServicio->idPais,
            'referenciaDireccion'  => $dataServicio->referenciaDireccion,
            'idSexo'  => $dataServicio->idSexo,
            'idComplexion'  => $dataServicio->idComplexion,
            'peso'  => $dataServicio->peso,
            'estatura'  => $dataServicio->estatura,
            'idEstadoCivil'  => $dataServicio->idEstadoCivil,
            'telefono'  => $dataServicio->telefono,
            'idTipoTelefono'  => $dataServicio->idTipoTelefono,
            'correoElectronico'  => $dataServicio->correoElectronico,
            'idParentesco'  => $dataServicio->idParentesco,
            'nombreMedico'  => $dataServicio->nombreMedico,
            'especialidadMedico'  => $dataServicio->especialidadMedico,
            'telefonoMedico'  => $dataServicio->telefonoMedico,
            'correoElectronicoMedico'  => $dataServicio->correoElectronicoMedico,
            'enfermedades'  => $dataServicio->enfermedades,
            'procedimientos'  => $dataServicio->procedimientos,
            'medicamentos'  => $dataServicio->medicamentos,
            'notas'  => $dataServicio->notas,
            'tieneCovid'  => intval($dataServicio->tieneCovid),
            'tieneAlzheimer'  => intval($dataServicio->tieneAlzheimer),
            'movimiento'  => intval($dataServicio->movimiento),
            'idTipoServicio'  => $dataServicio->idTipoServicio,
            'idResponsable'  => $dataServicio->idResponsable,
            'precioServicio'  => $dataServicio->precioServicio,
            'cantidadPagada'  => $dataServicio->cantidadPagada,
            'cantidadPorPagar'  => $dataServicio->cantidadPorPagar,
            'colabReq'  => $dataServicio->colabReq,
            'pagoColaborador'  => $dataServicio->pagoColaborador,
            'estatus'  => $dataServicio->estatus,
            'estatusOperativo'  => $dataServicio->estatusOperativo,
            'estatusPago'  => $dataServicio->estatusPago,
            'fechaTerminacion'  => $dataServicio->fechaTerminacion,
        ];

        $servicioModel->update_data($id, $data);

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Pago Actualizado'
          ]
      ];
      return $this->respond($response);
    }

    public function datos()
	{
		$servicioModel = new ServicioModel();	
		$resp["data"]=$servicioModel->getDatos($this->request->getVar('idServicio'));
		return $this->respond($resp);
	}

    public function datosServClien()
	{
		$servicioModel = new ServicioModel();
		$resp["data"]=$servicioModel->getDatosServClien($this->request->getVar('idCliente'));
		return $this->respond($resp);
	}

    public function datosServColab()
	{
		$servicioModel = new ServicioModel();
		$resp["data"]=$servicioModel->getDatosServColab($this->request->getVar('idServicio'));
		return $this->respond($resp);
	}

    // delete
    // public function delete($id = null){
    //     $colaboradorModel = new ColaboradorModel();
    //     $id = $this->request->getVar('num_colaborador');
    //                 $colaboradorModel->delete_data($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'messages' => [
    //                 'success' => 'Employee successfully deleted'
    //             ]
    //         ];
    //         return $this->respondDeleted($response);
        
    // }

    // colaboradorId
    // public function colaboradorId(){
    //     $colaboradorModel = new ColaboradorModel();
    //     $cuentaColaboradorModel = new CuentaColaboradorModel();
    //     $estudioModel = new EstudioModel();
    //     $experienciaModel = new ExperienciaModel();
    //     $id = $this->request->getVar('idColaborador');
    //     $colaborador=$colaboradorModel->getColaboradorId($id);
    //     $colaborador["cuentas"] = $cuentaColaboradorModel->getContactosColaborador($id);
    //     $colaborador["estudios"] = $estudioModel->getEstudiosColaborador($id);
    //     $colaborador["experiencia"] = $experienciaModel->getExperienciasColaborador($id);

    //     $resp["data"] = $colaborador;

    //     return $this->respond($resp);        
    // }

    // public function enviaMensaje(){
    //     $json = file_get_contents('php://input');
    //     $dataServicio = json_decode($json);

        

    //     $resp["data"] = $colaborador;

    //     return $this->respond($resp);        
    // }

}